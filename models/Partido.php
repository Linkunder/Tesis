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
		$consulta = $this->db->prepare("SELECT JugadoresPartido.idPartido, Partido.idRecinto FROM JugadoresPartido INNER JOIN Partido on Jugadorespartido.idPartido = Partido.idPartido WHERE Partido.estado = 2 AND JugadoresPartido.idUsuario = '$idUsuario'");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function setJugadoresPartidoPropio($idPartido, $idUsuario, $equipo, $color){
		$consulta = $this->db->prepare("
			INSERT INTO JugadoresPartido (
				idPartido, idUsuario, equipo, color1) 
				VALUES
				('$idPartido',
				'$idUsuario',
				'$equipo',
				'$color'
				);
			");
		$consulta->execute();
	}

	public function setJugadoresRevuelta($idPartido, $idUsuario, $color, $color2){
		$consulta = $this->db->prepare("
			INSERT INTO JugadoresPartido (
				idPartido, idUsuario, color1, color2) 
				VALUES
				('$idPartido',
				'$idUsuario',
				'$color',
				'$color2'
				);
			");
		$consulta->execute();
	}
	public function setPartido($idOrganizador,$fecha, $hora, $cuota, $tipo, $estado, $idRecinto){
		$consulta= $this->db->prepare("
			INSERT INTO Partido (
				idOrganizador,
				fecha,
				hora,
				cuota,
				tipo,
				estado,
				idRecinto)
			VALUES(
				'$idOrganizador',
				'$fecha',
				'$hora',
				'$cuota',
				'$tipo',
				'$estado',
				'$idRecinto'
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
			 Usuario.mail 
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

	public function setPartidoDesafio($idOrganizador,$fecha, $hora, $cuota, $tipo, $estado, $idRecinto){
		$consulta= $this->db->prepare(
			"INSERT INTO Partido (
				idOrganizador,
				fecha,
				hora,
				cuota,
				tipo,
				estado,
				idRecinto)
			VALUES(
				'$idOrganizador',
				(STR_TO_DATE('".$fecha."', '%d-%m-%Y')),
				'$hora',
				'$cuota',
				'$tipo',
				'$estado',
				'$idRecinto'
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
			"SELECT *
			FROM Partido
			JOIN Recinto ON Partido.idRecinto = Recinto.idRecinto
			WHERE Partido.estado=4
			AND Partido.idOrganizador = '".$idUsuario."'");
		$consulta->execute();
		$resultado=$consulta->fetchAll();
		return $resultado;
	}

	public function getPartidosSistema($idUsuario){
		$consulta = $this->db->prepare(
			"SELECT Partido.idPartido, Partido.fecha, Partido.hora, Recinto.nombre 
			FROM Partido 
			JOIN Recinto ON Partido.idRecinto = Recinto.idRecinto
			WHERE Partido.estado=5 AND Partido.idOrganizador != '".$idUsuario."' and Partido.idPartido in 
			(SELECT JugadoresPartido.idPartido from JugadoresPartido where JugadoresPartido.idUsuario != '".$idUsuario."')");
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
		Recinto.fotografia
		FROM Partido
		JOIN Recinto ON Partido.idRecinto = Recinto.idRecinto
		WHERE idPartido = '".$idPartido."';
		";
		$consulta = $this->db->prepare($sql);
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;		
	}







}
?>