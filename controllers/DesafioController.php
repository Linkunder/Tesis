<?php

require 'models/Equipo.php';
require 'models/Desafio.php';
require 'models/Usuario.php';
require 'models/Encuentro.php';
require 'models/Recinto.php';
require 'models/Horario.php';

session_start();

class DesafioController{
	function __construct(){
		$this->view = new View();
		$this->Desafio = new Desafio();
		$this->Encuentro = new Encuentro();
		$this->Equipo = new Equipo();
		$this->Usuario = new Usuario();
		$this->Recinto = new Recinto();
		$this->Horario = new Horario();
	}

	public function index(){
		$this->view->show("");
	}

	// Entregar lista de desafios realizados por el equipo.
	public function listaDesafios(){
		$idUsuario = $_SESSION['login_user_id'];
		$listaEquipos = $this->Equipo->getEquiposJugador($idUsuario); 			// Equipos en los que el jugador es el capitan.
		$data['listaEquipos'] = $listaEquipos;
		
		$listaDesafios = $this->Desafio->getDesafios($idUsuario);					// Desafios de los equipos del usuario
		$data['listaDesafios'] = $listaDesafios;

		$historialDesafios =  $this->Desafio->getHistorialDesafios($idUsuario);
		$data['historialDesafios'] = $historialDesafios;

		$nroEncuentros = 0;
		foreach ($listaDesafios as $desafio) {
			$idDesafio = $desafio['idDesafio'];
			//$detalleDesafio = $desafios->getDesafio($idDesafio);
			//$data['detalleDesafio'.$idDesafio] = $detalleDesafio;
			//var_dump($detalleDesafio);
			$listaEncuentros = $this->Encuentro->getEncuentros($idDesafio);		// Encuentros de los desafios hechos por el jugador de la sesión.
			if (!empty($listaEncuentros)){
				$data['listaEncuentros'.$idDesafio] = $listaEncuentros;
				$nroEncuentros++;
			} else {
				$data['listaEncuentros'.$idDesafio] = 0;
			}
			
		}
		$listaSolicitudes = $this->Encuentro->getSolicitudes($idUsuario);	// Lista de solicitudes realizadas por el jugador.
		$data['listaSolicitudes'] = $listaSolicitudes;
		$data['nroEncuentros'] = $nroEncuentros;
		$listaRecintos = $this->Recinto->getRecintosActivos();
		$data['listaRecintos'] = $listaRecintos;
		//$listaDesafiosSistema = $desafios->getDesafiosSistema($idUsuario);	// Desafios de los equipos del usuario
		//$data['listaDesafiosSistema'] = $listaDesafiosSistema;

		if (isset($_SESSION['accion'])){
			$data['accion'] = $_SESSION['accion'];
		}
		$_SESSION['accion'] = 0;
		$this->view->show('desafios.php',$data);
	}


	//	Crear un desafio
	public function crearDesafio(){
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
		$this->Desafio->setDesafio($fechaPartido, $limInf, $limSup, $comentario, $idEquipo, $recinto, "0");
		$_SESSION['accion'] = 1;
		header('Location: ?controlador=Desafio&accion=listaDesafios');
	}


