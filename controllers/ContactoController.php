<?php

require 'models/Contacto.php';
require 'models/Usuario.php';
require 'models/Equipo.php';

session_start();

class ContactoController{

	function __construct(){
		$this->view = new View();
		$this->Contacto = new Contacto();
		$this->Usuario = new Usuario();
		$this->Equipo = new Equipo();
	}

	public function index(){
		$this->view->show("");
	}

	// Entregar lista de contactos de un usuario. Si agrega un contacto, tambien lo hace mediante esta funcion.
	public function listaContactos(){
		$idUsuario = $_SESSION['login_user_id'];
		$contactos = new Contacto();
		$equipos = new Equipo();
		if (isset($_GET['jugador'])){
			$idContacto = $_GET['jugador'];
			$nuevoContacto = $contactos->setContacto($idUsuario,$idContacto);
		}
		$listaContactos = $contactos->getContactos($idUsuario);
		$data['listaContactos'] = $listaContactos;
		$listaEquipos = $equipos->getEquiposJugador($idUsuario);
		$data['listaEquipos'] = $listaEquipos;
		$this->view->show('listaContactos.php',$data); 
	}

	//	Agregar contacto a un equipo (desde la lista de contactos)
	public function agregarMiembro(){
		$equipo = new Equipo();
		$idContacto = $_POST["contacto"];
		$idEquipo = $_POST["equipo"];
		$equipo->agregarMiembroEquipo($idContacto,$idEquipo);
		$this->listaContactos();
	}




}


?>