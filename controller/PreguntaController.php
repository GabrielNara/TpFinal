<?php
include_once('./model/PreguntaModel.php');

class PreguntaController
{
    private $renderer;
    private $preguntaModel;

    public function __construct($renderer, $preguntaModel)
    {
        $this->renderer = $renderer;
        $this->preguntaModel = $preguntaModel;
    }

    public function crearPartida()
    {
        $this->preguntaModel->crearPartida();
        $lista_preguntas = $this->preguntaModel->obtenerPreguntas();
        $pregunta = $lista_preguntas[array_rand($lista_preguntas)];
        $categoria = $this->preguntaModel->obtenerCategoria($pregunta['id_categoria']);
        $respuestas = $this->preguntaModel->obtenerRespuestas($pregunta['id']);

        $respuestas_ordenadas = array(
            'a' => $respuestas[0]['respuesta'],
            'b' => $respuestas[1]['respuesta'],
            'c' => $respuestas[2]['respuesta'],
            'd' => $respuestas[3]['respuesta'],
        );

        $deporte = ($categoria['categoria'] === 'Deporte');
        $geografia = ($categoria['categoria'] === 'Geografía');
        $musica = ($categoria['categoria'] === 'Música');

        $contexto = array(
            'deporte' => $deporte,
            'geografia' => $geografia,
            'musica' => $musica,
            'pregunta' => $pregunta,
            'respuestas' => $respuestas_ordenadas
        );

        $this->renderer->render("pregunta", $contexto);
    }
}