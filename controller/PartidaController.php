<?php
include_once('./model/PartidaModel.php');

class PartidaController
{
	private $renderer;
	private $partidaModel;

	public function __construct($renderer, $partidaModel)
	{
		$this->renderer = $renderer;
		$this->partidaModel = $partidaModel;
	}

	public function pregunta()
	{
		$idusuario = $_SESSION['usuario']['id'];
		$this->partidaModel->crearPartida();
		$lista_preguntas = $this->partidaModel->obtenerListaPreguntas($idusuario);
		$_SESSION['lista_preguntas'] = $lista_preguntas;
		$_SESSION['puntaje'] = 0;
		$_SESSION['idPartida'] = $this->partidaModel->getIdPartida();
		$contexto = array(
			'nroPregunta' => ($_SESSION['puntaje'] + 1),
			'puntos' => $_SESSION['puntaje'],
			'tiempoLimite' => 10
		);
		$this->renderer->render("pregunta", $contexto);
	}

	public function siguientePregunta()
	{
		$idusuario = $_SESSION['usuario']['id'];
		$idPartida = $_SESSION['idPartida'];
		$lista_preguntas = $_SESSION['lista_preguntas'];
		if (empty($lista_preguntas)) {
			$this->partidaModel->reiniciarPreguntas($idPartida);
			$lista_preguntas = $this->partidaModel->obtenerListaPreguntas($idusuario);
		}
		$pregunta = $this->partidaModel->obtenerPreguntaAleatoria($lista_preguntas);
		$this->partidaModel->almacenarPregunta($idPartida, $pregunta['id']);
		$indice = array_search($pregunta, $lista_preguntas);
		array_splice($lista_preguntas, $indice, 1);
		$_SESSION['lista_preguntas'] = $lista_preguntas;
		$this->partidaModel->sumarPreguntaALaEstadistica($pregunta['id']);
		$this->partidaModel->sumarPreguntaAlJugador($idPartida);

		echo json_encode($pregunta);
	}

	public function responder()
	{
		$idPartida = $_SESSION['idPartida'];

		$datos = array(
			'idPregunta' => $_POST['id_pregunta'],
			'respuesta_seleccionada' => $_POST['respuesta_seleccionada']
		);

		$esLaRespuestaCorrecta = $this->partidaModel->consultarSiLaRespuestaEsCorrecta($datos);

		$contexto = array(
			'esLaRespuestaCorrecta' => $esLaRespuestaCorrecta,
			'respuesta' => $datos['respuesta_seleccionada']
		);

		if ($esLaRespuestaCorrecta) {
			$_SESSION['puntaje']++;
			$contexto['puntos'] = $_SESSION['puntaje'];
			$this->partidaModel->sumarPreguntaCorrectaALaEstadistica($datos['idPregunta']);
			$this->partidaModel->sumarPreguntaCorrectaAlJugador($idPartida);
		} else {
			$contexto['respuesta_correcta'] = $this->partidaModel->obtenerRespuestaCorrecta($datos['idPregunta']);
			$contexto['puntos'] = $_SESSION['puntaje'];
			$this->partidaModel->actualizarPuntaje($_SESSION['puntaje'], $idPartida);
			unset($_SESSION['lista_preguntas']);
			unset($_SESSION['puntaje']);
		}
		$this->partidaModel->actualizarPorcentajeAciertoPregunta($datos['idPregunta']);
		echo json_encode($contexto);
	}

	public function totalPuntaje()
	{
		$idPartida = $_SESSION['idPartida'];
		$contexto['total'] = $_SESSION['puntaje'];

		$this->partidaModel->actualizarPuntaje($_SESSION['puntaje'], $idPartida);
		echo json_encode($contexto);
	}

	public function reportarPregunta()
	{
		$id_pregunta = $_POST['id_pregunta'];
		$this->partidaModel->reportarPregunta($id_pregunta);
	}

}
