<?php
include('conexion.php');

	$horaInicio = $_POST['horaInicio'];

	$html = "";

	if ($horaInicio >= "08:00" && $horaInicio < "08:30"){
     	$matrizIni = '1';
    } else if($horaInicio >= "08:30" && $horaInicio < "09:00"){
     	$matrizIni = '2';
     }	else if($horaInicio >= "09:00" && $horaInicio < "09:30"){
     	$matrizIni = '3';
     }	else if($horaInicio >= "09:30" && $horaInicio < "10:00"){
     	$matrizIni = '4';
     }	else if($horaInicio >= "10:00" && $horaInicio < "10:30"){
     	$matrizIni = '5';
     }	else if($horaInicio >= "10:30" && $horaInicio < "11:00"){
     	$matrizIni = '6';
     }	else if($horaInicio >= "11:00" && $horaInicio < "11:30"){
     	$matrizIni = '7';
     }	else if($horaInicio >= "11:30" && $horaInicio < "12:00"){
     	$matrizIni = '8';
     }	else if($horaInicio >= "12:00" && $horaInicio < "12:30"){
     	$matrizIni = '9';
     }	else if($horaInicio >= "12:30" && $horaInicio < "13:00"){
     	$matrizIni = '10';
     }	else if($horaInicio >= "13:00" && $horaInicio < "13:30"){
     	$matrizIni = '11';
     }	else if($horaInicio >= "13:30" && $horaInicio < "14:00"){
     	$matrizIni = '12';
     }	else if($horaInicio >= "14:00" && $horaInicio < "14:30"){
     	$matrizIni = '13';
     }	else if($horaInicio >= "14:30" && $horaInicio < "15:00"){
     	$matrizIni = '14';
     }	else if($horaInicio >= "15:00" && $horaInicio < "15:30"){
     	$matrizIni = '15';
     }	else if($horaInicio >= "15:30" && $horaInicio < "16:00"){
     	$matrizIni = '16';
     }	else if($horaInicio >= "16:00" && $horaInicio < "16:30"){
     	$matrizIni = '17';
     }	else if($horaInicio >= "16:30" && $horaInicio < "17:00"){
     	$matrizIni = '18';
     }	else if($horaInicio >= "17:00" && $horaInicio < "17:30"){
     	$matrizIni = '19';
     }	else if($horaInicio >= "17:30" && $horaInicio < "18:00"){
     	$matrizIni = '20';
     }	else if($horaInicio >= "18:00" && $horaInicio < "18:30"){
     	$matrizIni = '21';
     }	else if($horaInicio >= "18:30" && $horaInicio < "19:00"){
     	$matrizIni = '22';
     }	else if($horaInicio >= "19:00" && $horaInicio < "19:30"){
     	$matrizIni = '23';
     }	else if($horaInicio >= "19:30" && $horaInicio < "20:00"){
     	$matrizIni = '24';
     }	else if($horaInicio >= "20:00" && $horaInicio < "20:30"){
     	$matrizIni = '25';
     }	else if($horaInicio >= "20:30" && $horaInicio < "21:00"){
     	$matrizIni = '26';
     }	
     else {
     	$matrizIni = '27';
     }
	
	$html .= "".$matrizIni."";
	
	echo $html;
?>