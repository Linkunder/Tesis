<?php
class Horario{
	protected $db;
	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getHorariosRecinto($idRecinto){
		$consulta = $this->db->prepare("
			SELECT idHorario, DATE_FORMAT(horaInicio,'%l:%i %p') as horaInicio, DATE_FORMAT(horaFin,'%l:%i %p') as horaFin,nombre, dias, precio, idRecinto FROM Horario WHERE idRecinto = '$idRecinto';
			");
		$consulta->execute();
		$resultado	=	$consulta->fetchAll();
		return $resultado;
	}

	public function getHorario($idHorario){
		$consulta = $this->db->prepare("SELECT * FROM Horario WHERE idHorario = '$idHorario' ;");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function setHorarioRecinto(){
	}

}
?>