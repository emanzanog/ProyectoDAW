<?php
class MsgView{
	private function __construct(){
	}
	public static function generaCabecera($numMsg){
		$cabecera = '<nav class="navbar navbar-light bg-light">'.
					'<div>'.
					'<a href="#" title="Nuevo Mensaje" id="newMsg" class="btn btn-outline-primary"><i class="far fa-plus-square"></i> Nuevo Mensaje</a>'.
					'<a href="#" title="Borrar Mensajes" id="borrarMsg" class="btn btn-outline-danger';  

		if($numMsg <=0){ 
			$cabecera .= ' disabled';
		}
		$cabecera .= '"><i class="far fa-trash-alt"></i> Borrar Mensajes</a></div></nav>';
		$cabecera .='<script type="text/javascript" src = "./utils/botonesCabeceraMsg.js"></script>';
		return $cabecera;
	}

	public static function creaMensaje($mensaje,$emisor,$receptor){
		$return = "<div class='container";
		 $return .=($mensaje->getEstado()=='NUEVO'? " nuevo" : "");
		$return .= "'><div class='card'>";
		$return .= "<div class='card-header'>De: ".$emisor->getNickName()." - Para: ".$receptor->getNickName()."</div>";
		$return .= "<div class='card-body'>";
		$return .= "<div class='card-title'>Asunto: ".$mensaje->getAsunto()."</div>";
		$return .= "<div class='card-text'>".$mensaje->getMensaje()."</div>";
		$return .= "<div class='card-footer text-muted'>".$mensaje->getFecha()."</div>";
		$return.= "</div></div></div>";
		
		return $return;
	}

	public static function nuevoMensaje(){
		$total = '<div class="container">';
		$total .= '<form id="formMsg">';
		$total .= '<div class="form-group">';
		$total .= '<label for="destinatario">Para: </label>';
		$total .= '<input type="text" class="form-control" id="destinatario" name="usrRecep"/>';
		$total .= '</div>';
		$total .= '<div class="form-group">';
		$total .= '<label for="asunto">Asunto: </label>';
		$total .= '<input type="text" class="form-control" id="asunto" name="asunto" />';
		$total .= '</div>';
		$total .= '<div class="form-group">';
		$total .= '<label for="mensaje">Mensaje: </label>';
		$total .= '<textarea class="form-control" id="mensaje" rows="3" name="mensaje"></textarea>';
		$total .= '</div>';
		$total .= '<button type="submit" class="btn btn-outline-primary" id="enviar">Enviar</button>';
		$total .= '</form>';
		$total .= '</div>';
		$total .= '<script type="text/javascript" src="./utils/sanitizeInputs.js"></script>';
		return $total;

	}

}
?>