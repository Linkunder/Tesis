<?php

require 'models/Partido.php';
require 'models/Usuario.php';
require 'models/Contacto.php';
require 'models/Recinto.php';
require 'models/Desafio.php';
require 'models/Equipo.php';
require 'models/TercerTiempo.php';
require 'models/Local.php';
require 'models/Horario.php';
require 'models/Mail.php';
require 'models/Encuentro.php';


      if(!isset($_SESSION)) { 
        session_start(); 
        } 

class PartidoController{
	function __construct(){
		$this->view = new View();
		$this->Partido = new Partido();
		$this->Usuario = new Usuario();
		$this->Contacto = new Contacto();
		$this->Recinto = new Recinto();
		$this->Desafio = new Desafio();
		$this->Equipo = new Equipo();
		$this->tercerTiempo = new TercerTiempo();
		$this->local = new Local();
		$this->Horario = new Horario();
		$this->Encuentro = new Encuentro();
	}

	public function index(){
		$this->view->show("");
	}



	public function partidos(){
		$idUsuario = $_SESSION['login_user_id'];



		if ( isset($_POST['idPartido']) && isset($_POST['accion'])){
			$idPartido = $_POST['idPartido'];
    		$accion = $_POST['accion'];
    		if ($accion == 0){
    			$data['accion'] = 0;
    			$mensaje = "Tu solicitud ha sido enviada al capitán del encuentro. ";
    			$data['mensaje'] = $mensaje;
    		}
    		if ($accion == 1){
    			$data['accion'] = 1;
    			$mensaje = "El partido ha sido cancelado y tus invitados han sido notificados vía mail.";
    			$data['mensaje'] = $mensaje;
    		}
    		if ($accion == 2){
    			$data['accion'] = 2;
    			$mensaje = "El partido ha sido notificado a los jugadores de MatchDay. Debes estar atento a sus solicitudes";
    			$data['mensaje'] = $mensaje;
    		}


			$this->cambiarEstadoPartido($idPartido, $accion);

			if ($accion == 4){
				$idSolicitante = $_POST['idUsuario'];
				$respuesta = $_POST['respuesta'];
				$this->cambiarEstadoSolicitud($idPartido, $idSolicitante, $respuesta, $accion);
				$data['accion'] = 4;
    			$mensaje = "La operación ha sido realizada con éxito. Al jugador se le notificará tu decisión.";
    			$data['mensaje'] = $mensaje;
    		}
		}


		// Partidos organizados por el jugador de la sesion en estado pendiente.
		$partidosPendientes = $this->Partido->getPartidosPendientes($idUsuario);
		$data['partidosPendientes'] = $partidosPendientes;

		$partidosUsuario = $this->Partido->getPartidosOrganizador($idUsuario);
		$data['partidosUsuario'] = $partidosUsuario;

		// Partidos del sistema donde el jugador no es el capitan ni participante ni ha enviado solicitud antes.
		$partidosSistema = $this->Partido->getPartidosSistema($idUsuario);
		$data['partidosSistema'] = $partidosSistema;


		$this->view->show("partidos.php",$data);
	}

	public function detallePartido(){
      $idPartido = $_GET['idPartido'];
      $partido = $this->Partido->getResumenPartido($idPartido);
      $data['partido'] = $partido;
      $data['accion'] = 0; // Solicitud
      $this->view->show("_detallePartido.php",$data);
    }


	public function cancelarPartido(){
      $idPartido = $_GET['idPartido']; 
      $partido = $this->Partido->getResumenPartido($idPartido);
      $data['partido'] = $partido;
      $data['accion'] = 1; // Cancelar
      $this->view->show("_detallePartido.php",$data);
    }

	public function notificarPartido(){
      $idPartido = $_GET['idPartido']; 
      $partido = $this->Partido->getResumenPartido($idPartido);
      $data['partido'] = $partido;
      $data['accion'] = 2; // Notificar
      $this->view->show("_detallePartido.php",$data);
    }


