<?php 
	
	$nombre = $_FILES["imagen"]["name"];
	$temporal = $_FILES["imagen"]["tmp_name"];
	$ruta = "../img/subida/";
	$absoluta = $ruta.$nombre;
	
	if(move_uploaded_file($temporal,$absoluta)){
		echo "carga exitosa";
	}else{
		echo "algo fallo";
	}
 ?>