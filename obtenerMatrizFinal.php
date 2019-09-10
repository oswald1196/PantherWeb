<?php
include('conexion.php');

	$horaFin = $_POST['horaFin'];

	$html = "";
	$matrizFin = "";

	if ($horaFin >= "08:00" && $horaFin < "08:30"){
     	$matrizFin = '1';
    } else if($horaFin >= "08:30" && $horaFin < "09:00"){
     	$matrizFin = '2';
     }	else if($horaFin >= "09:00" && $horaFin < "09:30"){
     	$matrizFin = '3';
     }	else if($horaFin >= "09:30" && $horaFin < "10:00"){
     	$matrizFin = '4';
     }	else if($horaFin >= "10:00" && $horaFin < "10:30"){
     	$matrizFin = '5';
     }	else if($horaFin >= "10:30" && $horaFin < "11:00"){
     	$matrizFin = '6';
     }	else if($horaFin >= "11:00" && $horaFin < "11:30"){
     	$matrizFin = '7';
     }	else if($horaFin >= "11:30" && $horaFin < "12:00"){
     	$matrizFin = '8';
     }	else if($horaFin >= "12:00" && $horaFin < "12:30"){
     	$matrizFin = '9';
     }	else if($horaFin >= "12:30" && $horaFin < "13:00"){
     	$matrizFin = '10';
     }	else if($horaFin >= "13:00" && $horaFin < "13:30"){
     	$matrizFin = '11';
     }	else if($horaFin >= "13:30" && $horaFin < "14:00"){
     	$matrizFin = '12';
     }	else if($horaFin >= "14:00" && $horaFin < "14:30"){
     	$matrizFin = '13';
     }	else if($horaFin >= "14:30" && $horaFin < "15:00"){
     	$matrizFin = '14';
     }	else if($horaFin >= "15:00" && $horaFin < "15:30"){
     	$matrizFin = '15';
     }	else if($horaFin >= "15:30" && $horaFin < "16:00"){
     	$matrizFin = '16';
     }	else if($horaFin >= "16:00" && $horaFin < "16:30"){
     	$matrizFin = '17';
     }	else if($horaFin >= "16:30" && $horaFin < "17:00"){
     	$matrizFin = '18';
     }	else if($horaFin >= "17:00" && $horaFin < "17:30"){
     	$matrizFin = '19';
     }	else if($horaFin >= "17:30" && $horaFin < "18:00"){
     	$matrizFin = '20';
     }	else if($horaFin >= "18:00" && $horaFin < "18:30"){
     	$matrizFin = '21';
     }	else if($horaFin >= "18:30" && $horaFin < "19:00"){
     	$matrizFin = '22';
     }	else if($horaFin >= "19:00" && $horaFin < "19:30"){
     	$matrizFin = '23';
     }	else if($horaFin >= "19:30" && $horaFin < "20:00"){
     	$matrizFin = '24';
     }	else if($horaFin >= "20:00" && $horaFin < "20:30"){
     	$matrizFin = '25';
     }	else if($horaFin >= "20:30" && $horaFin < "21:00"){
     	$matrizFin = '26';
     }	
     else {
     	$matrizFin = '27';
     }
	
	$html .= "".$matrizFin."";
	
	echo $html;
?>