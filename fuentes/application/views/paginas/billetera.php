<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php $this->load->view('comunes/cabecera')?>
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
	            
	            success: function (resultado) {
	                var respuesta = JSON.parse(resultado);
	                if(respuesta.success){
		                // Crear tabla html para listar todos los saldos.
		                
	                	$("#resultado").html("Saldo: " + respuesta.saldos[0].saldo);				
		            }else{
		            	 $("#resultado").html(respuesta.error);
			        } 
	                $("#resultado").html("Procesando, espere por favor...");
	            }
	        });
		}
	</script>
</head>
<body>
	<?php $this->load->view('comunes/menu')?>
	<div class="content">
	<form action="billetera/consultar_saldo">
    <div class="well">
	<div class="form-group">
    	<h2>Consulta de Saldo</h2>
		Numero de Tarjeta: <br>
   		<input type="text" class="form-control" name="numero_tarjeta" id="numero_tarjeta"/>
    </div>
    <input type="button" class="btn btn-primary" href="javascript:;" onclick="consultarSaldo($('#numero_tarjeta').val());return false;" value="Consultar"/>
 	<br>
    <span id="resultado"></span></form>
    <?php echo  form_close();?>
    </div>
</body>
</html>