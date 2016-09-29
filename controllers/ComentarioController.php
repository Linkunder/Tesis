<?php

require 'models/Comentario.php';

class ComentarioController{
		function __construct(){
        $this->view = new View();
        $this->comentario = new Comentario();
    }

    public function index(){
    	$this->view->show("");
    }

    public function getComentarios(){
    	if(isset($_GET['idRecinto'])){
    		$idRecinto = $_GET['idRecinto'];
    		$comentario = new Comentario();
    		$listadoComentarios = $comentario->getComentarios($idRecinto);
    		$data['comentarios']= $listadoComentarios;
    	return $data;
    	}
    	


    }
}
?>