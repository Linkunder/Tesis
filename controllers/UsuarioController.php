<?php

require 'models/Usuario.php';
require 'models/Contacto.php';
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
		return $usuario;
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
		$this->Usuario->updateUsuario($idUsuario, $nickname,$mail,$telefono,$fotografia, $fechaNacimiento);
		header('Location: ?controlador=Usuario&accion=modificarPerfil');
 	}

 	public function busquedaJugador(){
 		$usuario = new Usuario();
 		$contacto = new Contacto(); 
 		$idUsuario = $_SESSION['login_user_id'];
 		$nickname = $_POST['search'];
 		$data['search'] = $nickname;
 		$nuevoContacto = $usuario->buscarJugador($nickname);
  		$consulta = $contacto->verificarContacto($nuevoContacto, $idUsuario);
  		if ($consulta == "3"){
  			$data['excepcion']= "3";
  		} else {
  			if ($consulta == "2"){ // Es true, el contacto ya lo tiene.
  				$data['contacto']= true;
	  		} else {
	  			$data['contacto']= false;
	  		}
  		}
  		
  		$data['usuarios']=$nuevoContacto;
 		$this->view->show('busquedaJugador.php',$data);
 	}


}


?>