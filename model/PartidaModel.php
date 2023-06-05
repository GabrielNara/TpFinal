<?php

class PartidaModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function crearPartida() {
        $query = "INSERT INTO `partidas`(`puntaje`, `fecha`) VALUES (0, NOW())";
        return $this->database->queryInsertar($query);
    }

    public function getIdPartida() {
        $query = "SELECT id FROM partidas ORDER BY id DESC LIMIT 1";
        $idPartida = $this->database->query($query);
        return $idPartida[0]['id'];
    }

    public function obtenerPreguntas() {
        $query = "SELECT * FROM preguntas";
        return $this->database->query($query);
    }

    public function obtenerCategoria($id_categoria) {
        $query = "SELECT categoria FROM categorias WHERE id = '$id_categoria'";
        $categoria = $this->database->query($query);
        return $categoria[0];
    }

    public function obtenerRespuestas($id_pregunta) {
        $query = "SELECT * FROM respuestas WHERE id_pregunta = '$id_pregunta'";
        $respuestas = $this->database->query($query);
        shuffle($respuestas);
        $respuestas_desordenadas = array_slice($respuestas, 0, 4);
        return $respuestas_desordenadas;
    }

    public function consultarRespuesta($datos) {
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

    public function actualizarPuntaje($puntaje, $idPartida) {
        $query = "UPDATE partidas SET puntaje = '$puntaje' WHERE id = '$idPartida'";
        $this->database->queryInsertar($query);
    }

}