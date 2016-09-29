<?php

class Contacto{

	protected $db;

	public function __construct(){
		$this->db = SPDO::singleton();
	}

	// Obtener contactos de un usuario.
	public function getContactos($idUsuario){
		$query = $this->db->prepare("SELECT * FROM Usuario INNER JOIN Contacto ON Usuario.idUsuario = Contacto.idContacto WHERE Contacto.idUsuario = '".$idUsuario."'");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}



}


?>