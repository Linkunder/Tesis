<?php
require 'models/Recinto.php';
require 'models/Comentario.php';
require 'models/Puntuacion.php';
require 'models/Partido.php';
require 'models/Horario.php';
require 'models/Implemento.php';
require 'models/Contacto.php';

session_start();

class RecintoController{

	function __construct(){
        $this->view = new View();
        $this->Recinto = new Recinto();
        $this->Horario = new Horario();
        $this->Implemento = new Implemento();
        $this->Contacto = new Contacto();
    }

    public function index()
    {
        $this->view->show("");
    }

    //Busqueda recintos sin registrar
    public function busquedaRecintos(){

            if(isset($_POST['tipo'])){
	          $tipo = $_POST['tipo'];
             }else{
                $tipo=0;
             }
        
    	//Si es la busqueda sin sesion
    	$recinto = new Recinto();
    	$comentario = new Comentario();
      $puntuacion = new Puntuacion();
      $partido =  new Partido();
      if(!isset($_SESSION)) { 
        session_start(); 
        } 
    	if(!isset($_SESSION['login_user_id'])){
    		if (isset($_POST['search'])) {
                      $search = $_POST['search'];
                      $data['search']=$search;
                      $listadoComentarios = $comentario->getComentarios();
                       $data['comentarios'] = $listadoComentarios;

            }
    		$listadoRecintos = $recinto->getRecintos();
    		$data['recintos'] = $listadoRecintos;

    		$this->view->show("recintos.php",$data);

    	}else{
            if(!isset($_SESSION)) 
            { 
             session_start(); 
            } 
           $idUsuario = $_SESSION['login_user_id'];
            //Si es la busqueda con sesion
                          if (isset($_POST['search'])) {
                          $search = $_POST['search'];
                          $data['search']=$search;
                          $listadoComentarios = $comentario->getComentarios();
                          $data['comentarios'] = $listadoComentarios; 

                       $listadoContactos= $this->Contacto->getContactos($_SESSION['login_user_id']);
                       $numeroContactos=count($listadoContactos);
                       $data['numeroContactos'] = $numeroContactos;
                          $listadoPuntuacion = $puntuacion->getPuntuaciones($idUsuario);
                          $listadoPartidos = $partido->getPartidosUsuario($idUsuario);
                          $data['partidos'] = $listadoPartidos;
                          $data['puntuaciones'] = $listadoPuntuacion;

            }

    		$listadoRecintos = $recinto->getRecintos();
    		$data['recintos'] = $listadoRecintos;
    		$this->view->show("recintos.php",$data);

    	
    	}
    }

    public function notificarRecinto(){
      $this->view->show("notificarRecinto.php");
    }

    public function ingresarRecinto(){
      $recinto = new Recinto();
      $nombre = $_POST['nombre'];
      $fono = $_POST['fono'];
      $direccion = $_POST['direccion'];
      $idUsuario = $_POST['idUsuario'];

      $recinto->setSolicitud($nombre, $fono, $direccion, $idUsuario);

      header('Location: ?controlador=Recinto&accion=notificarRecinto&1');
    }

    public function horariosRecinto(){
      //Id del recinto tomada desde la variable global

      $idRecinto = $_GET['id'];
      $horarios = $this->Horario->getHorariosRecinto($idRecinto);
      $data['horarios'] = $horarios;
      //mostrar vista parcial con los horarios (dataTable)
      $this->view->show("_horarios.php",$data);
    }

    public function implementosRecinto(){
      //Id del recinto desde la variable global
      if(!isset($_SESSION)) { 
        session_start(); 
        } 
      $idRecinto = $_GET['id'];
      $implementos = $this->Implemento->getImplementosRecinto($idRecinto);
      $data['implementos'] = $implementos;
      //mostrar vista parcial con los implementos (dataTable)
      $this->view->show("_implementos.php", $data);
    }


    public function verMapaRecinto(){
      $idRecinto = $_GET['idRecinto'];
      $recinto = new Recinto();
      $mapaRecinto = $recinto->getDireccionRecinto($idRecinto);
      $data['mapa'] = $mapaRecinto;
      //mostrar vista parcial con los implementos (dataTable)
      $this->view->show("_mapa.php", $data);
    }

    public function getHorarios(){
      $idRecinto = $_GET['id'];
      $form = $_GET['form'];
      $data['horarios'] = $this->Horario->getHorariosRecinto($idRecinto);
      $data['form'] = $form;
      $this->view->show("_horarios.php", $data);
    }


    public function pruebaRecintos(){
      $recintos = $this->Recinto->getRecintos();
      $data['recintos'] = $recintos;
      $this->view->show('pruebaRecintos.php',$data);
    }




    /*    MODULO DE ADMINISTRACION  */
    public function adminRecintos(){
      $recintos = $this->Recinto->getRecintos();
      $data['recintos'] = $recintos;
      if (isset($_SESSION['recintoAdmin'])){
        $data['recintoAdmin'] = $_SESSION['recintoAdmin'];
      }
      $_SESSION['recintoAdmin'] = 0;
      $this->view->show('adminRecintos.php',$data);
    }


    public function cambiarEstadoRecinto(){
      $idRecinto = $_POST['idRecinto'];
      $estado = $_POST['estado'];
      $this->Recinto->cambiarEstadoRecinto($idRecinto, $estado);
      if ($estado == 1){
        $_SESSION['recintoAdmin'] = 2;
      }
      if ($estado == 2){
        $_SESSION['recintoAdmin'] = 1;
      }
      header('Location: ?controlador=Recinto&accion=adminRecintos');
    }

    public function editarRecinto(){
      $idRecinto = $_GET['idRecinto'];
      $recinto = $this->Recinto->getRecinto($idRecinto);
      $data['recinto'] = $recinto;
      $this->view->show("_adminEditarRecinto.php", $data);
    }


    public function updateRecinto(){
      $idRecinto = $_POST['idRecinto'];
      $nombre = $_POST['nombre'];
      $tipo = $_POST['tipo'];
      $superficie = $_POST['superficie'];
      $direccion = $_POST['direccion'];
      $telefono = $_POST['telefono'];
      $this->Recinto->actualizarRecinto($idRecinto, $nombre, $tipo, $superficie, $direccion, $telefono);
      $_SESSION['recintoAdmin'] = 3;
      header('Location: ?controlador=Recinto&accion=adminRecintos');
    }

    public function agregarRecinto(){
      $nombre = $_POST['nombre'];
      $tipo = $_POST['tipo'];
      $superficie = $_POST['superficie'];
      $direccion = $_POST['direccion'];
      $telefono = $_POST['telefono'];
      $estado = $_POST['estado'];
      $puntuacion = 0;
      $idUsuario = $_SESSION['login_user_id'];
      $this->Recinto->setRecinto($nombre,$tipo,$superficie,$direccion,$telefono,$estado, $puntuacion, $idUsuario);
    }

}
?>