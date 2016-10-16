<?php

require 'models/Contacto.php';
require 'models/Usuario.php';

session_start();

class ContactoController{

	function __construct(){
		$this->view = new View();
		$this->Contacto = new Contacto();
		$this->Usuario = new Usuario();
	}

	public function index(){
		$this->view->show("");
	}

	// Entregar lista de contactos de un usuario. Si agrega un contacto, tambien lo hace mediante esta funcion.
	public function listaContactos(){
		$idUsuario = $_SESSION['login_user_id'];
		$contactos = new Contacto();
		if (isset($_GET['jugador'])){
			$idContacto = $_GET['jugador'];
			$nuevoContacto = $contactos->setContacto($idUsuario,$idContacto);
		}
		$listaContactos = $contactos->getContactos($idUsuario);
		$data['listaContactos'] = $listaContactos;
		$this->view->show('listaContactos.php',$data); 
	}




}


?>