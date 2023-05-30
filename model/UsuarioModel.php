<?php

class UsuarioModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getUsuario($nombre_usuario, $contrasena) {
        $query = "SELECT * FROM usuarios WHERE nombre_usuario='" . $nombre_usuario . "' AND contrasena='" . $contrasena . "'";
        return $this->database->query($query);
    }

    public function getUsuarioPorNombreUsuario($nombre_usuario) {
        $query = "SELECT * FROM usuarios WHERE nombre_usuario='" . $nombre_usuario . "'";
        return $this->database->query($query);
    }

    public function getErrores($nombre_usuario, $contrasena) {
        $errores = [];
        if (empty($nombre_usuario)) {
            $errores['errorUsername'] = 'El usuario no puede estar vacío.';
        }
        if (empty($contrasena)) {
            $errores['errorContrasena'] = 'La contraseña no puede estar vacía.';
        }
        if (strlen($nombre_usuario) > 0 && empty($this->getUsuarioPorNombreUsuario($nombre_usuario))) {
            $errores['errorNombreUsuario'] = 'No existe un usuario con ese nombre de usuario.';
        }
        if (empty($this->getUsuario($nombre_usuario, $contrasena)) && !empty($this->getUsuarioPorNombreUsuario($nombre_usuario))) {
            $errores['errorCredenciales'] = 'La contraseña es incorrecta.';
        }
        return $errores;
    }
}