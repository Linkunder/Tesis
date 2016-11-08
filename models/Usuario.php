
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
		
		$query = $this->db->prepare("SELECT * FROM Usuario WHERE idUsuario = '".$idUsuario."'");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	public function setUsuario($nombre, $apellido, $nickname, $mail, $sexo, $fotografia,
								 $password, $telefono, $fechaNacimiento, 
								$perfil, $estado){
		$sql = "INSERT INTO Usuario (nombre, apellido, nickname, mail, sexo, fotografia, password, telefono, fechaNacimiento, perfil, estado) 
				VALUES ('$nombre', '$apellido', '$nickname', '$mail', '$sexo', '$fotografia','$password', '$telefono', (STR_TO_DATE('".$fechaNacimiento."', '%Y-%d-%m')), '$perfil', '$estado');";
		echo $sql;
		//$query = $this->db->prepare($sql);
		//$query->execute();
	}

	public function setFotografia($idUsuario, $imagen){
		$sql = "UPDATE Usuario SET fotografia = '".$imagen."' WHERE idUsuario = '".$idUsuario."' ";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	public function updateUsuario($idUsuario, $nickname,$mail,$telefono,$fotografia,$fechaNacimiento){
		$sql = "UPDATE Usuario SET 
			nickname = '".$nickname."',
			mail = '".$mail."',
			telefono = '".$telefono."',
			fechaNacimiento = '".$fechaNacimiento."'
			WHERE idUsuario = '".$idUsuario."'";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	public function buscarJugador($nickname){
		$sql = "SELECT * FROM Usuario WHERE nickname = '".$nickname."';";
		$query = $this->db->prepare($sql);
		$query->execute();
		$result = $query->fetchAll();
		return $result;
	}

	public function getNombreApellido($idUsuario){
		$query = $this->db->prepare("SELECT nombre,apellido FROM Usuario WHERE idUsuario = '".$idUsuario."'");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

}

?>
