<?php

require_once("../Model/dbmanager.php");
require_once("../view/msg/msgView.php");

class MsgController{

	public function __construct($metodo){
		$this->generaCabecera();
		$this->$metodo();
	}
	public function generaCabecera(){
		if(isset($_POST['sesion']) || isset($_SESISON['sesion'])){
			$sesion = $_POST['sesion'];
			$numMsg = DbManager::numMsg($sesion['codUsuario']);
			echo MsgView::generaCabecera($numMsg);
		}
	}

	public function generaMsg(){
		if(isset($_POST['sesion']) || isset($_SESISON['sesion'])){
			$sesion = $_POST['sesion'];
			$mensajes = DbManager::getMsgByReceptor($sesion['codUsuario']);
			$total = "";
			foreach($mensajes as $msg){
				$emisor = DbManager::getUser($msg->getCodEmisor());
				$receptor = DbManager::getUser($msg->getCodReceptor());
				$ahora = MsgView::creaMensaje($msg,$emisor,$receptor);
				$total .=$ahora;
			}
			echo $total;	
		}	

	}
	public function nuevoMsg(){
		if(isset($_POST['sesion']) || isset($_SESISON['sesion'])){
			$sesion = isset($_SESSION['sesion'])? $_SESSION['sesion'] : $_POST['sesion'];
			echo MsgView::nuevoMensaje();	
		}	

	}
	
}
if(isset($_POST['metodo'])){
	$msgController;
	switch($_POST['metodo']){
		case "creaPantalla":
			$msgController = new MsgController("generaMsg");
			break;
		case "nuevoMensaje":
			$msgController = new MsgController("nuevoMsg");
			break;	
		default:
			break;
	}
}


?>