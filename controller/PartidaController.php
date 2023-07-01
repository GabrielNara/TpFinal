<?php
include_once('./model/PartidaModel.php');
include_once('./model/LobbyModel.php');

class PartidaController
{
	private $renderer;
	private $partidaModel;
	private $lobbyModel;

	public function __construct($renderer, $partidaModel, $lobbyModel)
	{
		$this->renderer = $renderer;
		$this->partidaModel = $partidaModel;
		$this->lobbyModel = $lobbyModel;
	}

	public function redireccionamiento()
	{
		if (!isset($_SESSION['usuario']) || !$this->lobbyModel->estaValidadoElCorreoUsuario($_SESSION['usuario']['email'])) {
			header('Location: /tpfinal/');
			exit();
		}
	}

	public function pregunta()
	{
		$this->redireccionamiento();
		$this->partidaModel->crearPartida();
		$_SESSION['lista_preguntas'] = $this->partidaModel->obtenerListaPreguntas($_SESSION['usuario']['id']);
		$_SESSION['puntaje'] = 0;
		$_SESSION['idPartida'] = $this->partidaModel->getIdPartida();
		$trampitas = $this->partidaModel->getTrampitasUsuario($_SESSION['usuario']['id']);
		$contexto = array(
			'nroPregunta' => ($_SESSION['puntaje'] + 1),
			'puntos' => $_SESSION['puntaje'],
			'tiempoLimite' => 10,
			'trampitas' => $trampitas
		);
		$this->renderer->render("pregunta", $contexto);
	}

	public function siguientePregunta()
	{
		if (!isset($_SESSION['lista_preguntas'])) {
			$_SESSION['lista_preguntas'] = $this->partidaModel->obtenerListaPreguntas($_SESSION['usuario']['id']);
		}
		$pregunta = $this->partidaModel->obtenerPreguntaAleatoria($_SESSION['lista_preguntas']);
		$indice = array_search($pregunta, $_SESSION['lista_preguntas']);
		unset($_SESSION['lista_preguntas'][$indice]);
		$this->partidaModel->sumarPreguntaALaEstadistica($pregunta['id']);
		$this->partidaModel->sumarPreguntaAlJugador($_SESSION['idPartida']);
		echo json_encode($pregunta);
	}

	public function responder()
	{
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
			$this->partidaModel->sumarPreguntaCorrectaAlJugador($_SESSION['idPartida']);
		} else {
			$contexto['respuesta_correcta'] = $this->partidaModel->obtenerRespuestaCorrecta($datos['idPregunta']);
			$contexto['puntos'] = $_SESSION['puntaje'];
			$this->partidaModel->actualizarPuntaje($_SESSION['puntaje'], $_SESSION['idPartida']);
		}
		$this->partidaModel->actualizarPorcentajeAciertoPregunta($datos['idPregunta']);
		echo json_encode($contexto);
	}

	public function totalPuntaje()
	{
		$this->partidaModel->actualizarPuntaje($_SESSION['puntaje'], $_SESSION['idPartida']);
		echo json_encode($_SESSION['puntaje']);
		unset($_SESSION['lista_preguntas']);
		unset($_SESSION['puntaje']);
	}

	public function usarTrampita()
	{
		if ($this->partidaModel->getTrampitasUsuario($_SESSION['usuario']['id']) > 0) {
			$datos = array(
				'idPregunta' => $_POST['id_pregunta']
			);

			$_SESSION['puntaje']++;
			$contexto['puntos'] = $_SESSION['puntaje'];
			$this->partidaModel->sumarPreguntaCorrectaALaEstadistica($datos['idPregunta']);
			$this->partidaModel->sumarPreguntaCorrectaAlJugador($_SESSION['idPartida']);
			$this->partidaModel->actualizarPorcentajeAciertoPregunta($datos['idPregunta']);
			$this->partidaModel->restarTrampitaAlUsuario($_SESSION['usuario']['id']);
			$contexto['trampitas'] = $this->partidaModel->getTrampitasUsuario($_SESSION['usuario']['id']);
			echo json_encode($contexto);
		}
	}

	public function reportarPregunta()
	{
		$this->partidaModel->reportarPregunta($_POST['id_pregunta']);
	}

	public function actualizarTrampitas()
	{
		$contexto['trampitas'] = $this->partidaModel->getTrampitasUsuario($_SESSION['usuario']['id']);
		echo json_encode($contexto);
	}

}