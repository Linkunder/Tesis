<?php

require 'models/Login.php';

class SesionController{

	function __construct(){
		$this->view = new View();
		$this->Login = new Login();
	}

	public function index(){
		$this->view->show("");
	}

	public function login(){
		if(!isset($_SESSION['login_mail'])){
            $this->view->show("ingresar.php");
        }else{
            header('Location:inicio.php');
        }
	}


	public function verificarLogin(){
        $mail = $_POST['mail'];
        $password = $_POST['password'];
        $resultado =  $this->Login->getLogin($mail, $password);
        if($resultado){
            $_SESSION['login_user_id'] = $resultado->idUsuario;
            $_SESSION['login_user_name'] = $resultado->nombre;
            $_SESSION['login_user_email'] = $resultado->mail;
            $data['login'] = true;
            header('Location: index.php');
        }else{
            $data['error_login'] = true;
            $this->view->show("inicio.php", $data);
        }
    }

    public function logout(){
        unset($_SESSION['login_user_id']);
        unset($_SESSION['login_user_name']);
        unset($_SESSION['login_user_email']);
        header('Location: ?');
    }

}

?>