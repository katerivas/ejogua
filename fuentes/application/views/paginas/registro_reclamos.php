<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>
<?php $this->load->view('comunes/cabecera')?></head>
<title>Registrar Usuario</title>
	<script>
		function enviar_reclamo(tipo_reclamo, detalle_reclamo){
			var parametros = {
	            "tipo_reclamo" : tipo_reclamo,
	            "detalle_reclamo" : detalle_reclamo,

	      
	        };

	        console.log(parametros);
	        $.ajax({
	            data: parametros,
	            url:   '/reclamos/registro_reclamos',
	            type:  'post',
	            beforeSend: function () {
	                /* $("#resultado").html("Procesando, espere por favor..."); */
	            },
	            success: function (resultado) {
	            	/* var v_saldo = jQuery.parseJSON(resultado);
	                $("#resultado").html("Saldo: " + v_saldo[0].saldo); */
	            	if(resultado){
			            $("#resultado").html("Reclamo Enviado"); 				
			        }else{
			            $("#resultado").html("Reclamo no Reclamo");
				    }
	            }
	        });
		}
	</script>
<html>
<body>
<?php $this->load->view('comunes/menu')?>
<div class="content well">
<form method="post" action="reclamo/obtener_datos_reclamos">
	<h2>Complete el siguiente formulario</h2>
	<p>Tipo de reclamo que desea enviar</p>
	<div class="checkbox">
		<input type="checkbox" id=tipo_reclamo name="tipo_reclamo" value="queja">Queja<br>
	</div>
	<div class="checkbox">
  		<input type="checkbox" id="tipo_reclamo" name="tipo_reclamo" value="reclamo">Reclamo<br>
  	</div>
  	<div class="checkbox">
  		<input type="checkbox" id="tipo_reclamo" name="tipo_reclamo" value="sugerencia">Sugerencia<br>
	</div>
	<div class="checkbox">
		<input type="checkbox" id="tipo_reclamo" name="tipo_reclamo" value="felicitacion">Felicitaci&oacuten<br>
	</div>
	<div class="form-group">
		<br>Escriba sus comentarios en no m&aacutes de 200 caracteres: <br>
		<textarea rows="4" cols="50" id="detalle_reclamo" name="detalle_reclamo">
 		Escriba su comentario aqui.
		</textarea>
	</div>
  	<input type="button" class="btn btn-primary" href="javascript:;" onclick="enviar_reclamo($('#tipo_reclamo').val(), $('#detalle_reclamo').val());return false;" value="Enviar reclamo"/>
  	<div id="resultado"></div>
</form>
</div>
</body>
</html>
