<?php
	require 'models/TercerTiempo.php';
	require 'models/Partido.php';

class TercerTiempoController{

	function __construct(){
		$this->view= new View();
		$this->tercerTiempo = new TercerTiempo();
		$this->partido = new Partido();
	}

	public function index(){
		$this->view->show("");
	}

	public function ingresarTercerTiempo(){
		//obtener via post las variables del tercer tiempo
		$hora = $_POST['hora'];
		$comentario = $_POST['comentario'];
		$cuota	=	$_POST['cuota'];
		$idLocal = $_POST['idLocal'];
		//obtener via SESSION
		$idPartido = $_SESSION['idPartido'];

		$idTercerTiempo = $this->tercerTiempo->setTercerTiempo(
			$comentario, $cuota, $hora, $idLocal, $idPartido
			);
	//una vez que se obtiene el id del tercer tiempo debemos hacer un Update al partido
		$this->partido->setTercerTiempoPartido($idPartido, $idTercerTiempo);
		//Ahora llamamos al resumenPartido

		header('Location:?controlador=Partido&accion=resumenPartido');


	}




}
?>