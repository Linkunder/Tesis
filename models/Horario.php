<?php
class Horario{
	protected $db;
	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getHorariosRecinto($idRecinto){
		$consulta = $this->db->prepare("
			SELECT * FROM horario WHERE idRecinto = '$idRecinto';
			");
		$consulta->execute();
		$resultado	=	$consulta->fetchAll();
		return $resultado;
	}

	public function setHorarioRecinto(){
	}

}
?>