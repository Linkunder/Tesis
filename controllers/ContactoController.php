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

	// Entregar lista de contactos de un usuario.
	public function listaContactos(){
		$idUsuario = $_SESSION['login_user_id'];
		$contactos = new Contacto();
		$listaContactos = $contactos->getContactos($idUsuario);
		$data['listaContactos'] = $listaContactos;
		$this->view->show('listaContactos.php',$data); 
	}



}


?>