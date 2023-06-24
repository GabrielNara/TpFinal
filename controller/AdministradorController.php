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

		$contexto = array(
			'filtroDia' => $filtro === 'D',
			'filtroSemana' => $filtro === 'S',
			'filtroMes' => $filtro === 'M',
			'filtroAnio' => $filtro === 'A'
		);

		switch ($filtro) {
			case 'D':
				$desde = 1;
				break;
			case 'S':
				$desde = 7;
				break;
			case 'M':
				$desde = 30;
				break;
			case 'A':
				$desde = 365;
				break;
		}

		$cantidadPreguntasActivas = $this->administradorModel->obtenerCantidadPreguntas($desde, 1);
		$cantidadPreguntasSugeridas = $this->administradorModel->obtenerCantidadPreguntas($desde, 4);

		$contexto['cantPreguntasActivas'] = json_encode($cantidadPreguntasActivas);
		$contexto['cantPreguntasSugeridas'] = json_encode($cantidadPreguntasSugeridas);

		$this->renderer->render("statsPreguntas", $contexto);
	}

    public function cantPartidasJugadas(){
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
            case 'anio': //REVISAR FILTRO DE ANIOS --------------------------------------------------------
                $getAnios = $this->administradorModel->getAniosRegistroPartidas();
                 foreach ($getAnios as $anio) {
                    $anios[] = intval($anio['anios']);
                }
                $cantidadPartidasTotal = $this->administradorModel->obtenerCantidadPartidasPorAnio($anios);
                $contexto['anios'] = json_encode($anios);
                $contexto['cantidadPartidasTotal'] = json_encode($cantidadPartidasTotal);
                break;
        }

        $this->renderer->render("partidasJugadas", $contexto);
    }

    public function cantUsuariosEdad(){
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

                //var_dump($contexto);
                break;

            case 'anio':
                $cantidadUsuariosTotal = $this->administradorModel->obtenerCantidadUsuariosPorEdadPorAnio();
                $usuariosJson = [];
                foreach ($cantidadUsuariosTotal as $usuarios) {
                    $usuariosJson[] = [
                        'menores' => $usuarios['menores'],
                        'medios' => $usuarios['medios'],
                        'jubilados' => $usuarios['jubilados']
                    ];
                }
                $contexto['cantidadUsuariosTotal'] = json_encode($usuariosJson);

                //var_dump($contexto);
                break;

        }

        $this->renderer->render("usuariosEdad", $contexto);
    }

}