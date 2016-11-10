<?php

require 'models/Equipo.php';
require 'models/Desafio.php';
require 'models/Usuario.php';
require 'models/Encuentro.php';
require 'models/Recinto.php';

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
		$encuentros = new Encuentro();
		$recintos = new Recinto();
		$listaEquipos = $equipos->getEquiposJugador($idUsuario); 			// Equipos en los que el jugador es el capitan.
		$data['listaEquipos'] = $listaEquipos;
		$listaDesafios = $desafios->getDesafios($idUsuario);				// Desafios de los equipos del usuario
		$data['listaDesafios'] = $listaDesafios;
		$nroEncuentros = 0;
		foreach ($listaDesafios as $desafio) {
			$idDesafio = $desafio['idDesafio'];
			//$detalleDesafio = $desafios->getDesafio($idDesafio);
			//$data['detalleDesafio'.$idDesafio] = $detalleDesafio;
			//var_dump($detalleDesafio);
			$listaEncuentros = $encuentros->getEncuentros($idDesafio);		// Encuentros de los desafios hechos por el jugador de la sesión.
			if (!empty($listaEncuentros)){
				$data['listaEncuentros'.$idDesafio] = $listaEncuentros;
				$nroEncuentros++;
			} else {
				$data['listaEncuentros'.$idDesafio] = 0;
			}
			
		}
		$listaSolicitudes = $encuentros->getSolicitudes($idUsuario);	// Lista de solicitudes realizadas por el jugador.
		$data['listaSolicitudes'] = $listaSolicitudes;
		$data['nroEncuentros'] = $nroEncuentros;
		$listaRecintos = $recintos->getRecintosActivos();
		$data['listaRecintos'] = $listaRecintos;
		//$listaDesafiosSistema = $desafios->getDesafiosSistema($idUsuario);	// Desafios de los equipos del usuario
		//$data['listaDesafiosSistema'] = $listaDesafiosSistema;
		$this->view->show('desafios.php',$data);
	}


	//	Crear un desafio
	public function crearDesafio(){
		$desafio = new Desafio();
		$equipo = new Equipo();
		$recinto = $_POST["recinto"];
		$fechaPartido = $_POST["date"]."";
		$idEquipo = $_POST["equipo"];
		$rangoEdad = $_POST["edad"];
		if ($rangoEdad == Null){
			$limInf = 18;
			$limSup = 60;
		} else {
			$edades = explode(",",$rangoEdad);
			$limInf = $edades[0];
			$limSup = $edades[1];
		}
		$comentario = $_POST["comentario"];
		//echo "Inferior: ".$limInf." Superior: ".$limSup;
		$desafio->setDesafio($fechaPartido, $limInf, $limSup, $comentario, $idEquipo, $recinto, "0");
		header('Location: ?controlador=Desafio&accion=listaDesafios');
	}


	// Ver vestibulo de partidos
	public function verVestibuloDesafios(){
		$desafios = new Desafio();
		$equipo = new Equipo();
		$encuentro = new Encuentro();
		$idUsuario = $_SESSION['login_user_id'];
		$idEquipoJugador = $_POST["equipo"];
		$_SESSION['equipoSeleccionado'] = $idEquipoJugador;
		$rangoEdad = $_POST["edad"];
		if ($rangoEdad == Null){
			$limInf = 18;
			$limSup = 60;
		} else {
			$edades = explode(",",$rangoEdad);
			$limInf = $edades[0];
			$limSup = $edades[1];
		}
		$desafiosSistema = $desafios->getDesafiosSistema($idUsuario, $limInf, $limSup);	// equipos con desafios donde el usuario no es capitan
		$miembrosEquipo = $equipo->getMiembrosEquipo($idEquipoJugador);	// miembros del equipo que eligio el usuario
		//$auxDesafio = array();
		$auxDesafiosSistema = 0;
		$auxEncuentros = 0;
		foreach ($desafiosSistema as $key) {
			$idEquipo = $key['idEquipo'];
			$cont = 0;
			foreach ($miembrosEquipo as $usuario) {
				$idUsuario = $usuario['idUsuario'];
				$respuesta = $equipo->verificarMiembro($idUsuario, $idEquipo);
				if (count($respuesta)>0){	// El miembro pertenece al equipo que tiene un desafio, donde el jugador no es capitan
					$cont++;
				}
			}
			if ($cont==0){
				//$auxDesafio[$aux] = $key['idDesafio'];
				$idDesafio = $key['idDesafio'];
				$desafioDisponible = $desafios->getDesafio($idDesafio);
				//$data['listaDesafiosSistema'.$aux] = $desafioDisponible;
				$encuentroAcordado = $encuentro->verificarEncuentro($idEquipoJugador, $idDesafio);
				if (!empty($encuentroAcordado)){
					$auxEncuentros++;
					$data['encuentroAcordado'.$auxEncuentros] = $encuentroAcordado;
				} else {
					$auxDesafiosSistema++;
					$data['listaDesafiosSistema'.$auxDesafiosSistema] = $desafioDisponible;
				}
			}
		}
		$nroDesafios = $auxDesafiosSistema;
		//$data['idEquipo'] = $idEquipoJugador;
		$data['nroDesafios'] =$nroDesafios;
		$this->view->show('vestibuloDesafios.php',$data);

	}


    public function detalleDesafio(){
      //Id del recinto desde la variable global
    	//$encuentro = new Encuentro();
      if(!isset($_SESSION)) { 
        session_start(); 
        } 
      $idDesafio = $_SESSION['idDesafio'];
      $desafio = $this->Desafio->getDesafio($idDesafio);
      $data['desafio'] = $desafio;
      //mostrar vista parcial con los implementos (dataTable)
      $this->view->show("_detalleDesafio.php", $data);
    }





}

?>