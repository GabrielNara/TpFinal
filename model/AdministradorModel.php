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


 /*
    public function obtenerCantidadJugadores()
    {
        $query = "SELECT COUNT(*) AS cantidad FROM usuarios u
              INNER JOIN usuarios_roles ur ON u.id = ur.idUsuario
              INNER JOIN roles r ON ur.idRol = r.id
              WHERE r.id = 3";

        return $this->database->querySelectFetchAssoc($query);
    }

 */
    public function obtenerCantidadJugadores($filtroPeriodo = '')
    {
        $query = "SELECT COUNT(*) AS cantidad FROM usuarios u
              INNER JOIN usuarios_roles ur ON u.id = ur.idUsuario
              INNER JOIN roles r ON ur.idRol = r.id
              WHERE r.id = 3";

        if ($filtroPeriodo !== '') {
            $query .= " AND " . $filtroPeriodo;
        }

        return $this->database->querySelectFetchAssoc($query);
    }





}

























