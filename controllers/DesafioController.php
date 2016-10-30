<?php

require 'models/Equipo.php';
require 'models/Desafio.php';
require 'models/Usuario.php';

session_start();

class DesafioController{
	function __construct(){
		$this->view = new View();
		$this->Desafio = new Desafio();
	}

	public function index(){
		$this->view->show("");
	}

	// Entregar lista de desafios realizados por el equipo.
	public function listaDesafios(){
		$idUsuario = $_SESSION['login_user_id'];
		$equipos = new Equipo();
		$desafios = new Desafio();
		$usuarios = new Usuario();
		$listaEquipos = $equipos->getEquiposJugador($idUsuario); 			// Equipos en los que el jugador es el capitan.
		$data['listaEquipos'] = $listaEquipos;
		$listaDesafios = $desafios->getDesafios($idUsuario);				// Desafios de los equipos del usuario
		$data['listaDesafios'] = $listaDesafios;
		$listaDesafiosSistema = $desafios->getDesafiosSistema($idUsuario);	// Desafios de los equipos del usuario
		$data['listaDesafiosSistema'] = $listaDesafiosSistema;
		$this->view->show('desafios.php',$data);
	}


	//	Crear un desafio
	public function crearDesafio(){
		$desafio = new Desafio();
		$equipo = new Equipo();
		$tipoPartido = $_POST["tipoPartido"];
		$fechaPartido = $_POST["fecha"];
		$idEquipo = $_POST["equipo"];
		$miembrosEquipo = $equipo->getMiembrosEquipo($idEquipo);
		$edades = array();
		foreach ($miembrosEquipo as $key) {
			$fechaNacimiento = $key['fechaNacimiento'];
			$edades[] = $this->calcularEdad($fechaNacimiento);
		}
		$edadPromedio = $this->calcularPromedio($edades);
		$comentario = $_POST["comentario"];
		$desafio->setDesafio($edadPromedio, $fechaPartido, $comentario, $idEquipo, $tipoPartido, "0");
		header('Location: ?controlador=Desafio&accion=listaDesafios');
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




}

?>