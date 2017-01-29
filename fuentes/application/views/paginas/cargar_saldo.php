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
	                //$("#resultado").html("Procesando, espere por favor...");
	            },
	             success: function (resultado) {
	            	var respuesta = JSON.parse(resultado);
	            	if(respuesta.success){
			            $("#resultado").html("Saldo Cargado"); 				
			        }else{
			            $("#resultado").html(respuesta.error);
	                $("#resultado").html("Procesando, espere por favor...");
}
}
	        });
		} 
	</script>
</head>
<body>
<?php $this->load->view('comunes/menu')?>
<div class="content well"" >
<form method="post" action="billetera/cargar_saldo">
<div class="form-group">
    <h2>Carga de Saldo</h2><br>
		Numero de Tarjeta: <br>
	    <input type="text" class="form-control" name="numero_tarjeta" id="numero_tarjeta"/><br>
</div>
<div class="form-group">
	    Monto: <br>
	    <input type="text"class="form-control" name="monto" id="monto"/><br>
	    <input type="button" class="btn btn-primary" href="javascript:;" onclick="acreditarSaldo($('#numero_tarjeta').val(),$('#monto').val());return false;" value="Cargar Saldo"/>
 		<br>

 	<div id="resultado"></div>
</div>
</body>
</div>
</html>