$("#newMsg").click(function(evt){
	evt.preventDefault();
	$("cuerpo").load("./Controller/MsgController.php",{"sesion" : sesion, "metodo": "nuevoMensaje"});
	return false;
});
$("#borrarMsg:not(.disabled)").click(function(evt){
	evt.preventDefault();
	console.log("ADIOS");
	$(".msgs").load("");
	return false;
});
