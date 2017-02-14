<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<script>
		function administrar_usuarios(id_usuario, usuario, id_rol, id_estado){

		var parametros = {

					"id_usuario" : id_usuario,
	        "usuario" : usuario,
	        "id_rol" : id_rol,
	        "id_estado" : id_estado,

	    };
			console.log(parametros);
	    $.ajax({
	        data: parametros,
	        url:   '/usuario/actualizar_usuario',
	        type:  'post',
					success: function (resultado) {
							//var respuesta = JSON.parse(resultado);
							if(resultado){
								$("#resultado").html("Usuario Modificado");
								$("#resultado").show();
						}else{
							 $("#resultado_error").html(resultado.error);
							 $("#resultado_error").show();
					}
	        }
	    });
	}
	</script>
<?php $this->load->view('comunes/cabecera')?>
<?php $this->load->view('comunes/menu')?>
<title>Administraci&oacuten de Usuarios</title>
</head>
<body>
	<div class="content well">
		<table class="table table-striped table-hover">
		<thead>
		<tr class="bg-primary">
			<th>Id Usuario</th>
			<th>Nombre de Usuario</th>
			<th>Rol</th>
			<th>Grupo</th>
			<th>Estado</th>
		</tr>
		</thead>
		<tbody>
		<?php	foreach ($usuarios as $r): ?>
			<tr>
				<td><?php echo $r->id_usuario; ?></td>
				<td><a href="<?php echo base_url() . "usuario/mostrar_id_usuario/" . $r->id_usuario;?>"><?php echo $r->usuario; ?></a></td>
				<td><?php echo $r->detalle_rol; ?></td>
				<td><?php echo $r->detalle_grupo; ?></td>
				<td><?php echo $r->detalle_estado; ?></td>
				<?php endforeach?>
			</tr>
		</tbody>
		</table>
				<!-- <form method="post" action="/usuario/actualizar_usuario"> -->
					<?php
						foreach ($usuario_seleccionado as $r):?>
							<input type="hidden" name="id_usuario" id="id_usuario" class="form-control" value="<?php echo $r->id_usuario;?>">
							<label>Nombre de Usuario: </label>
							<input type="text" name="usuario" id="usuario" class="form-control"value="<?php echo $r->usuario;?>">
							<label>Rol</label>
							<select class="form-control" name="id_rol"  id="id_rol">
							<?php
								foreach ($roles as $r) {
									echo "<option value='". $r['id_rol'] . "'>" . $r['detalle'] . "</option>";
								}
								?>
							</select>
							<label>Estado</label>
							<select name="id_estado" class="form-control">
									<option value="1">Activo</option>
									<option value="2">Inactivo</option>
							</select>

							<input type="button" class="btn btn-primary" value="Modificar" href="javascript:;" onclick="administrar_usuarios($('#id_usuario').val(),$('#usuario').val(),$('#id_rol').val(),$('#id_estado'));return false;" >

						<?php endforeach?>
				</form>

</body>
</html>
