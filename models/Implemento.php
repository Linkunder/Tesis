<?php
class Implemento{

	protected $db;
	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getImplementosRecinto($idRecinto){
		$consulta = $this->db->prepare("
			SELECT * FROM Implemento WHERE idRecinto = '$idRecinto';
			");
		$consulta->execute();
		$resultado= $consuulta->fetchAll();
		return $resultado;
	}

	public function getImplementos(){

	}
	public function setImplemento(){
	}

	public function deleteImplemento(){
	}


}


?>