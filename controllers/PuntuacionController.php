<?php

require 'models/Puntuacion.php';

class PuntuacionController{
		function __construct(){
        $this->view = new View();
        $this->Puntuacion = new Puntuacion();
    }

    public function index(){
    	$this->view->show("");
    }

    public function getPuntuaciones(){
    
    }

    public function setPuntuacion(){
        $idRecinto = $_POST['idRecinto'];
        $idUsuario = $_POST['idUsuario'];
        $contenido = $_POST['valoracion'];

        $this->Puntuacion->setPuntuacion($idRecinto, $idUsuario, $valoracion);
        
    }
}
?>