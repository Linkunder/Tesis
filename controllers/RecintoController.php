<?php
require 'models/Recinto.php';
require 'models/Comentario.php';
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
            $tipo= $_POST['tipo'];
        }else{  
            if(isset($_GET['tipo'])){
	          $tipo = $_GET['tipo'];
             }else{
                $tipo=0;
             }
        }
    	//Si es la busqueda sin sesion
    	$recinto = new Recinto();
    	$comentario = new Comentario();
    	if($tipo == 0){
    		if (isset($_POST['search'])) {
                      $search = $_POST['search'];
                      $data['search']=$search;
                      $listadoComentarios = $comentario->getComentarios();
                      $data['comentarios']= $listadoComentarios;
            }
    		$listadoRecintos = $recinto->getRecintos();
    		$data['recintos'] = $listadoRecintos;

    		$this->view->show("recintos.php",$data);

    	}else{

    		//Si es la busqueda con sesion
    		$listadoRecintos = $recinto->getRecintos();
    		$data['recintos'] = $listadoRecintos;
    		$this->view->show("recintos.php",$data);

    	
    	}
    }




}
?>