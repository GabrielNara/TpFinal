<?php

class PartidaModel
{
	private $database;

	public function __construct($database)
	{
		$this->database = $database;
	}

	public function crearPartida()
	{
		if (isset($_SESSION['usuario'])) {
			$usuario = $_SESSION['usuario'];
			$idUsuario = $usuario["id"];
		}
		$query = "INSERT INTO `partidas`(`puntaje`, `fecha`, `idUsuario`) VALUES (0, NOW(), $idUsuario)";
		return $this->database->queryInsertar($query);
	}

	public function getIdPartida()
	{
		$query = "SELECT id FROM partidas ORDER BY id DESC LIMIT 1";
		$idPartida = $this->database->query($query);
		return $idPartida[0]['id'];
	}

	public function obtenerListaPreguntas($id_usuario)
	{
		$porcentajeAcierto = $this->obtenerPorcentajeAciertoJugador($id_usuario);

		switch (true) {
			case ($porcentajeAcierto > 70):
				$query = "SELECT * FROM preguntas WHERE porcentaje_acierto < 30 AND (id_estado_pregunta = 1 OR id_estado_pregunta = 3)";
				break;
			case ($porcentajeAcierto < 30):
				$query = "SELECT * FROM preguntas WHERE porcentaje_acierto > 70 AND (id_estado_pregunta = 1 OR id_estado_pregunta = 3)";
				break;
			default:
				$query = "SELECT * FROM preguntas WHERE porcentaje_acierto BETWEEN 30 AND 70 AND (id_estado_pregunta = 1 OR id_estado_pregunta = 3)";
				break;
		}

		return $this->database->querySelectFetchAssoc($query);
	}

	public function obtenerPreguntaAleatoria($lista_preguntas)
	{
		$indiceAleatorio = rand(0, sizeof($lista_preguntas) - 1);

		$pregunta = $lista_preguntas[$indiceAleatorio];

		$respuestasDesordenadas = ['respuesta_a', 'respuesta_b', 'respuesta_c', 'respuesta_d'];

		$respuestasOriginales = [];
		foreach ($respuestasDesordenadas as $indice) {
			$respuestasOriginales[$indice] = $pregunta[$indice];
		}
		shuffle($respuestasOriginales);

		foreach ($respuestasDesordenadas as $indice => $valor) {
			$pregunta[$valor] = $respuestasOriginales[$indice];
		}

		return $pregunta;
	}

	public function obtenerCategoria($id_categoria)
	{
		$query = "SELECT categoria FROM categorias WHERE id = '$id_categoria'";
		$categoria = $this->database->query($query);
		return $categoria[0];
	}

	public function obtenerRespuestas($id_pregunta)
	{
		$query = "SELECT * FROM respuestas WHERE id_pregunta = '$id_pregunta'";
		$respuestas = $this->database->query($query);
		shuffle($respuestas);
		$respuestas_desordenadas = array_slice($respuestas, 0, 4);
		return $respuestas_desordenadas;
	}

	public function consultarSiLaRespuestaEsCorrecta($datos)
	{
		$query = "SELECT respuesta_correcta FROM preguntas WHERE id = '{$datos['idPregunta']}'";
		$respuestaCorrecta = $this->database->querySelectFetchAssoc($query);

		return $datos['respuesta_seleccionada'] == $respuestaCorrecta[0]['respuesta_correcta'];
	}

	public function obtenerRespuestaCorrecta($id_pregunta)
	{
		$query = "SELECT respuesta_correcta FROM preguntas WHERE id = '$id_pregunta'";
		$respuestas = $this->database->querySelectFetchAssoc($query);
		return $respuestas[0]['respuesta_correcta'];
	}

	public function actualizarPuntaje($puntaje, $idPartida)
	{
		if (isset($_SESSION['usuario'])) {
			$usuario = $_SESSION['usuario'];
			$idUsuario = $usuario["id"];
		}
		$query = "UPDATE partidas SET puntaje = '$puntaje' WHERE id = '$idPartida' and idUsuario= '$idUsuario' ";
		$this->database->queryInsertar($query);
	}

	public function sumarPreguntaALaEstadistica($id_pregunta)
	{
		$query = "UPDATE preguntas SET `preguntas_totales` = `preguntas_totales` + 1 WHERE id = '$id_pregunta'";
		return $this->database->queryInsertar($query);
	}

