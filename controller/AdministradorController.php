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
		if (isset($_SESSION['usuario'])) {
			$rol = $this->administradorModel->getRol($_SESSION['usuario']["id"]);

			if ($rol[0]['idRol'] == 3 || $rol[0]['idRol'] == 2) {
				header('Location: /tpfinal/lobby/list');
				exit();
			}
		} else {
			header('Location: /tpfinal/');
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
		$filtro = $_GET['filtro'] ?? 'anio';


		$contexto = array(
			'filtroDia' => $filtro === 'dia',
			'filtroSemana' => $filtro === 'semana',
			'filtroMes' => $filtro === 'mes',
			'filtroAnio' => $filtro === 'anio'
		);

		switch ($filtro) {
			case 'dia':
				$desde = 1;
				break;
			case 'semana':
				$desde = 7;
				break;
			case 'mes':
				$desde = 30;
				break;
			case 'anio':
				$desde = 365;
				break;
		}

		$cantidadPreguntasActivas = $this->administradorModel->obtenerCantidadPreguntas($desde, 1);
		$cantidadPreguntasSuspendidas = $this->administradorModel->obtenerCantidadPreguntas($desde, 2);
		$cantidadPreguntasReportadas = $this->administradorModel->obtenerCantidadPreguntas($desde, 3);
		$cantidadPreguntasSugeridas = $this->administradorModel->obtenerCantidadPreguntas($desde, 4);

		$contexto['cantPreguntasActivas'] = json_encode($cantidadPreguntasActivas);
		$contexto['cantPreguntasSuspendidas'] = json_encode($cantidadPreguntasSuspendidas);
		$contexto['cantPreguntasReportadas'] = json_encode($cantidadPreguntasReportadas);
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

	public function porcentajeAciertoPorJugador()
	{
		$this->redireccionamiento();
		$datos = $this->administradorModel->obtenerPorcentajeAciertoPorJugador();
		$contexto['datos'] = json_encode($datos);
		$this->renderer->render("porcentajeAciertoPorJugador", $contexto);
	}

	public function convertirAPdfCantidadJugadores()
	{
		$this->redireccionamiento();

		$filtro = $_GET['filtro'] ?? 'anio';
		$pdf = new FPDF();
		$pdf->AddPage();

		// Establecer el título de la tabla
		$pdf->SetFont('Arial', 'B', 14);
		$pdf->Cell(0, 10, 'Jugadores', 0, 1, 'C');

		// Obtener los datos según el filtro seleccionado
		switch ($filtro) {
			case 'dia':
				$datos = $this->administradorModel->obtenerCantidadJugadoresPorDia();
				$ultimos7Dias = array();
				$fechaActual = new DateTime();

				for ($i = 0; $i < 7; $i++) {
					$fecha = clone $fechaActual;
					$fecha->sub(new DateInterval('P'.$i.'D'));
					$dia = $fecha->format('d');
					$mes = $fecha->format('m');
					$fechaFormateada = $dia.'-'.$mes;
					$ultimos7Dias[] = $fechaFormateada;
				}

				$ultimos7Dias = array_reverse($ultimos7Dias); // Invertir el orden para que aparezcan en el PDF en orden ascendente

				$pdf->SetFont('Arial', '', 12);
				$pdf->Cell(40, 10, 'Dia', 1);
				$pdf->Cell(40, 10, 'Jugadores', 1);
				$pdf->Ln(); // Salto de línea

				if (!empty($datos)) {
					$indice = 0;
					foreach ($ultimos7Dias as $dia) {
						$cantidad = isset($datos[$indice]) ? $datos[$indice] : 0;
						$pdf->Cell(40, 10, $dia, 1);
						$pdf->Cell(40, 10, $cantidad, 1);
						$pdf->Ln(); // Salto de línea
						$indice++;
					}
				} else {
					$pdf->Cell(160, 10, 'No hay datos disponibles', 1, 1, 'C');
				}
				break;
			case 'semana':
				$datos = $this->administradorModel->obtenerCantidadJugadoresPorSemana();
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
				$pdf->Cell(40, 10, 'Semana', 1);
				$pdf->Cell(40, 10, 'Jugadores', 1);
				$pdf->Ln(); // Salto de línea

				if (!empty($datos)) {
					$indice = 0;
					foreach ($ultimas4Semanas as $semana) {
						$cantidad = isset($datos[$indice]) ? $datos[$indice] : 0;
						$pdf->Cell(40, 10, $semana, 1);
						$pdf->Cell(40, 10, $cantidad, 1);
						$pdf->Ln(); // Salto de línea
						$indice++;
					}
				} else {
					$pdf->Cell(160, 10, 'No hay datos disponibles', 1, 1, 'C');
				}
				break;
			case 'mes':
				$datos = $this->administradorModel->obtenerCantidadJugadoresPorMes();
				$meses = array(
					'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre',
					'Noviembre', 'Diciembre'
				);

				// Generar la tabla en el PDF
				$pdf->SetFont('Arial', '', 12);
				$pdf->Cell(40, 10, 'Mes', 1);
				$pdf->Cell(40, 10, 'Jugadores', 1);
				$pdf->Ln(); // Salto de línea

				if (!empty($datos)) {
					$indice = 0;
					foreach ($meses as $mes) {
						$cantidad = isset($datos[$indice]) ? $datos[$indice] : 0;
						$pdf->Cell(40, 10, $mes, 1);
						$pdf->Cell(40, 10, $cantidad, 1);
						$pdf->Ln(); // Salto de línea
						$indice++;
					}
				} else {
					$pdf->Cell(160, 10, 'No hay datos disponibles', 1, 1, 'C');
				}
				break;
			case 'anio':
				$ultimos4Anios = array();
				$anioActual = date('Y');

				for ($i = 0; $i < 4; $i++) {
					$anio = $anioActual - $i;
					$ultimos4Anios[] = $anio;
				}

				$ultimos4Anios = array_reverse($ultimos4Anios); // Invertir el orden para que aparezcan en el PDF en orden ascendente
				$datos = $this->administradorModel->obtenerCantidadJugadoresPorAnio($ultimos4Anios);

				// Generar la tabla en el PDF
				$pdf->SetFont('Arial', '', 12);
				$pdf->Cell(40, 10, 'Anio', 1);
				$pdf->Cell(40, 10, 'Jugadores', 1);
				$pdf->Ln(); // Salto de línea

				if (!empty($datos)) {
					$indice = 0;
					foreach ($ultimos4Anios as $anio) {
						$cantidad = isset($datos[$indice]) ? $datos[$indice] : 0;
						$pdf->Cell(40, 10, $anio, 1);
						$pdf->Cell(40, 10, $cantidad, 1);
						$pdf->Ln(); // Salto de línea
						$indice++;
					}
				} else {
					$pdf->Cell(160, 10, 'No hay datos disponibles', 1, 1, 'C');
				}
				break;
			default:
				$datos = array(); // Definir datos por defecto si no se encuentra un filtro válido
		}

		$pdf->Output();
	}

	public function convertirAPdfEstadisticasPreguntas()
	{
		$this->redireccionamiento();
		$filtro = $_GET['filtro'] ?? 'anio';

		$pdf = new FPDF();
		$pdf->AddPage();

		// Establecer el título de la tabla
		$pdf->SetFont('Arial', 'B', 14);
		$pdf->Cell(0, 10, 'Estado preguntas', 0, 1, 'C');

		// Obtener los datos según el filtro seleccionado
		switch ($filtro) {
			case 'dia':
				$desde = 1;
				$pdf->SetFont('Arial', '', 12);
				$pdf->Cell(40, 10, 'Dia', 1);
				$pdf->Cell(40, 10, 'Activas', 1);
				$pdf->Cell(40, 10, 'Suspendidas', 1);
				$pdf->Cell(40, 10, 'Reportadas', 1);
				$pdf->Cell(40, 10, 'Sugeridas', 1);
				$pdf->Ln(); // Salto de línea
				$cantidadPreguntasActivas = $this->administradorModel->obtenerCantidadPreguntas($desde, 1);
				$cantidadPreguntasSuspendidas = $this->administradorModel->obtenerCantidadPreguntas($desde, 2);
				$cantidadPreguntasReportadas = $this->administradorModel->obtenerCantidadPreguntas($desde, 3);
				$cantidadPreguntasSugeridas = $this->administradorModel->obtenerCantidadPreguntas($desde, 4);
				$fechaActual = new DateTime();
				$dia = $fechaActual->format('d');
				$mes = $fechaActual->format('m');
				$fechaFormateada = $dia.'-'.$mes;
				$pdf->Cell(40, 10, $fechaFormateada, 1);
				$pdf->Cell(40, 10, $cantidadPreguntasActivas, 1);
				$pdf->Cell(40, 10, $cantidadPreguntasSuspendidas, 1);
				$pdf->Cell(40, 10, $cantidadPreguntasReportadas, 1);
				$pdf->Cell(40, 10, $cantidadPreguntasSugeridas, 1);
				break;
			case 'semana':
				$desde = 7;
				$pdf->SetFont('Arial', '', 12);
				$pdf->Cell(40, 10, 'Semana', 1);
				$pdf->Cell(40, 10, 'Activas', 1);
				$pdf->Cell(40, 10, 'Suspendidas', 1);
				$pdf->Cell(40, 10, 'Reportadas', 1);
				$pdf->Cell(40, 10, 'Sugeridas', 1);
				$pdf->Ln(); // Salto de línea
				$cantidadPreguntasActivas = $this->administradorModel->obtenerCantidadPreguntas($desde, 1);
				$cantidadPreguntasSuspendidas = $this->administradorModel->obtenerCantidadPreguntas($desde, 2);
				$cantidadPreguntasReportadas = $this->administradorModel->obtenerCantidadPreguntas($desde, 3);
				$cantidadPreguntasSugeridas = $this->administradorModel->obtenerCantidadPreguntas($desde, 4);
				$fechaActual = new DateTime();
				$semana = $fechaActual->format('W');
				$pdf->Cell(40, 10, $semana, 1);
				$pdf->Cell(40, 10, $cantidadPreguntasActivas, 1);
				$pdf->Cell(40, 10, $cantidadPreguntasSuspendidas, 1);
				$pdf->Cell(40, 10, $cantidadPreguntasReportadas, 1);
				$pdf->Cell(40, 10, $cantidadPreguntasSugeridas, 1);
				break;
			case 'mes':
				$desde = 30;
				$pdf->SetFont('Arial', '', 12);
				$pdf->Cell(40, 10, 'Mes', 1);
				$pdf->Cell(40, 10, 'Activas', 1);
				$pdf->Cell(40, 10, 'Suspendidas', 1);
				$pdf->Cell(40, 10, 'Reportadas', 1);
				$pdf->Cell(40, 10, 'Sugeridas', 1);
				$pdf->Ln(); // Salto de línea
				$cantidadPreguntasActivas = $this->administradorModel->obtenerCantidadPreguntas($desde, 1);
				$cantidadPreguntasSuspendidas = $this->administradorModel->obtenerCantidadPreguntas($desde, 2);
				$cantidadPreguntasReportadas = $this->administradorModel->obtenerCantidadPreguntas($desde, 3);
				$cantidadPreguntasSugeridas = $this->administradorModel->obtenerCantidadPreguntas($desde, 4);
				$fechaActual = new DateTime();
				$mes = $fechaActual->format('n');
				$meses = array(
					'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre',
					'Noviembre', 'Diciembre'
				);
				$pdf->Cell(40, 10, $meses[$mes - 1], 1);
				$pdf->Cell(40, 10, $cantidadPreguntasActivas, 1);
				$pdf->Cell(40, 10, $cantidadPreguntasSuspendidas, 1);
				$pdf->Cell(40, 10, $cantidadPreguntasReportadas, 1);
				$pdf->Cell(40, 10, $cantidadPreguntasSugeridas, 1);
				break;
			case 'anio':
				$desde = 365;
				$pdf->SetFont('Arial', '', 12);
				$pdf->Cell(40, 10, 'Anio', 1);
				$pdf->Cell(40, 10, 'Activas', 1);
				$pdf->Cell(40, 10, 'Suspendidas', 1);
				$pdf->Cell(40, 10, 'Reportadas', 1);
				$pdf->Cell(40, 10, 'Sugeridas', 1);
				$pdf->Ln(); // Salto de línea
				$cantidadPreguntasActivas = $this->administradorModel->obtenerCantidadPreguntas($desde, 1);
				$cantidadPreguntasSuspendidas = $this->administradorModel->obtenerCantidadPreguntas($desde, 2);
				$cantidadPreguntasReportadas = $this->administradorModel->obtenerCantidadPreguntas($desde, 3);
				$cantidadPreguntasSugeridas = $this->administradorModel->obtenerCantidadPreguntas($desde, 4);
				$fechaActual = new DateTime();
				$anio = $fechaActual->format('Y');
				$pdf->Cell(40, 10, $anio, 1);
				$pdf->Cell(40, 10, $cantidadPreguntasActivas, 1);
				$pdf->Cell(40, 10, $cantidadPreguntasSuspendidas, 1);
				$pdf->Cell(40, 10, $cantidadPreguntasReportadas, 1);
				$pdf->Cell(40, 10, $cantidadPreguntasSugeridas, 1);
				break;
			default:
				$datos = array(); // Definir datos por defecto si no se encuentra un filtro válido
		}

		$pdf->Output();
	}

	public function convertirAPdfUsuariosPorSexo()
	{
		$this->redireccionamiento();

		$filtro = $_GET['filtro'] ?? 'anio';
		$pdf = new FPDF();
		$pdf->AddPage();

		// Establecer el título de la tabla
		$pdf->SetFont('Arial', 'B', 14);
		$pdf->Cell(0, 10, 'Usuarios por sexo', 0, 1, 'C');

		// Obtener los datos según el filtro seleccionado
		switch ($filtro) {
			case 'dia':
				$datos = $this->administradorModel->obtenerCantidadUsuariosPorSexoPorDia();
				$ultimos7Dias = array();
				$fechaActual = new DateTime();

				for ($i = 0; $i < 7; $i++) {
					$fecha = clone $fechaActual;
					$fecha->sub(new DateInterval('P'.$i.'D'));
					$dia = $fecha->format('d');
					$mes = $fecha->format('m');
					$fechaFormateada = $dia.'-'.$mes;
					$ultimos7Dias[] = $fechaFormateada;
				}

				$ultimos7Dias = array_reverse($ultimos7Dias); // Invertir el orden para que aparezcan en el PDF en orden ascendente

				$pdf->SetFont('Arial', '', 12);
				$pdf->Cell(40, 10, 'Dia', 1);
				$pdf->Cell(40, 10, 'Hombres', 1);
				$pdf->Cell(40, 10, 'Mujeres', 1);
				$pdf->Cell(40, 10, 'Otros', 1);
				$pdf->Ln(); // Salto de línea

				if (!empty($datos)) {
					$indice = 0;
					foreach ($ultimos7Dias as $dia) {
						$cantidadHombres = isset($datos[$indice]['masculinos']) ? $datos[$indice]['masculinos'] : 0;
						$cantidadMujeres = isset($datos[$indice]['femeninos']) ? $datos[$indice]['femeninos'] : 0;
						$cantidadOtros = isset($datos[$indice]['otros']) ? $datos[$indice]['otros'] : 0;
						$pdf->Cell(40, 10, $dia, 1); // Mostrar el día de la lista de últimos 7 días
						$pdf->Cell(40, 10, $cantidadHombres, 1);
						$pdf->Cell(40, 10, $cantidadMujeres, 1);
						$pdf->Cell(40, 10, $cantidadOtros, 1);
						$pdf->Ln(); // Salto de línea
						$indice++;
					}
				} else {
					$pdf->Cell(160, 10, 'No hay datos disponibles', 1, 1, 'C');
				}
				break;
			case 'semana':
				$datos = $this->administradorModel->obtenerCantidadUsuariosPorSexoPorSemana();
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
				$pdf->Cell(40, 10, 'Semana', 1);
				$pdf->Cell(40, 10, 'Hombres', 1);
				$pdf->Cell(40, 10, 'Mujeres', 1);
				$pdf->Cell(40, 10, 'Otros', 1);
				$pdf->Ln(); // Salto de línea

				if (!empty($datos)) {
					$indice = 0;
					foreach ($ultimas4Semanas as $semana) {
						$cantidadHombres = isset($datos[$indice]['masculinos']) ? $datos[$indice]['masculinos'] : 0;
						$cantidadMujeres = isset($datos[$indice]['femeninos']) ? $datos[$indice]['femeninos'] : 0;
						$cantidadOtros = isset($datos[$indice]['otros']) ? $datos[$indice]['otros'] : 0;
						$pdf->Cell(40, 10, $semana, 1);
						$pdf->Cell(40, 10, $cantidadHombres, 1);
						$pdf->Cell(40, 10, $cantidadMujeres, 1);
						$pdf->Cell(40, 10, $cantidadOtros, 1);
						$pdf->Ln(); // Salto de línea
						$indice++;
					}
				} else {
					$pdf->Cell(160, 10, 'No hay datos disponibles', 1, 1, 'C');
				}
				break;
			case 'mes':
				$datos = $this->administradorModel->obtenerCantidadUsuariosPorSexoPorMes();
				$meses = array(
					'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
					'Octubre',
					'Noviembre', 'Diciembre'
				);

				// Generar la tabla en el PDF
				$pdf->SetFont('Arial', '', 12);
				$pdf->Cell(40, 10, 'Mes', 1);
				$pdf->Cell(40, 10, 'Hombres', 1);
				$pdf->Cell(40, 10, 'Mujeres', 1);
				$pdf->Cell(40, 10, 'Otros', 1);
				$pdf->Ln(); // Salto de línea

				if (!empty($datos)) {
					$indice = 0;
					foreach ($meses as $mes) {
						$cantidadHombres = isset($datos[$indice]['masculinos']) ? $datos[$indice]['masculinos'] : 0;
						$cantidadMujeres = isset($datos[$indice]['femeninos']) ? $datos[$indice]['femeninos'] : 0;
						$cantidadOtros = isset($datos[$indice]['otros']) ? $datos[$indice]['otros'] : 0;
						$pdf->Cell(40, 10, $mes, 1);
						$pdf->Cell(40, 10, $cantidadHombres, 1);
						$pdf->Cell(40, 10, $cantidadMujeres, 1);
						$pdf->Cell(40, 10, $cantidadOtros, 1);
						$pdf->Ln(); // Salto de línea
						$indice++;
					}
				} else {
					$pdf->Cell(160, 10, 'No hay datos disponibles', 1, 1, 'C');
				}
				break;
			case 'anio':
				$datos = $this->administradorModel->obtenerCantidadUsuariosPorSexoPorAnio();
				$ultimos4Anios = array();
				$anioActual = date('Y');

				for ($i = 0; $i < 4; $i++) {
					$anio = $anioActual - $i;
					$ultimos4Anios[] = $anio;
				}

				$ultimos4Anios = array_reverse($ultimos4Anios);

				// Generar la tabla en el PDF
				$pdf->SetFont('Arial', '', 12);
				$pdf->Cell(40, 10, 'Anio', 1);
				$pdf->Cell(40, 10, 'Hombres', 1);
				$pdf->Cell(40, 10, 'Mujeres', 1);
				$pdf->Cell(40, 10, 'Otros', 1);
				$pdf->Ln(); // Salto de línea

				if (!empty($datos)) {
					$indice = count($ultimos4Anios) - 1;
					foreach ($ultimos4Anios as $anio) {
						$cantidadHombres = isset($datos[$indice]['masculinos']) ? $datos[$indice]['masculinos'] : 0;
						$cantidadMujeres = isset($datos[$indice]['femeninos']) ? $datos[$indice]['femeninos'] : 0;
						$cantidadOtros = isset($datos[$indice]['otros']) ? $datos[$indice]['otros'] : 0;
						$pdf->Cell(40, 10, $anio, 1);
						$pdf->Cell(40, 10, $cantidadHombres, 1);
						$pdf->Cell(40, 10, $cantidadMujeres, 1);
						$pdf->Cell(40, 10, $cantidadOtros, 1);
						$pdf->Ln(); // Salto de línea
						$indice--;
					}
				} else {
					$pdf->Cell(160, 10, 'No hay datos disponibles', 1, 1, 'C');
				}
				break;
			default:
				$datos = array(); // Definir datos por defecto si no se encuentra un filtro válido
		}

		$pdf->Output();
	}

	public function convertirAPdfCantidadPartidas()
	{
		$this->redireccionamiento();

		$filtro = $_GET['filtro'] ?? 'anio';
		$pdf = new FPDF();
		$pdf->AddPage();

		// Establecer el título de la tabla
		$pdf->SetFont('Arial', 'B', 14);
		$pdf->Cell(0, 10, 'Partidas por fechas', 0, 1, 'C');

		// Obtener los datos según el filtro seleccionado
		switch ($filtro) {
			case 'dia':
				$datos = $this->administradorModel->obtenerCantidadPartidasPorDia();
				$ultimos7Dias = array();
				$fechaActual = new DateTime();

				for ($i = 0; $i < 7; $i++) {
					$fecha = clone $fechaActual;
					$fecha->sub(new DateInterval('P'.$i.'D'));
					$dia = $fecha->format('d');
					$mes = $fecha->format('m');
					$fechaFormateada = $dia.'-'.$mes;
					$ultimos7Dias[] = $fechaFormateada;
				}

				$ultimos7Dias = array_reverse($ultimos7Dias); // Invertir el orden para que aparezcan en el PDF en orden ascendente

				// Generar la tabla en el PDF
				$pdf->SetFont('Arial', '', 12);
				$pdf->Cell(40, 10, 'Dia', 1);
				$pdf->Cell(40, 10, 'Partidas', 1);
				$pdf->Ln(); // Salto de línea

				if (!empty($datos)) {
					$indice = 0;
					foreach ($ultimos7Dias as $dia) {
						$cantidad = isset($datos[$indice]) ? $datos[$indice] : 0;
						$pdf->Cell(40, 10, $dia, 1); // Mostrar el día de la lista de últimos 7 días
						$pdf->Cell(40, 10, $cantidad, 1); // Mostrar la cantidad de partidas
						$pdf->Ln(); // Salto de línea
						$indice++;
					}
				} else {
					$pdf->Cell(0, 10, 'No hay datos disponibles', 1, 1, 'C');
				}
				break;
			case 'semana':
				$datos = $this->administradorModel->obtenerCantidadPartidasPorSemana();
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
				$pdf->Cell(40, 10, 'Semana', 1);
				$pdf->Cell(40, 10, 'Partidas', 1);
				$pdf->Ln(); // Salto de línea

				if (!empty($datos)) {
					$indice = 0;
					foreach ($ultimas4Semanas as $semana) {
						$cantidad = isset($datos[$indice]) ? $datos[$indice] : 0;
						$pdf->Cell(40, 10, $semana, 1);
						$pdf->Cell(40, 10, $cantidad, 1);
						$pdf->Ln(); // Salto de línea
						$indice++;
					}
				} else {
					$pdf->Cell(0, 10, 'No hay datos disponibles', 1, 1, 'C');
				}
				break;
			case 'mes':
				$datos = $this->administradorModel->obtenerCantidadPartidasPorMes();
				$meses = array(
					'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
					'Octubre',
					'Noviembre', 'Diciembre'
				);

				// Generar la tabla en el PDF
				$pdf->SetFont('Arial', '', 12);
				$pdf->Cell(40, 10, 'Mes', 1);
				$pdf->Cell(40, 10, 'Partidas', 1);
				$pdf->Ln(); // Salto de línea

				if (!empty($datos)) {
					$indice = 0;
					foreach ($meses as $mes) {
						$cantidad = isset($datos[$indice]) ? $datos[$indice] : 0;
						$pdf->Cell(40, 10, $mes, 1); // Mostrar el día de la lista de últimos 7 días
						$pdf->Cell(40, 10, $cantidad, 1); // Mostrar la cantidad de partidas
						$pdf->Ln(); // Salto de línea
						$indice++;
					}
				} else {
					$pdf->Cell(0, 10, 'No hay datos disponibles', 1, 1, 'C');
				}
				break;
			case 'anio':
				$datos = $this->administradorModel->obtenerCantidadPartidasPorAnio();
				$ultimos4Anios = array();
				$anioActual = date('Y');

				for ($i = 0; $i < 4; $i++) {
					$anio = $anioActual - $i;
					$ultimos4Anios[] = $anio;
				}

				$ultimos4Anios = array_reverse($ultimos4Anios);

				// Generar la tabla en el PDF
				$pdf->SetFont('Arial', '', 12);
				$pdf->Cell(40, 10, 'Anio', 1);
				$pdf->Cell(40, 10, 'Partidas', 1);
				$pdf->Ln(); // Salto de línea

				if (!empty($datos)) {
					$indice = count($ultimos4Anios) - 1;
					foreach ($ultimos4Anios as $anio) {
						$cantidad = isset($datos[$indice]) ? $datos[$indice] : 0;
						$pdf->Cell(40, 10, $anio, 1);
						$pdf->Cell(40, 10, $cantidad, 1); // Mostrar la cantidad de partidas
						$pdf->Ln(); // Salto de línea
						$indice--;
					}
				} else {
					$pdf->Cell(0, 10, 'No hay datos disponibles', 1, 1, 'C');
				}
				break;
			default:
				$datos = array(); // Definir datos por defecto si no se encuentra un filtro válido
		}

		// Salida del PDF
		$pdf->Output();
	}

	public function convertirAPdfUsuariosPorEdad()
	{
		$this->redireccionamiento();

		$filtro = $_GET['filtro'] ?? 'anio';
		$pdf = new FPDF();
		$pdf->AddPage();

		// Establecer el título de la tabla
		$pdf->SetFont('Arial', 'B', 14);
		$pdf->Cell(0, 10, 'Usuarios por edad', 0, 1, 'C');

		// Obtener los datos según el filtro seleccionado
		switch ($filtro) {
			case 'dia':
				$datos = $this->administradorModel->obtenerCantidadUsuariosPorEdadPorDia();
				$ultimos7Dias = array();
				$fechaActual = new DateTime();

				for ($i = 0; $i < 7; $i++) {
					$fecha = clone $fechaActual;
					$fecha->sub(new DateInterval('P'.$i.'D'));
					$dia = $fecha->format('d');
					$mes = $fecha->format('m');
					$fechaFormateada = $dia.'-'.$mes;
					$ultimos7Dias[] = $fechaFormateada;
				}

				$ultimos7Dias = array_reverse($ultimos7Dias); // Invertir el orden para que aparezcan en el PDF en orden ascendente

				$pdf->SetFont('Arial', '', 12);
				$pdf->Cell(40, 10, 'Dia', 1);
				$pdf->Cell(40, 10, 'Menores', 1);
				$pdf->Cell(40, 10, 'Medios', 1);
				$pdf->Cell(40, 10, 'Jubilados', 1);
				$pdf->Ln(); // Salto de línea

				if (!empty($datos)) {
					$indice = 0;
					foreach ($ultimos7Dias as $dia) {
						$cantidadMenores = isset($datos[$indice]['menores']) ? $datos[$indice]['menores'] : 0;
						$cantidadMedios = isset($datos[$indice]['medios']) ? $datos[$indice]['medios'] : 0;
						$cantidadJubilados = isset($datos[$indice]['jubilados']) ? $datos[$indice]['jubilados'] : 0;
						$pdf->Cell(40, 10, $dia, 1); // Mostrar el día de la lista de últimos 7 días
						$pdf->Cell(40, 10, $cantidadMenores, 1); // Mostrar la cantidad de menores
						$pdf->Cell(40, 10, $cantidadMedios, 1); // Mostrar la cantidad de medios
						$pdf->Cell(40, 10, $cantidadJubilados, 1); // Mostrar la cantidad de jubilados
						$pdf->Ln(); // Salto de línea
						$indice++;
					}
				} else {
					$pdf->Cell(160, 10, 'No hay datos disponibles', 1, 1, 'C');
				}


				break;

			case 'semana':
				$datos = $this->administradorModel->obtenerCantidadUsuariosPorEdadPorSemana();
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
				$pdf->Cell(40, 10, 'Semana', 1);
				$pdf->Cell(40, 10, 'Menores', 1);
				$pdf->Cell(40, 10, 'Medios', 1);
				$pdf->Cell(40, 10, 'Jubilados', 1);
				$pdf->Ln(); // Salto de línea

				if (!empty($datos)) {
					$indice = 0;
					foreach ($ultimas4Semanas as $semana) {
						$cantidadMenores = isset($datos[$indice]['menores']) ? $datos[$indice]['menores'] : 0;
						$cantidadMedios = isset($datos[$indice]['medios']) ? $datos[$indice]['medios'] : 0;
						$cantidadJubilados = isset($datos[$indice]['jubilados']) ? $datos[$indice]['jubilados'] : 0;
						$pdf->Cell(40, 10, $semana, 1); // Mostrar el día de la lista de últimos 7 días
						$pdf->Cell(40, 10, $cantidadMenores, 1); // Mostrar la cantidad de menores
						$pdf->Cell(40, 10, $cantidadMedios, 1); // Mostrar la cantidad de medios
						$pdf->Cell(40, 10, $cantidadJubilados, 1); // Mostrar la cantidad de jubilados
						$pdf->Ln(); // Salto de línea
						$indice++;
					}
				} else {
					$pdf->Cell(160, 10, 'No hay datos disponibles', 1, 1, 'C');
				}

				break;
			case 'mes':
				$datos = $this->administradorModel->obtenerCantidadUsuariosPorEdadPorMes();
				$meses = array(
					'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
					'Octubre',
					'Noviembre', 'Diciembre'
				);

				// Generar la tabla en el PDF
				$pdf->SetFont('Arial', '', 12);
				$pdf->Cell(40, 10, 'Mes', 1);
				$pdf->Cell(40, 10, 'Menores', 1);
				$pdf->Cell(40, 10, 'Medios', 1);
				$pdf->Cell(40, 10, 'Jubilados', 1);
				$pdf->Ln(); // Salto de línea

				if (!empty($datos)) {
					$indice = 0;
					foreach ($meses as $mes) {
						$cantidadMenores = isset($datos[$indice]['menores']) ? $datos[$indice]['menores'] : 0;
						$cantidadMedios = isset($datos[$indice]['medios']) ? $datos[$indice]['medios'] : 0;
						$cantidadJubilados = isset($datos[$indice]['jubilados']) ? $datos[$indice]['jubilados'] : 0;
						$pdf->Cell(40, 10, $mes, 1); // Mostrar el día de la lista de últimos 7 días
						$pdf->Cell(40, 10, $cantidadMenores, 1); // Mostrar la cantidad de menores
						$pdf->Cell(40, 10, $cantidadMedios, 1); // Mostrar la cantidad de medios
						$pdf->Cell(40, 10, $cantidadJubilados, 1); // Mostrar la cantidad de jubilados
						$pdf->Ln(); // Salto de línea
						$indice++;
					}
				} else {
					$pdf->Cell(160, 10, 'No hay datos disponibles', 1, 1, 'C');
				}

				break;
			case 'anio':
				$datos = $this->administradorModel->obtenerCantidadUsuariosPorEdadPorAnio();
				$ultimos4Anios = array();
				$anioActual = date('Y');

				for ($i = 0; $i < 4; $i++) {
					$anio = $anioActual - $i;
					$ultimos4Anios[] = $anio;
				}

				$ultimos4Anios = array_reverse($ultimos4Anios);

				// Generar la tabla en el PDF
				$pdf->SetFont('Arial', '', 12);
				$pdf->Cell(40, 10, 'Anio', 1);
				$pdf->Cell(40, 10, 'Menores', 1);
				$pdf->Cell(40, 10, 'Medios', 1);
				$pdf->Cell(40, 10, 'Jubilados', 1);
				$pdf->Ln(); // Salto de línea

				if (!empty($datos)) {
					$indice = count($ultimos4Anios) - 1;
					foreach ($ultimos4Anios as $anio) {
						$cantidadMenores = isset($datos[$indice]['menores']) ? $datos[$indice]['menores'] : 0;
						$cantidadMedios = isset($datos[$indice]['medios']) ? $datos[$indice]['medios'] : 0;
						$cantidadJubilados = isset($datos[$indice]['jubilados']) ? $datos[$indice]['jubilados'] : 0;
						$pdf->Cell(40, 10, $anio, 1); // Mostrar el día de la lista de últimos 7 días
						$pdf->Cell(40, 10, $cantidadMenores, 1); // Mostrar la cantidad de menores
						$pdf->Cell(40, 10, $cantidadMedios, 1); // Mostrar la cantidad de medios
						$pdf->Cell(40, 10, $cantidadJubilados, 1); // Mostrar la cantidad de jubilados
						$pdf->Ln(); // Salto de línea
						$indice--;
					}
				} else {
					$pdf->Cell(160, 10, 'No hay datos disponibles', 1, 1, 'C');
				}

				break;
			default:
				$datos = array(); // Definir datos por defecto si no se encuentra un filtro válido
		}

		$pdf->Output();
	}

	public function convertirAPdfUsuariosPorPais()
	{
		$this->redireccionamiento();

		$filtro = $_GET['filtro'] ?? 'anio';
		$pdf = new FPDF();
		$pdf->AddPage();

		// Establecer el título de la tabla
		$pdf->SetFont('Arial', 'B', 14);
		$pdf->Cell(0, 10, 'Usuarios por pais', 0, 1, 'C');

		// Obtener los datos según el filtro seleccionado
		switch ($filtro) {
			case 'dia':
				$datos = $this->administradorModel->obtenerCantidadUsuariosPorPaisPorDia();
				$ultimos7Dias = array();
				$fechaActual = new DateTime();

				for ($i = 0; $i < 7; $i++) {
					$fecha = clone $fechaActual;
					$fecha->sub(new DateInterval('P'.$i.'D'));
					$dia = $fecha->format('d');
					$mes = $fecha->format('m');
					$fechaFormateada = $dia.'-'.$mes;
					$ultimos7Dias[] = $fechaFormateada;
				}

				$ultimos7Dias = array_reverse($ultimos7Dias); // Invertir el orden para que aparezcan en el PDF en orden ascendente

				$pdf->SetFont('Arial', '', 12);
				$pdf->Cell(20, 10, 'Dia', 1);
				$pdf->Cell(20, 10, 'Argentina', 1);
				$pdf->Cell(20, 10, 'Chile', 1);
				$pdf->Cell(20, 10, 'Peru', 1);
				$pdf->Cell(20, 10, 'Colombia', 1);
				$pdf->Cell(20, 10, 'Otros', 1);
				$pdf->Ln(); // Salto de línea

				if (!empty($datos)) {
					$indice = 0;
					foreach ($ultimos7Dias as $dia) {
						$cantidadArgentina = isset($datos[$indice]['argentinos']) ? $datos[$indice]['argentinos'] : 0;
						$cantidadChile = isset($datos[$indice]['chilenos']) ? $datos[$indice]['chilenos'] : 0;
						$cantidadPeru = isset($datos[$indice]['peruanos']) ? $datos[$indice]['peruanos'] : 0;
						$cantidadColombia = isset($datos[$indice]['colombianos']) ? $datos[$indice]['colombianos'] : 0;
						$cantidadOtros = isset($datos[$indice]['otros']) ? $datos[$indice]['otros'] : 0;
						$pdf->Cell(20, 10, $dia, 1);
						$pdf->Cell(20, 10, $cantidadArgentina, 1);
						$pdf->Cell(20, 10, $cantidadChile, 1);
						$pdf->Cell(20, 10, $cantidadPeru, 1);
						$pdf->Cell(20, 10, $cantidadColombia, 1);
						$pdf->Cell(20, 10, $cantidadOtros, 1);
						$pdf->Ln(); // Salto de línea
						$indice++;
					}
				} else {
					$pdf->Cell(160, 10, 'No hay datos disponibles', 1, 1, 'C');
				}
				break;
			case 'semana':
				$datos = $this->administradorModel->obtenerCantidadUsuariosPorPaisPorSemana();
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
				$pdf->Cell(20, 10, 'Semana', 1);
				$pdf->Cell(20, 10, 'Argentina', 1);
				$pdf->Cell(20, 10, 'Chile', 1);
				$pdf->Cell(20, 10, 'Peru', 1);
				$pdf->Cell(20, 10, 'Colombia', 1);
				$pdf->Cell(20, 10, 'Otros', 1);
				$pdf->Ln(); // Salto de línea

				if (!empty($datos)) {
					$indice = 0;
					foreach ($ultimas4Semanas as $semana) {
						$cantidadArgentina = isset($datos[$indice]['argentinos']) ? $datos[$indice]['argentinos'] : 0;
						$cantidadChile = isset($datos[$indice]['chilenos']) ? $datos[$indice]['chilenos'] : 0;
						$cantidadPeru = isset($datos[$indice]['peruanos']) ? $datos[$indice]['peruanos'] : 0;
						$cantidadColombia = isset($datos[$indice]['colombianos']) ? $datos[$indice]['colombianos'] : 0;
						$cantidadOtros = isset($datos[$indice]['otros']) ? $datos[$indice]['otros'] : 0;
						$pdf->Cell(20, 10, $semana, 1);
						$pdf->Cell(20, 10, $cantidadArgentina, 1);
						$pdf->Cell(20, 10, $cantidadChile, 1);
						$pdf->Cell(20, 10, $cantidadPeru, 1);
						$pdf->Cell(20, 10, $cantidadColombia, 1);
						$pdf->Cell(20, 10, $cantidadOtros, 1);
						$pdf->Ln(); // Salto de línea
						$indice++;
					}
				} else {
					$pdf->Cell(160, 10, 'No hay datos disponibles', 1, 1, 'C');
				}
				break;
			case 'mes':
				$datos = $this->administradorModel->obtenerCantidadUsuariosPorPaisPorMes();
				$meses = array(
					'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre',
					'Octubre',
					'Noviembre', 'Diciembre'
				);

				// Generar la tabla en el PDF
				$pdf->SetFont('Arial', '', 12);
				$pdf->Cell(40, 10, 'Mes', 1);
				$pdf->Cell(20, 10, 'Argentina', 1);
				$pdf->Cell(20, 10, 'Chile', 1);
				$pdf->Cell(20, 10, 'Peru', 1);
				$pdf->Cell(20, 10, 'Colombia', 1);
				$pdf->Cell(20, 10, 'Otros', 1);
				$pdf->Ln(); // Salto de línea

				if (!empty($datos)) {
					$indice = 0;
					foreach ($meses as $mes) {
						$cantidadArgentina = isset($datos[$indice]['argentinos']) ? $datos[$indice]['argentinos'] : 0;
						$cantidadChile = isset($datos[$indice]['chilenos']) ? $datos[$indice]['chilenos'] : 0;
						$cantidadPeru = isset($datos[$indice]['peruanos']) ? $datos[$indice]['peruanos'] : 0;
						$cantidadColombia = isset($datos[$indice]['colombianos']) ? $datos[$indice]['colombianos'] : 0;
						$cantidadOtros = isset($datos[$indice]['otros']) ? $datos[$indice]['otros'] : 0;
						$pdf->Cell(40, 10, $mes, 1);
						$pdf->Cell(20, 10, $cantidadArgentina, 1);
						$pdf->Cell(20, 10, $cantidadChile, 1);
						$pdf->Cell(20, 10, $cantidadPeru, 1);
						$pdf->Cell(20, 10, $cantidadColombia, 1);
						$pdf->Cell(20, 10, $cantidadOtros, 1);
						$pdf->Ln(); // Salto de línea
						$indice++;
					}
				} else {
					$pdf->Cell(160, 10, 'No hay datos disponibles', 1, 1, 'C');
				}
				break;
			case 'anio':
				$datos = $this->administradorModel->obtenerCantidadUsuariosPorPaisPorAnio();
				$ultimos4Anios = array();
				$anioActual = date('Y');

				for ($i = 0; $i < 4; $i++) {
					$anio = $anioActual - $i;
					$ultimos4Anios[] = $anio;
				}

				$ultimos4Anios = array_reverse($ultimos4Anios);

				// Generar la tabla en el PDF
				$pdf->SetFont('Arial', '', 12);
				$pdf->Cell(40, 10, 'Anio', 1);
				$pdf->Cell(20, 10, 'Argentina', 1);
				$pdf->Cell(20, 10, 'Chile', 1);
				$pdf->Cell(20, 10, 'Peru', 1);
				$pdf->Cell(20, 10, 'Colombia', 1);
				$pdf->Cell(20, 10, 'Otros', 1);
				$pdf->Ln(); // Salto de línea

				if (!empty($datos)) {
					$indice = count($ultimos4Anios) - 1;
					foreach ($ultimos4Anios as $anio) {
						$cantidadArgentina = isset($datos[$indice]['argentinos']) ? $datos[$indice]['argentinos'] : 0;
						$cantidadChile = isset($datos[$indice]['chilenos']) ? $datos[$indice]['chilenos'] : 0;
						$cantidadPeru = isset($datos[$indice]['peruanos']) ? $datos[$indice]['peruanos'] : 0;
						$cantidadColombia = isset($datos[$indice]['colombianos']) ? $datos[$indice]['colombianos'] : 0;
						$cantidadOtros = isset($datos[$indice]['otros']) ? $datos[$indice]['otros'] : 0;
						$pdf->Cell(40, 10, $anio, 1);
						$pdf->Cell(20, 10, $cantidadArgentina, 1);
						$pdf->Cell(20, 10, $cantidadChile, 1);
						$pdf->Cell(20, 10, $cantidadPeru, 1);
						$pdf->Cell(20, 10, $cantidadColombia, 1);
						$pdf->Cell(20, 10, $cantidadOtros, 1);
						$pdf->Ln(); // Salto de línea
						$indice--;
					}
				} else {
					$pdf->Cell(160, 10, 'No hay datos disponibles', 1, 1, 'C');
				}
				break;
			default:
				$datos = array(); // Definir datos por defecto si no se encuentra un filtro válido
		}

		$pdf->Output();
	}

	public function convertirAPdfPorcentajeAciertoPorJugador()
	{
		$this->redireccionamiento();

		$pdf = new FPDF();
		$pdf->AddPage();

		// Establecer el título de la tabla
		$pdf->SetFont('Arial', 'B', 14);
		$pdf->Cell(0, 10, 'Porcentaje de acierto por jugador', 0, 1, 'C');

		$datos = $this->administradorModel->obtenerPorcentajeAciertoPorJugador();

		// Generar la tabla en el PDF
		$pdf->SetFont('Arial', '', 12);
		$pdf->Cell(50, 10, 'Nombre de usuario', 1);
		$pdf->Cell(50, 10, 'Porcentaje de acierto', 1);
		$pdf->Ln(); // Salto de línea

		for ($i = 0; $i < count($datos); $i++) {
			$nombre_usuario = $datos[$i]['nombre_usuario'];
			$porcentaje_acierto = $datos[$i]['porcentaje_acierto'];
			$pdf->Cell(50, 10, $nombre_usuario, 1);
			$pdf->Cell(50, 10, $porcentaje_acierto.'%', 1);
			$pdf->Ln(); // Salto de línea
		}
		$pdf->Output();
	}

	public function list()
	{
		header('Location: /tpfinal/administrador/estadisticas');
		exit();
	}
}