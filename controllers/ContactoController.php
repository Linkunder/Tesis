<?php

require 'models/Contacto.php';
require 'models/Usuario.php';
require 'models/Equipo.php';
require 'models/MiembrosEquipo.php';

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

	// Entregar lista de contactos de un usuario. Si agrega un contacto, tambien lo hace mediante esta funcion. - MODULO LISTAR CONTACTOS
	public function listaContactos(){
		$idUsuario = $_SESSION['login_user_id'];
		$contactos = new Contacto();
		$equipos = new Equipo();
		$miembrosEquipo = new MiembrosEquipo();
		if (isset($_GET['jugador'])){
			$idContacto = $_GET['jugador'];
			$nuevoContacto = $contactos->setContacto($idUsuario,$idContacto);
		}
		$listaContactos = $contactos->getContactos($idUsuario);
		$data['listaContactos'] = $listaContactos;			// Listar contactos del usuario
		$listaEquipos = $equipos->getEquiposJugador($idUsuario);
		$data['listaEquipos'] = $listaEquipos;				// Listar equipos del usuario (para que un contacto sea agregado a uno de ellos)
		$listaMiembrosEquiposJugador = $miembrosEquipo->getMiembrosEquiposJugador($idUsuario);
		$data['listaMiembrosEquiposJugador'] = $listaMiembrosEquiposJugador;	// Miembros de los equipos de los cuales el jugador es el capitan.
		$this->view->show('listaContactos.php',$data); 
	}

	//	Agregar contacto a un equipo (desde la lista de contactos)	- MODULO AGREGAR CONTACTO. MODAL
	public function agregarMiembro(){
		$equipo = new Equipo();
		$idContacto = $_POST["contacto"];
		$idEquipo = $_POST["equipo"];
		$equipo->agregarMiembroEquipo($idContacto,$idEquipo);
		header('Location: ?controlador=Contacto&accion=listaContactos');
	}




}


?>