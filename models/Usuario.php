<?php

class Usuario{

	protected $db;

	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getUsuarios(){
		$query = $this->db->prepare('SELECT * FROM Usuario');
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	public function getUsuario($idUsuario){
		echo $idUsuario;
		$query = $this->db->prepare('SELECT * FROM Usuario WHERE idUsuario = $idUsuario');
		$query->execute();
		$resultado = $query->fetchObject();
		return $resultado;
	}

	public function setUsuario($nombre, $apellido, $nickname, $mail, $sexo, $fotografia,
								 $password, $telefono, $fechaNacimiento, 
								$perfil, $estado){
		$sql = "INSERT INTO Usuario (nombre, apellido, nickname, mail, sexo, fotografia, password, telefono, fechaNacimiento, perfil, estado) 
				VALUES ('$nombre', '$apellido', '$nickname', '$mail', '$sexo', 'no','$password', '$telefono', '$fechaNacimiento', '$perfil', '$estado');";
		$query = $this->db->prepare($sql);
		$query->execute();
	}



}

?>