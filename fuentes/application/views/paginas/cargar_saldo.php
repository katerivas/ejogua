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
	            beforeSend: function () {
	                $("#resultado").html("Procesando, espere por favor...");
	            },
	            success: function (resultado) {
	            	/* var v_saldo = jQuery.parseJSON(resultado);
	                $("#resultado").html("Saldo: " + v_saldo[0].saldo); */
	             	if(resultado){
			            $("#resultado").html("Saldo Cargado"); 				
			        }else{
			            $("#resultado").html("No se pudo cargar el saldo");
				    }
	            }
	        });
		} 
	</script>
</head>
<body>
<?php $this->load->view('comunes/menu')?>
<div class="content">
<form method="post" action="billetera/cargar_saldo">
    <p>Carga de Saldo</p><br>
		Numero de Tarjeta: <br>
	    <input type="text" name="numero_tarjeta" id="numero_tarjeta"/><br>
	    Monto: <br>
	    <input type="text" name="monto" id="monto"/><br>
	    <input type="button" href="javascript:;" onclick="acreditarSaldo($('#numero_tarjeta').val(),$('#monto').val());return false;" value="Cargar Saldo"/>
 	<br>
 	<div id="resultado"></div>
</form></div>
</body>
</div>
</html>