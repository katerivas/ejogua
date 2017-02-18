<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<?php $this->load->view('comunes/cabecera')?>
<?php $this->load->view('comunes/menu')?>

<script>
	function modificar_tarjeta(id_tarjeta,numero_tarjeta,codigo_seguridad,tipo_tarjeta,id_estado){

		var parametros = {
						"id_tarjeta" : id_tarjeta,
						"numero_tarjeta" : numero_tarjeta,
						"codigo_seguridad" : codigo_seguridad,
						"tipo_tarjeta" : tipo_tarjeta,
						"id_estado" : id_estado

				};
				console.log(parametros);
				$.ajax({
						data: parametros,
						url:   '/tarjeta/actualizar_tarjeta',
						type:  'post',
						success: function (resultado) {
							var respuesta = JSON.parse(resultado);
								if(respuesta.success){
									$("#resultado").html("Tarjeta Modificada!");
									$("#resultado").show();
								}else{
									console.log("hola");
								 $("#resultado_error").html(respuesta.error);
								 $("#resultado_error").show();
							 }
						}
				});
	}
</script>


<title></title>

</head>
<body>
	<?php echo form_open('form_validation/check_validation');?>
	<div><?php echo validation_errors(); ?></div>
<div class="content well">
	<table class="table table-striped table-hover">
	<thead>
	<tr class="bg-primary">

		<th>Id Tarjeta</th>
		<th>Numero de Tarjeta</th>
		<th>Codigo de Seguridad </th>
		<th>Tipo de Tarjeta</th>
		<th>Estado</th>
	</tr>
	</thead>
	<tbody>

		<?php
		foreach ($tarjetas as $t): ?>
		<tr>
			<td><?php echo $t->id_tarjeta; ?></td>
			<td><a href="<?php echo base_url() . "tarjeta/mostrar_id_tarjeta/" . $t->id_tarjeta;?>"><?php echo $t->numero_tarjeta; ?></a></td>
			<td><?php echo $t->codigo_seguridad; ?></td>
			<td><?php echo $t->tipo_tarjeta; ?></td>
			<td><?php echo $t->id_estado; ?></td>
			<?php endforeach?>
			</tr>
	</tbody>
	</table>
    <!-- <form method="post" action="/tarjeta/actualizar_tarjeta"> -->
    	<?php
    	foreach ($tarjeta_seleccionada as $r):?>
    		<input type="hidden" name="id_tarjeta" id="id_tarjeta" class="form-control" value="<?php echo $r->id_tarjeta;?>">
    		<label>Numero de Tarjeta:</label>
    		<input type="text" name="numero_tarjeta" id="numero_tarjeta" class="form-control" value="<?php echo $r->numero_tarjeta;?>"><br>
    		<label>Codigo de Seguridad: </label>
    		<input type="text" name="codigo_seguridad" id="codigo_seguridad"class="form-control"value="<?php echo $r->codigo_seguridad;?>">
    		<br><label>Tipo de Tarjeta:</label>
    		<select name="tipo_tarjeta" id="tipo_tarjeta" class="form-control">
    			<option value="Visa">Visa</option>
    			<option value="Master Card">Master Card</option>
    		</select><br>
    		<label>Estado:</label>
				<select name="id_estado" id="id_estado" class="form-control">
    			<option value="1">Activo</option>
    			<option value="2">Inactivo</option>
    		</select><br>

    		<br><input type="button" class="btn btn-primary" href="javascript:;" onclick="modificar_tarjeta($('#id_tarjeta').val(),$('#numero_tarjeta').val(),$('#codigo_seguridad').val(),$('#tipo_tarjeta').val(),$('#id_estado').val());return false;" value="Modificar Tarjeta"/>
    	<?php endforeach?>

	</form>
	<div id="resultado"class="alert alert-success"  hidden="true"></div>
	<div id="resultado_error" class="alert alert-danger" hidden="true"></div>
</div>

</body>
</html>
