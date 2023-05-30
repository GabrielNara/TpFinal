<?php

class UsuarioModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getUsuario($datos) {
        $query = "SELECT * FROM usuarios WHERE nombre_usuario='" . $datos['username'] . "' AND contrasena='" . $datos['password'] . "'";
        return $this->database->query($query);
    }

    public function getUsuarioPorNombreUsuario($nombre_usuario) {
        $query = "SELECT * FROM usuarios WHERE nombre_usuario='" . $nombre_usuario . "'";
        return $this->database->query($query);
    }

    public function getErrores($datos) {
        $errores = [];
        if (empty($datos['username'])) {
            $errores['errorUsername'] = 'El usuario no puede estar vacío.';
        }
        if (empty($datos['password'])) {
            $errores['errorContrasena'] = 'La contraseña no puede estar vacía.';
        }
        if (strlen($datos['username']) > 0 && empty($this->getUsuarioPorNombreUsuario($datos['username']))) {
            $errores['errorNombreUsuario'] = 'No existe un usuario con ese nombre de usuario.';
        }
        if (empty($this->getUsuario($datos)) && !empty($this->getUsuarioPorNombreUsuario($datos['username'])) && !empty($datos['password'])) {
            $errores['errorCredenciales'] = 'La contraseña es incorrecta.';
        }
        return $errores;
    }
}