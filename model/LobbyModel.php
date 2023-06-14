<?php

class LobbyModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function estaValidadoElCorreoUsuario($email)
    {
        $query = "SELECT validado FROM usuarios WHERE email = '$email'";
        $result = $this->database->query($query);
        return $result[0]['validado'];
    }

    public function getRol($id)
    {

        $query = "SELECT idRol FROM `usuarios_roles` inner join usuarios on idUsuario= usuarios.id 
        where idUsuario = '$id'";
        return $this->database->querySelectFetchAssoc($query);


    }


}