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
					<div id="left">
						<input type="text" name="email" id="email" />
						<button id="submit" onclick="mandarMail()">Enviar</button> 
					</div>
					<div id="right">
						<a href="index.php?zip=true">Descargar en ZIP</a>
					</div>
                    
                        <!-- hay que poner estilos a esto-->
                        <div style="float:left">
                            <div>
                                <label>Nombre:</label><input type="text" class="nombre" name="nombre" style="width:200px" />
                            </div>
                            <div>
                                <label>Mensaje:</label><textarea cols="30" rows="5" class="mensaje" name="mensaje" style="width:200px; height:100px !important" ></textarea>
                            </div>
                            <div class="msg"></div>
                                <button onclick="mandarfeed();" id="submit">Enviar Feed</button>
                        </div>
                        <div id="feed">
                        
                        </div>
                        <!-- hay que poner estilos a esto-->
                    </div>
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