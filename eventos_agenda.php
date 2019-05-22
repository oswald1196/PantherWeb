<?php
header('Content-type: application/json');

require_once 'conexion.php';

$sql = "SELECT * FROM TranCalendario";

$consulta=$conn->query($sql);

?>