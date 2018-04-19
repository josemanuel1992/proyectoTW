<?php 
require_once("_db.php");
if(!isset($_POST['accion'])){
	$accion ="";
}else{
	$accion = $_POST['accion'];
}
switch ($accion) {
	case 'eliminarUsuario': eliminarUsuarios();
	break;

	case 'insertarUsuario': insertarUsuarios();
	break;

	case 'consultarUsuario': consultarUsuarios();
	break;

	case 'individualUsuario': individualUsuarios();
	break;

	case 'editarUsuario': editarUsuarios();
	break;

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
function insertarUsuarios(){
	global $db;
	extract($_POST);
	$db->insert("usuarios",[
		"nombre_usr" => $nombre,
		"correo_usr" => $correo,
		"telefono_usr" => $telefono,
		"password_usr" => $password
	]);
	$usuario = $db->id();
	echo "Se ha registrado correctamente el usuario ".$nombre." con el ID ".$usuario;
}
function consultarUsuarios(){
	global $db;
	$usuarios = $db->select("usuarios","*");
	echo json_encode($usuarios);
}
function eliminarUsuarios(){
	global $db;
	extract($_POST);
	$usuarios = $db->delete("usuarios",["id_usr" => $usuario]);
	echo "Se ha eliminado el usuario correctamente";	
}
function individualUsuarios(){
	global $db;
	extract($_POST);
	$usuarios = $db->get("usuarios","*",["id_usr" => $id]);
	echo json_encode($usuarios);
}
function editarUsuarios(){
	global $db;
	//print_r($_POST);
	extract($_POST);
	$db->update("usuarios",[
		"nombre_usr" => $nombre,
		"correo_usr" => $correo,
		"telefono_usr" => $telefono,
		"password_usr" => $password], ["id_usr" => $id]);
	echo "Se ha actualizado correctamente el usuario con el ID ".$id;
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