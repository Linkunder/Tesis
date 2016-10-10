<?php

require 'models/Comentario.php';

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
            var_dump($listadoComentarios);
    		$data['comentarios']= $listadoComentarios;
    	    return $data;
    }

    public function setComentario(){
        $idRecinto = $_POST['idRecinto'];
        $idUsuario = $_POST['idUsuario'];
        $contenido = $_POST['contenido'];

        $this->Comentario->setComentario($idRecinto, $idUsuario, $contenido);
        
    }
}
?>