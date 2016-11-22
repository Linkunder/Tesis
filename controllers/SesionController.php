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
        $resultado =  $this->Login->getLogin($mail); 
        if ($resultado){
            if(password_verify($password, $resultado->password)){
                session_start();
                $_SESSION['login_user_id'] = $resultado->idUsuario;
                $_SESSION['login_user_name'] = $resultado->nombre;
                $_SESSION['login_user_email'] = $resultado->mail;
                $_SESSION['login_user_estado'] = $resultado->estado;
                $_SESSION['login_user_perfil'] = $resultado->perfil;
                if ($_SESSION['login_user_perfil'] == 1 ){
                    header('Location: ?controlador=Index&accion=indexJugador');
                }
                if ( $_SESSION['login_user_perfil'] == 2 ){
                    header('Location: ?controlador=Index&accion=indexAdmin');
                }
                // Direccionar a la pantalla de inicio del jugador
                
            } else{
            //var_dump($resultado);
            $data['error_login'] = true;
            $this->view->show("inicio.php", $data);
            }
        } else{
            //var_dump($resultado);
            $data['error_login'] = true;
            $this->view->show("inicio.php", $data);
            }
    }



    public function logout(){
        session_start();
        unset($_SESSION['login_user_id']);
        unset($_SESSION['login_user_name']);
        unset($_SESSION['login_user_email']);
        //$data['cerrar_sesion'] = true;
        //$this->view->show("inicio.php", $data);
        session_destroy();
        header('Location: ?controlador=Index&accion=inicio');
    }

}

?>