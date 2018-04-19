<?php 
require_once __DIR__ . '/../../../config/config.php';
if(!isset($_POST['accion'])){
	$accion ="";
}else{
	$accion = $_POST['accion'];
}
switch ($accion) {

	case 'consultarServicio': consultarServicios();
	break;

	case 'eliminarServicio': eliminarServicios();
	break;

	case 'insertarServicio': insertarServicios();
	break;

	case 'individualServicio' : individualServicios();
	break;

	case 'editarServicio' : editarServicios();
	break;
}

function consultarServicios(){
	global $db;
	$servicios = $db->select("servicios","*");
	echo json_encode($servicios);
}
function eliminarServicios(){
	global $db;
	extract($_POST);
	$servicios = $db->select("servicios",["id_ser" => $servicio]);
	echo "Se ha eliminado el servicio correctamente";
}
function insertarServicios(){
	global $db;
	extract($_POST);
	$db->insert("servicios",[
		"suc_ser" => $sucursales,
		"exp_ser" => $exp,
		"cl_ser" => $clientes,
		"emp_ser" => $emp
	]);
	$servicio = $db->id();
	echo "Se ha registrado correctamente el servicio con ID ".$servicio;
}
function editarServicios(){
	global $db;
	print_r($_POST);
	extract($_POST);
	$db->update("servicios",[
		"suc_ser" => $sucursales,
		"exp_ser" => $exp,
		"cl_ser" => $clientes,
		"emp_ser" => $emp
	], ["id_ser" => $id]);
	echo "Se ha actualizado correctamente el servicio con ID ".$id;
}
function individualServicios(){
	global $db;
	extract($_POST);
	$servicios = $db->get("servicios","*",["id_ser" => $id]);
	echo json_encode($servicios);
}
?>