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

	public function setJugadoresPartido($idPartido, $idUsuario, $equipo){
		$consulta = $this->db->prepare("
			INSERT INTO JugadoresPartido (
				idPartido, idUsuario, equipo) 
				VALUES
				('$idPartido',
				'$idUsuario',
				'$equipo');
			");
		$consulta->execute();
	}
	public function setPartidoEquipoPropio($idOrganizador,$fecha, $hora, $cuota, $tipo, $estado, $idRecinto){
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







}
?>