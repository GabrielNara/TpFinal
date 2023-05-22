<?php
include_once('helpers/MySqlDatabase.php');
include_once("helpers/MustacheRender.php");
include_once('helpers/Router.php');

include_once("model/LobbyModel.php");

include_once('controller/RankingController.php');
include_once('controller/CrearPartidaController.php');
include_once('controller/CrearPreguntaController.php');
include_once('controller/LobbyController.php');

include_once('third-party/mustache/src/Mustache/Autoloader.php');

class Configuration
{
    private $configFile = 'config/config.ini';

    public function __construct()
    {
    }

    public function getRankingController()
    {
        return new RankingController($this->getRenderer());
    }

    public function getCrearPartidaController()
    {
        return new CrearPartidaController($this->getRenderer());
    }

    public function getCrearPreguntaController()
    {
        return new CrearPreguntaController($this->getRenderer());
    }

    public function getLobbyController()
    {
        return new LobbyController($this->getRenderer());
    }

    private function getArrayConfig()
    {
        return parse_ini_file($this->configFile);
    }

    private function getRenderer()
    {
        return new MustacheRender('view/partial');
    }

    public function getDatabase()
    {
        $config = $this->getArrayConfig();
        return new MySqlDatabase(
            $config['servername'],
            $config['username'],
            $config['password'],
            $config['database']);
    }

    public function getRouter()
    {
        return new Router(
            $this,
            "getLobbyController",
            "list");
    }
}