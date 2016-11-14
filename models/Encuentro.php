
<?php

class Encuentro{

	protected $db;

	public function __construct(){
		$this->db = SPDO::singleton();
	}

	//	Obtener respuestas de un desafio
	public function getEncuentros($idDesafio){
		$sql = "SELECT DISTINCT 
		desafio.estado,
		desafio.fecha as fechaPartido,
		desafio.comentario, 
		encuentro.idEncuentro,
		encuentro.estadoSolicitud,
		equipo.idEquipo , 
		encuentro.idDesafio,  
		recinto.nombre as nombreRecinto, 
		recinto.fotografia as fotoRecinto,
		recinto.tipo as tipoPartido, 
		equipo.nombre as nombreEquipo, 
		usuario.nombre as nombreCap, 
		usuario.apellido as apellidoCap, 
		usuario.fotografia, 
		equipo.puntuacion, 
		equipo.edadPromedio 
			FROM encuentro 
			join desafio on encuentro.idDesafio = desafio.idDesafio 
			join recinto on desafio.idRecinto = recinto.idRecinto
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
	public function setEncuentro($idDesafio, $idEquipo, $respuesta, $estado){
		$sql = "INSERT INTO Encuentro (idDesafio, idEquipo, respuesta, estadoSolicitud) 
			VALUES ('".$idDesafio."', '".$idEquipo."' , '".$respuesta."', '".$estado."');";
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


	public function cambiarEstado($idDesafio, $estado){
		$sql = "UPDATE Encuentro SET estadoSolicitud = '".$estado."' WHERE idDesafio = '".$idDesafio."' ;";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	public function getSolicitudes($idUsuario){
		$sql = "SELECT encuentro.idEncuentro, encuentro.idDesafio, (DATE_FORMAT(Desafio.fecha,'%d-%m-%Y')) as fechaPartido , recinto.tipo as tipoPartido, equipo.nombre as equipo1,(select nombre from equipo where idEquipo = desafio.idEquipo) as equipo2, encuentro.estadoSolicitud 
		from encuentro 
		join desafio on encuentro.idDesafio = desafio.idDesafio
		join recinto on recinto.idRecinto = desafio.idRecinto 
		join equipo on encuentro.idEquipo = equipo.idEquipo WHERE equipo.idCapitan= '".$idUsuario."';";
		$query = $this->db->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	public function getEncuentro($idEncuentro){
		$sql = "SELECT encuentro.idEncuentro, encuentro.idDesafio, (DATE_FORMAT(Desafio.fecha,'%d-%m-%Y')) as fechaPartido , Recinto.tipo as tipoPartido,
		Recinto.fotografia as fotoRecinto, Recinto.nombre as nombreRecinto, equipo.nombre as equipo1,(select nombre from equipo where idEquipo = desafio.idEquipo) as equipo2, encuentro.estadoSolicitud 
		from encuentro 
		join desafio on encuentro.idDesafio = desafio.idDesafio 
		join recinto on desafio.idRecinto = recinto.idRecinto
		join equipo on encuentro.idEquipo = equipo.idEquipo WHERE encuentro.idEncuentro= '".$idEncuentro."';";
		//echo $sql;
		$query = $this->db->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}


	public function getEncuentroAcordado($idDesafio){
		$sql = "SELECT equipo.idEquipo as idRival ,equipo.nombre as nombreEquipo2, encuentro.respuesta
		from encuentro 
		join desafio on encuentro.idDesafio = desafio.idDesafio 
		join equipo on encuentro.idEquipo = equipo.idEquipo WHERE encuentro.idDesafio= '".$idDesafio."';";
		//echo $sql;
		$query = $this->db->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}


	public function cancelarEncuentro($idEncuentro){
		$sql = 
			"DELETE FROM encuentro WHERE idEncuentro = '".$idEncuentro."';";
		$query = $this->db->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}


}


?>