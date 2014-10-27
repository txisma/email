	
	$(function() {
		
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
                        $("#resultado").html(response);
                }
        });
	}
	$(function()
	{
		$("#convertir_texto_plano").click(function()
		{
			value_html = $("#value_html");
			value_plano =$("#value_plano");
			$("#pasador").text(value_html.val()).css({display: "none"});;
			value_html.val($("#pasador").html());
		});
	}); 
	