	public function sumarPreguntaCorrectaALaEstadistica($id_pregunta)
	{
		$query = "UPDATE preguntas SET `preguntas_correctas` = `preguntas_correctas` + 1 WHERE id = '$id_pregunta'";
		return $this->database->queryInsertar($query);
	}

	public function sumarPreguntaAlJugador($idPartida)
	{
		$query = "SELECT idUsuario FROM partidas WHERE id = '$idPartida'";
		$id_usuario = $this->database->querySelectFetchAssoc($query);
		$id = $id_usuario[0]['idUsuario'];

		$query = "UPDATE usuarios SET `preguntas_totales` = `preguntas_totales` + 1 WHERE id = '$id'";
		$this->database->queryInsertar($query);
		$this->actualizarPorcentajeAciertoJugador($id);
	}

	public function sumarPreguntaCorrectaAlJugador($idPartida)
	{
		$query = "SELECT idUsuario FROM partidas WHERE id = '$idPartida'";
		$id_usuario = $this->database->querySelectFetchAssoc($query);
		$id = $id_usuario[0]['idUsuario'];

		$query = "UPDATE usuarios SET `preguntas_correctas` = `preguntas_correctas` + 1 WHERE id = '$id'";
		return $this->database->queryInsertar($query);
	}

	public function actualizarPorcentajeAciertoPregunta($id_pregunta)
	{
		$query = "SELECT preguntas_totales FROM preguntas WHERE id = '$id_pregunta'";
		$preguntas_totales = $this->database->querySelectFetchAssoc($query);
		$total = $preguntas_totales[0]['preguntas_totales'];

		$query = "SELECT preguntas_correctas FROM preguntas WHERE id = '$id_pregunta'";
		$preguntas_correctas = $this->database->querySelectFetchAssoc($query);
		$correctas = $preguntas_correctas[0]['preguntas_correctas'];

		$porcentaje_acierto = (($correctas * 100) / $total);

		$query = "UPDATE preguntas SET `porcentaje_acierto` = '$porcentaje_acierto' WHERE id = '$id_pregunta'";
		return $this->database->queryInsertar($query);
	}

	public function actualizarPorcentajeAciertoJugador($id_usuario)
	{
		$query = "SELECT preguntas_totales FROM usuarios WHERE id = '$id_usuario'";
		$preguntas_totales = $this->database->querySelectFetchAssoc($query);
		$total = $preguntas_totales[0]['preguntas_totales'];

		$query = "SELECT preguntas_correctas FROM usuarios WHERE id = '$id_usuario'";
		$preguntas_correctas = $this->database->querySelectFetchAssoc($query);
		$correctas = $preguntas_correctas[0]['preguntas_correctas'];

		$porcentaje_acierto = (($correctas * 100) / $total);

		$query = "UPDATE usuarios SET `porcentaje_acierto` = '$porcentaje_acierto' WHERE id = '$id_usuario'";
		return $this->database->queryInsertar($query);
	}

	public function obtenerPorcentajeAciertoJugador($id_usuario)
	{
		$query = "SELECT porcentaje_acierto FROM usuarios WHERE id = '$id_usuario'";
		$porcentaje_acierto = $this->database->querySelectFetchAssoc($query);
		return $porcentaje_acierto[0]['porcentaje_acierto'];
	}

	public function obtenerPorcentajeAciertoPregunta($id_pregunta)
	{
		$query = "SELECT porcentaje_acierto FROM preguntas WHERE id = '$id_pregunta'";
		return $this->database->querySelectFetchAssoc($query);
	}

	public function reportarPregunta($id_pregunta)
	{
		$query = "UPDATE preguntas SET `id_estado_pregunta` = 3 WHERE id = '$id_pregunta'";
		return $this->database->queryInsertar($query);
	}

	public function getTrampitasUsuario($id)
	{
		$query = "SELECT trampitas FROM usuarios WHERE id = '$id'";
		$result = $this->database->query($query);
		return $result[0]['trampitas'];
	}

	public function restarTrampitaAlUsuario($id_usuario)
	{
		$query = "UPDATE usuarios SET trampitas = trampitas - 1 WHERE id = '$id_usuario'";
		$this->database->queryInsertar($query);
	}
}
