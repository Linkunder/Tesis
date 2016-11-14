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

	// Desplegar formulario de registro. Opción Registrarse.
	public function formularioRegistro(){
		$this->view->show('formularioRegistro.php');
	}

	public function formularioRegistro2(){
		$this->view->show('testform.php');
	}

	// Registrar usuario en la base de datos. 
	public function registrarUsuario(){
		$nombre = $_POST['nombre'];
		$apellido= $_POST['apellido'];
		$nickname= $_POST['nickname'];
		$fechaNacimiento= $_POST['date'];
		//echo $fechaNacimiento;
		$mail= $_POST['mail'];
		$telefono= $_POST['telefono'];
		$password = $_POST['password'];
		$password_cifrada = password_hash($password,PASSWORD_DEFAULT); 
		/* Coste de la función por defecto: 10
			password_hash($password,PASSWORD_DEFAULT,array("cost")=>12);
			http://php.net/manual/es/faq.passwords.php
		*/
		//echo $password_cifrada;
		$sexo= $_POST['sexo'];
		$fotografia = "no";
		
		$this->Usuario->setUsuario($nombre,$apellido,$nickname, $mail, $sexo, $fotografia, $password_cifrada, $telefono, $fechaNacimiento,1,1);
		
		$usuarios = $this->Usuario->getUsuarios();
		$idUsuario = end($usuarios)['idUsuario'];
		$this->guardarImagen($idUsuario);
		$mensaje = 1;
		$data['nuevoUsuario'] = $mensaje;
		//$this->view->show('inicio.php',$data);
		header('Location: ?controlador=Index&accion=inicio');
	}

	// Subir imagen 
	private function guardarImagen($idUsuario){
		$target_dir = "assets/images/usuarios/";
		$target_file = $target_dir.basename($_FILES["imagen"]["name"]);
		//echo $target_file;
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Asignar nuevo nombre: idUsuario.extensionFotografia
		$newName = $idUsuario.".".$imageFileType;
		$newDir = $target_dir.$newName;
		// Chequear si es o no una imagen
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
		    if($check !== false){
		        $uploadOk = 1;
				$message = "Archivo es una imagen - " . $check["mime"] . ".";;
		    } else {
		        $message = "Archivo no es una imagen.";
		        $uploadOk = 0;
		    }
		}
		/*/ Chequear si el archivo existe o no (no deberia)
		if (file_exists($target_file)) {
		    $message = "Lo sentimos pero esta imagen ya existe.";
		    $uploadOk = 0;
		}*/
		// Chequear el tamaño de la imagen. 
		if ($_FILES["imagen"]["size"] > 5000000) {
		    $message = "Lo sentimos, pero el archivo es muy grande.";
		    $uploadOk = 0;
		}
		// Chequear extension
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"
		&& $imageFileType != "GIF") {
		    $message = "Lo sentimos , solo archivos con JPG, JPEG, PNG & GIF son permitidos.";
		    $uploadOk = 0;
		}
		// Chequear la variable $uploadOk = 0
		if ($uploadOk == 0) {
		    $message =  "Lo sentimos, tu archivo no se puede subir.";
		// OK, Intenta subir imagen.
		} else {
		    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $newDir)) {
		    	$this->Usuario->setFotografia($idUsuario,$newName);
		    	//echo "ok";
		    } else {
		        $message = "Lo sentimos, hubo un error al subir el archivo."; // No debiese entrar aqui.
		    }
		}		
	}




 	// Busqueda de un usuario mediante nickname.  Opción Agregar Contacto
 	public function busquedaJugador(){
 		$usuario = new Usuario();
 		$contacto = new Contacto(); 
 		$idUsuario = $_SESSION['login_user_id'];
 		$nickname = $_POST['search'];
 		$data['search'] = $nickname;
 		$nuevoContacto = $usuario->buscarJugador($nickname);
 		if (!count($nuevoContacto)==0){
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
 		}
  		$data['usuarios']=$nuevoContacto;
 		$this->view->show('busquedaJugador.php',$data);
 	}


 	// Mostrar perfil del usuario.  Opcion Perfil
	public function perfilUsuario(){
		$usuario = new Usuario();
		$idUsuario = $_SESSION['login_user_id'];
		$perfilUsuario = $usuario->getUsuario($idUsuario);
		$data['perfilUsuario'] = $perfilUsuario;
		/*
		foreach ($perfilUsuario as $key ) {
			$fechaNacimiento = $key['fechaNacimiento'];
		}
		$edad = $this->calcularEdad($fechaNacimiento);
		$data['edadUsuario'] = $edad;
		*/
		$this->view->show('perfilUsuario.php',$data);
	}

	//	Calcular edad de un usuario.
	public function calcularEdad($fecha){
		list($Y,$m,$d) = explode("-", $fecha);
		return(date("md")<$m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	}

	// Calcular promedio de edad de un array
	public function calcularPromedio($array){
		return round(array_sum($array)/count($array));
	}

	// Mostrar formulario para modificar perfil. Opcion Mi información
	public function modificarPerfil(){
		$usuario = new Usuario();
		$idUsuario = $_SESSION['login_user_id'];
		$modificarPerfil = $usuario->getUsuario($idUsuario);
		$data['modificarPerfil'] = $modificarPerfil;
		$this->view->show('modificarPerfil.php',$data);
 	}

 	// Actualizar información del usuario en la BD
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

 	// Desplegar calendario de partidos activos. Opción Mi Calendario
 	public function verCalendario(){
 		$this->view->show('verCalendario.php');
 	}



}


?>