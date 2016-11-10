<?php

require 'models/Encuentro.php';
require 'models/Desafio.php';

session_start();

class EncuentroController{
	function __construct(){
		$this->view = new View();
		$this->Encuentro = new Encuentro();
	}

	public function index(){
		$this->view->show("");
	}


	// Set Encuentro
	public function setEncuentro(){
		$encuentro = new Encuentro();
		$desafio = new Desafio();
		/*
		$idDesafio = $_GET['idDesafio'];
		$idEquipo = $_SESSION['equipoSeleccionado'];
		$estado = 1;
		$encuentro->setEncuentro($idDesafio, $idEquipo, $estado); // Se inserta en la base de datos
		$desafio->cambiarEstado($idDesafio, $estado);				// Se cambia el estado del desafio (sin respuestas->con respuestas)
		header('Location: ?controlador=Desafio&accion=listaDesafios');*/
	}

	// Se acepto una solicitud de este desafio, por lo tanto se registra que el desafio será jugado y las demas solicitudes se rechazan.
	public function aceptarEncuentro(){
		$encuentro = new Encuentro();
		$desafio = new Desafio();
		$idDesafio = $_POST['desafio'];
		$idEquipo = $_POST['equipo'];
		$estado = 2;
		$desafio->cambiarEstado($idDesafio, $estado);
		$encuentro->cambiarEstado($idDesafio, $estado);
		$encuentro->eliminarEncuentros($idDesafio, $idEquipo);
		header('Location: ?controlador=Desafio&accion=listaDesafios');
	}

	// Se elimina una tupla de la tabla encuentro.
	public function cancelarEncuentro(){
		$idDesafio = $_POST['desafio'];
		$idEquipo = $_POST['equipo'];
		echo "desafio: ".$idDesafio." equipo: ".$idEquipo;
	}





}

?>