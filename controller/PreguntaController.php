<?php
include_once('./model/PreguntaModel.php');
include_once('./model/PartidaModel.php');

class PreguntaController
{
    private $renderer;
    private $preguntaModel;
    private $partidaModel;

    public function __construct($renderer, $preguntaModel, $partidaModel)
    {
        $this->renderer = $renderer;
        $this->preguntaModel = $preguntaModel;
        $this->partidaModel = $partidaModel;
    }


}