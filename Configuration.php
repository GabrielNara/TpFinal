<?php
include_once('helpers/MySqlDatabase.php');
include_once("helpers/MustacheRender.php");
include_once('helpers/Router.php');

include_once("model/LobbyModel.php");
include_once("model/FormRegistroModel.php");
include_once("model/UsuarioModel.php");

include_once('controller/RankingController.php');
include_once('controller/CrearPartidaController.php');
include_once('controller/CrearPreguntaController.php');
include_once('controller/LobbyController.php');
include_once('controller/PerfilJugadorController.php');
include_once('controller/FormRegistroController.php');
include_once('controller/LoginController.php');


include_once('third-party/mustache/src/Mustache/Autoloader.php');

class Configuration
{
    private $configFile = 'config/config.ini';

    public function __construct()
    {
    }

    public function getBaseUrl()
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        $script = $_SERVER['SCRIPT_NAME'];

        // Concatena el protocolo, el host y la ruta de la carpeta raíz del proyecto
        return $protocol . '://' . $host . dirname($script);
    }

    public function getLoginController()
    {
        return new LoginController($this->getRenderer(), new UsuarioModel($this->getDatabase()));
    }

    public function getPerfilJugadorController()
    {
        return new PerfilJugadorController($this->getRenderer());
    }

    public function getFormRegistroController()
    {
        return new FormRegistroController(
            $this->getRenderer(),
            new FormRegistroModel($this->getDatabase())
        );
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
            "list",
            "/TpFinal"
        );
    }


}