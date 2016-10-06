<?php
class Puntuacion{

	protected $db;
	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getPuntuaciones($idUsuario){
		$consulta = $this->db->prepare(
			"SELECT puntuacion.idRecinto, puntuacion.idUsuario, puntuacion.valoracion FROM puntuacion INNER JOIN usuario ON puntuacion.idUsuario = usuario.idUsuario WHERE puntuacion.idUsuario = $idUsuario "
			);
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}


	public function getPuntuacionRecinto($idRecinto){

		$consulta = $this->db->prepare(
			'SELECT * FROM Puntuacion WHERE idRecinto = $idRecinto'
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