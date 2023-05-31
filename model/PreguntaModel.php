<?php

class PreguntaModel
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
        $query = "SELECT respuesta FROM respuestas WHERE id_pregunta = '1'";
        $respuestas = $this->database->query($query);
        shuffle($respuestas);
        $respuestas_desordenadas = array_slice($respuestas, 0, 4);
        return $respuestas_desordenadas;
    }

}