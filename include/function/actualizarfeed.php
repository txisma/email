<?PHP 
//importo las librerias necesaria
require 'conexion.php';

//Creo un objeto de tipo db y abro conexion con la BBDD
$db = new db;
$db->abrir();

//Defino una variable estatica con el nombre de la tabla
	$tbl= simplexml_load_file(__DIR__.'/xml.xml');
	
	//Realizo la consulta a la tabla
	$tbl = $db->consulta("SELECT * FROM tablas WHERE id = ".$tbl->id);
	//Y guardo el nombre de la tabla en una variable estatica
	define("NOMTABLA", $tbl[0]['nombreTabla']);

//Creo la sql con la que se va a actuializa
$sql = 'UPDATE '.NOMTABLA.' SET corregido = true WHERE id = '.$_POST['id'];

//Ejecuto la sentencia
$res = $db->sql($sql);

//Devuelvo el resultado
print_r($res);

//Cierro la conexion
$db->cerrar();
?>