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
								if(resultado){
									$("#resultado").html("Saldo Cargado");
									$("#resultado").show();
								}else{
									console.log("hola");
								 $("#resultado_error").html(resultado.error);
								 $("#resultado_error").show();
							 }
						}
				});
	}
</script>
</head>
<body>

<?php $this->load->view('comunes/menu')?>
<div class="container well">
	<form method="post" action="billetera/obtener_datos2">
		<?php echo form_open('form_validation/check_validation');?>
		<div><?php echo validation_errors(); ?></div>
		<h2>Carga de Saldo</h2><br>
		<div class="col-xs-4">

					Numero de Tarjeta: <br>
					<select class="form-control" name="numero_tarjeta"  id="numero_tarjeta">
					<?php
						foreach ($tarjetas as $t) {
							echo "<option value='". $t['numero_tarjeta'] . "'>" . $t['numero_tarjeta'] . "</option>";
						}
						?>
					</select>
		    Monto: <br>
			    <select class="form-control" name="monto" id="monto">
							<option value="5000">5000</option>
							<option value="10000">10000</option>
							<option value="15000">15000</option>
							<option value="20000">20000</option>
							<option value="25000">25000</option>
							<option value="50000">50000</option>
							<option value="100000">100000</option>
					</select>
					<br>
					<input type="button" class="btn btn-primary" href="javascript:;" onclick="acreditarSaldo($('#numero_tarjeta').val(),$('#monto').val());return false;" value="Cargar Saldo"/>
		 			<br>
					<div id="resultado" class="alert alert-success" hidden="true"></div>
					<div id="resultado_error" class="alert alert-danger" hidden="true"></div>
			</div><br>

			</div>
	</form>


</body>
</html>
