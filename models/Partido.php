<?php
class Partido{

	protected $db;
	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getPartidos(){

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
			SELECT LAST_INSERT_ID();
				");
		$consulta->execute();
		$resultado= $consulta->fetchAll();

		return $resultado;
	}




}
?>