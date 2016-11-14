<?php
class Local{
	protected $db;
	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getLocales(){
		$consulta = $this->db->prepare('SELECT * FROM Local');
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function getLocal($idLocal){
		$consulta = $this->db->prepare("
			SELECT * FROM Loca WHERE idLocal = '$idLocal';
			");
		$consulta->execute();
		$resultado=$consulta->fetchAll();
		return $resultado;
	}


}
?>