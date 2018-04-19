<?php 
require_once __DIR__ . '/../../../config/config.php';
if(!isset($_POST['accion'])){
	$accion ="";
}else{
	$accion = $_POST['accion'];
}
switch ($accion) {
	case 'eliminarPromo': eliminarPromos();
	break;
	
	case 'insertar' : insertar();
	break;

	case 'consultar' : consultarPromos();
	break;

	case 'individual' : individual();
	break;

	case 'editar' : editar();
	break;

	default:
		# code...
	break;
}

function eliminarPromos(){
	global $db;
	extract($_POST);
	$promos = $db->delete("promos",["id_pro" => $promo]);
	echo "Se ha eliminado la promo correctamente";	
}
function insertar(){
	print_r($_FILES);
	global $db;
	extract($_POST);
	$db->insert("promos",[
		"titulo_pro" => $titulo,
		"descripcion_pro" => $descripcion,
		"link_pro" => $link,
		"imagen_pro" => substr($imagenOculta, 12),
		"status_pro" => $status
	]);
	$promo = $db->id();
	echo "Se ha registrado correctamente la promo con ID ".$promo;
}
function consultarPromos(){
	global $db;
	$promos = $db->select("promos","*");
	echo json_encode($promos);
}
function individual(){
	global $db;
	extract($_POST);
	$promos = $db->get("promos","*",[
		"id_pro" => $id
	]);
	echo json_encode($promos);
}
function editar(){
	global $db;
	print_r($_POST);
	extract($_POST);
	$db->update("promos",[
		"titulo_pro" => $titulo,
		"descripcion_pro" => $descripcion,
		"link_pro" => $link,
		"imagen_pro" => substr($imagenOculta, 12),
		"status_pro" => $status
	], ["id_pro" => $id]);
	
	echo "Se ha actualizado correctamente la promo con ID ".$id;
}
?>
