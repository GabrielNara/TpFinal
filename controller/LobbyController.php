<?php
include_once('./model/LobbyModel.php');
include_once('./model/RankingModel.php');

class LobbyController
{
	private $renderer;
	private $lobbyModel;
	private $rankingModel;

	public function __construct($renderer, $lobbyModel, $rankingModel)
	{
		$this->renderer = $renderer;
		$this->lobbyModel = $lobbyModel;
		$this->rankingModel = $rankingModel;
	}

	public function list()
	{
		$usuario = $_SESSION['usuario'];
		if ($this->lobbyModel->estaValidadoElCorreoUsuario($usuario['email']) == 1) {
			$mayorPuntaje = $this->rankingModel->obtenerMayorPuntaje($usuario["id"]);
			$historial = $this->rankingModel->obtenerHistorial($usuario["id"]);
			$rol = $this->lobbyModel->getRol($usuario["id"]);
			$cantidadTrampitas = $this->lobbyModel->getTrampitasUsuario($usuario["id"]);

			$data = array(
				'usuario' => $usuario,
                'puntajeMayor' => isset($mayorPuntaje[0]["puntajeTotal"]) ? $mayorPuntaje[0]["puntajeTotal"] : null,
                'historial' => $historial,
				'trampitas' => $cantidadTrampitas
			);

            if (!empty($rol) && isset($rol[0]['idRol']) && $rol[0]['idRol'] == 2)
                {
				$data['editor'] = true;
			} else {
                if (!empty($rol) && isset($rol[0]['idRol']) && $rol[0]['idRol'] == 1) 
                    {
					$data['editor'] = true;
					$data['administrador'] = true;
				}
			}

			$this->renderer->render('lobby', $data);
		} else {
			$data = array(
				'usuario' => $usuario
			);
			$this->renderer->render('faltaConfirmarMail', $data);
		}
	}

	public function comprarTrampita()
	{
		$usuario = $_SESSION['usuario'];
		$cantidadTrampitas = $_POST['cantidad'];

		if ($cantidadTrampitas > 0) {
			$this->lobbyModel->agregarTrampitaAlUsuario($usuario["id"], $cantidadTrampitas);
		}
	}

	public function cerrarSesion()
	{
		session_destroy();
		header('Location: /tpfinal/');
		exit();
	}
}