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

    public function obtenerPreguntas()
    {
        $query = "SELECT * FROM preguntas";
        return $this->database->query($query);
    }

    public function almacenarPregunta($id_partida, $id_pregunta) {
        $query = "INSERT INTO `partidas_preguntas`(`id_partida`, `id_pregunta`) VALUES ('$id_partida', '$id_pregunta')";
        return $this->database->queryInsertar($query);
    }

    public function reiniciarPreguntas($id_partida) {
        $query = "DELETE FROM `partidas_preguntas` WHERE id_partida = '$id_partida'";
        return $this->database->queryInsertar($query);
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

    public function consultarRespuesta($datos)
    {
        $query = "SELECT id FROM respuestas WHERE id_pregunta = '{$datos['idPregunta']}'";
        $respuestas = $this->database->query($query);

        for ($i = 0; $i < count($respuestas); $i++) {
            if ($respuestas[$i]['id'] == $datos['idRespuesta']) {
                $query = "SELECT respuesta_correcta FROM respuestas WHERE id = '{$datos['idRespuesta']}'";
                $respuestaCorrecta = $this->database->query($query);
            }
        }

        return $respuestaCorrecta[0]['respuesta_correcta'];
    }

    public function actualizarPuntaje($puntaje, $idPartida)
    {
        $query = "UPDATE partidas SET puntaje = '$puntaje' WHERE id = '$idPartida'";
        $this->database->queryInsertar($query);
    }


    public function obtenerRespuestaCorrecta($datos)
    {
        $query = "SELECT respuesta FROM respuestas WHERE id_pregunta = '{$datos['idPregunta']}' AND respuesta_correcta = 1";
        $respuestas = $this->database->query($query);
        return $respuestas[0]['respuesta'];
    }

    public function obtenerPuntajeTotalDeUnJugador($idJugador)
    {
        $query = "SELECT SUM(puntaje) as puntajeTotal FROM `partidas` WHERE idUsuario = $idJugador";
        return $this->database->query($query);
    }

    public function obtenerMayorPuntaje($idJugador)
    {
        $query = "SELECT MAX(puntaje) as puntajeTotal FROM `partidas` WHERE idUsuario = $idJugador";
        return $this->database->query($query);
    }

    public function obtenerHistorial($idJugador)
    {
        $query = "SELECT fecha, puntaje FROM `partidas` WHERE idUsuario = $idJugador ORDER BY fecha DESC LIMIT 3";
        return $this->database->query($query);
    }
}