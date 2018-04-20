<?php 
require_once("_db.php");
if(!isset($_POST['accion'])){
	$accion ="";
}else{
	$accion = $_POST['accion'];
}
switch ($accion) {
	case 'eliminarContactanos': eliminarContactanos();
	break;
	
	case 'insertar' : insertar();
	break;

	case 'consultar' : consultarContactanos();
	break;

	case 'individual' : individual();
	break;

	case 'editar' : editar();
	break;

	default:
		# code...
	break;
}
function editar(){
	global $db;
	print_r($_POST);
	extract($_POST);
	$db->update("contactanos",[
		"nombre" => $nombre,
		"telefono" => $telefono,
		"correo" => $correo,
		"comentario" => $comentario
	], ["id_nombre" => $id]);
	
	echo "Se ha actualizado correctamente el usuario con ID ".$id;
}
function insertar(){
	global $db;
	extract($_POST);
	$db->insert("contactanos",[
		"nombre" => $nombre,
		"telefono" => $telefono,
		"correo" => $correo,
		"comentario" => $comentario,
	]);
	$contactanos = $db->id();
	echo "Se ha registrado correctamente el usuario con ID ".$contactanos;
}
function consultarContactanos(){
	global $db;
	$contactanos = $db->select("contactanos","*");
	echo json_encode($contactanos);
}
function individual(){
	global $db;
	extract($_POST);
	$contactanos = $db->get("contactanos","*",[
		"id_nombre" => $id
	]);
	echo json_encode($contactanos);
}
function eliminarContactanos(){
	global $db;
	extract($_POST);
	$contactanos = $db->delete("contactanos",["id_nombre" => $contactanos]);
	echo "Se ha eliminado el usuario correctamente";	
}
?>