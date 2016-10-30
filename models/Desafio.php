
<?php

class Desafio{

	protected $db;

	public function __construct(){
		$this->db = SPDO::singleton();
	}

	// Creacion de un desafio
	public function setDesafio($edadPromedio, $fechaPartido, $comentario, $idEquipo, $tipoPartido, $estado){
		$sql = "INSERT INTO Desafio (edadPromedio, fecha, comentario, idEquipo, tipoPartido, estado) 
				VALUES ('$edadPromedio', '$fechaPartido', '$comentario', '$idEquipo' ,'$tipoPartido', '$estado');";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	// Obtener un determinado desafio.
	public function getDesafio($idDesafio){
		$query = $this->db->prepare("SELECT * FROM Desafio WHERE idDesafio = '".$idDesafio."'");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	// Obtener los desafios de los equipos de un usuario.
	public function getDesafios($idUsuario){
		$query = $this->db->prepare
		("SELECT * FROM Desafio JOIN Equipo ON Desafio.idEquipo = Equipo.idEquipo WHERE Equipo.idCapitan = '".$idUsuario."'");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	public function getDesafiosSistema($idUsuario){
		$query = $this->db->prepare
		("SELECT Desafio.idDesafio, Desafio.edadPromedio, Desafio.fecha, Desafio.comentario, Desafio.idEquipo, Desafio.tipoPartido, Equipo.nombre as nombreEquipo, Equipo.puntuacion, Usuario.nombre, Usuario.Apellido FROM Desafio JOIN Equipo ON Desafio.idEquipo = Equipo.idEquipo JOIN Usuario ON Usuario.idUsuario = Equipo.idCapitan WHERE Equipo.idCapitan != '".$idUsuario."'");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}


	// Obtener los desafios de un equipo
	public function getRespuestas($idDesafio){
		$query = $this->db->prepare("SELECT Encuentro.estadoSolicitud FROM Desafio JOIN Encuentro ON Desafio.idDesafio = Encuentro.idDesafio WHERE Desafio.idDesafio = '".$idDesafio."'");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}



}


?>