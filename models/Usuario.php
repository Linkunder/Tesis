
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
		$query = $this->db->prepare('SELECT * FROM Usuario WHERE perfil != 2 AND estado != 3');
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

	public function getCantidadPorSexo(){
		$consulta = $this->db->prepare("SELECT count(*) as F FROM Usuario WHERE sexo= 'F'");
		$consulta->execute();
		$resultado[0] = $consulta->fetchAll();
		$consulta = $this->db->prepare("SELECT count(*) as M FROM Usuario WHERE sexo= 'M'");
		$consulta->execute();
		$resultado[1] = $consulta->fetchAll();

		return $resultado;


	}
	public function getEdades(){
		$consulta = $this->db->prepare("SELECT YEAR( CURDATE() ) - YEAR(  `fechaNacimiento` ) + IF( DATE_FORMAT( CURDATE() ,  '%m-%d' ) > DATE_FORMAT( fechaNacimiento,  '%m-%d' ) , 0, -1 ) AS edad, COUNT( * ) AS cantidad
		FROM  Usuario 
		WHERE perfil =1
		GROUP BY edad");
		$consulta->execute();
		$resultado = $consulta->fetchAll();

		return $resultado;
	}

	public function getComentariosUsuario(){
		$consulta = $this->db->prepare("SELECT Usuario.idUsuario , count(*) AS cantidad FROM Usuario NATURAL JOIN Comentario WHERE Usuario.Perfil = 1 GROUP BY idUsuario");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function getTopTenJugadoresPartidos(){
		$consulta = $this->db->prepare("SELECT JugadoresPartido.idUsuario, Usuario.nombre, Usuario.apellido, COUNT(*) AS partidos
					FROM JugadoresPartido
					INNER JOIN Partido ON JugadoresPartido.idPartido = Partido.idPartido
					INNER JOIN Usuario ON JugadoresPartido.idUsuario = Usuario.idUsuario 
					WHERE Partido.Estado =2
					GROUP BY JugadoresPartido.idUsuario
					ORDER BY partidos DESC 
					LIMIT 0 , 10");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}



}

?>
