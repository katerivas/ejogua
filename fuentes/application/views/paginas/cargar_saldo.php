<!DOCTYPE html>
<html>
<head>
<!-- Cabecera -->
<?php $this->load->view('comunes/cabecera')?>
	<script>
 		function acreditarSaldo(numero_tarjeta,monto){
 	 	
			var parametros = {
	            "numero_tarjeta" : numero_tarjeta,
	            "monto" : monto
	   
	        };
	        console.log(parametros);
	        $.ajax({
	            data: parametros,
	            url:   '/billetera/cargar_saldo',
	            type:  'post',
	            success: function (resultado) {
	                var respuesta = JSON.parse(resultado);
	                if(respuesta.success){
	                	$("#resultado").html("Saldo Cargado");				
		            }else{
		            	 $("#resultado").html(respuesta.error);
			        }
	            }
	        });
		}
	</script>
</head>
<body>
<?php $this->load->view('comunes/menu')?>
 <?php echo form_open('form_validation/check_validation');?>
<div class="content well">
	<form method="post" action="billetera/cargar_saldo">
	<div class="form-group">
	    <h2>Carga de Saldo</h2><br>
			Numero de Tarjeta: <br>
		    <input type="text" class="form-control" name="numero_tarjeta" id="numero_tarjeta"/><br>
	</div>
			<?php echo form_error('numero_tarjeta');?>
			<div class="form-group">
		    Monto: <br>
		    <input type="text"class="form-control" name="monto" id="monto"/><br>
		    <input type="button" class="btn btn-primary" href="javascript:;" onclick="acreditarSaldo($('#numero_tarjeta').val(),$('#monto').val());return false;" value="Cargar Saldo"/>
	 		<br>
	 		<?php echo form_error('monto');?>
	
	 	<div id="resultado"></div>
	</div>
	</form>
	</div>
</body>
</html>