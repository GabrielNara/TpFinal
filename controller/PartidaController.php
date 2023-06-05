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

    public function crearPartida()
    {
        $this->partidaModel->crearPartida();
        $lista_preguntas = $this->partidaModel->obtenerPreguntas();
        $_SESSION['lista_preguntas'] = $lista_preguntas;
        $_SESSION['puntaje'] = 0;
        $idPartida = $this->partidaModel->getIdPartida();
        $redirectUrl = '/tpFinal/partida/mostrarPregunta?partida=' . $idPartida;
        header('Location: ' . $redirectUrl);
    }

    public function mostrarPregunta()
    {
        $lista_preguntas = $_SESSION['lista_preguntas'] ?? '';
        $pregunta = $lista_preguntas[array_rand($lista_preguntas)];
        $categoria = $this->partidaModel->obtenerCategoria($pregunta['id_categoria']);
        $respuestas = $this->partidaModel->obtenerRespuestas($pregunta['id']);

        $respuestas_ordenadas = array(
            'a' => $respuestas[0],
            'b' => $respuestas[1],
            'c' => $respuestas[2],
            'd' => $respuestas[3],
        );

        $deporte = ($categoria['categoria'] === 'Deporte');
        $geografia = ($categoria['categoria'] === 'Geografía');
        $musica = ($categoria['categoria'] === 'Música');

        $contexto = array (
            'nroPregunta' => ($_SESSION['puntaje'] + 1),
            'deporte' => $deporte,
            'geografia' => $geografia,
            'musica' => $musica,
            'pregunta' => $pregunta,
            'puntos' => $_SESSION['puntaje'],
            'respuestas' => $respuestas_ordenadas
        );

        $this->renderer->render("pregunta", $contexto);
    }

    public function responder() {
        $idPartida = $this->partidaModel->getIdPartida();

        $datos = array(
            'idPregunta' => $_POST['pregunta'],
            'idRespuesta' => $_POST['respuesta_seleccionada']
        );

        $respuestaCorrecta = $this->partidaModel->consultarRespuesta($datos);

        $contexto = array(
            'idPartida' => $idPartida,
            'respuestaCorrecta' => $respuestaCorrecta
        );

        if ($contexto['respuestaCorrecta']) {
            $this->renderer->render("respuestaCorrecta", $contexto);
            $_SESSION['puntaje']++;
        } else {
            $this->renderer->render("respuestaIncorrecta", $contexto);
            $this->partidaModel->actualizarPuntaje($_SESSION['puntaje'], $idPartida);
            unset($_SESSION['lista_preguntas']);
            unset($_SESSION['puntaje']);
        }
    }

}