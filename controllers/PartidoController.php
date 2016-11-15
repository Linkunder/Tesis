<?php

require 'models/Partido.php';
require 'models/Usuario.php';
require 'models/Contacto.php';
require 'models/Recinto.php';
require 'models/Desafio.php';
require 'models/Equipo.php';
require 'models/TercerTiempo.php';
require 'models/Local.php';


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
	}

	public function index(){
		$this->view->show("");
	}

	public function partidos(){
		$this->view->show("partidos.php");
	}

	//Recopilar informacion del sistema
	public function partidoEquipoPropio(){
		//Datos del partido
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
		//Contactos del jugador capitan
		$listadoContactos=$this->Contacto->getContactos($idCapitan);
		//Recinto deportivo en el cual se efectuara el partido
		$recinto = $this->Recinto->getRecinto($_SESSION['idRecinto']);
		//Datos del partido hacia la vista
		$data['fecha'] = $fecha;
		$data['hora']  = $hora;
		$data['cantidad'] = $cantidad;
		$data['color']= $color;
		$data['color2']= $color;
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
		//Contactos del jugador capitan
		$listadoContactos=$this->Contacto->getContactos($idCapitan);
		//Recinto deportivo en el cual se efectuara el partido
		$recinto = $this->Recinto->getRecinto($_SESSION['idRecinto']);
		//Datos del partido hacia la vista
		$data['fecha'] = $fecha;
		$data['hora']  = $hora;
		$data['cantidad'] = $cantidad;
		$data['color']= $color;
		$data['color2']= $color;
		//Revuelta = 1
		$data['tipoPartido'] = 3;
		$data['recintoSeleccionado']= $recinto;
		$data['contactos']=$listadoContactos;
		$this->view->show("eleccionJugadoresAB.php",$data);
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

		//partido con estado agendado
		$idEstado = "1";
		$cuota = "0";
		//Ingresar Partido
		$idPartido = $this->Partido->setPartidoEquipoPropio($idCapitan,$fecha, $hora, $cuota, $idTipo, $idEstado, $idRecinto);
		$_SESSION['idPartido'] = $idPartido;


		//Ingresar equipo del partido (Jugadores) Esto es igual en revuelta y EquipoPropio
		$data	=	json_decode($_POST['jObject'], true);
		for($i=0; $i<sizeof($data); $i++){
			$id=$data[$i];
			$this->Partido->setJugadoresPartido($idPartido, $id, "A");
		}
			//Debido a que el capitan no se trae, se debe agregar.
			$this->Partido->setJugadoresPartido($idPartido, $idCapitan,"A");
		}

	public function agendarPartidoAB(){

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
		/*unset($_SESSION['tipoPartido']);
		unset($_SESSION['fecha']);
		unset($_SESSION['hora']);
		unset($_SESSION['cantidad']);
		unset($_SESSION['color']);
		unset($_SESSION['idRecinto']);
		unset($_SESSION['tipoPartido']);*/
		
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
		
		$idTercer = $_SESSION['idTercer'];
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



if ($existenciaTercerTiempo != 0) { // Si es 0, no hay tercer tiempo 
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
$message .= '<div style="height:auto; width:auto;"><img src="" alt="Website Change Request" /></div>';
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

mail($to,$subject,$message,$headers);
 //Email response
 
  

	}
}
?>