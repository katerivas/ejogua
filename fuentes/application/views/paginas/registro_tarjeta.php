<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>




<?php $this->load->view('comunes/cabecera')?>
<title>Registrar Tarjeta</title>
	<script>
		function registrar_tarjeta(numero_tarjeta, id_estado, id_usuario,tipo_tarjeta, codigo_seguridad){
			var parametros = {
	            "numero_tarjeta" : numero_tarjeta,
	            "tipo_tarjeta" : tipo_tarjeta,
	            "codigo_seguridad" : codigo_seguridad,
							"id_usuario" : id_usuario,
							"id_estado" : id_estado

	        };
					// console.log(parametros);
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
		            	$("#resultado_success").html("Tarjeta Ingresada");
									$("#numero_tarjeta").val('');
									$("#codigo_seguridad").val('');
									$("#resultado_success").show();
		            }else{
		            	 $("#resultado_danger").html(respuesta.error);
									 $("#resultado_danger").show();
			        }

	            }
	        });
		}
	</script>
<html>
<body>
<?php $this->load->view('comunes/menu')?>
<?php echo form_open('form_validation/check_validation');?>
<div class="content well">
		<h2>Registro de Tarjeta</h2>
			<div class="form-group">

			<label>Numero de Tarjeta:</label></td>
			<input type="text" class="form-control" name="numero_tarjeta" id="numero_tarjeta">
			 <?php echo form_error('numero_tarjeta');  ?>
		</div>

		<div class="form-group">
			<label>Seleccione tipo de Tarjeta</label>
			<select name="tipo_tarjeta" class="form-control" id="tipo_tarjeta">
				<option id="Visa" value="Visa">Visa</option>
				<option id="Master Card" value="Master Card">Master Card</option>
			</select>
		</div>

		<div class="form-group">
			<label>Codigo de Seguridad:</label>
			<input type="text" class="form-control" name="codigo_seguridad" id="codigo_seguridad"></input>
			 <?php echo form_error('codigo_seguridad');  ?>
		</div>

		<div class="form-group">
			<input type="hidden" class="form-control" name="id_estado" id="id_estado" value="1" disabled></input>
		</div>

		<input type="button" class="btn btn-primary" href="javascript:;" onclick="registrar_tarjeta($('#numero_tarjeta').val(), $('#id_estado').val(),$('#id_usuario').val(),$('#tipo_tarjeta').val(), $('#codigo_seguridad').val());return false;" value="Registrar";/>
		<?php echo  form_close();?>

 </form>
	<div id="resultado_danger" class="alert alert-danger" hidden="true"></div>
	<div id="resultado_success" class="alert alert-success" hidden="true"></div>
</div>
</body>
</html>
