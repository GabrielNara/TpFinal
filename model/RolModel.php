<?php

class RolModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function obtenerUsuariosJugadores()
    {
        $query = "SELECT * FROM usuarios_roles WHERE idRol=3";
        return $this->database->query($query);
    }
}