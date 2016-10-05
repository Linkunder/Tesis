<?php

require 'models/Usuario.php';
session_start();

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
		$this->view->show('gestionUsuarios.php',$data); // Prueba parcial.
	}

	public function getUsuario(){
		$idUsuario= $_POST['idUsuario'];
		$usuarios = new Usuario();
		$usuario = $usuarios->getUsuario($idUsuario);
		echo end($usuario)['nombre'];
		echo end($usuario)['nickname'];
	}

	// Desplegar formulario de registro.
	public function formularioRegistro(){
		$this->view->show('formularioRegistro.php');
	}

	// Registrar usuario en la base de datos. Queda pendiente subir fotografia.
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
		$usuario = new Usuario();
		$idUsuario = $_SESSION['login_user_id'];
		$perfilUsuario = $usuario->getUsuario($idUsuario);
		$data['perfilUsuario'] = $perfilUsuario;
		$this->view->show('perfilUsuario.php',$data);
	}


	public function modificarPerfil(){
		$usuario = new Usuario();
		$idUsuario = $_SESSION['login_user_id'];
		$modificarPerfil = $usuario->getUsuario($idUsuario);
		$data['modificarPerfil'] = $modificarPerfil;
		$this->view->show('modificarPerfil.php',$data);
 	}

 	public function actualizarInformacion(){
 		$idUsuario = $_SESSION['login_user_id'];
 		$nickname= $_POST['nickname'];
		$mail= $_POST['mail'];
		$telefono= $_POST['telefono'];
		$fotografia = "actualice foto";
		$fechaNacimiento = $_POST['fechaNacimiento'];
		echo $nickname." ".$mail." ".$telefono." ".$fotografia;
		$this->Usuario->updateUsuario($idUsuario, $nickname,$mail,$telefono,$fotografia, $fechaNacimiento);
		header('Location: ?controlador=Usuario&accion=modificarPerfil');
 	}

 	public function buscarUsuario(){
 		$nickname = $_GET['search'];
 		$this->view->show('busquedaJugador.php');
 	}


}


?>