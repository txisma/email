<?php
require 'conexion.php';
//Creo un objeto de tipo db y abro conexion con la BBDD
$db = new db;
$db->abrir();

//Para comprobar si es la primera vez que se han metido en el
//proyecto miro si existe el archivo de "configuracion"
if (file_exists(__DIR__.'/xml.xml')) {
	//Si existe lo que hago es leer el xml y 
	//Defino una variable estatica con el nombre de la tabla
	$tbl= simplexml_load_file(__DIR__.'/xml.xml');
	
	//Realizo la consulta a la tabla
	$tbl = $db->consulta("SELECT * FROM tablas WHERE id = ".$tbl->id);
	//Y guardo el nombre de la tabla en una variable estatica
	define("NOMTABLA", $tbl[0]['nombreTabla']);
} else {
    creartabla();
}
//Realizo la consulta a la tabla
$feed = $db->consulta("SELECT * FROM ".NOMTABLA);
//Cierrro conexion
$db->cerrar();
//Convierto el resultado en JSON y lo envio.
$return["json"] = json_encode($feed);
echo json_encode($return);



/*

FUNCION PARA CREAR UN NOMBRE DE TABLA DINAMICO Y GUARDARLO EN UN XML

*/
function creartabla(){
	//Creo una nueva variable db y abro la conexion con la BBDD
	$db = new db;
	$db->abrir();
	do{
		//Creo un nombre al azar de la tabla
		$tbl = RandomString();
		//Compruebo que no existe el nombre
		$conTbl = $db->consulta("SELECT * FROM tablas WHERE nombreTabla = '".$tbl."'");
	//Realizo la operacion hasta que no encuentra un nombre sin usar
	}while(!empty($conTbl));
	
	//Guerado la el nombre de la tabla 
	$sql = 'INSERT INTO tablas(nombreTabla) VALUES("'.$tbl.'")';
	$res = $db->sql($sql);
	//Obtengo el id del registro
	$res = $db->id();
	
	$sql = "CREATE TABLE IF NOT EXISTS `".$tbl."` (
			`id` int(11) NOT NULL,
			  `ip` varchar(15) NOT NULL,
			  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
			  `usuario` varchar(30) NOT NULL,
			  `feed` text NOT NULL,
			  `corregido` tinyint(1) NOT NULL
			) ENGINE=InnoDB  DEFAULT CHARSET=utf8";
	$db->sql($sql);
	
	
	//Creo un objeto de tipo XML
	$xml = new DomDocument('1.0', 'UTF-8');
	//Le agrego  un elemento
	$conf = $xml->createElement('conf');
	$conf = $xml->appendChild($conf);
	//Y dentro del primer elemento un segundo
	//Donde voy a guardar el id de la tabla para asi luego 
	//ya obtener el nombre de la tabla a consultar	
	$child = $xml->createElement('id');
	$child = $conf->appendChild($child);
	$value = $xml->createTextNode($res);
	$value = $child->appendChild($value);

	$xml->formatOutput = true;
	//Guardo el XML
	$strings_xml = $xml->saveXML();
	//Y lo añado en el directorio
	$xml->save(__DIR__.'/xml.xml');
	
	//Defino una variable estatica con el nombre de la tabla
	define("NOMTABLA", $tbl);
	
	}
	function RandomString($length=10,$uc=TRUE,$n=TRUE,$sc=FALSE)
	{
		$source = 'abcdefghijklmnopqrstuvwxyz';
		if($uc==1) $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		if($n==1) $source .= '1234567890';
		if($sc==1) $source .= '|@#~$%()=^*+[]{}-_';
		if($length>0){
			$rstr = "";
			$source = str_split($source,1);
			for($i=1; $i<=$length; $i++){
				mt_srand((double)microtime() * 1000000);
				$num = mt_rand(1,count($source));
				$rstr .= $source[$num-1];
			}
	 
		}
    return $rstr;
	}
	

?>