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



}