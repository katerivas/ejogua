<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php $this->load->view('comunes/cabecera')?>
<title>Registrar Tarjeta</title>
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
	                 //$("#resultado").html("Procesando, espere por favor...");  
	            },
	            success: function (resultado) {
	            	var respuesta = JSON.parse(resultado);
		            if(respuesta.success){
		            	$("#resultado").html("Tarjeta Ingresada"); 				
		            }else{
		            	 $("#resultado").html(respuesta.error);
			        } 

	            }
	        });
		}
	</script>
<html>
<body>
<?php $this->load->view('comunes/menu')?>
<div class="well">
		<h2>Registro de Tarjeta</h2>
		
		<div id="resultado"></div>
		
		<div class="form-group">
			<label>Numero de Tarjeta:</label></td>
			<input type="text" class="form-control" name="numero_tarjeta" id="numero_tarjeta">
		</div>

		<div class="form-group">
			<label>Seleccione tipo de Tarjeta</label>
			<select name="tipo_tarjeta" class="form-control" id="tipo_tarjeta">
				<option id="1" value="1">Visa</option>
				<option id="2" value="2">Master Card</option>
			</select>
		</div>
		
		<div class="form-group">
			<label>Codigo de Seguridad:</label>
			<input type="text" class="form-control" name="codigo_seguridad" id="codigo_seguridad"></input>	
		</div>
		
		
		<input type="button" class="btn btn-primary" href="javascript:;" onclick="registrar_tarjeta($('#numero_tarjeta').val(), $('#tipo_tarjeta').val(), $('#codigo_seguridad').val());return false;" value="Registrar";/>    
		

			<?php echo  form_close();?>
 
 </form>
	</div id="resultado">

	</div>
</div>
</body>
</html>
