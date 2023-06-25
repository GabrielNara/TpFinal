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

	public function statsPreguntas()
	{
		$this->redireccionamiento();
		$desde = 0;
		$filtro = $_GET['filtro'] ?? 'A';


        $this->redireccionamiento();
        $cantDiasARestar = 0;
        $filtro = $_GET['filtro'] ?? 'A';

        switch ($filtro){
            case 'D':
                $cantDiasARestar = 1;
                break;
            case 'S':
                $cantDiasARestar = 7;
                break;
            case 'M':
                $cantDiasARestar = 30;
                break;
            case 'A':
                $cantDiasARestar = 365;
                break;
        }

        $cantidadPreguntasActivas = $this->administradorModel->obtenerCantidadPreguntas($cantDiasARestar,1);
        $cantidadPreguntasSugeridas = $this->administradorModel->obtenerCantidadPreguntas($cantDiasARestar,4);

		$contexto['cantPreguntasActivas'] = json_encode($cantidadPreguntasActivas);
		$contexto['cantPreguntasSugeridas'] = json_encode($cantidadPreguntasSugeridas);

		$this->renderer->render("statsPreguntas", $contexto);
	}

	public function cantPartidasJugadas()
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
				$cantidadPartidasTotal = $this->administradorModel->obtenerCantidadPartidasPorDia();
				$contexto['cantidadPartidasTotal'] = json_encode($cantidadPartidasTotal);
				break;
			case 'semana':
				$cantidadPartidasTotal = $this->administradorModel->obtenerCantidadPartidasPorSemana();
				$contexto['cantidadPartidasTotal'] = json_encode($cantidadPartidasTotal);
				break;
			case 'mes':
				$cantidadPartidasTotal = $this->administradorModel->obtenerCantidadPartidasPorMes();
				$contexto['cantidadPartidasTotal'] = json_encode($cantidadPartidasTotal);
				break;
			case 'anio':
				$cantidadPartidasTotal = $this->administradorModel->obtenerCantidadPartidasPorAnio();
				$anios = [];

				$anio_actual = date('Y');

				for ($i = 0; $i < 4; $i++) {
					$anio = $anio_actual - $i;
					$anios[] = $anio;
				}

				$contexto['anios'] = json_encode($anios);
				$contexto['cantidadPartidasTotal'] = json_encode($cantidadPartidasTotal);

				break;

		}

		$this->renderer->render("partidasJugadas", $contexto);
	}

	public function cantUsuariosEdad()
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
				$cantidadUsuariosTotal = $this->administradorModel->obtenerCantidadUsuariosPorEdadPorDia();
				$usuariosJson = [];
				foreach ($cantidadUsuariosTotal as $usuarios) {
					$usuariosJson[] = [
						'menores' => $usuarios['menores'],
						'medios' => $usuarios['medios'],
						'jubilados' => $usuarios['jubilados']
					];
				}
				$contexto['cantidadUsuariosTotal'] = json_encode($usuariosJson);
				break;
			case 'semana':
				$cantidadUsuariosTotal = $this->administradorModel->obtenerCantidadUsuariosPorEdadPorSemana();
				$usuariosJson = [];
				foreach ($cantidadUsuariosTotal as $usuarios) {
					$usuariosJson[] = [
						'menores' => $usuarios['menores'],
						'medios' => $usuarios['medios'],
						'jubilados' => $usuarios['jubilados']
					];
				}
				$contexto['cantidadUsuariosTotal'] = json_encode($usuariosJson);

				break;
			case 'mes':
				$cantidadUsuariosTotal = $this->administradorModel->obtenerCantidadUsuariosPorEdadPorMes();
				$usuariosJson = [];
				foreach ($cantidadUsuariosTotal as $usuarios) {
					$usuariosJson[] = [
						'menores' => $usuarios['menores'],
						'medios' => $usuarios['medios'],
						'jubilados' => $usuarios['jubilados']
					];
				}
				$contexto['cantidadUsuariosTotal'] = json_encode($usuariosJson);

				break;

			case 'anio':
				$cantidadUsuariosTotal = $this->administradorModel->obtenerCantidadUsuariosPorEdadPorAnio();
				$usuariosJson = [];
				$anios = [];
				foreach ($cantidadUsuariosTotal as $usuarios) {
					$usuariosJson[] = [
						'menores' => $usuarios['menores'],
						'medios' => $usuarios['medios'],
						'jubilados' => $usuarios['jubilados']
					];
					$anios[] = $usuarios['anio'];
				}
				$contexto['cantidadUsuariosTotal'] = json_encode($usuariosJson);
				$contexto['anios'] = json_encode($anios);
				break;

		}

		$this->renderer->render("usuariosEdad", $contexto);
	}

	public function cantUsuariosSexo()
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
				$cantidadUsuariosTotal = $this->administradorModel->obtenerCantidadUsuariosPorSexoPorDia();
				$usuariosJson = [];
				foreach ($cantidadUsuariosTotal as $usuarios) {
					$usuariosJson[] = [
						'masculinos' => $usuarios['masculinos'],
						'femeninos' => $usuarios['femeninos'],
						'otros' => $usuarios['otros']
					];
				}
				$contexto['cantidadUsuariosTotal'] = json_encode($usuariosJson);
				break;
			case 'semana':
				$cantidadUsuariosTotal = $this->administradorModel->obtenerCantidadUsuariosPorSexoPorSemana();
				$usuariosJson = [];
				foreach ($cantidadUsuariosTotal as $usuarios) {
					$usuariosJson[] = [
						'masculinos' => $usuarios['masculinos'],
						'femeninos' => $usuarios['femeninos'],
						'otros' => $usuarios['otros']
					];
				}
				$contexto['cantidadUsuariosTotal'] = json_encode($usuariosJson);
				break;
			case 'mes':
				$cantidadUsuariosTotal = $this->administradorModel->obtenerCantidadUsuariosPorSexoPorMes();
				$usuariosJson = [];
				foreach ($cantidadUsuariosTotal as $usuarios) {
					$usuariosJson[] = [
						'masculinos' => $usuarios['masculinos'],
						'femeninos' => $usuarios['femeninos'],
						'otros' => $usuarios['otros']
					];
				}
				$contexto['cantidadUsuariosTotal'] = json_encode($usuariosJson);

				break;
			case 'anio':
				$cantidadUsuariosTotal = $this->administradorModel->obtenerCantidadUsuariosPorSexoPorAnio();
				$usuariosJson = [];
				$anios = [];
				foreach ($cantidadUsuariosTotal as $usuarios) {
					$usuariosJson[] = [
						'masculinos' => $usuarios['masculinos'],
						'femeninos' => $usuarios['femeninos'],
						'otros' => $usuarios['otros']
					];
					$anios[] = $usuarios['anio'];
				}
				$contexto['cantidadUsuariosTotal'] = json_encode($usuariosJson);
				$contexto['anios'] = json_encode($anios);
				break;
		}

		$this->renderer->render("jugadoresSexo", $contexto);
	}

	public function cantUsuariosPais()
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
				$cantidadUsuariosTotal = $this->administradorModel->obtenerCantidadUsuariosPorPaisPorDia();
				$usuariosJson = [];
				foreach ($cantidadUsuariosTotal as $usuarios) {
					$usuariosJson[] = [
						'argentinos' => $usuarios['argentinos'],
						'chilenos' => $usuarios['chilenos'],
						'peruanos' => $usuarios['peruanos'],
						'colombianos' => $usuarios['colombianos'],
						'otros' => $usuarios['otros']
					];
				}
				$contexto['cantidadUsuariosTotal'] = json_encode($usuariosJson);
				break;
			case 'semana':
				$cantidadUsuariosTotal = $this->administradorModel->obtenerCantidadUsuariosPorPaisPorSemana();
				$usuariosJson = [];
				foreach ($cantidadUsuariosTotal as $usuarios) {
					$usuariosJson[] = [
						'argentinos' => $usuarios['argentinos'],
						'chilenos' => $usuarios['chilenos'],
						'peruanos' => $usuarios['peruanos'],
						'colombianos' => $usuarios['colombianos'],
						'otros' => $usuarios['otros']
					];
				}
				$contexto['cantidadUsuariosTotal'] = json_encode($usuariosJson);
				break;
			case 'mes':
				$cantidadUsuariosTotal = $this->administradorModel->obtenerCantidadUsuariosPorPaisPorMes();
				$usuariosJson = [];
				foreach ($cantidadUsuariosTotal as $usuarios) {
					$usuariosJson[] = [
						'argentinos' => $usuarios['argentinos'],
						'chilenos' => $usuarios['chilenos'],
						'peruanos' => $usuarios['peruanos'],
						'colombianos' => $usuarios['colombianos'],
						'otros' => $usuarios['otros']
					];
				}
				$contexto['cantidadUsuariosTotal'] = json_encode($usuariosJson);
				break;

			case 'anio':
				$cantidadUsuariosTotal = $this->administradorModel->obtenerCantidadUsuariosPorPaisPorAnio();
				$usuariosJson = [];
				$anios = [];
				foreach ($cantidadUsuariosTotal as $usuarios) {
					$usuariosJson[] = [
						'argentinos' => $usuarios['argentinos'],
						'chilenos' => $usuarios['chilenos'],
						'peruanos' => $usuarios['peruanos'],
						'colombianos' => $usuarios['colombianos'],
						'otros' => $usuarios['otros']
					];
					$anios[] = $usuarios['anio'];
				}
				$contexto['cantidadUsuariosTotal'] = json_encode($usuariosJson);
				$contexto['anios'] = json_encode($anios);
				break;
		}

		$this->renderer->render("jugadoresPais", $contexto);
	}

}