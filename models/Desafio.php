
<?php

class Desafio{

	protected $db;

	public function __construct(){
		$this->db = SPDO::singleton();
	}

	// Creacion de un desafio
	public function setDesafio($fechaPartido, $limInf, $limSup, $comentario, $idEquipo, $tipoPartido, $estado){
		$sql = "INSERT INTO Desafio (fecha, limInferior, limSuperior, comentario, idEquipo, tipoPartido, estado) 
				VALUES ( '$fechaPartido', '$limInf',' $limSup', '$comentario', '$idEquipo' ,'$tipoPartido', '$estado');";
				echo $sql;
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	// Obtener un determinado desafio.
	public function getDesafio($idDesafio){
		$query = $this->db->prepare("SELECT Desafio.idDesafio, (DATE_FORMAT(Desafio.fecha,'%d-%m-%Y')) as fechaPartido , Desafio.comentario, Desafio.tipoPartido, Desafio.estado as estadoDesafio, Equipo.nombre as nombreEquipo, Usuario.nombre, Usuario.Apellido 
			FROM Desafio 
			JOIN Equipo ON Desafio.idEquipo = Equipo.idEquipo 
			JOIN Usuario ON Usuario.idUsuario = Equipo.idCapitan 
			WHERE Desafio.idDesafio = '".$idDesafio."'
			ORDER BY desafio.fecha ASC
			");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}


	// Obtener los desafios de los equipos de un usuario.
	public function getDesafios($idUsuario){
		$query = $this->db->prepare
		("SELECT Desafio.idDesafio, (DATE_FORMAT(Desafio.fecha,'%d-%m-%Y')) as fechaPartido , Desafio.comentario, Desafio.tipoPartido, Desafio.estado as estadoDesafio, Equipo.nombre as nombreEquipo, Equipo.idEquipo
			FROM Desafio 
			JOIN Equipo ON Desafio.idEquipo = Equipo.idEquipo WHERE Equipo.idCapitan = '".$idUsuario."' ORDER BY desafio.estado DESC");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}


	public function getDesafiosSistema($idUsuario, $limInf, $limSup){
		$sql = "SELECT Desafio.idDesafio, 
			Desafio.fecha, 
			Desafio.comentario, 
			Desafio.idEquipo, 
			Desafio.tipoPartido, 
			Desafio.estado,
			Equipo.nombre as nombreEquipo, 
			Equipo.puntuacion, 
			Usuario.nombre, 
			Usuario.Apellido 
			FROM Desafio 
			JOIN Equipo ON Desafio.idEquipo = Equipo.idEquipo 
			JOIN Usuario ON Usuario.idUsuario = Equipo.idCapitan 
			WHERE Equipo.idCapitan != '".$idUsuario."' 
			AND Desafio.limInferior >= '".$limInf."' 
			AND Desafio.limSuperior <= '".$limSup."'
			ORDER BY desafio.fecha DESC
			 ";
		$query = $this->db->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}



	public function cambiarEstado($idDesafio, $estado){
		$sql = "UPDATE Desafio SET estado = '".$estado."' WHERE idDesafio = '".$idDesafio."' ;";
		$query = $this->db->prepare($sql);
		$query->execute();
	}



}


?>