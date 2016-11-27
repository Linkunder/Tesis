
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

	public function getFechaNac($idUsuario){
		
		$query = $this->db->prepare("SELECT fechaNacimiento FROM Usuario WHERE idUsuario = '".$idUsuario."'");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	public function setUsuario($nombre, $apellido, $nickname, $mail, $sexo, 
								 $password, $telefono, $fechaNacimiento, 
								$perfil, $estado){
		$sql = "INSERT INTO Usuario (nombre, apellido, nickname, mail, sexo,  password, telefono, fechaNacimiento, perfil, estado) 
				VALUES ('$nombre', '$apellido', '$nickname', '$mail', '$sexo', '$password', '$telefono', (STR_TO_DATE('".$fechaNacimiento."', '%d-%m-%Y')), '$perfil', '$estado');";
		//echo $sql;
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	public function setFotografia($idUsuario, $imagen){
		$sql = "UPDATE Usuario SET fotografia = '".$imagen."' WHERE idUsuario = '".$idUsuario."' ";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	public function updateUsuario($idUsuario, $nombre, $apellido, $nickname,$mail,$telefono){
		$sql = "UPDATE Usuario SET 
			nombre = '".$nombre."',
			apellido = '".$apellido."',
			nickname = '".$nickname."',
			mail = '".$mail."',
			telefono = '".$telefono."'
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

	public function getUsuariosAdmin(){
		$query = $this->db->prepare('SELECT * FROM Usuario WHERE perfil != 2');
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	public function cambiarEstadoJugador($idJugador, $estado){
		$sql = "UPDATE Usuario SET 
			estado = '".$estado."'
			WHERE idUsuario = '".$idJugador."'";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	public function eliminarUsuario($idUsuario){
		$consulta = $this->db->prepare('
			DELETE FROM Usuario WHERE idUsuario = $idUsuario
			');
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

}

?>
