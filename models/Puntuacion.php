<?php
class Puntuacion{

	protected $db;
	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getPuntuaciones(){
		$consulta = $this->db->prepare(
			'SELECT * FROM Puntuacion'
			);
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function getPuntuacionRecinto($idRecinto){

		$consulta = $this->db->prepare(
			'SELECT * FROM Puntuacion WHERE idRecinto = $idRecinto';
			);
		$consulta->execute;
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function setPuntuacion($idRecinto,$idUsuario,$valoracion){
		$consulta = $this->db->prepare('INSERT INTO Puntuacion (
				idRecinto,
				idUsuario,
				valoracion
			) VALUES(
				"'.$idRecinto.'",
				"'.$idUsuario.'",
				"'.$valoracion.'"
			)');
	}
}

?>