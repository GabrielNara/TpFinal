<?php

class AdministradorModel
{
	private $database;

	public function __construct($database)
	{
		$this->database = $database;
	}

	public function getRol($id)
	{
		$query = "SELECT idRol FROM `usuarios_roles` inner join usuarios on idUsuario= usuarios.id where idUsuario = '$id'";
		return $this->database->querySelectFetchAssoc($query);
	}

	public function obtenerCantidadJugadoresPorDia()
	{
		$cantidad_jugadores = [];
		$fechas = [];
		for ($i = 0; $i < 7; $i++) {
			$fecha = date("Y-m-d", strtotime("-$i days"));
			array_push($fechas, $fecha);
		}
		sort($fechas);
		foreach ($fechas as $fecha) {
			$fechaInicio = $fecha." 00:00:00";
			$fechaFin = $fecha." 23:59:59";
			$query = "SELECT COUNT(*) AS cantidad FROM usuarios WHERE fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'";
			$cantidad = $this->database->querySelectFetchAssoc($query);
			array_push($cantidad_jugadores, intval($cantidad[0]["cantidad"]));
		}

		return $cantidad_jugadores;
	}

	public function obtenerCantidadJugadoresPorSemana()
	{
		$cantidad_jugadores = [];
		$fechas = [];

		for ($i = 0; $i < 4; $i++) {
			$fecha_inicio = strtotime("-".(($i * 7) + 6)." days");
			$fecha_fin = strtotime("-".($i * 7)." days");

			$fechas[$i] = array(
				'inicio' => date('Y-m-d', $fecha_inicio),
				'fin' => date('Y-m-d', $fecha_fin)
			);
		}

		$fechas = array_reverse($fechas);

		for ($i = 0; $i < count($fechas); $i++) {
			$fechaInicio = $fechas[$i]['inicio']." 00:00:00";
			$fechaFin = $fechas[$i]['fin']." 23:59:59";
			$query = "SELECT COUNT(*) AS cantidad FROM usuarios WHERE fecha_registro BETWEEN '$fechaInicio' AND '$fechaFin'";
			$cantidad = $this->database->querySelectFetchAssoc($query);
			array_push($cantidad_jugadores, intval($cantidad[0]["cantidad"]));
		}

		return $cantidad_jugadores;
	}

	public function obtenerCantidadJugadoresPorMes()
	{
		$cantidad_jugadores = [];

		for ($i = 1; $i <= 12; $i++) {
			$query = "SELECT COUNT(*) AS cantidad FROM usuarios u
                  INNER JOIN usuarios_roles ur ON u.id = ur.idUsuario
                  INNER JOIN roles r ON ur.idRol = r.id
                  WHERE r.id = 3 AND YEAR(u.fecha_registro) = 2023 AND MONTH(u.fecha_registro) = '$i';";

			$cantidad = $this->database->querySelectFetchAssoc($query);
			array_push($cantidad_jugadores, intval($cantidad[0]["cantidad"]));
		}

		return $cantidad_jugadores;
	}

	public function obtenerCantidadJugadoresPorAnio($anios)
	{
		$cantidad_jugadores = [];

		foreach ($anios as $anio) {
			$query = "SELECT COUNT(*) AS cantidad FROM usuarios u
                  INNER JOIN usuarios_roles ur ON u.id = ur.idUsuario
                  INNER JOIN roles r ON ur.idRol = r.id
                  WHERE r.id = 3 AND YEAR(u.fecha_registro) = '$anio';";

			$cantidad = $this->database->querySelectFetchAssoc($query);
			array_push($cantidad_jugadores, intval($cantidad[0]["cantidad"]));
		}

		return $cantidad_jugadores;
	}

	public function getAniosRegistroJugadores()
	{
		$query = "SELECT YEAR(fecha_registro) AS anios FROM usuarios ORDER BY anios ASC;";
		return $this->database->querySelectFetchAssoc($query);
	}
    public function obtenerCantidadPreguntas($desde, $estado){
        $query = "SELECT COUNT(*) cant_preguntas FROM preguntas WHERE fecha_creacion >= DATE_SUB(CURDATE(), INTERVAL $desde DAY) AND fecha_creacion <= CURDATE() AND id_estado_pregunta = $estado;";
        $cantidad =$this->database->querySelectFetchAssoc($query);
        return intval($cantidad[0]["cant_preguntas"]);
    }


    public function obtenerCantidadJugadoresMDia($fecha){

        $query= "SELECT COUNT(*)FROM `usuarios` WHERE sexo = 'M' and fecha_registro ='$fecha'";
        $cantidadM = $this->database->querySelectFetchAssoc($query);
        return intval($cantidadM[0]["COUNT(*)"]);
    }


    public function obtenerCantidadJugadoresFDia($fecha){

        $query= "SELECT COUNT(*)FROM `usuarios` WHERE sexo = 'F' and fecha_registro = '$fecha'";
        $cantidad = $this->database->querySelectFetchAssoc($query);
        return intval($cantidad[0]["COUNT(*)"]);
    }

    public function obtenerCantidadJugadoresOtroDia($fecha){

        $query= "SELECT COUNT(*)FROM `usuarios` WHERE sexo = 'Otro' and fecha_registro ='$fecha'";
        $cantidad = $this->database->querySelectFetchAssoc($query);
        return intval($cantidad[0]["COUNT(*)"]);
    }

public function ObtenerCantidadJugadoresMSemanal($fechaInicio, $fechaSalida){
    $query= "SELECT COUNT(*)FROM `usuarios` WHERE sexo = 'M' and fecha_registro between '$fechaInicio' and '$fechaSalida'";
    $cantidad = $this->database->querySelectFetchAssoc($query);
    return intval($cantidad[0]["COUNT(*)"]);
}
    public function ObtenerCantidadJugadoresFSemanal($fechaInicio, $fechaSalida){
        $query= "SELECT COUNT(*)FROM `usuarios` WHERE sexo = 'F' and fecha_registro between '$fechaInicio' and '$fechaSalida'";
        $cantidad = $this->database->querySelectFetchAssoc($query);
        return intval($cantidad[0]["COUNT(*)"]);
    }
    public function ObtenerCantidadJugadoresOtroSemanal($fechaInicio, $fechaSalida){
        $query= "SELECT COUNT(*)FROM `usuarios` WHERE sexo = 'Otro' and fecha_registro between '$fechaInicio' and '$fechaSalida'";
        $cantidad = $this->database->querySelectFetchAssoc($query);
        return intval($cantidad[0]["COUNT(*)"]);
    }
}