	public function resumenCapitan(){
      $idPartido = $_GET['idPartido'];
      $partido = $this->Partido->getResumenPartido($idPartido);
      $data['partido'] = $partido;
      $data['accion'] = 3; // Solicitud
      $this->view->show("_detallePartido.php",$data);
    }

	public function verSolicitudes(){
      $idPartido = $_GET['idPartido'];
      $partido = $this->Partido->getResumenPartido($idPartido);
      $data['partido'] = $partido;
      $data['accion'] = 4; // Solicitud
      $arrayEdades = array();
      $i = 0;
      $solicitudes = $this->Partido->obtenerSolicitudes($idPartido);
      foreach ($solicitudes as $key ) {
      	$arrayEdades[] = $this->calcularEdad($key['fechaNacimiento']);
      	$data['edadUsuario'.$key['idUsuario']] = $arrayEdades[$i];
      	$i++;
      }
      $data['solicitudes'] = $solicitudes;
      $this->view->show("_detallePartido.php",$data);
    }

    public function cambiarEstadoSolicitud($idPartido, $idUsuario, $respuesta, $accion){
    	if ($accion == 4){		// Rechazar la solicitud.
    		$this->Partido->cambiarEstadoSolicitud($idPartido, $idUsuario, $respuesta);
    		if ($respuesta == 1 ){ // Se acepto la solicitud, por lo tanto lo agrego a jugadores partido.
    			$estado = 1;
    			$this->Partido->agregarJugador($idPartido, $idUsuario, $estado);
    		}
    	}
    }


