<?PHP 
require 'conexion.php';

$db = new db;
$db->abrir();

$sql = 'UPDATE feedback SET corregido = true WHERE id = '.$_POST['id'];

$res = $db->sql($sql);

print_r($res);

?>