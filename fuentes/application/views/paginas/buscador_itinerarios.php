<!DOCTYPE html>
<html>
<head>
<!-- Cabecera -->
<?php $this->load->view('comunes/cabecera')?>
<?php $this->load->view('comunes/menu')?>
	<script>
 		function itinerario(id_estacion_inicio,id_estacion_final){

			var parametros = {
	            "id_estacion_inicio" : id_estacion_inicio,
	            "id_estacion_final" : id_estacion_final

	        };
					// console.log(parametros);
	        $.ajax({
	            data: parametros,
	            url:   '/buscador_itinerarios/mostrar_itinerario_seleccionado',
	            type:  'post',
							dataType: 'json',
	            success: function (resultado) {
	                if(resultado.success){
										var datos = resultado.datos;
										var trHTML = '';
										trHTML += '<table class="table"><tr class="bg-primary"><th>Linea</th><th>Hora de Salida</th><th>Hora de Llegada</th><th>Ciudad</th><th>Estacion de Inicio</th><th>Estacion Final</th></tr>'
										for(var i=0; i<datos.length; i++){
											trHTML +=
													'</td><td>'
		                      + datos[i].linea
		                      + '</td><td>'
		                      + datos[i].hora_salida
	                      	+ '</td><td>'
											    + datos[i].hora_llegada
													+ '</td><td>'
													+ datos[i].ciudad
													+ '</td><td>'
													+ datos[i].estacion_inicio
													+ '</td><td>'
													+ datos[i].estacion_final
											    + '</td></tr>';
										}
										console.log(datos);
	                	// $("#resultado").html("OK de lujo");
										$('#resultado').append(trHTML);
		            }else{
		            	 $("#resultado").html("No existen itinerarios con ese destino");
			        }
	            }
	        });
		}
	</script>


</head>
<body>
<div class="content well">
	<form method="post">
			<label>Estacion de Inicio: </label>
			<select name="id_estacion_inicio" id="id_estacion_inicio" class="form-control">;
    	<?php
					foreach ($estaciones as $e) {
		        echo "<option value='". $e['id_estacion'] . "'>" . $e['detalle'] . "</option>";
		    	}
				?>
			</select><br/>
			<label>Estacion de Fin: </label>
			<select name="id_estacion_final" id="id_estacion_final" class="form-control">;
				<?php

				foreach ($estaciones as $e) {
        	echo "<option value='". $e['id_estacion'] . "'>" . $e['detalle'] . "</option>";
    		}?>
			</select>
			<br>
			<div id="resultado">
			</div>
			<input type="button" class="btn btn-primary" href="javascript:;" onclick="itinerario($('#id_estacion_inicio').val(),$('#id_estacion_final').val());return false;" value="Ver Itinerario"/>
</form>



</div>

</body>
</html>