	// Ver vestibulo de partidos
	public function verVestibuloDesafios(){
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

		$desafiosSistema = $this->Desafio->getDesafiosSistema($idUsuario, $limInf, $limSup);	// equipos con desafios donde el usuario no es capitan
		$miembrosEquipo = $this->Equipo->getMiembrosEquipo($idEquipoJugador);	// miembros del equipo que eligio el usuario
		//$auxDesafio = array();
		$auxDesafiosSistema = 0;
		$auxEncuentros = 0;
		foreach ($desafiosSistema as $key) {
			$idEquipo = $key['idEquipo'];
			$cont = 0;
			foreach ($miembrosEquipo as $usuario) {
				$idUsuario = $usuario['idUsuario'];
				$respuesta = $this->Equipo->verificarMiembro($idUsuario, $idEquipo);
				if (count($respuesta)>0){	// El miembro pertenece al equipo que tiene un desafio, donde el jugador no es capitan
					$cont++;
				}
			}
			if ($cont==0){
				//$auxDesafio[$aux] = $key['idDesafio'];
				$idDesafio = $key['idDesafio'];
				$desafioDisponible = $this->Desafio->getDesafio($idDesafio);
				//$data['listaDesafiosSistema'.$aux] = $desafioDisponible;
				$encuentroAcordado = $this->Encuentro->verificarEncuentro($idEquipoJugador, $idDesafio);
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
      /*if(!isset($_SESSION)) { 
        session_start(); 
        } */
      $idDesafio = $_GET['idDesafio']; // POST o algo
      	$desafio = $this->Desafio->getDesafio($idDesafio);
      $data['desafio'] = $desafio;
      $data['equipoSeleccionado'] = $_SESSION['equipoSeleccionado'];
      $this->view->show("_detalleDesafio.php", $data);
    }


    public function agendarPartido(){
      /*if(!isset($_SESSION)) { 
        session_start(); 
        } */
        $idEncuentro = $_GET['idEncuentro'];
        $encuentro = $this->Encuentro->getEncuentro($idEncuentro);
        foreach ($encuentro as $key ) {
        	$idRecinto = $key['idRecinto'];
        }
        $horarios = $this->Horario->getHorariosRecinto($idRecinto);
        $data['horarios'] = $horarios;
        $data['encuentro'] = $encuentro;
        $this->view->show("_agendarDesafio.php", $data);

        /*
      $idDesafio = $_GET['idDesafio'];
      $desafio = $this->Desafio->getDesafio($idDesafio);
      $encuentro = new Encuentro();
      $encuentroAcordado = $encuentro->getEncuentroAcordado($idDesafio);
      foreach ($encuentroAcordado as $key ) {
      	$data['nombreEquipo2'] = $key['nombreEquipo2'];
      	$data['respuestaRival'] = $key['respuesta'];
      	$data['idRival'] = $key['idRival'];
      }
      $data['desafio'] = $desafio;
      $this->view->show("_agendarDesafio.php", $data);*/
    }

    public function verRespuestas(){
      /*if(!isset($_SESSION)) { 
        session_start(); 
        } */
        $idDesafio = $_GET['idDesafio'];
        $desafio = $this->Desafio->getDesafio($idDesafio);
        $data['desafio'] = $desafio;
        $listaEncuentros = $this->Encuentro->getEncuentros($idDesafio);
        $data['listaEncuentros'] = $listaEncuentros;
        $this->view->show("_verRespuestas.php", $data);
    }



	// Set Encuentro
	public function setEncuentro(){

		$idDesafio = $_POST['desafio'];
		$idEquipo = $_POST['equipo'];
		$estado = 1;
		$respuesta = $_POST["comentario"];


		//echo "desafio: ".$idDesafio." equipo: ".$idEquipo." estado: ".$estado;
		$this->Encuentro->setEncuentro($idDesafio, $idEquipo, $respuesta, $estado); // Se inserta en la base de datos
		$this->Desafio->cambiarEstado($idDesafio, $estado);
		$_SESSION['accion'] = 2;				// Se cambia el estado del desafio (sin respuestas->con respuestas)
		header('Location: ?controlador=Desafio&accion=listaDesafios');
	}


	// Se acepto una solicitud de este desafio, por lo tanto se registra que el desafio será jugado y las demas solicitudes se rechazan.
	public function aceptarEncuentro(){
		$idDesafio = $_POST['idDesafio'];
		$idEquipo = $_POST['idEquipo'];
		$idEncuentro = $_POST['idEncuentro'];
		$estado = 2;
		$this->Desafio->cambiarEstado($idDesafio, $estado);
		$this->Encuentro->cambiarEstado($idDesafio, $estado);
		$this->Encuentro->eliminarEncuentros($idDesafio, $idEquipo);
		$_SESSION['accion'] = 3;
		header('Location: ?controlador=Desafio&accion=listaDesafios');
	}

	// Se elimina una tupla de la tabla encuentro.
	public function cancelarEncuentro(){
		$idEncuentro = $_POST['idEncuentro'];
		$idDesafio = $_POST['idDesafio'];
		//echo $idEncuentro;
		//$idEquipo = $_POST['idEquipo'];
		$this->Encuentro->cancelarEncuentro($idEncuentro);
		$estado = 0;
		$this->Desafio->cambiarEstado($idDesafio, $estado);
		//echo "encuentro: ".$idEncuentro." equipo: ".$idEquipo;
		$_SESSION['accion'] = 4;
		header('Location: ?controlador=Desafio&accion=listaDesafios');
	}


	public function detalleEncuentro(){
		$idEncuentro = $_GET['idEncuentro'];
		$encuentro = $this->Encuentro->getEncuentro($idEncuentro);
		$data['encuentro'] = $encuentro;
	    //$data['equipoSeleccionado'] = $_SESSION['equipoSeleccionado'];
	    $data['accion'] = 1;
	    $this->view->show("_detalleEncuentro.php", $data);
	}

	public function resumenDesafio(){
		$idEncuentro = $_GET['idEncuentro'];
		$encuentro = $this->Encuentro->getEncuentro($idEncuentro);
		$data['encuentro'] = $encuentro;
	    //$data['equipoSeleccionado'] = $_SESSION['equipoSeleccionado'];
	    $data['accion'] = 2;
	    $this->view->show("_resumenDesafio.php", $data);
	}









    /*    MODULO DE ADMINISTRACION  */
    public function adminDesafios(){
      $desafios = $this->Desafio->getDesafiosAdmin();
      $data['desafios'] = $desafios;
      $this->view->show('adminDesafios.php',$data);
    }

    public function detalleDesafioAdmin(){
    	$idDesafio = $_GET['idDesafio'];
    	$estado = $_GET['estado'];
    	$data['idDesafio'] = $idDesafio;
    	$data['estado'] = $estado;
    	$desafio = $this->Desafio->getDesafio($idDesafio);
    	$data['desafio'] = $desafio;
    	if ($estado == 3){
    		$encuentro = $this->Encuentro->getEncuentroAcordado($idDesafio);
    		$data['encuentro'] = $encuentro;
    	}
	    $this->view->show("_adminDetalleDesafio.php", $data);
    }





}

?>