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

    public function obtenerListaPreguntas()
    {
        $query = "SELECT * FROM preguntas";
        return $this->database->querySelectFetchAssoc($query);
    }

    public function obtenerPreguntaAleatoria($lista_preguntas)
    {
        $indiceAleatorio = rand(0, sizeof($lista_preguntas)-1);
        return $lista_preguntas[$indiceAleatorio];
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
        $query = "UPDATE partidas SET puntaje = '$puntaje' WHERE id = '$idPartida'";
        $this->database->queryInsertar($query);
    }

}