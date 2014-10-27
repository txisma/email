<?PHP
	include('include/function/function.php');
	if (isset($_GET['zip'])){
		if($_GET['zip']==true){
			crearzip();
		}
	}
?><!DOCTYPE html>
<html>
	<head>
		<title>Template</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta charset="utf-8" />
		<link rel="stylesheet" href="include/css/style.css" />
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<script type="text/javascript" src="include/js/main.js"></script>
	</head>
	<body>
		<div id="header">
			<div class="width">
				<div id="download">
                	<input type="text" name="email" id="email" style="width:200px;"/>
                 	<button onclick="mandarMail()">Enviar email</button> 
                    <br/>
                	<!--<input type="button" onClick="mandarMail();" value="Mandar email" />-->
					<a href="index.php?zip=true">Descargar en ZIP</a>
				</div>
			</div>
		</div>
		<div id="iframelive" class="">
			<div id="frameWrapper">
				<iframe id="frame" frameborder="0" src="home.html">
					No tu navegador no soporta frames o no est� configurado para mostrar frames
				</iframe>
			</div>
		</div>
	</body>
</html>