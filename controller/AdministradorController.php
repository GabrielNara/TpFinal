<?php

class AdministradorController
{
	private $renderer;

	private $administradorModel;

	public function __construct($renderer, $administradorModel)
	{
		$this->renderer = $renderer;
		$this->administradorModel = $administradorModel;
	}

	public function redireccionamiento()
	{
		$usuario = $_SESSION['usuario'];
		$rol = $this->administradorModel->getRol($usuario["id"]);

		if ($rol[0]['idRol'] == 3 || $rol[0]['idRol'] == 2) {
			header('Location: /tpfinal/lobby/list');
			exit();
		}
	}

	public function estadisticas()
	{
		$this->redireccionamiento();

		$this->renderer->render("estadisticas");
	}

	public function cantJugadores()
	{
		$this->redireccionamiento();

		$filtro = $_GET['filtro'] ?? 'anio';

		$contexto = array(
			'filtroDia' => $filtro === 'dia',
			'filtroSemana' => $filtro === 'semana',
			'filtroMes' => $filtro === 'mes',
			'filtroAnio' => $filtro === 'anio'
		);

		switch ($filtro) {
			case 'dia':
				$cantidadJugadoresTotal = $this->administradorModel->obtenerCantidadJugadoresPorDia();
				$contexto['cantidadJugadoresTotal'] = json_encode($cantidadJugadoresTotal);
				break;
			case 'semana':
				$cantidadJugadoresTotal = $this->administradorModel->obtenerCantidadJugadoresPorSemana();
				$contexto['cantidadJugadoresTotal'] = json_encode($cantidadJugadoresTotal);
				break;
			case 'mes':
				$cantidadJugadoresTotal = $this->administradorModel->obtenerCantidadJugadoresPorMes();
				$contexto['cantidadJugadoresTotal'] = json_encode($cantidadJugadoresTotal);
				break;
			case 'anio':
				$getAnios = $this->administradorModel->getAniosRegistroJugadores();
				foreach ($getAnios as $anio) {
					$anios[] = intval($anio['anios']);
				}
				$cantidadJugadoresTotal = $this->administradorModel->obtenerCantidadJugadoresPorAnio($anios);
				$contexto['anios'] = json_encode($anios);
				$contexto['cantidadJugadoresTotal'] = json_encode($cantidadJugadoresTotal);
				break;
		}

		$this->renderer->render("cantidadJugadores", $contexto);
	}

}