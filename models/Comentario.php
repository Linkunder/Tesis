<?php
class Comentario{

	protected $db;
	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getComentariosRecinto($idRecinto){
		$consulta = $this->db->prepare('
			SELECT * FROM Comentario WHERE idRecinto = $idRecinto
		');
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function getComentarios(){
		$consulta = $this->db->prepare('
			SELECT * FROM Comentario
		');
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function setComentario($idRecinto, $idUsuario, $contenido){

		$consulta = $this->db->prepare('
			INSERT INTO Comentario (
				idRecinto,
				idUsuario,
				contenido,
				fecha,
				hora
				)VALUES(
				$idRecinto,
				$idUsuario,
				$contenido,
				CURRENT_DATE,
				CURRENT_TIME
				) 
			');
		$consulta->execute();

	}

	public function deleteComentario($idRecinto, $idUsuario){
		$consulta = $this->db->prepare('
			DELETE FROM Comentario WHERE idRecinto = $idRecinto AND idUsuario = $idUsuario
			');
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}



}
?>