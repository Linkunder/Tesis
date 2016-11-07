<?php
require 'models/Recinto.php';
require 'models/Comentario.php';
require 'models/Puntuacion.php';
require 'models/Partido.php';
require 'models/Horario.php';
require 'models/Implemento.php';


class RecintoController{

	function __construct(){
        $this->view = new View();
        $this->Recinto = new Recinto();
        $this->Horario = new Horario();
        $this->Implemento = new Implemento();
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

    public function horariosRecinto(){
      //Id del recinto tomada desde la variable global
      if(!isset($_SESSION)) { 
        session_start(); 
        } 

      $idRecinto = $_SESSION['idRecinto'];
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
      $idRecinto = $_SESSION['idRecinto'];
      $implementos = $this->Implemento->getImplementosRecinto($idRecinto);
      $data['implementos'] = $implementos;
      //mostrar vista parcial con los implementos (dataTable)
      $this->view->show("_implementos.php", $data);
    }

    


}
?>