<?php

require 'models/Equipo.php';
require 'models/Contacto.php';

session_start();

class EquipoController{
	function __construct(){
		$this->view = new View();
		$this->Equipo = new Equipo();
	}

	public function index(){
		$this->view->show("");
	}

	// Entregar lista de equipos de un usuario. Si agrega un equipo, tambien viene a esta funcion
	public function listaEquipos(){
		$idUsuario = $_SESSION['login_user_id'];
		$equipos = new Equipo();
		$contactos = new Contacto();
		$listaContactos = $contactos->getContactos($idUsuario);				// Contactos del usuario, para crear su nuevo equipo.
		$data['listaContactos'] = $listaContactos;
		$listaEquipos = $equipos->getEquiposJugador($idUsuario); 			// Equipos en los que el jugador es el capitan.
		$data['listaEquipos'] = $listaEquipos;
		foreach ($listaEquipos as $key ) {
			$idEquipo = $key['idEquipo'];
			$listaMiembrosEquipo = $equipos->getMiembrosEquipo($idEquipo); 	// Jugadores de un determinado equipo.
			$data['listaMiembrosEquipo'.$idEquipo]= $listaMiembrosEquipo;
		}
		$listaEquiposMiembro = $equipos->getEquiposMiembro($idUsuario);		// Equipos en los que el jugador es solo un miembro (no capitán).
		$data['listaEquiposMiembro'] = $listaEquiposMiembro;
		foreach ($listaEquiposMiembro as $key ) {
			$idEquipo = $key['idEquipo'];
			$listaMiembrosEquipo = $equipos->getMiembrosEquipo($idEquipo); 		// Jugadores de un determinado equipo.
			$data['listaMiembrosEquipo'.$idEquipo]= $listaMiembrosEquipo;
		}
		$this->view->show('listaEquipos.php',$data);
	}

	// Entregar datos del equipo, y además los contactos del usuario.
	public function gestionarEquipo(){
		$equipo = new Equipo();
		$idUsuario = $_SESSION['login_user_id'];
		$idEquipo = $_GET['idEquipo'];
		$data['equipo'] = $equipo->getEquipo($idEquipo);
		$listaMiembrosEquipo = $equipo->getMiembrosEquipo($idEquipo); 		// Contactos que ya están en el equipo.
		$data['listaMiembrosEquipo']= $listaMiembrosEquipo;
		$listaContactos = $equipo->getContactosEquipo($idUsuario,$idEquipo);				// Contactos que no estan en el equipo
		$data['listaContactos']= $listaContactos;
		$this->view->show('gestionarEquipo.php',$data);
	}

	//	Actualizar información del equipo (nombre, color, jugadores)
	public function updateEquipo(){
		$equipo = new Equipo();
		$miembros = $_POST["arrayContactos"];
		$idEquipo =  $_SESSION['idEquipo'];
		for ($i=0; $i<count($miembros) ; $i++) {
			$idMiembro = $miembros[$i];
			$resultado = $equipo->verificarMiembro($idMiembro,$idEquipo);
			$respuesta = count($resultado);
			if ($respuesta == 0){
				$equipo->agregarMiembroEquipo($idMiembro,$idEquipo);
			}
		}
		$this->view->show('listaEquipos.php',$data);
	}

	//	Desplegar formulario para crear el equipo (nombre, color, jugadores)
	public function crearEquipo(){
		$equipo = new Equipo();
		$nombre = $_POST["nombre"];
		$color = $_POST["color"];
		$idUsuario = $_SESSION['login_user_id'];
		$this->Equipo->setEquipo($nombre,$color,$idUsuario);
		$miembros = $_POST["arrayContactos"];
		$equipos = $this->Equipo->getEquipos();
		$idEquipo = end($equipos)['idEquipo'];
		for ($i=0; $i<count($miembros) ; $i++) {
			$idMiembro = $miembros[$i];
			$equipo->agregarMiembroEquipo($idMiembro,$idEquipo);
		}
		$this->view->show('listaEquipos.php',$data);
	}



}

?>