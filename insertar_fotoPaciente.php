<?php

	//RECIBIMOS DATOS DE IMAGEN
	
	ini_set('display_errors',1); error_reporting(E_ALL); 

	$nombre_imagen = $_FILES['imagen']['name'];
	$tipo_imagen = $_FILES['imagen']['type'];
	$tamano_imagen = $_FILES['imagen']['size'];

	if($tamano_imagen <= 1000000){
		if($tipo_imagen == "image/jpeg" || $tipo_imagen == "image/jpg" || $tipo_imagen == "image/png"){
	//RUTA DE LA CARPETA DESTINO EN SERVIDOR
	$archivo_temporal = $_FILES['imagen']['tmp_name'];

	$carpeta_destino = $_SERVER['DOCUMENT_ROOT'].'/uploads';

	//MOVEMOS LA IMAGEN DE DIRECTORIO TEMPORAL AL DIRECTORIO ESCOGIDO
	$moved = move_uploaded_file($archivo_temporal,$carpeta_destino.$nombre_imagen);
	}
	else {
		echo "Solo se permiten png,jpg o jpeg";
	}
}
	else {
		echo "El tamaño es demasiado grande";
	}

?>