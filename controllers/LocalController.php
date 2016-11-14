<?php

require 'models/Local.php';

class LocalController{

	function __construct(){
		$this->view = new View();
		$this->local = new Local();
	}

	public function index(){
		$this->view->show("");
	}

	public function busquedaLocales(){

		//Cuando se realice la busqueda
		if(isset($_POST['search'])){
			$search = $_POST['search'];
			$data['search'] = $search;
		}
		$listadoLocales = $this->local->getLocales();
		//listado de locales
		$data['locales'] = $listadoLocales;


		$this->view->show("locales.php",$data);
	}

    public function verMapaLocal(){
      $idLocal = $_GET['idLocal'];
      $local = new Local();
      $mapaLocal = $local->getDireccionLocal($idLocal);
      $data['mapa'] = $mapaLocal;
      //mostrar vista parcial con los implementos (dataTable)
      $this->view->show("_mapa.php", $data);
    }


}


?>