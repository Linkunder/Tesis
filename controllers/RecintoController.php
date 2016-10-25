<?php
require 'models/Recinto.php';
require 'models/Comentario.php';
require 'models/Puntuacion.php';
require 'models/Partido.php';


class RecintoController{

	function __construct(){
        $this->view = new View();
        $this->Recinto = new Recinto();
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



}
?>