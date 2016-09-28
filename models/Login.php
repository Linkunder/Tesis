<?php

class Login{

	protected $db;

	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getLogin($mail, $password){
		$query = $this->db->prepare("SELECT * FROM Usuario WHERE mail = '$mail' and password = '$password'");
		$query->execute();
		$resultado = $query->fetchObject();
		return $resultado;
	}
}

?>