<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>
<?php $this->load->view('comunes/cabecera')?></head>
<title>Registrar Usuario</title>
	<script>
		function registrar_tarjeta(numero_tarjeta, tipo_tarjeta, codigo_seguridad){
			var parametros = {
	            "numero_tarjeta" : numero_tarjeta,
	            "tipo_tarjeta" : tipo_tarjeta,
	            "codigo_seguridad" : codigo_seguridad,
	      
	        };
	        $.ajax({
	            data: parametros,
	            url:   '/tarjeta/registro_tarjeta',
	            type:  'post',
	            beforeSend: function () {
	                 //$("#resultado").html("Procesando, espere por favor...");  */
	            },
	            success: function (resultado) {
		            console.log(resultado);
		            if(resultado){
		            	$("#resultado").html("Tarjeta Ingresada"); 				
		            }else{
		            	$("#resultado").html("Tarjeta no ingresada");
			        }

	            }
	        });
		}
	</script>
<html>
<body>
<?php $this->load->view('comunes/menu')?>
<div class="content">
<form method="post" action="tarjeta/registro_tarjeta">
	<h2>Registro de Tarjeta</h2>
	Numero de Tarjeta: <input type="text" name="numero_tarjeta" id="numero_tarjeta"><br>
	Seleccione tipo de Tarjeta<select name="tipo_tarjeta" id="tipo_tarjeta">
	<option id="Visa">Visa</option>
	<option id="Master Card">Master Card</option>
	</select><br>
	Codigo de Seguridad: <input type="text" name="codigo_seguridad" id="codigo_seguridad"></input><br>
  	<input type="button" href="javascript:;" onclick="registrar_tarjeta($('#numero_tarjeta').val(), $('#tipo_tarjeta').val(), $('#codigo_seguridad').val());return false;" value="Registrar"/>
<div id="resultado"></div>
</form>
</div>
</body>
</html>
