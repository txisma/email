<?PHP
//A quien va dirijido el emaikl
$para      = $_POST['email'];

//El asunto del email
$titulo    = 'Email Marketing';

//El cuerpo del mensaje
$mensaje   = $_POST['html'];

//Configuro las cabeceras para que se visualize bien
$cabeceras = 'From: dev@cardumen.com.pe' . "\r\n" .
    'Reply-To: no-reply' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	// Cabecera que especifica que es un HMTL
$cabeceras  .= 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

//Para que se visualicen bien las imagenes en el email tengo que cambiar la ruta de las imagenes
//Lo primero que hago es obtener la ruta del archivo
$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
//Obtengo la longitud de la url
$maximo= strlen ($url);
//Defino cual va ser el comienzo y el final de la url que voy a modificar
$ide= "http://";
$ide2= "include";
//Obtengo la posicion dentro de la url del principio
$total= strpos($url,$ide);
//Y del final
$total2= stripos($url,$ide2);
$total3= ($maximo-$total2);
//extraigo la parte que necesito de la url
$final= substr ($url,$total,-$total3);
//Añado lo que necesito
$final = $final . 'images/';

//Y remplazo en todo el cuerpo del email el src de las imagenes y pongo la URL buena
$cuerpo = str_replace('src="images/','src="'.$final,$_POST['html']);

//envio el email y devolverá una TRUE o FALSE si se ha enviado
if (mail($para, $titulo, $cuerpo, $cabeceras)){
	echo $result = true;
}else{
	echo $result = false;
}
return($result);
?>