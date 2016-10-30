
<?php

class Equipo{

	protected $db;

	public function __construct(){
		$this->db = SPDO::singleton();
	}

	// Set Equipo: Nuevo Equipo (puntuacion = partidosDisputados = partidosCancelados = 0) - MODULO CREAR EQUIPO
	public function setEquipo($nombre, $color, $idCapitan){
		$sql = "INSERT INTO Equipo (nombre, puntuacion, color, partidosDisputados, partidosCancelados, idCapitan) 
				VALUES ('$nombre', 0, '$color', 0, 0, '$idCapitan');";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	// Obtener un determinado equipo.
	public function getEquipo($idEquipo){
		$query = $this->db->prepare("SELECT * FROM Equipo WHERE idEquipo = '".$idEquipo."'");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	// Actualizar información de un determinado equipo.
	public function updateEquipo($idEquipo,$nombre,$color){
		$sql = "UPDATE Equipo SET nombre = '".$nombre."' , color = '".$color."' WHERE idEquipo = '".$idEquipo."' ";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	

	// Obtener equipos de un usuario. (Como Capitán) - MODULO LISTAR EQUIPOS
	public function getEquiposJugador($idUsuario){
		$query = $this->db->prepare("SELECT * FROM Equipo WHERE Equipo.idCapitan = '".$idUsuario."'");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}



	// Obtener equipos
	public function getEquipos(){
		$query = $this->db->prepare("SELECT * FROM Equipo");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	// Obtener equipos de un usuario (Como Miembro, por lo tanto se revisa la tabla 'MiembrosEquipo'). MODULO LISTAR EQUIPOS
	public function getEquiposMiembro($idUsuario){
		$query = $this->db->prepare("SELECT * FROM Equipo INNER JOIN MiembrosEquipo ON Equipo.idEquipo = MiembrosEquipo.idEquipo 
			WHERE MiembrosEquipo.idUsuario = '".$idUsuario."' AND Equipo.idCapitan != '".$idUsuario."' ");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	// Obtener miembros de un determinado equipo. - MODULO MODIFICAR EQUIPO
	public function getMiembrosEquipo($idEquipo){
		$query = $this->db->prepare("SELECT Usuario.idUsuario, Usuario.nombre, Usuario.apellido, Usuario.fotografia, Usuario.fechaNacimiento FROM Usuario INNER JOIN MiembrosEquipo ON Usuario.idUsuario = MiembrosEquipo.idUsuario WHERE MiembrosEquipo.idEquipo = '".$idEquipo."'");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	// Obtener posibles jugadores para un equipo (contactos de un usuario que no esten en un determinado equipo) - MODULO CREAR EQUIPO
	public function getContactosEquipo($idUsuario, $idEquipo){
		$query = $this->db->prepare("SELECT Usuario.idUsuario, Usuario.nombre, Usuario.apellido, Usuario.Fotografia FROM Usuario JOIN Contacto ON Usuario.idUsuario = Contacto.idContacto 
									WHERE Contacto.idUsuario = '".$idUsuario."' AND Usuario.idUsuario NOT IN 
									(SELECT Usuario.idUsuario FROM Usuario JOIN MiembrosEquipo ON Usuario.idUsuario = MiembrosEquipo.idUsuario 
										WHERE miembrosequipo.idEquipo = '".$idEquipo."' )");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	//	Verificar existencia de un miembro en un determinado equipo.
	public function verificarMiembro($idUsuario, $idEquipo){
		$query = $this->db->prepare("SELECT * FROM MiembrosEquipo WHERE idUsuario = '".$idUsuario."' AND idEquipo = '".$idEquipo."'");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;

	}

	//	Agregar miembro a un determinado equipo.
	public function agregarMiembroEquipo($idUsuario, $idEquipo){
		$query = $this->db->prepare("INSERT INTO MiembrosEquipo (idUsuario, idEquipo) VALUES ('$idUsuario','$idEquipo');");
		$query->execute();
	}






}


?>