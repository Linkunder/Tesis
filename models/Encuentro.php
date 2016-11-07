
<?php

class Encuentro{

	protected $db;

	public function __construct(){
		$this->db = SPDO::singleton();
	}

	//	Obtener respuestas de un desafio
	public function getEncuentros($idDesafio){
		$sql = "SELECT DISTINCT 
		desafio.estado, encuentro.idEncuentro, equipo.idEquipo , encuentro.idDesafio, equipo.nombre as nombreEquipo, usuario.nombre as nombreCap, usuario.apellido as apellidoCap, usuario.fotografia, equipo.puntuacion, equipo.edadPromedio 
			FROM encuentro 
			join desafio on encuentro.idDesafio = desafio.idDesafio 
			join equipo on equipo.idEquipo = encuentro.idEquipo 
			join usuario on equipo.idCapitan = usuario.idUsuario
			WHERE encuentro.idDesafio = '".$idDesafio."' ";
		$query = $this->db->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}




	// Obtener los desafios de un equipo
	public function getRespuestas($idDesafio){
		$query = $this->db->prepare("SELECT Encuentro.estadoSolicitud as estadoSolicitud 
			FROM Desafio 
			JOIN Encuentro ON Desafio.idDesafio = Encuentro.idDesafio
			WHERE Desafio.idDesafio = '".$idDesafio."'");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	// Guardar el desafio realizado por un equipo (En el vestibulo)
	public function setEncuentro($idDesafio, $idEquipo, $estado){
		$sql = "INSERT INTO Encuentro (idDesafio, idEquipo, estadoSolicitud) 
			VALUES ('".$idDesafio."', '".$idEquipo."' , '".$estado."');";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	// Verificar la existencia de un encuentro
	public function verificarEncuentro($idEquipo, $idDesafio){
		$sql = "SELECT * FROM Encuentro WHERE idEquipo = '".$idEquipo."' AND idDesafio = '".$idDesafio."'";
		$query = $this->db->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	public function eliminarEncuentros($idDesafio, $idEquipo){
		$sql = "DELETE FROM encuentro WHERE idDesafio = '".$idDesafio."' and idEquipo != '".$idEquipo."';";
		$query = $this->db->prepare($sql);
		$query->execute();
	}



}


?>