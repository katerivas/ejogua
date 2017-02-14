<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php $this->load->view('comunes/cabecera')?>
	<?php $this->load->view('comunes/menu')?>
<title></title>
	<script>
		function consultarSaldo(numero_tarjeta){
			var parametros = {
	             "numero_tarjeta" : numero_tarjeta
	        };
	        $.ajax({
	            data: parametros,
	            url:   '/billetera/consultar_saldo',
	            type:  'post',
							dataType: 'json',
	            success: function (resultado) {
	              //  var resultado = JSON.parse(resultado);
									//  console.log(resultado);
	                if(resultado){
	                	$("#resultado").html("Saldo: " + resultado.datos.saldo);
										$("#resultado").show();
		            }else{
		            	 $("#resultado").html("Error");
			        }
	            }
	        });
		}
	</script>
</head>
<body>

    <div class="content well">
    <form method="post" action="billetera/obtener_datos">
			<div class="form-group">
    		<h2>Consulta de Saldo</h2>
					Numero de Tarjeta: <br>
					<select class="form-control" name="numero_tarjeta"  id="numero_tarjeta">
					<?php
						foreach ($tarjetas as $t) {
							echo "<option value='". $t['numero_tarjeta'] . "'>" . $t['numero_tarjeta'] . "</option>";
						}
						?>
					</select>
    </div>
    <input type="button" class="btn btn-primary" href="javascript:;" onclick="consultarSaldo($('#numero_tarjeta').val());return false;" value="Consultar"/>
 	<br>
	<br>
    <div class="alert alert-success" id="resultado" hidden="true"></div></form>
    <?php echo  form_close();?>
    </div>

</body>
</html>
