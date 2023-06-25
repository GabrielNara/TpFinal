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

    public function convertirAPdf() {
        $this->redireccionamiento();

        $filtro = $_GET['filtro'] ?? 'anio';
        //  ob_clean();
        //  ob_start();
        $pdf = new FPDF();
        $pdf->AddPage();

        // Establecer el título de la tabla
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(0, 10, 'Partidas por fechas', 0, 1, 'C');

        // Obtener los datos según el filtro seleccionado
        switch ($filtro) {
            case 'dia':
                $datos = $this->administradorModel->obtenerCantidadPartidasPorDia();
                // Obtener los últimos 7 días
                $ultimos7Dias = array();
                $fechaActual = new DateTime();

                for ($i = 0; $i < 7; $i++) {
                    $fecha = clone $fechaActual;
                    $fecha->sub(new DateInterval('P'.$i.'D'));
                    $dia = $fecha->format('d');
                    $mes = $fecha->format('m');
                    $fechaFormateada = $dia . '-' . $mes;
                    $ultimos7Dias[] = $fechaFormateada;
                }

                $ultimos7Dias = array_reverse($ultimos7Dias); // Invertir el orden para que aparezcan en el PDF en orden ascendente

                // Generar la tabla en el PDF
                $pdf->SetFont('Arial', '', 12);
                if (!empty($datos)) {
                    $indice = 0;
                    foreach ($ultimos7Dias as $dia) {
                        $cantidad = isset($datos[$indice]) ? $datos[$indice] : 0;
                        $pdf->Cell(40, 10, $cantidad, 1); // Mostrar la cantidad de partidas
                        $pdf->Cell(40, 10, $dia, 1); // Mostrar el día de la lista de últimos 7 días
                        $pdf->Ln(); // Salto de línea
                        $indice++;
                    }
                } else {
                    // Manejar el caso en el que no hay datos disponibles
                    $pdf->Cell(0, 10, 'No hay datos disponibles', 1, 1, 'C');
                }

                break;

            case 'semana':
                $datos = $this->administradorModel->obtenerCantidadPartidasPorSemana();
                // Obtener las últimas 4 semanas
                $ultimas4Semanas = array();
                $fechaActual = new DateTime();

                for ($i = 0; $i < 4; $i++) {
                    $fecha = clone $fechaActual;
                    $fecha->sub(new DateInterval('P'.($i * 7).'D')); // Restar múltiplos de 7 días para obtener las semanas
                    $semana = $fecha->format('W');
                    $ultimas4Semanas[] = $semana;
                }

                $ultimas4Semanas = array_reverse($ultimas4Semanas); // Invertir el orden para que aparezcan en el PDF en orden ascendente

                // Generar la tabla en el PDF
                $pdf->SetFont('Arial', '', 12);
                if (!empty($datos)) {
                    $indice = 0;
                    foreach ($ultimas4Semanas as $semana) {
                        $cantidad = isset($datos[$indice]) ? $datos[$indice] : 0;
                        $pdf->Cell(40, 10, $cantidad, 1);
                        $pdf->Cell(40, 10, $semana, 1);
                        $pdf->Ln(); // Salto de línea
                        $indice++;
                    }
                } else {
                    // Manejar el caso en el que no hay datos disponibles
                    $pdf->Cell(0, 10, 'No hay datos disponibles', 1, 1, 'C');
                }

                break;
            case 'mes':
                $datos = $this->administradorModel->obtenerCantidadPartidasPorMes();
                // Obtener los 12 meses del año
                $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

                // Generar la tabla en el PDF
                $pdf->SetFont('Arial', '', 12);
                if (!empty($datos)) {
                    $indice = 0;
                    foreach ($meses as $mes) {
                        $cantidad = isset($datos[$indice]) ? $datos[$indice] : 0;
                        $pdf->Cell(40, 10, $cantidad, 1); // Mostrar la cantidad de partidas
                        $pdf->Cell(40, 10, $mes, 1); // Mostrar el día de la lista de últimos 7 días
                        $pdf->Ln(); // Salto de línea
                        $indice++;
                    }
                } else {
                    // Manejar el caso en el que no hay datos disponibles
                    $pdf->Cell(0, 10, 'No hay datos disponibles', 1, 1, 'C');
                }

                break;
            case 'anio':
                $datos = $this->administradorModel->obtenerCantidadPartidasPorAnio();
                // Obtener los últimos 4 años
                $ultimos4Anios = array();
                $anioActual = date('Y');

                for ($i = 0; $i < 4; $i++) {
                    $anio = $anioActual - $i;
                    $ultimos4Anios[] = $anio;
                }

                // Generar la tabla en el PDF
                $pdf->SetFont('Arial', '', 12);
                if (!empty($datos)) {
                    $indice = 0;
                    foreach ($ultimos4Anios as $anio) {
                        $cantidad = isset($datos[$indice]) ? $datos[$indice] : 0;
                        $pdf->Cell(40, 10, $cantidad, 1); // Mostrar la cantidad de partidas
                        $pdf->Cell(40, 10, $anio, 1);
                        $pdf->Ln(); // Salto de línea
                        $indice++;
                    }
                } else {
                    // Manejar el caso en el que no hay datos disponibles
                    $pdf->Cell(0, 10, 'No hay datos disponibles', 1, 1, 'C');
                }

                break;
            default:
                $datos = array(); // Definir datos por defecto si no se encuentra un filtro válido
        }

        // Salida del PDF
        $pdf->Output();
    }





}