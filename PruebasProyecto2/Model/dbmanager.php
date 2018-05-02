<?php
require_once("../Model/conexion.php");
require_once("../Model/objects/Usuario.php");
require_once("../Model/objects/Mensaje.php");
class DbManager{
	public static function getConnection(){
		$inst = Conexion::getInstance();
		return $inst->getConnection();
	}


	public static function authnUser($userName, $pass){
		$connection = self::getConnection();
		$sql = "SELECT * FROM Usuario WHERE NickName = '".$userName."' AND Password = '".$pass."'";
		$result = $connection->query($sql);
		$usuario;
		if($result){
			$row = $result->fetch_array();
			$usuario = new Usuario($row);
		}
		return $usuario;
	}
	public static function getUser($codUsr){
		$connection = self::getConnection();
		$sql = "SELECT * FROM Usuario WHERE codUsuario = ".$codUsr;
		$result = $connection->query($sql);
		$usuario;
		if($result){
			$row = $result->fetch_array();
			$usuario = new Usuario($row);
		}
		return $usuario;
	}

	public static function insertUser($name, $lastName, $nickName, $email, $password){
		$connection = self::getConnection();
		$sql = "INSERT INTO Usuario (Nombre, Apellidos, NickName, Email, Password)";
		$sql .= "VALUES ('".$name."', '".$lastName."', '".$nickName."', '".$email."', '".$password."')";
		$result = $connection->query($sql);
		if($result){
			return true;
		}
		return false;
	}

	public static function deleteUser($codUsr){
		$connection = self::getConnection();
		$sql = "DELETE FROM Usuario WHERE CodUsuario = ".$codUsr;
		$result = $connection->query($sql);
		if($result){
			return true;
		}
		return false;
	}
	public static function insertMsg($codEmisor, $codReceptor, $asunto, $mensaje){
		$connection = self::getConnection();
		$sql = "INSERT INTO Mensajes (CodEmisor, CodReceptor, Asunto, Mensaje)";
		$sql .= "VALUES ('".$codEmisor."', '".$codReceptor."', '".$asunto."', '".$mensaje."')";
		$result = $connection->query($sql);
		if($result){
			return true;
		}
		return false;
	}
	public static function numMsg($codReceptor){
		$connection =  self::getConnection();
		$sql = "SELECT * FROM Mensajes where CodReceptor = " . $codReceptor; 
		$result = $connection->query($sql);	

		if($result){
			return $result->num_rows;
		}
		return 0;
	}
	public static function getMsgByReceptor($codReceptor){
		$connection =  self::getConnection();
		$sql = "SELECT * FROM Mensajes WHERE CodReceptor = ".$codReceptor." ORDER BY Estado ASC, fecha DESC";
		$result = $connection->query($sql);
		$mensajes = array();
		if($result){
			while($row = $result->fetch_array()){
				$mensajes[] = new Msg($row);
			}
		}
		return $mensajes;
	}

}

?>