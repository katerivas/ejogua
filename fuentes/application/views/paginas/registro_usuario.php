<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('comunes/cabecera')?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registrar Usuario</title>
	<script>
		function registrar_usuario(usuario, password, nombre, apellido, genero, nro_ci, direccion, email, telefono){
			var parametros = {
	            "usuario" : usuario,
	            "password" : password,
	            "nombre" : nombre,
	            "apellido" : apellido,
	            "genero" : genero,
	            "nro_ci" : nro_ci,
	            "direccion" : direccion,
	            "email" : email,
	            "telefono" : telefono
	        };


	        $.ajax({
	            data: parametros,
	            url:   '/usuario/agregar_usuario',
	            type:  'post',
	            beforeSend: function () {
	                /* $("#resultado").html("Procesando, espere por favor..."); */
	            },
	            success: function (resultado) {
	            	 var respuesta = JSON.parse(resultado);
	                if(respuesta.success){
			            $("#resultado_success").html("Usuario Ingresado");
									$("#resultado_success").show();
									$("#usuario").val('');
									$("#password").val('');
									$("#nombre").val('');
									$("#apellido").val('');
									$("#nro_ci").val('');
									$("#direccion").val('');
									$("#email").val('');
									$("#telefono").val('');
			        }else{
								$("#resultado_error").html(respuesta.error);
								$("#resultado_error").show();
								$("#usuario").val('');
								$("#password").val('');
								$("#nombre").val('');
								$("#apellido").val('');
								$("#nro_ci").val('');
								$("#direccion").val('');
								$("#email").val('');
								$("#telefono").val('');
	            }
						}
	        });
		}
	</script>
</head>
<body>

<?php echo form_open('form_validation/check_validation');?>
	<?php echo validation_errors(); ?>
	<div class="content well ">
		<form method="post">
			<h2>Registrar usuario</h2>
			<div class="form-group">
				<label>Nombre de usuario:</label>
				<input type="text" class="form-control" name="usuario" id="usuario">
				 <?php echo form_error('usuario');?>
			</div>
			<div class="form-group">
				<label>Contrase&ntildea:</label>
				<input type="password" class="form-control" name="password" id="password">
				 <?php echo form_error('password'); ?>
			</div>
			<h3>Datos Personales</h3>
			<div class="form-group">
				<label>Nombre:</label>
				<input type="text" class="form-control" name="nombre" id="nombre" >
				<?php echo form_error('nombre'); ?>
			</div>
			<div class="form-group">
				<label>Apellido:</label>
				<input type="text" class="form-control" name="apellido" id="apellido">
				<?php echo form_error('apellido'); ?>
			</div>

			<label>Genero: </label>
			<input type="checkbox" name="genero" value="M" id="M"> Masculino
		 	<input type="checkbox" name="genero" value="F" checked="checked" id="F"> Femenino
		 	<div class="form-group">
		  		<label>Numero de Documento:</label>
		  		<input type="text" class="form-control" name="nro_ci" id="nro_ci">
					<?php echo form_error('nro_ci'); ?>
			</div>
		  	<div class="form-group">
		  		<label>Direccion: </label>
		  		<input type="text" class="form-control" name="direccion" id="direccion">
					<?php echo form_error('direccion'); ?>
				</div>
		  	<div class="form-group">
		  		<label>Email: </label>
		  		<input type="text" class="form-control" name="email" id="email">
					<?php echo form_error('email'); ?>
				</div>
		  	<div class="form-group">
		  		<label>Telefono:</label>
		  		<input type="text"class="form-control" name="telefono" id="telefono">
					<?php echo form_error('telefono'); ?>
			</div>
			<input type="button" class="btn btn-primary" onclick="registrar_usuario($('#usuario').val(), $('#password').val(), $('#nombre').val(), $('#apellido').val(), $('#genero').val(), $('#nro_ci').val(), $('#direccion').val(), $('#email').val(), $('#telefono').val());return false;" value="Registrar"/>

		<div id="resultado_success" class="alert alert-success" hidden="true"></div>
		<div id="resultado_error" class="alert alert-danger" hidden="true"></div>
	</form>
	<?php echo  form_close();?>
	</div>
</body>
</html>
