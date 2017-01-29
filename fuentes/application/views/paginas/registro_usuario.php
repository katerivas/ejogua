<!DOCTYPE html>
<head>
<?php $this->load->view('comunes/cabecera')?></head>
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

	        console.log(parametros);
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
			            $("#resultado").html("Usuario Registrado"); 				
			        }else{
			            $("#resultado").html(respuesta.error);
	            }
}
	        });
		}
	</script>
<html>
<body>
<?php $this->load->view('comunes/menu')?>
<div><?php echo validation_errors(); ?></div>
<form method="post" action="billetera/agregar_usuario">
<div class="well">
	<h2>Registro de Usuario</h2>
	<div class="form-group">
		<label>Nombre de usuario:</label>
		<input type="text" class="form-control" name="usuario" id="usuario">
	</div>
	<div class="form-group"> 
		<label>Contrase&ntildea:</label>
		<input type="password" class="form-control name="password" id="password">
	</div>
	<h3>Datos Personales</h3>
	<div class="form-group">
		<label>Nombre:</label> 
		<input type="text" class="form-control" name="nombre" id="nombre" >
	</div>
	<div class="form-group">
		<label>Apellido:</label> 
		<input type="text" class="form-control" name="apellido" id="apellido">
	</div>

	<label>Genero: </label>
	<input type="checkbox" name="genero" value="M" id="M"> Masculino
 	<input type="checkbox" name="genero" value="F" checked="checked" id="F"> Femenino
 	<div class="form-group">
  		<label>Numero de Documento:</label>
  		<input type="text" class="form-control" name="nro_ci" id="nro_ci">
  	</div>
  	<div class="form-group">
  		<label>Direccion: </label>
  		<input type="text" class="form-control" name="direccion" id="direccion">
  	</div>
  	<div class="form-group">
  		<label>Email: </label>
  		<input type="text" class="form-control" name="email" id="email">
  	</div>
  	<div class="form-group">
  		<label>Telefono:</label>
  		<input type="text"class="form-control name="telefono" id="telefonos">
  		
	</div>
	<input type="button" class="btn btn-primary" href="javascript:;" onclick="registrar_usuario($('#usuario').val(), $('#password').val(), $('#nombre').val(), $('#apellido').val(), $('#genero').val(), $('#nro_ci').val(), $('#direccion').val(), $('#email').val(), $('#telefono').val());return false;" value="Registrar"/>
</form>
</div>	
</div>
</body>
</html>
