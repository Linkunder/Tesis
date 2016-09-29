<?php

require 'models/Usuario.php';

class UsuarioController{

	function __construct(){
		$this->view = new View();
		$this->Usuario = new Usuario();
	}

	public function index(){
		$this->view->show("");
	}

	// Entregar lista de usuarios del sistema.
	public function gestionUsuarios(){
		$usuarios = new Usuario();
		$listaUsuarios = $usuarios->getUsuarios();
		$data['listaUsuarios'] = $listaUsuarios;
		$this->view->show('gestionUsuarios.php',$data);
	}

	// Desplegar formulario de registro.
	public function formularioRegistro(){
		$this->view->show('formularioRegistro.php');
	}

	// Registrar usuario en la base de datos. Queda pendiente lo de la foto.
	public function registrarUsuario(){
		$nombre = $_POST['nombre'];
		$apellido= $_POST['apellido'];
		$nickname= $_POST['nickname'];
		$fechaNacimiento= $_POST['fechaNacimiento'];
		$mail= $_POST['mail'];
		$telefono= $_POST['telefono'];
		$password = $_POST['password'];
		$sexo= $_POST['sexo'];
		$fotografia = "hola";
		$this->Usuario->setUsuario($nombre,$apellido,$nickname, $mail, $sexo, $fotografia, $password, $telefono, $fechaNacimiento,1,1);
		header('Location: ?controlador=Index&accion=index');
	}



	public function perfilUsuario(){
		$idUsuario = $_GET['idUsuario'];
		$perfilUsuario = $usuario->getUsuario($idUsuario);
		$data['perfilUsuario'] = $perfilUsuario;
		$this->view->show('perfilUsuario.php',$data);
	}

}


?>