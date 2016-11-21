<!DOCTYPE html>
<html>
<head>
    <!-- Cabecera -->
	<?php $this->load->view('comunes/cabecera')?>
	
	<script>
		function consultarSaldo(numero_tc){
			var parametros = {
	            "numero_tc" : numero_tc
	        };
	        $.ajax({
	            data: parametros,
	            url:   '/billetera/consultar_saldo',
	            type:  'post',
	            beforeSend: function () {
	                $("#resultado").html("Procesando, espere por favor...");
	            }, 
	            success: function (resultado) {
	            	var v_saldo = jQuery.parseJSON(resultado);
	                $("#resultado").html("Saldo: " + v_saldo[0].saldo);
	            }
	        });
		}
	</script>
</head>
<body>
	<?php $this->load->view('comunes/menu')?>
	<div class="content">
	<form action="billetera/consultar_saldo">
    <p>Consulta de Saldo</p><br>
	Numero de Tarjeta: <br>
    <input type="text" name="numero_tc" id="numero_tc"/>
    <input type="button" href="javascript:;" onclick="consultarSaldo($('#numero_tc').val());return false;" value="Consultar"/>
 	<br>
    <span id="resultado"></span></form>
    </div>
</body>
</html>