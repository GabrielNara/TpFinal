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
        $query = "SELECT idRol FROM `usuarios_roles` inner join usuarios on idUsuario= usuarios.id 
        where idUsuario = '$id'";
        return $this->database->querySelectFetchAssoc($query);
    }



    public function obtenerCantidadJugadores($filtroPeriodo = '')
    {
        $query = "SELECT COUNT(*) AS cantidad FROM usuarios u
              INNER JOIN usuarios_roles ur ON u.id = ur.idUsuario
              INNER JOIN roles r ON ur.idRol = r.id
              WHERE r.id = 3";


        // Verificar si el filtro es válido antes de agregarlo a la consulta
        if ($filtroPeriodo !== '' && $this->esFiltroValido($filtroPeriodo)) {
            $query .= " AND " . $filtroPeriodo;
        }

        return $this->database->querySelectFetchAssoc($query);
    }

    private function esFiltroValido($filtro)
    {
        // Aquí puedes agregar la lógica para verificar si el filtro es válido
        // por ejemplo, puedes usar un switch para validar los posibles filtros

        switch ($filtro) {
            case 'DATE(u.fecha_registro) = CURDATE()':
            case 'DATE_FORMAT(u.fecha_registro, "%x-%v") = DATE_FORMAT(CURDATE(), "%x-%v")':
            case 'MONTH(u.fecha_registro) = MONTH(CURDATE())':
            case 'YEAR(u.fecha_registro) = YEAR(CURDATE())':
                return true;
            default:
                return false;
        }
    }




}

























