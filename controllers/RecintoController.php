<?php
require 'models/Recinto.php';

class RecintoController{

	function __construct(){
        $this->view = new View();
        $this->recinto = new Recinto();
    }

    public function index()
    {
        $this->view->show("");
    }

    //Busqueda recintos sin registrar
    public function busquedaRecintos(){
    	$tipo = $_GET['tipo'];
    	//Si es la busqueda sin sesion
    	$recinto = new Recinto();
    	if($tipo == 0){
    		if (isset($_GET['search'])) {
                      $search = $_GET['search'];
                      $data['search']=$search;
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