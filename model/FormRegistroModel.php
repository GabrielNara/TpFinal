<?php

use PHPMailer\PHPMailer\PHPMailer;

class FormRegistroModel
{
	private $database;

	public function __construct($database)
	{
		$this->database = $database;
	}

	public function validarDatosUsuario($datos)
	{
		$errores = [];
		if (empty($datos['nombre'])) {
			$errores['errorNombre'] = 'El campo nombre no puede estar vacío.';
		}
		if (empty($datos['apellido'])) {
			$errores['errorApellido'] = 'El campo apellido no puede estar vacío.';
		}
		if (empty($datos['username'])) {
			$errores['errorUsername'] = 'El campo nombre de usuario no puede estar vacío.';
		}
		$query = "SELECT * FROM usuarios WHERE nombre_usuario = '{$datos['username']}'";
		$result = $this->database->query($query);
		if (count($result) > 0) {
			$errores['errorUsername'] = 'Ya existe un jugador con ese nombre de usuario.';
		}
		if (empty($datos['latitud']) || empty($datos['longitud']) || empty($datos['pais'])) {
			$errores['errorAutocomplete'] = 'Dirección no puede estar vacío.';
		}
		if (empty($datos['sexo'])) {
			$errores['errorSexo'] = 'El campo sexo no puede estar vacío.';
		}
		if (empty($datos['fnacimiento'])) {
			$errores['errorAnoNacimiento'] = 'El campo año de nacimiento no puede estar vacío.';
		}
		if (empty($datos['email'])) {
			$errores['errorEmail'] = 'El campo email no puede estar vacío.';
		}
		$query = "SELECT * FROM usuarios WHERE email = '{$datos['email']}'";
		$result = $this->database->query($query);
		if (count($result) > 0) {
			$errores['errorEmail'] = 'El email ya fue utilizado.';
		}
		if (empty($datos['password'])) {
			$errores['errorContrasena'] = 'El campo contraseña no puede estar vacío.';
		}
		if (empty($datos['cpassword'])) {
			$errores['errorRepetirContrasena'] = 'El campo repetir contraseña no puede estar vacío.';
		}
		if (empty($datos['foto_perfil'])) {
			$errores['errorFotoPerfil'] = 'Debe subir una foto de perfil.';
		}
		if (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
			$errores['errorEmail'] = 'El email no es válido.';
		}

		if (count($errores) == 0) {
			$this->cargarDatos($datos);
		}

		return $errores;
	}

	public function cargarDatos($datos)
	{
		$nombre = $datos['nombre'];
		$apellido = $datos['apellido'];
		$username = $datos['username'];
		$pais = $datos['pais'];
        $longitud = $datos['longitud'];
        $latitud = $datos['latitud'];
		$sexo = $datos['sexo'];
		$anionacimiento = $datos['fnacimiento'];
		$email = $datos['email'];
		$contrasena = md5($datos['password']);
		$fotoperfil = $datos['foto_perfil'];
		$token = uniqid();
		$this->moverImagen();
		$this->enviarEmail($token, $email);

		$query = "INSERT INTO `usuarios`(`nombre`, `apellido`, `email`, `contrasena`, `ano_nacimiento`, `sexo`, `pais`, `longitud`, `latitud`, `nombre_usuario`, `foto_perfil`,`token`,`fecha_registro`) 
VALUES ('$nombre','$apellido','$email','$contrasena','$anionacimiento','$sexo','$pais','$longitud','$latitud','$username','$fotoperfil','$token',NOW())";
		return $this->database->queryInsertar($query);
	}

	public function enviarEmail($token, $email)
	{
		$asunto = 'Confirmá tu email para empezar a jugar';
		$cuerpo = "Por favor, haz clic en el siguiente enlace para validar tu correo electrónico: ";
		$cuerpo .= "http://localhost/tpFinal/formregistro/validar?token=$token";

		$mail = new PHPMailer(true);
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'juegopreguntastpweb2@gmail.com';
		$mail->Password = 'lwzrhqlwmlewptrc';
		$mail->SMTPSecure = 'ssl';
		$mail->Port = 465;
		$mail->CharSet = 'UTF-8';
		$mail->setFrom('juegopreguntastpweb2@gmail.com');
		$mail->addAddress($email);
		$mail->Subject = $asunto;
		$mail->Body = $cuerpo;
		$mail->send();
	}

	public function validarCorreo()
	{
		// Obtener el token desde la URL// obtengo el token desde una consulta a la bd
		$token = $_GET['token'];

		$query = "SELECT * FROM usuarios WHERE token = '$token'";
		$result = $this->database->query($query);

		if (!empty($result)) {
			// El token es válido, marcar la cuenta de usuario como validada
			$email = $result[0]['email'];

			$id = $result[0]['id'];
			// Actualizar la columna de validación en la base de datos
			$query = "UPDATE usuarios SET validado = 1 WHERE email = '$email'";
			$query2 = "INSERT INTO usuarios_roles (idUsuario, idRol) VALUES ('$id', '3')";
			$this->database->queryInsertar($query);
			$this->database->queryInsertar($query2);
		} else {
			// El token no es válido
			echo "El token de validación no es válido.";
		}
	}

	public function moverImagen()
	{
		$fotoperfil = $_FILES['fotoPerfil']['tmp_name'];
		move_uploaded_file($fotoperfil, "./public/img/".$_FILES['fotoPerfil']['name']);
	}

}