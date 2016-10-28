
<?php

class MiembrosEquipo{

	protected $db;

	public function __construct(){
		$this->db = SPDO::singleton();
	}



	// Obtener miembros de un determinado equipo de un determinado capitan. 
	// Obtener equipos de un usuario. (Como Capitán) - 
	public function getMiembrosEquiposJugador($idUsuario){
		$query = $this->db->prepare("SELECT miembrosequipo.idUsuario, equipo.idEquipo, equipo.nombre from miembrosequipo join equipo on equipo.idequipo = miembrosequipo.idEquipo where miembrosequipo.idEquipo in (select idEquipo from equipo where idCapitan='".$idUsuario."')");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	// Obtener contactos que no estan en un determinado equipo
	public function getContactosNoMiembros($idEquipo, $idUsuario){
		$query = $this->db->prepare("SELECT * FROM contacto WHERE contacto.idUsuario='".$idUsuario."' AND contacto.idContacto NOT IN 
			(SELECT miembrosequipo.idUsuario FROM miembrosequipo WHERE idEquipo= '".$idEquipo."')");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	} 




}


?>