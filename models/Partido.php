<?php
class Partido{

	protected $db;
	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getPartidos(){

	}

	public function getPartido($idPartido){
		$consulta = $this->db->prepare("
			SELECT * FROM Partido WHERE idPartido = '$idPartido';
			");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;


	}

	public function getPartidosUsuario($idUsuario){
		$consulta = $this->db->prepare('
			SELECT jugadorespartido.idPartido, partido.idRecinto FROM jugadorespartido INNER JOIN usuario on jugadorespartido.idUsuario = usuario.idUsuario INNER JOIN partido on jugadorespartido.idPartido = partido.idPartido');
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function setJugadoresPartido($idPartido, $idUsuario, $equipo){
		$consulta = $this->db->prepare("
			INSERT INTO jugadorespartido (
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
				idRecinto,
				tercerTiempo)
			VALUES(
				'$idOrganizador',
				'$fecha',
				'$hora',
				'$cuota',
				'$tipo',
				'$estado',
				'$idRecinto',
				 0	
				);
			SELECT LAST_INSERT_ID() AS lastId;
				");
		$consulta->execute();
		$resultado= $this->db->lastInsertId();

		return $resultado;
	}

	public function getJugadoresPartido($idPartido){
		$consulta = $this->db->prepare("SELECT usuario.nombre, usuario.nickname, usuario.fotografia, usuario.email FROM jugadorespartido INNER JOIN usuario on jugadorespartido.idUsuario = usuario.idUsuario WHERE idPartido='$idPartido'");
		$consulta->execute();
		$resultado=$consulta->fetchAll();
		return $resultado;
	}




}
?>