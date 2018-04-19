<?php
require_once __DIR__ . '/../../../config/config.php';
if(!isset($_POST['accion'])){
    $accion ="";
}else{
    $accion = $_POST['accion'];
}
switch ($accion) {
    case 'eliminarTitulo': eliminarTitulos();
        break;

    case 'insertar' : insertarNosotros();
        break;

    case 'consultar' : consultarTitul();
        break;

    case 'individual': individualNos();
        break;

    case 'editar': editarNos();
        break;

    default:
        # code...
        break;
}

function editarNos(){
    global $db;
    print_r($_POST);
    extract($_POST);
    $db->update("nosotros",[
        "titulo_nosotrs" => $titulo,
        "subtitulo_nosotrs" => $subtitulo,
        "texto_nosotrs" => $texto
    ], ["id_nosotrs" => $id]);

    echo "Se ha actualizado correctamente el apartado con ID ".$id;
}
function insertarNosotros(){
    global $db;
    extract($_POST);
    $db->insert("nosotros",[
        "titulo_nosotrs" => $titulo,
        "subtitulo_nosotrs" => $subtitulo,
        "texto_nosotrs" => $texto,
        "imagen_nosotrs" => substr($imagenOculta, 12)
    ]);
    $titul = $db->id();
    echo "Se ha añadido correctamente el apartado ".$titul;
}
function consultarTitul(){
    global $db;
    $nosotros = $db->select("nosotros","*");
    echo json_encode($nosotros);
}
function individualNos(){
    global $db;
    extract($_POST);
    $nosotros = $db->get("nosotros","*", ["id_nosotrs"=> $id
    ]);
    echo json_encode($nosotros);
}
function eliminarTitulos(){
    global $db;
    extract($_POST);
    $nosotros = $db->delete("nosotros",["id_nosotrs" => $titul]);
    echo "Se ha eliminado el apartado";
}

?>