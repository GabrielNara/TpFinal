<?php
include_once('./model/UsuarioModel.php');
include_once('./model/RankingModel.php');

class PerfilJugadorController
{
	private $renderer;
	private $usuarioModel;
	private $rankingModel;

	public function __construct($renderer, $usuarioModel, $rankingModel)
	{
		$this->renderer = $renderer;
		$this->usuarioModel = $usuarioModel;
		$this->rankingModel = $rankingModel;
	}

	public function list()
	{
		$id = $_GET['id'];
		$usuario = $this->usuarioModel->getUsuarioPorId($id);

		if (empty($usuario)) {
			header('Location: /tpfinal/lobby/list');
			exit();
		}

		$resultado = $this->rankingModel->obtenerElRankingPorIdUsuario($id);

		$qr = $this->usuarioModel->generarQr($id);

		$datos = array(
			'usuario' => $usuario[0],
			'qr' => '.'.$qr
		);

		if (!empty($resultado)) {
			$datos['ranking'] = $resultado[0];
		} else {
			$datos['ranking'] = [
				'puntajeTotal' => 0,
				'cantidadPartidas' => 0
			];
		}

		$this->renderer->render("perfilJugador", $datos);
	}
}