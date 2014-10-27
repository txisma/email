<?PHP
$para      = $_POST['email'];
$titulo    = 'Email Marketing';
$mensaje   = $_POST['html'];
$cabeceras = 'From: dev@cardumen.com.pe' . "\r\n" .
    'Reply-To: no-reply' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
	// Cabecera que especifica que es un HMTL
$cabeceras  .= 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";


$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$maximo= strlen ($url);
$ide= "http://";
$ide2= "include";
$total= strpos($url,$ide);
$total2= stripos($url,$ide2);
$total3= ($maximo-$total2);
$final= substr ($url,$total,-$total3);
$final = $final . 'images/';

$cuerpo = str_replace('src="images/','src="'.$final,$_POST['html']);

mail($para, $titulo, $cuerpo, $cabeceras);

?>