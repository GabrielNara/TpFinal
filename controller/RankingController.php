<?php
include_once('./model/PartidaModel.php');
include_once('./model/UsuarioModel.php');
include_once('./model/RolModel.php');

class RankingController
{
    private $renderer;
    private $rolModel;
    private $partidaModel;
    private $usuarioModel;

    public function __construct($renderer, $rolModel, $partidaModel, $usuarioModel)
    {
        $this->renderer = $renderer;
        $this->rolModel = $rolModel;
        $this->partidaModel = $partidaModel;
        $this->usuarioModel = $usuarioModel;
    }

    public function list()
    {
        $ranking = $this->partidaModel->obtenerElRanking();

        $datos = array(
            'jugadores' => $ranking
        );
        $this->renderer->render("ranking", $datos);


    }
}