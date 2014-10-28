<?php
require 'conexion.php';

$db = new db;
$db->abrir();
$feed = $db->consulta("SELECT * FROM feedback");

$return["json"] = json_encode($feed);
echo json_encode($return);

?>