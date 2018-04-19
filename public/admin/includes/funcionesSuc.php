<?php 
require_once __DIR__ . '/../../../config/config.php';
if(!isset($_POST['accion'])){
	$accion ="";
}else{
	$accion = $_POST['accion'];
}
switch ($accion) {
	case 'eliminarSucursal': eliminarSucursales();
	break;

	case 'insertarSucursal': insertarSucursales();
	break;

	case 'consultarSucursal': consultarSucursales();
	break;

	case 'individualSucursal': individualSucursales();
	break;

	case 'editarSucursal': editarSucursales();
	break;
}
function insertarSucursales(){
	global $db;
	extract($_POST);
	$db->insert("sucursales",[
		"ciudad_suc" => $ciudad,
		"telefono_suc" => $telefono,
	]);
	$sucursal = $db->id();
	echo "Se ha registrado correctamente la ciudad de ".$ciudad." con el ID ".$sucursal;
}
function consultarSucursales(){
	global $db;
	$sucursales = $db->select("sucursales","*");
	echo json_encode($sucursales);
}
function eliminarSucursales(){
	global $db;
	extract($_POST);
	$sucursales = $db->delete("sucursales",["id_suc" => $sucursal]);
	echo "Se ha eliminado la sucursal correctamente";	
}
function individualSucursales(){
	global $db;
	extract($_POST);
	$sucursales = $db->get("sucursales","*",["id_suc" => $id]);
	echo json_encode($sucursales);
}
function editarSucursales(){
	global $db;
	//print_r($_POST);
	extract($_POST);
	$db->update("sucursales",[
		"ciudad_suc" => $ciudad,
		"telefono_suc" => $telefono], ["id_suc" => $id]);
	echo "Se ha actualizado correctamente la sucursal con el ID ".$id;
}
?>
