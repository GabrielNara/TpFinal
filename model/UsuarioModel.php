<?php

class UsuarioModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getUsuarioByUserAndPassword($user, $pass)
    {
        if (empty($user)) throw new Exception('El user no puede estar vacío.');
        if (empty($pass)) throw new Exception('La password no puede estar vacío.');

        $query = "SELECT * FROM usuarios WHERE nombre_usuario='" . $user . "' AND contrasena='" . $pass . "'";
        return $this->database->query($query);
    }
    public function getUsuarioById($id)
    {

        $query = "SELECT * FROM usuarios WHERE id='" . $id .  "'";
        return $this->database->query($query);
    }
}