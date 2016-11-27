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

      $recintos = $this->Recinto->getRecintos();
      $idNuevoRecinto = end($recintos)['idRecinto'];


      $subirImagen = $this->guardarImagen($idNuevoRecinto);

      if ($subirImagen == 0 ){  // hubo un error
        $data['error'] = 0;
        //$this->Recinto->eliminarRecinto($idNuevoRecinto);
        $this->view->show('adminRecintos.php', $data);
      } else {  // todo ok
        $_SESSION['recintoAdmin'] = 4;
        header('Location: ?controlador=Recinto&accion=adminRecintos');
        //$this->view->show('inicio.php', $data);
      }
    }


  private function guardarImagen($idNuevoRecinto){
    $target_dir = "assets/images/recintos/";
    $target_file = $target_dir.basename($_FILES["imagen"]["name"]);
    //echo $target_file;
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Asignar nuevo nombre: idUsuario.extensionFotografia
    $newName = $idNuevoRecinto.".".$imageFileType;
    $newDir = $target_dir.$newName;
    // Chequear si es o no una imagen
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if($check !== false){
            $uploadOk = 1;
        $message = "Archivo es una imagen - " . $check["mime"] . ".";;
        } else {
            $message = "Archivo no es una imagen.";
            $uploadOk = 0;
        }
    }
    /*/ Chequear si el archivo existe o no (no deberia)
    if (file_exists($target_file)) {
        $message = "Lo sentimos pero esta imagen ya existe.";
        $uploadOk = 0;
    }*/
    // Chequear el tamaño de la imagen. 
    if ($_FILES["imagen"]["size"] > 5000000) {
        $message = "Lo sentimos, pero el archivo es muy grande.";
        $uploadOk = 0;
    }
    // Chequear extension
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"
    && $imageFileType != "GIF") {
        $message = "Lo sentimos , solo archivos con JPG, JPEG, PNG & GIF son permitidos.";
        $uploadOk = 0;
    }
    // Chequear la variable $uploadOk = 0
    if ($uploadOk == 0) {
        $message =  "Lo sentimos, tu archivo no se puede subir.";
    // OK, Intenta subir imagen.
    } else {
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $newDir)) {
          $this->Recinto->setFotografia($idNuevoRecinto,$newName);
          return 1;
          //echo "ok";
        } else {
            $message = "Lo sentimos, hubo un error al subir el archivo."; // No debiese entrar aqui.
            return 0;
        }
    }   
  }




}
?>