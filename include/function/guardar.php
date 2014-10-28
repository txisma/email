<?PHP 
require 'conexion.php';

$db = new db;
$db->abrir();

$ip = $_SERVER['REMOTE_ADDR'];
$user = $_POST['nombre'];
$msg = $_POST['mensaje'];
$corregido = false;

$sql = 'INSERT INTO feedback(ip, usuario, feed, corregido) VALUES("'.$ip.'","'.$user.'","'.$msg.'","'.$corregido.'")';

$res = $db->sql($sql);

print_r($res);

?>