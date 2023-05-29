<?php

class LobbyModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function estaValidadoElCorreoUsuario($email) {
        $query = "SELECT validado FROM usuarios WHERE email = '$email'";
        $result = $this->database->query($query);
        return $result[0]['validado'];
    }
}