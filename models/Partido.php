<?php
class Partido{

	protected $db;
	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getPartidos(){
		$consulta = $this->db->prepare("
			SELECT * FROM Partido;
			");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function getPartido($idPartido){
		$consulta = $this->db->prepare("
			SELECT * FROM Partido WHERE idPartido = '$idPartido';
			");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;


	}

	//PARTIDOS JUGADOS DEL USUARIO
	public function getPartidosUsuario($idUsuario){
		$consulta = $this->db->prepare("SELECT JugadoresPartido.idPartido, Partido.idRecinto FROM JugadoresPartido INNER JOIN Partido on JugadoresPartido.idPartido = Partido.idPartido WHERE Partido.estado = 2 AND JugadoresPartido.idUsuario = '$idUsuario'");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function setJugadoresPartidoPropio($idPartido, $idUsuario, $equipo, $color){
		$consulta = $this->db->prepare("
			INSERT INTO JugadoresPartido (
				idPartido, idUsuario, equipo, color1, estado) 
				VALUES
				('$idPartido',
				'$idUsuario',
				'$equipo',
				'$color',
				'0'
				);
			");
		$consulta->execute();
	}

	public function setJugadoresRevuelta($idPartido, $idUsuario, $color, $color2){
		$consulta = $this->db->prepare("
			INSERT INTO JugadoresPartido (
				idPartido, idUsuario, color1, color2, estado) 
				VALUES
				('$idPartido',
				'$idUsuario',
				'$color',
				'$color2',
				'0'
				);
			");
		$consulta->execute();
	}
	public function setJugadoresAB($idPartido, $idUsuario, $equipo, $color){
		$consulta = $this->db->prepare("
			INSERT INTO JugadoresPartido 
			(idPartido, 
			 idUsuario, 
			 equipo, 
			 color1, 
			 estado)
			VALUES(
			'$idPartido',
			'$idUsuario',
			'$equipo',
			'".$color."',
			'0'
			);
			");
		$consulta->execute();
	}
	public function setPartido($idOrganizador,$fecha, $hora, $cuota, $tipo, $estado, $idRecinto, $cantidad){
		$consulta= $this->db->prepare("
			INSERT INTO Partido (
				idOrganizador,
				fecha,
				hora,
				cuota,
				tipo,
				estado,
				idRecinto,
				nroJugadores
				)
			VALUES(
				'$idOrganizador',
				'$fecha',
				'$hora',
				'$cuota',
				'$tipo',
				'$estado',
				'$idRecinto',
				'$cantidad'
				);
			SELECT LAST_INSERT_ID() AS lastId;
				");
		$consulta->execute();
		$resultado= $this->db->lastInsertId();

		return $resultado;
	}

	public function getJugadoresPartido($idPartido){
		$consulta = $this->db->prepare(
			"SELECT Usuario.nombre,
			 Usuario.apellido, 
			 Usuario.nickname, 
			 Usuario.fotografia, 
			 Usuario.mail,
			 JugadoresPartido.equipo,
			 JugadoresPartido.color1,
			 JugadoresPartido.color2
			FROM JugadoresPartido 
			INNER JOIN Usuario on JugadoresPartido.idUsuario = Usuario.idUsuario 
			WHERE idPartido='$idPartido'");
		$consulta->execute();
		$resultado=$consulta->fetchAll();
		return $resultado;
	}

	public function getTipoPartido($idPartido){
		$consulta = $this->db->prepare(
			"SELECT tipo
			FROM Partido
			WHERE idPartido='$idPartido'");
		$consulta->execute();
		$resultado=$consulta->fetchAll();
		return $resultado;
	}

	public function setPartidoDesafio($idOrganizador,$fecha, $hora, $cuota, $tipo, $estado, $idRecinto, $nroJugadores){
		$consulta= $this->db->prepare(
			"INSERT INTO Partido (
				idOrganizador,
				fecha,
				hora,
				cuota,
				tipo,
				estado,
				idRecinto,
				nroJugadores)
			VALUES(
				'$idOrganizador',
				(STR_TO_DATE('".$fecha."', '%d-%m-%Y')),
				'$hora',
				'$cuota',
				'$tipo',
				'$estado',
				'$idRecinto',
				'$nroJugadores'
				);
			SELECT LAST_INSERT_ID() AS lastId;
				");
		$consulta->execute();
		$resultado= $this->db->lastInsertId();

		return $resultado;
	}

	public function setEquiposDesafio($ultimoPartido, $idEquipoOrganizador, $idRival){
		$consulta= $this->db->prepare(
			"INSERT INTO EquiposPartido (
				idPartido,
				idEquipo,
				idEquipo2)
			VALUES(
				'$ultimoPartido',
				'$idEquipoOrganizador',
				'$idRival'
				);
			SELECT LAST_INSERT_ID() AS lastId;
				");
		$consulta->execute();
		$resultado= $this->db->lastInsertId();

		return $resultado;
	}


	public function getPartidosPendientes($idUsuario){
		$consulta = $this->db->prepare(
			"SELECT 
			Usuario.nombre as nombreCap, 
			Usuario.apellido as apellidoCap, 
			Partido.idPartido, 
			DATE_FORMAT(Partido.fecha,'%d-%m-%Y') as fechaPartido, 
			DATE_FORMAT(Partido.hora,'%l:%i %p') as horaPartido,
			Recinto.nombre 
			FROM Partido 
			JOIN Recinto ON Partido.idRecinto = Recinto.idRecinto
			JOIN Usuario ON Partido.idOrganizador = Usuario.idUsuario
			WHERE Partido.estado=4
			AND Partido.idOrganizador = '".$idUsuario."'");
		$consulta->execute();
		$resultado=$consulta->fetchAll();
		return $resultado;
	}


	public function getPartidosOrganizador($idUsuario){
		$consulta = $this->db->prepare(
			"SELECT 
			Usuario.nombre as nombreCap, 
			Usuario.apellido as apellidoCap, 
			Partido.idPartido, 
			Partido.estado,
			DATE_FORMAT(Partido.fecha,'%d-%m-%Y') as fechaPartido, 
			DATE_FORMAT(Partido.hora,'%l:%i %p') as horaPartido,
			Recinto.nombre 
			FROM Partido 
			JOIN Recinto ON Partido.idRecinto = Recinto.idRecinto
			JOIN Usuario ON Partido.idOrganizador = Usuario.idUsuario
			WHERE Partido.idOrganizador = '".$idUsuario."'
			AND Partido.estado != 2 AND Partido.estado !=3 ");
		$consulta->execute();
		$resultado=$consulta->fetchAll();
		return $resultado;
	}


	public function getPartidosSistema($idUsuario){
		$consulta = $this->db->prepare(
			"SELECT DISTINCT 
			Usuario.nombre as nombreCap, 
			Usuario.apellido as apellidoCap,
			Partido.idPartido as idPartido1, 
			DATE_FORMAT(Partido.fecha,'%d-%m-%Y') as fechaPartido, 
			DATE_FORMAT(Partido.hora,'%l:%i %p') as horaPartido,
			Recinto.nombre,
            (SELECT SolicitudParticipacion.estado FROM SolicitudParticipacion 
            LEFT OUTER JOIN Usuario ON Usuario.idUsuario = SolicitudParticipacion.idUsuarioSolicitante
            WHERE Usuario.idUsuario = '".$idUsuario."' AND SolicitudParticipacion.idPartido = idPartido1) as estadoSolicitud
			FROM Partido 
			JOIN Recinto ON Partido.idRecinto = Recinto.idRecinto
			JOIN Usuario ON Partido.idOrganizador = Usuario.idUsuario
			WHERE Partido.estado=5 AND Partido.idOrganizador != '".$idUsuario."'
			");
		$consulta->execute();
		$resultado=$consulta->fetchAll();
		return $resultado;
	}

	public function getResumenPartido($idPartido){
		$sql = "SELECT 
		Partido.idPartido,
		Partido.fecha,
		Partido.hora,
		Partido.cuota,
		Partido.tipo, 
		Partido.estado,
		Partido.idRecinto,
		Recinto.nombre,
		Recinto.fotografia,
		Usuario.nombre as nombreCap,
		Usuario.apellido as apellidoCap
		FROM Partido
		JOIN Recinto ON Partido.idRecinto = Recinto.idRecinto
		JOIN Usuario ON Partido.idOrganizador = Usuario.idUsuario
		WHERE idPartido = '".$idPartido."';";
		$consulta = $this->db->prepare($sql);
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;		
	}


	public function eliminarJugadoresPartido($idPartido){
		$sql = "DELETE FROM JugadoresPartido WHERE idPartido = '".$idPartido."';";
		$query = $this->db->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	public function cambiarEstado($idPartido, $estado){
		$sql = "UPDATE Partido SET estado = '".$estado."' WHERE idPartido = '".$idPartido."' ;";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	public function agregarSolicitud($idUsuario, $idPartido, $estadoSolicitud, $tipoSolicitud){
		$sql = 
		"INSERT INTO SolicitudParticipacion (idUsuarioSolicitante, idPartido, estado, tipo) 
		VALUES ('".$idUsuario."','".$idPartido."','".$estadoSolicitud."','".$tipoSolicitud."');
		";
		$query = $this->db->prepare($sql);
		$query->execute();
	}


	public function obtenerSolicitudes($idPartido){
		$sql = "SELECT 
		Usuario.idUsuario, 
		Usuario.nombre,
		Usuario.apellido,
		Usuario.fechaNacimiento,
		Usuario.telefono,
		SolicitudParticipacion.estado
		FROM Usuario
		JOIN SolicitudParticipacion ON Usuario.idUsuario = SolicitudParticipacion.idUsuarioSolicitante
		WHERE SolicitudParticipacion.idPartido = '".$idPartido."' 
		AND SolicitudParticipacion.estado != 3 ;";
		$consulta = $this->db->prepare($sql);
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;	
	}

	public function cambiarEstadoSolicitud($idPartido, $idUsuario, $respuesta){
		$sql = "UPDATE SolicitudParticipacion SET estado = '".$respuesta."' 
		WHERE idPartido = '".$idPartido."' AND idUsuarioSolicitante = '".$idUsuario."' ;";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	public function agregarJugador($idPartido, $idUsuario, $estado){
		$sql = 
		"INSERT INTO JugadoresPartido (idPartido, idUsuario, estado) 
		VALUES ('".$idPartido."','".$idUsuario."','".$estado."');
		";
		$query = $this->db->prepare($sql);
		$query->execute();
	}


}
?>