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
        $this->view->show("index.php");
    }
    public function inicio(){
        $this->view->show("inicio.php");
    }

    public function indexJugador(){
        $this->view->show("indexJugador.php");
    }
}

?>