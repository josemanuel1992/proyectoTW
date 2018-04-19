<?php

require_once __DIR__ . '/../../../config/config.php';

if(!isset($_POST['accion'])){
    $accion ="";
}else{
    $accion = $_POST['accion'];
}

switch ($accion) {
    case 'eliminarUsuario': eliminarUsuarios();
        break;

    case 'insertar' : insertar();
        break;

    case 'consultar' : consultarUsuarios();
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
    $db->update("usuarios",[
        "nombre_usr" => $nombre,
        "correo_usr" => $correo,
        "telefono_usr" => $telefono,
        "password_usr" => $password
    ], ["id_usr" => $id]);

    echo "Se ha actualizado correctamente el usuario con ID ".$id;
}
function insertar(){
    global $db;
    extract($_POST);
    $db->insert("usuarios",[
        "nombre_usr" => $nombre,
        "correo_usr" => $correo,
        "telefono_usr" => $telefono,
        "password_usr" => $password
    ]);
    $usuario = $db->id();
    echo "Se ha registrado correctamente el usuario con ID ".$usuario;
}
function consultarUsuarios(){
    global $db;
    $usuarios = $db->select("usuarios","*");
    echo json_encode($usuarios);
}
function individual(){
    global $db;
    extract($_POST);
    $usuarios = $db->get("usuarios","*",[
        "id_usr" => $id
    ]);
    echo json_encode($usuarios);
}
function eliminarUsuarios(){
    global $db;
    extract($_POST);
    $usuarios = $db->delete("usuarios",["id_usr" => $usuario]);
    echo "Se ha eliminado el usuario correctamente";
}
?>