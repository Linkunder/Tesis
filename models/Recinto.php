<?php
class Recinto{

	protected $db;
	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getRecintos(){
		$consulta = $this->db->prepare('SELECT * FROM Recinto');
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function getRecinto($idRecinto){
		$consulta = $this->db->prepare('
			SELECT * FROM Recinto WHERE idRecinto = $idRecinto ');
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;

	}
	public function setRecinto($nombre,$tipo,$superficie,$direccion,$numeroCanchas,$telefono,$fotografia,$puntuacion,$estado,$idUsuario){
		$consulta = $this->db->prepare("
			INSERT INTO Recinto (
				nombre,
				tipo,
				superficie,
				direccion,
				numeroCanchas,
				telefono,
				fotografia,
				puntuacion,
				estado,
				idUsuario) VALUES (
				'".$nombre."',
				'".$tipo."',
				'".$superficie."',
				'".$direccion."',
				'".$numeroCanchas."',
				'".$telefono."',
				'".$fotografia."',
				'".$puntuacion."',
				'".$estado."',
				'".$idUsuario."')");
		$consulta->execute();
	}

	public function updateRecinto($idRecinto,$nombre,$tipo,$superficie,$direccion,$numeroCanchas,$telefono,$fotografia,$puntuacion,$estado,$idUsuario){

		$consulta = $this->db->prepare(
			"UPDATE Recinto SET 
			nombre 		 = '$nombre',
			tipo 		 = '$tipo',
			superficie	 = '$superficie',
			direccion	 = '$direccion',
			numeroCanchas= '$numeroCanchas',
			telefono	 = '$telefono',
			fotografia	 = '$fotografia',
			puntuacion	 = '$puntuacion',
			estado	 	 = '$estado',
			idUsuario	 = '$idUsuario'");
		
		$consulta->execute();
	}
}
?>