<?php

require 'models/Comentario.php';

session_start();

class ComentarioController{
		function __construct(){
        $this->view = new View();
        $this->Comentario = new Comentario();
    }

    public function index(){
    	$this->view->show("");
    }

    public function getComentarios(){
    		$idRecinto = $_GET['idRecinto'];
    		$comentario = new Comentario();
    		$listadoComentarios = $comentario->getComentarios($idRecinto);
            //var_dump($listadoComentarios);
    		$data['comentarios']= $listadoComentarios;
    	    return $data;
    }

    public function setComentario(){
        $comentario = new Comentario();
        $idRecinto = $_POST['idRecinto'];
        $idUsuario = $_POST['idUsuario'];
        $contenido = $_POST['contenido'];

        $comentario->setComentario($idRecinto, $idUsuario, $contenido);
        header('Location: ?controlador=Recinto&accion=busquedaRecintos&nuevo=1');
        
    }



    /*    MODULO DE ADMINISTRACION  */
    public function adminComentarios(){
        $comentarios = $this->Comentario->getComentariosAdmin();
        $data['comentarios'] = $comentarios;
        if (isset($_SESSION['adminComentarios'])){
            $data['adminComentarios'] = $_SESSION['adminComentarios'];
        }
        $_SESSION['adminComentarios'] = 0;
        $this->view->show('adminComentarios.php',$data);
    }

    public function eliminarComentario(){
        $idComentario = $_POST['idComentario'];
        $this->Comentario->eliminarComentario($idComentario);
        $_SESSION['adminComentarios'] = 1;
        header('Location: ?controlador=Comentario&accion=adminComentarios');
    }
}
?>