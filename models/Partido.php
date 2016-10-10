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


}
?>