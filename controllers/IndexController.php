<?php

class IndexController
{
	
	function __construct()
    {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
    }
 
    public function index()
    {
        //La pagina de inicio
        if(!isset($_SESSION)) { 
        session_start(); 
        } 
        if(!isset($_SESSION['login_user_id'])){
            $this->view->show("index.php");
        }else{
             $this->view->show("indexJugador.php");
        }
    }
    public function inicio(){
        $this->view->show("inicio.php");
    }

    public function indexJugador(){
        $this->view->show("indexJugador.php");
    }

    public function indexAdmin(){
        $this->view->show("indexAdmin.php");
    }
}

?>