<?php

require 'models/Partido.php';
require 'models/Usuario.php';
require 'models/Contacto.php';
require 'models/Recinto.php';


session_start();

class PartidoController{
	function __construct(){
		$this->view = new View();
		$this->Partido = new Partido();
		$this->Usuario = new Usuario();
		$this->Contacto = new Contacto();
		$this->Recinto = new Recinto();
	}

	public function index(){
		$this->view->show("");
	}

	//Recopilar informacion del sistema
	public function partidoEquipoPropio(){

		$idCapitan	= $_SESSION['login_user_id'];
		$fecha	=	$_POST['fecha'];
		$hora	=	$_POST['hora'];
		$cantidad	=	$_POST['cantidad'];
		$color	=	$_POST['color'];

		$listadoContactos= $this->Contacto->getContactos($idCapitan);
		$recinto = $this->Recinto->getRecinto($_SESSION['idRecinto']);
		$data['fecha'] = $fecha;
		$data['hora']  = $hora;
		$data['cantidad'] = $cantidad;
		$data['color']= $color;
		$data['tipoPartido'] = 2;
		$data['recintoSeleccionado']= $recinto;
		$data['contactos']=$listadoContactos;

		$this->view->show("eleccionJugadores.php",$data);
		
	}
	public function agendarPartidoEquipoPropio(){

		$idCapitan	= $_SESSION['login_user_id'];
		$fecha	=	$_SESSION['fecha'];
		$hora	=	$_SESSION['hora'];
		$cantidad	= $_SESSION['cantidad'];
		$color	=	$_SESSION['color'];
		$idRecinto = $_SESSION['idRecinto'];
		$idEstado = "1";
		$idTipo ="2";
		$cuota = "0";
		//Ingresar Partido
		$idPartido = $this->Partido->setPartidoEquipoPropio($idCapitan,$fecha, $hora, $cuota, $idTipo, $idEstado, $idRecinto);
		$aux=end($idPartido);
		$idPartidoCreado=$aux['LAST_INSERT_ID()'];
		//NO FUNCIONA EL TRAER EL ULTIMO, O NO SE


		//Ingresar equipo del partido (Jugadores)
		$data	=	json_decode($_POST['jObject'], true);
		for($i=0; $i<sizeof($data); $i++){
			$id=$data[$i];
			$this->Partido->setJugadoresPartido("19", $id, "B");
		}
			//Debido a que el capitan no se trae, se debe agregar.
			$this->Partido->setJugadoresPartido("19", $idCapitan,"C");



		




	}
}
?>