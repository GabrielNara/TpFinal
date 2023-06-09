<?php
include_once('helpers/MySqlDatabase.php');
include_once("helpers/MustacheRender.php");
include_once('helpers/Router.php');

include_once("model/PartidaModel.php");
include_once("model/LobbyModel.php");
include_once("model/FormRegistroModel.php");
include_once("model/UsuarioModel.php");
include_once("model/RolModel.php");
include_once("model/RankingModel.php");
include_once("model/CrearPreguntaModel.php");
include_once("model/EditorModel.php");
include_once("model/AdministradorModel.php");
include_once("model/CrearCategoriaModel.php");

include_once('controller/HomeController.php');
include_once('controller/CrearPreguntaController.php');
include_once('controller/CrearCategoriaController.php');
include_once('controller/LobbyController.php');
include_once('controller/PerfilJugadorController.php');
include_once('controller/FormRegistroController.php');
include_once('controller/LoginController.php');
include_once('controller/PartidaController.php');
include_once('controller/RankingController.php');
include_once('controller/EditorController.php');
include_once('controller/AdministradorController.php');


include_once('third-party/phpqrcode/qrlib.php');
include_once('third-party/mustache/src/Mustache/Autoloader.php');
include_once('third-party/fpdf/fpdf.php');
require 'third-party/PHPMailer/src/Exception.php';
require 'third-party/PHPMailer/src/PHPMailer.php';
require 'third-party/PHPMailer/src/SMTP.php';

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
		return $protocol.'://'.$host.dirname($script);
	}

	public function getLoginController()
	{
		return new LoginController($this->getRenderer(), new UsuarioModel($this->getDatabase()));
	}

	public function getPerfilJugadorController()
	{
		return new PerfilJugadorController($this->getRenderer(),
			new UsuarioModel($this->getDatabase()),
			new RankingModel($this->getDatabase()));
	}

	public function getFormRegistroController()
	{
		return new FormRegistroController(
			$this->getRenderer(),
			new FormRegistroModel($this->getDatabase())
		);
	}

	public function getPartidaController()
	{
		return new PartidaController(
			$this->getRenderer(),
			new PartidaModel($this->getDatabase()),
			new LobbyModel($this->getDatabase())
		);
	}

	public function getHomeController()
	{
		return new HomeController($this->getRenderer());
	}

	public function getRankingController()
	{
		return new RankingController($this->getRenderer(),
			new RankingModel($this->getDatabase()));
	}

	public function getEditorController()
	{
		return new EditorController($this->getRenderer(),
			new EditorModel($this->getDatabase()));
	}

	public function getAdministradorController()
	{
		return new AdministradorController($this->getRenderer(),
			new AdministradorModel($this->getDatabase()));
	}

	public function getCrearPreguntaController()
	{
		return new CrearPreguntaController($this->getRenderer(),
			new CrearPreguntaModel($this->getDatabase()));
	}

    public function getCrearCategoriaController()
    {
        return new CrearCategoriaController($this->getRenderer(),
            new CrearCategoriaModel($this->getDatabase()));
    }

	public function getLobbyController()
	{
		return new LobbyController($this->getRenderer(),
			new LobbyModel($this->getDatabase()),
			new RankingModel($this->getDatabase()));
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
			"getHomeController",
			"list",
			"/TpFinal"
		);
	}


}