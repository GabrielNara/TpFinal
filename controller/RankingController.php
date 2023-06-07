<?php
include_once('./model/RankingModel.php');

class RankingController
{
    private $renderer;
    private $rankingModel;

    public function __construct($renderer, $rankingModel)
    {
        $this->renderer = $renderer;
        $this->rankingModel = $rankingModel;
    }

    public function list()
    {
        $ranking = $this->rankingModel->obtenerElRanking();
        $datos = array(
            'jugadores' => $ranking
        );
        $this->renderer->render("ranking", $datos);
    }
}