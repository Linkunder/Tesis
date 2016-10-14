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
	//`idRecinto`, `nombre`, `tipo`, `superficie`, `direccion`, `numeroCanchas`, `telefono`, `fotografia`, `puntuacion`, `estado`, `idUsuario
	public function setSolicitud($nombre, $fono, $direccion, $idUsuario){
		$consulta = $this->db->prepare(
			"INSERT INTO Recinto (
				nombre,
				direccion,
				telefono,
				estado,
				idUsuario) 
				 VALUES (
				'$nombre',
				'$direccion',
				'$fono',
				'2',
				'$idUsuario'
				)");
		$consulta->execute();
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