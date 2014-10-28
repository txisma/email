	
	$(function() {
		cargarFeed();
		var viewportHeight = $(window).height();
		var heightFrame = viewportHeight - 50;
		$('#iframelive').css({'height': heightFrame + 'px'});
		
		$(window).resize(function() {
			var viewportHeight = $(window).height();
			var heightFrame = viewportHeight - 50;
			$('#iframelive').css({'height': heightFrame + 'px'});
		});
		$(window).trigger('resize');
		
		$("#header ul.menu li").click(function() {
			$('#header ul li').removeClass('active');
			$(this).addClass('active');
			var device = $(this).attr('id');
			$('#iframelive').removeClass().addClass(device);
			frame.src = frame.src;
			var url = 'home.html'
			$('#frame').attr('src', url);
		});
		
		$("#header ul.option li a").click(function(e) {
			e.preventDefault();
			$('#header ul li').removeClass('active');
			$(this).parent().addClass('active');
			var url = $(this).attr('href');
			$('#frame').attr('src', url);
			$('#iframelive').removeClass().addClass('desktop');
			//$('#frame').reload();
		});
		
		//$("#trigger").click(function() {
			//if ($('#header').is(':visible')) {
				//$("#header").slideUp();
				//$(this).animate({'top':'0'});
				//$(this).addClass('active');
				
			//} else {
				//$("#header").slideDown();
				//$(this).animate({'top':'49px'});
				//$(this).removeClass('active');
			//}
		//});
		
	});
	
	function mandarMail(){
		
		var iFrame = document.getElementById('frame');
		var iFrameBody; 
		if ( iFrame.contentDocument ) { // FF 
			iFrameBody = iFrame.contentDocument.getElementsByTagName('html')[0]; 
		} else if ( iFrame.contentWindow ) { // IE 
			iFrameBody = iFrame.contentWindow.document.getElementsByTagName('html')[0]; 
		}
		
		var html = iFrameBody.innerHTML;
		var email = $('#email').val();
		//console.log(iFrameBody.innerHTML);
        var parametros = {
                "html" : html,
				"email": email 
        };
        $.ajax({
                data:  parametros,
                url:   'include/function/email.php',
                type:  'post',
                success:  function (response) {
					console.log(response);
					if(response ==true){
						alert("Su email ha sido enviado satisfactoriamente");
					}else{
						alert("Se ha producido un error");
					}
                }
        });
	}
	function mandarfeed(){
		var nombre = $(".nombre").val();
			mensaje = $(".mensaje").val();
 
		if (nombre == "") {
			$(".nombre").focus();
			return false;
		}else if(mensaje == ""){
			$(".mensaje").focus();
			return false;
		}else{
			var datos = 'nombre='+ nombre + '&mensaje=' + mensaje;
			$.ajax({
				type: "POST",
				url: "include/function/guardar.php",
				data: datos,
				success: function() {
					cargarFeed();
					alert('Mensaje enviado!');  
				},
				error: function() {
					alert('Hubo un error!');
				}
			});
			return false;
		}
 
	}
	function cargarFeed(){
		$.ajax({
			type: "POST",
			url: "include/function/cargarfeed.php",
			dataType: "json",
			success: function(data) {
				data = $.parseJSON(data.json);
				var html = '<table><tr><th>Usuario</th><th>hora</th><th>Feed</th><th>Corregido</th></tr>';
				$.each(data, function(i, val) {
				  html +='<tr>';
					html +='<td>'+val.usuario+'</td>';
					html +='<td>'+val.fecha+'</td>';
					html +='<td>'+val.feed+'</td>';
					if(val.corregido==0){
						html +='<td>'
								+'<img src="include/images/ez.png" alt="NO corregido" style="width:20px">'
								+'<button onclick="actualizarfeed('+val.id+');" id="submit">Corregido</button>'
								+'</td>';
					}else{
						html +='<td><img src="include/images/bai.png" alt="SI corregido" style="width:20px"></td>';
					}
				  html +='</tr>';
				});
				html += '<table>';
				$('#feed').html(html);
				console.log($('#feed'));
			}
		});
		return false;
	}
	function actualizarfeed(id){
		var datos = 'id='+ id;
		$.ajax({
			type: "POST",
			data: datos,
			url: "include/function/actualizarfeed.php",
			dataType: "json",
			success: function(data) {
				cargarFeed();
			}
		});
		return false;
	}

	