	//	Calcular edad de un usuario.
	public function calcularEdad($fecha){
		list($Y,$m,$d) = explode("-", $fecha);
		return(date("md")<$m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	}



    // Cambiar el estado del partido dependiendo de la accion 
    public function cambiarEstadoPartido($idPartido, $accion){
    	if ($accion == 0 ){	// Solicitud partido
    		$estadoSolicitud = 2;
    		$tipoSolicitud = 0;
    		$idUsuario = $_SESSION['login_user_id'];
    		$this->Partido->agregarSolicitud($idUsuario, $idPartido, $estadoSolicitud, $tipoSolicitud);	
    	}
    	if ($accion == 1){	// Cancelar partido
    		$this->Partido->eliminarJugadoresPartido($idPartido);				// 	1. Eliminar jugadores del partido.
    		$tercerTiempo = $this->tercerTiempo->getTercerTiempo($idPartido);	
    		if (count($tercerTiempo) > 0){
    			$this->tercerTiempo->deleteTercerTiempo($idPartido);			//	2. Eliminar tercer tiempo del partido, si hay.
    		} 
    		$estado = 3;
    		$this->Partido->cambiarEstado($idPartido, $estado);					//	3. Cambiar estado en la tupla partido a cancelado (3->Cancelado)
    	}
    	if ($accion == 2){	// Notificar partido
    		$estado = 5;
    		$this->Partido->cambiarEstado($idPartido, $estado);
    	}
    }



	//Recopilar informacion del sistema
	public function partidoEquipoPropio(){
		//Datos del partido
		$idCapitan	= $_SESSION['login_user_id'];
		$fecha	=	$_POST['fecha'];
		$hora	=	$_POST['hora'];
		$cantidad	=	$_POST['cantidad'];
		$color	=	$_POST['color'];
		$idRecinto = $_POST['idRecinto'];
		$idHorario = $_POST['idHorario'];
		$_SESSION['idRecinto'] = $idRecinto;
		$listadoContactos= $this->Contacto->getContactos($idCapitan);
		$recinto = $this->Recinto->getRecinto($idRecinto);
		$data['fecha'] = $fecha;
		$data['hora']  = $hora;
		$data['cantidad'] = $cantidad;
		$data['color']= $color;
		$data['idHorario'] =$idHorario;
		//EquipoPropio = 2
		$data['tipoPartido'] = 2;
		$_SESSION['tipoPartido'] = 2;
		$data['recintoSeleccionado']= $recinto;
		$data['contactos']=$listadoContactos;


		$this->view->show("eleccionJugadores.php",$data);
		
	}
	public function partidoRevuelta(){
		//Datos del partido
		$idCapitan	= $_SESSION['login_user_id'];
		$fecha	=	$_POST['fecha'];
		$hora	=	$_POST['hora'];
		$cantidad	=	$_POST['cantidad'];
		$color	=	$_POST['color'];
		$color2 =	$_POST['color2'];
		$idRecinto = $_POST['idRecinto'];
		$idHorario = $_POST['idHorario'];
		$_SESSION['idRecinto'] = $idRecinto;
		//Contactos del jugador capitan
		$listadoContactos=$this->Contacto->getContactos($idCapitan);
		//Recinto deportivo en el cual se efectuara el partido
		$recinto = $this->Recinto->getRecinto($idRecinto);
		//Datos del partido hacia la vista
		$data['fecha'] = $fecha;
		$data['hora']  = $hora;
		$data['cantidad'] = $cantidad;
		$data['color']= $color;
		$data['color2']= $color2;
		$data['idHorario'] =$idHorario;
		//Revuelta = 1
		$data['tipoPartido'] = 1;
		$_SESSION['tipoPartido'] = 1;
		$data['recintoSeleccionado']= $recinto;
		$data['contactos']=$listadoContactos;
		$this->view->show("eleccionJugadores.php",$data);

	}
	public function partidoAB(){
		//Datos del partido
		$idCapitan	= $_SESSION['login_user_id'];
		$fecha	=	$_POST['fecha'];
		$hora	=	$_POST['hora'];
		$cantidad	=	$_POST['cantidad'];
		$color	=	$_POST['color'];
		$color2 =	$_POST['color2'];
		$idHorario	=	$_POST['idHorario'];
		$idRecinto = $_POST['idRecinto'];
		$_SESSION['idRecinto'] =$idRecinto;
		//Aqui guardamos el equipo del capitán
		$equipoCapitan = $_POST['equipo'];
		//Contactos del jugador capitan
		$listadoContactos=$this->Contacto->getContactos($idCapitan);
		//Recinto deportivo en el cual se efectuara el partido
		$recinto = $this->Recinto->getRecinto($idRecinto);
		//Datos del partido hacia la vista
		$data['fecha'] = $fecha;
		$data['hora']  = $hora;
		$data['cantidad'] = $cantidad;
		$data['color']= $color;
		$data['color2']= $color2;
		//Letra del equipo
		$data['equipoCapitan'] = $equipoCapitan;
		$data['idHorario']= $idHorario;
	
		$data['tipoPartido'] = 3;
		$data['recintoSeleccionado']= $recinto;
		$data['contactos']=$listadoContactos;
		//Enviamos la información a una vista intermedia que le provee al usuario la capacidad de elegir los jugadores de su equipo
		$this->view->show("eleccionJugadoresABCapitan.php",$data);

	}

	public function equipoCapitanAB(){
		//Debido a que esta funcion es ajax "Cambio a POST"
		//Contiene el arreglo de los id de los jugadores elegidos
		$jugadoresEquipoCap	= $_POST['jugadoresEquipoCap'];
		//Agregamos al equipo capitan y su equipo 
		$arregloJugadores = explode(',', $jugadoresEquipoCap);
		$_SESSION['jugadoresEquipo1'] = $arregloJugadores;
		$listadoTotalContactos=$this->Contacto->getContactos($_SESSION['login_user_id']);
		$listadoContactos;
		//realizamos una filtración de los contactos
		$num=0;
		foreach ($listadoTotalContactos AS $contacto) {
			$cont=0;
			for($i=0; $i<count($arregloJugadores); $i++){
				//Se comprueba si ya fue elegido
				if($contacto['idUsuario'] == $arregloJugadores[$i]){
					$cont++;
				}
			}
			if($cont == 0){
				$listadoContactos[$num] = $contacto;
				$num++;
			}
		}
		$recinto = $this->Recinto->getRecinto($_SESSION['idRecinto']);
		$data['recintoSeleccionado'] =$recinto;
		$data['contactos'] = $listadoContactos;
		//vamos a la vista del otro equipo
		$this->view->show("eleccionJugadoresABOtro.php",$data);
		
	}
	public function agendarPartido(){
		//debemos identificar que tipo de partido es
		//Si es revuelta agregar color
		$idTipo =	$_SESSION['tipoPartido'];
		$idCapitan	= $_SESSION['login_user_id'];
		$fecha	=	$_SESSION['fecha'];
		$hora	=	$_SESSION['hora'];
		$cantidad	= $_SESSION['cantidad'];
		$color	=	$_SESSION['color'];
		$idRecinto = $_SESSION['idRecinto'];
		$idHorario = $_SESSION['idHorario'];
		//partido con estado agendado
		$idEstado = "1";
		//se calcula la cuota
		$horario = $this->Horario->getHorario($idHorario);

		$cuota = end($horario)['precio']/($cantidad*2);
		


		//Ingresar Partido
		$idPartido = $this->Partido->setPartido($idCapitan,$fecha, $hora, $cuota, $idTipo, $idEstado, $idRecinto, $cantidad);
		$_SESSION['idPartido'] = $idPartido;


		//Ingresar equipo del partido (Jugadores) Esto es igual en revuelta y EquipoPropio
		$data	=	json_decode($_POST['jObject'], true);
		for($i=0; $i<sizeof($data); $i++){
			$id=$data[$i];
			$this->Partido->setJugadoresPartidoPropio($idPartido, $id, "A", $color);
		}
			//Debido a que el capitan no se trae, se debe agregar.
			$this->Partido->setJugadoresPartidoPropio($idPartido, $idCapitan,"A", $color);
		}

	public function agendarPartidoRevuelta(){
		$idTipo =	$_SESSION['tipoPartido'];
		$idCapitan	= $_SESSION['login_user_id'];
		$fecha	=	$_SESSION['fecha'];
		$hora	=	$_SESSION['hora'];
		$cantidad	= $_SESSION['cantidad'];
		$color	=	$_SESSION['color'];
		$color2 = $_SESSION['color2'];
		$idRecinto = $_SESSION['idRecinto'];
		$idHorario = $_SESSION['idHorario'];
		//partido con estado agendado

		$idEstado = "1";
		$horario = $this->Horario->getHorario($idHorario);
		$cuota = end($horario)['precio']/$cantidad;
		
		//Ingresar Partido
		$idPartido = $this->Partido->setPartido($idCapitan,$fecha, $hora, $cuota, $idTipo, $idEstado, $idRecinto, $cantidad);
		$_SESSION['idPartido'] = $idPartido;


		//Ingresar equipo del partido (Jugadores) Esto es igual en revuelta y EquipoPropio
		$data	=	json_decode($_POST['jObject'], true);
		for($i=0; $i<sizeof($data); $i++){
			$id=$data[$i];
			$this->Partido->setJugadoresRevuelta($idPartido, $id, $color, $color2);
		}
			//Debido a que el capitan no se trae, se debe agregar.
			$this->Partido->setJugadoresRevuelta($idPartido, $idCapitan, $color, $color2);
	}
	public function agendarPartidoAB(){
		$idTipo =	$_SESSION['tipoPartido'];
		$idCapitan	= $_SESSION['login_user_id'];
		$fecha	=	$_SESSION['fecha'];
		$hora	=	$_SESSION['hora'];
		$cantidad	= $_SESSION['cantidadTotal'];
		$color	=	$_SESSION['color'];
		$color2 = $_SESSION['color2'];
		$idRecinto = $_SESSION['idRecinto'];
		$idHorario = $_SESSION['idHorario'];
		//Jugadores del capitan
		$equipoCapitan =$_SESSION['equipoCapitan'];
		$jugadoresEquipo1 = $_SESSION['jugadoresEquipo1'];
		$jugadoresEquipo2 =json_decode($_POST['jObject'], true);
		$idEstado = "1";
		$horario = $this->Horario->getHorario($idHorario);
		$cuota = end($horario)['precio']/$cantidad;
		$idTipo=3;
		$_SESSION['tipoPartido'] = $idTipo;
		//Ingresar Partido
		$idPartido = $this->Partido->setPartido($idCapitan,$fecha, $hora, $cuota, $idTipo, $idEstado, $idRecinto, $cantidad);
		$_SESSION['idPartido'] = $idPartido;


		for($i=0; $i<sizeof($jugadoresEquipo1); $i++){
			$id=$jugadoresEquipo1[$i];
			if($equipoCapitan == "A"){
				$this->Partido->setJugadoresAB($idPartido,$id,"A",$color);
			}else{
				$this->Partido->setJugadoresAB($idPartido,$id,"B",$color2);
			}
		}

		for($i=0; $i<sizeof($jugadoresEquipo2); $i++){
			$id=$jugadoresEquipo2[$i];

			if($equipoCapitan == "A"){
				$this->Partido->setJugadoresAB($idPartido,$id,"B",$color2);
			}else{
				$this->Partido->setJugadoresAB($idPartido,$id,"A",$color);
			}
		}

			if($equipoCapitan == "A"){
				$this->Partido->setJugadoresAB($idPartido,$idCapitan,"A",$color);
			}else{
				$this->Partido->setJugadoresAB($idPartido,$idCapitan,"B",$color2);
			}



	}


	public function resumenPartido(){
		//Se debe filtrar por tipo de partido.
		$idCapitan	=	$_SESSION['login_user_id'];
		$fecha	=	$_SESSION['fecha'];
		$hora	=	$_SESSION['hora'];
		$cantidad	=	$_SESSION['cantidad'];
		$color	=	$_SESSION['color'];
		$idRecinto =	$_SESSION['idRecinto'];
		$idEstado = "1";

		//Datos del partido
		//Se deben traer 
		$data['tipoPartido'] = $_SESSION['tipoPartido'];
		$data['idCapitan']	=  $_SESSION['login_user_id'];
		$data['fecha']	=	$_SESSION['fecha'];
		$data['hora']	=	$_SESSION['hora'];
		$data['cantidad']	=	$_SESSION['cantidad'];
		$data['color']	=	$_SESSION['color'];
		//Se debe manejar la cuota con JS creo yo
		$cuota['cuota'] =	0;
		//Jugadores del partido
		$jugadoresPartido =	$this->Partido->getJugadoresPartido($_SESSION['idPartido']);
		$data['jugadores']	= $jugadoresPartido;
		//Recinto deportivo

		$recinto = $this->Recinto->getRecinto($_SESSION['idRecinto']);


		//Obtenemos el id del tercer tiempo
		$t = $this->tercerTiempo->getTercerTiempo($_SESSION['idPartido']);
		//var_dump($t);
		$partido= $this->Partido->getPartido($_SESSION['idPartido']);
		$data['partido'] = $partido;


		if(count($t) != 0){
			//pasamos el tercerTiempo
			$data['tercerTiempo'] = $t;
			$aux = end($t);
			$idLocal = $aux['idLocal'];
			$_SESSION['idTercer']= $aux['idTercerTiempo'];

			$data['local'] = $this->local->getLocal($idLocal);
		}



		$data['recinto'] = $recinto;

		//Liberamos las variables globales

		//enviamos los datos a la vista del resumen del partido
		$this->view->show("resumenPartido2.php",$data);		
	}

	public function getJugadoresPartido(){
		$idPartido = $_GET['idPartido'];
		$partido = $this->Partido->getTipoPartido($idPartido);
		foreach ($partido as $key) {
			$tipoPartido = $key['tipo'];
		}
		if ($tipoPartido == 4 ){ 	// Desafio
			// Traer equipos con sus jugadores.
			$idEquipo1 = $_SESSION['idEquipo1'];
			$idEquipo2 = $_SESSION['idEquipo2'];
			//Datos de los equipos.
			$equipo1 = $this->Equipo->getEquipo($idEquipo1);
			$data['equipo1']	= $equipo1;
			$equipo2 = $this->Equipo->getEquipo($idEquipo2);
			$data['equipo2']	= $equipo2;
			//Jugadores del equipo rival
			$jugadoresEquipo1 = $this->Equipo->getMiembrosEquipo($idEquipo1);
			$data['jugadores1']	= $jugadoresEquipo1;
			$jugadoresEquipo2 = $this->Equipo->getMiembrosEquipo($idEquipo2);
			$data['jugadores2']	= $jugadoresEquipo2;
			?>
			<?php
		} else {
			$jugadoresPartido =	$this->Partido->getJugadoresPartido($idPartido);
			$data['jugadores']	= $jugadoresPartido;
		}
		$data['tipoPartido'] = $tipoPartido;
		$this->view->show("_jugadoresPartido.php", $data);
	}


	public function agendarDesafio(){
		//$desafio = new Desafio();
		$idOrganizador= $_POST['idUsuario'];
		$idRival = $_POST['rival'];
		$_SESSION['idEquipo2'] = $idRival;
		$idDesafio = $_POST['desafio'];
		$idEncuentro = $_POST['idEncuentro'];


		$horaPartido = $_POST['hora'];
		$desafio = $this->Desafio->getDesafio($idDesafio);
		foreach ($desafio as $item) {
			$fechaPartido = $item['fechaPartido'];
			$idRecinto = $item['idRecinto'];
			$idEquipoOrganizador = $item['idEquipoOrganizador'];
			$_SESSION['idEquipo1'] = $idEquipoOrganizador;
			$equipoOrganizador = $item['nombreEquipo'];
			$cuota = 0;
		}

		$estado = 1; // Activo.
		$estadoDesafio = 3; // Agendado.
		$tipoPartido = 4; // Desafio.

		// Enviar datos a la BD
		$this->Desafio->cambiarEstado($idDesafio, $estadoDesafio);
		$this->Encuentro->cambiarEstadoEncuentro($idEncuentro, $estadoDesafio);
		$this->Partido->setPartidoDesafio($idOrganizador,$fechaPartido, $horaPartido, $cuota, $tipoPartido, $estado, $idRecinto);

		$partidos = $this->Partido->getPartidos();
		$ultimoPartido = end($partidos)['idPartido'];
		$this->Partido->setEquiposDesafio($ultimoPartido, $idEquipoOrganizador, $idRival);

		//Datos del partido
		$data['tipoPartido'] = $tipoPartido;
		$data['idCapitan']	=  $idOrganizador;
		$data['fecha']	=	$fechaPartido;
		$data['hora']	=	$horaPartido;
		$data['cantidad']	=	0;
		$data['color']	=	"Definidos por cada equipo"; // Falta traer estos datos.
		//$cuota['cuota'] =	0;

		//Jugadores del equipo rival
		$jugadoresEquipo1 = $this->Equipo->getMiembrosEquipo($idEquipoOrganizador);
		$jugadoresEquipo2 = $this->Equipo->getMiembrosEquipo($idRival);

		$data['jugadoresEquipo1'] = $jugadoresEquipo1;
		$data['jugadoresEquipo2'] = $jugadoresEquipo2;
		//$data['jugadores']	= $jugadoresPartido;
		//Recinto deportivo
		$recinto = $this->Recinto->getRecinto($idRecinto);
		$data['recinto'] = $recinto;

		$data['idRecinto'] = $idRecinto;
		$data['idPartido'] = $ultimoPartido;

		$this->view->show("resumenPartido2.php",$data);	


	}

	public function enviarInvitaciones(){

		$idPartido= $_SESSION["idPartido"];
		$idUsuario= $_SESSION['idUsuario'];
		$idRecinto= $_SESSION['idRecinto']; //Recinto seleccionado
		$cantidad = $_SESSION['cantidad'];
		$tipoPartido= $_SESSION['tipoPartido'];
		$correo=$_SESSION['login_user_email'];
        $nombreJugador= $_SESSION['login_user_name'];
    

        $recinto = $this->Recinto->getRecinto($_SESSION['idRecinto']);
		foreach ($recinto as $Recinto) {
			$imagenRecinto = $Recinto['fotografia'];
			$nombreRecinto = $Recinto['nombre'];
			$direccionRecinto = $Recinto['direccion'];
		}

$existenciaTercerTiempo=0;
//buscamos con el id del partido si tiene tercer tiempo
$tercerTiempoPartido = $this->tercerTiempo->getTercerTiempo($idPartido);
$existenciaTercerTiempo = count($tercerTiempoPartido);
$partidoSeleccionado = $this->Partido->getPartido($idPartido);


$idLocal=0;
$nombreLugar="";
$direcciontercertiempo="";

if ($existenciaTercerTiempo != 0) { // Si es 0, no hay tercer tiempo 
	$idTercer = $_SESSION['idTercerTiempo'];
	foreach ($tercerTiempoPartido as $TercerTiempo) {
	$idLocal = $TercerTiempo['idLocal'];
	}
	$localTercerTiempo = $this->local->getLocal($idLocal);
	foreach ($localTercerTiempo as $Local) {
		$nombreLugar = $Local['nombre'];
		$direcciontercertiempo = $Local['direccion'];
		$imagenLugar = $Local['fotografia'];
}

}



			foreach ($partidoSeleccionado as $Partido) {
				$dia = $Partido['fecha'];
				$newFecha = date("d-m-Y", strtotime($dia));
				$hora = $Partido['hora'];
				$cuotaTotal = $Partido['cuota']*$cantidad;
				$participantes = $cantidad;
				$cuotaPersonal = $Partido['cuota'];
				$tipoPartido = $Partido['tipo'];
			}


		$vectorEquipo =	$this->Partido->getJugadoresPartido($_SESSION['idPartido']);

$to = "partidomatchday@gmail.com";
foreach ($vectorEquipo as $Jugador) {
					$aux = $to;
					$to = $aux.", ".$Jugador['mail'];
					
				}	
//foreach para rellenar el campo con los correos de los jugadores
//$query = "SELECT correo FROM jugador WHERE id_jugador IN (SELECT id_jugador FROM equipo where id_partido in (SELECT id_partido FROM partido))";
//echo $query;
//foreach ($query as $key) {
//$to .= ", ".$key;
//}

$dir = $direccionRecinto;
//rellenar con la direccion
$nombre = $nombreJugador;
//rellenar con nombre jugador
$fecha = $newFecha;
//fecha partido
//se mantiene el que copie
//hora partido
$monto = $cuotaTotal;
//precio original cancha
$cant = $cantidad;
//cantidad de jugadores
$pagoporpersona = $cuotaPersonal;
//monto/cancha

$subject = "Invitacion MatchDay";
//se debe obtener el asunto, Partido de: X deporte
$tercertiempo = $nombreLugar;
//recibir existencia de 3er tiempo
$direcciontercertiempo = $direcciontercertiempo;
//direccion tercer tiempo


$message = "<html>";
$message .= "<head>";
$message .= "<title>HTML email</title>";
$message .= "</head>";
$message .= "<body>";
$message .= '<div style="height:auto; width:auto;"><center><img src="assets/images/logoCorreo.png" alt="Website Change Request" /></center></div>';
$message .= '<div style="height:auto; width:auto;"><img src="http://maps.googleapis.com/maps/api/staticmap?center='. $dir . '&zoom=14&scale=false&size=600x300&maptype=roadmap&format=png&visual_refresh=true&markers=size:small%7Ccolor:0xff0000%7Clabel:%7C'.$dir.'" alt="Website Change Request" /></div>';
$message .= "<p>El jugador " .$nombre.  ", te ha invitado a un partido.</p>";
$message .= "<table>";
$message .= "<tr>";
$message .= "<td>Direccion:</td>";
$message .= "<td>".$dir."</td>";
$message .= "</tr>";
$message .= "<tr>";
$message .= "<td>Fecha:</td>";
$message .= "<td>".$fecha."</td>";
$message .= "</tr>";
$message .= "<tr>";
$message .= "<td>Hora: :</td>";
$message .= "<td>".$hora."</td>";
$message .= "</tr>";
$message .= "<tr>";
$message .= "<td>Monto total a pagar:</td>";
$message .= "<td>".$monto."</td>";
$message .= "</tr>";
$message .= "<tr>";
$message .= "<td>Monto a Pagar por persona:</td>";
$message .= "<td>".$pagoporpersona."</td>";
$message .= "</tr>";

//Por tipo de partido
//Revuelta
if($tipoPartido==1){
$message .= "<tr>";
$message .= "<td>Tipo de Partido:</td>";
$message .= "<td>Revuelta</td>";
$message .= "</tr>";
$message .= "<tr>";
$message .= "<td>Colores a llevar:</td>";
$message .= "<td>".$_SESSION['color']." , ".$_SESSION['color2']."</td>";
$message .= "</tr>";

}
//Equipo Propio
if($tipoPartido==2){
$message .= "<tr>";
$message .= "<td>Tipo de Partido:</td>";
$message .= "<td>Equipo Propio</td>";
$message .= "</tr>";
$message .= "<tr>";
$message .= "<td>Color de Camiseta:</td>";
$message .= "<td>".$_SESSION['color']."</td>";
$message .= "</tr>";

	
}
//A vs B
if($tipoPartido==3){
$message .= "<tr>";
$message .= "<td>Tipo de partido:</td>";
$message .= "<td>A v/s B</td>";
$message .= "</tr>";

if($_SESSION['equipoCapitan'] == "A"){
	$message .= "<tr>";
	$message .= "<td>Equipo A:</td>";
	$message .= "<td>".$_SESSION['color']."</td>";
	$message .= "</tr>";

	$message .= "<tr>";
	$message .= "<td>Equipo B:</td>";
	$message .= "<td>".$_SESSION['color2']."</td>";
	$message .= "</tr>";	
}else{
	$message .= "<tr>";
	$message .= "<td>Equipo A:</td>";
	$message .= "<td>".$_SESSION['color2']."</td>";
	$message .= "</tr>";

	$message .= "<tr>";
	$message .= "<td>Equipo B:</td>";
	$message .= "<td>".$_SESSION['color']."</td>";
	$message .= "</tr>";

}
//Jugadores
foreach ($vectorEquipo as $jugador) {
	# code...

	$message .= "<tr>";
	$message .= "<td>".$jugador['nickname']." :</td>";
	$message .= "<td>".$jugador['equipo']."</td>";
	$message .= "</tr>";
}

}
if($tipoPartido==4){
$message .= "<tr>";
$message .= "<td>Monto a Pagar por persona:</td>";
$message .= "<td>".$pagoporpersona."</td>";
$message .= "</tr>";
	
}
$message .= "</table>";



if($existenciaTercerTiempo!=0){
$message .= "<p>Tambien se te ha invitado a un evento post partido!</p>";
	$message .= "Este tercer tiempo sera en: " .$nombreLugar. " mapa de referencia:";
$message .= '<div style="height:auto; width:auto;"><img src="http://maps.googleapis.com/maps/api/staticmap?center='. $direcciontercertiempo . ',Chillan&zoom=14&scale=false&size=600x300&maptype=roadmap&format=png&visual_refresh=true&markers=size:small%7Ccolor:0xff0000%7Clabel:%7C'.$direcciontercertiempo.' Chillan, Chile" alt="Website Change Request" /></div>';
}
$message .= "<center><b><p>© 2016. MatchDay.</p></b></center>";
$message .= "</body>";
$message .= "</html>";



// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <partidomatchday@gmail.com>' . "\r\n"; //
$headers .= 'Cc: partidomatchday@gmail.com' . "\r\n"; // 


//Le paso el mensaje, la lista de correos
send($message,$to);

 //Email response
 		unset($_SESSION['tipoPartido']);
		unset($_SESSION['fecha']);
		unset($_SESSION['hora']);
		unset($_SESSION['cantidad']);
		unset($_SESSION['color']);
		unset($_SESSION['idRecinto']);
		unset($_SESSION['tipoPartido']);
		unset($_SESSION['idPartido']);
		unset($_SESSION['idTercer']);
  

	}
}
?>