<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>
<?php $this->load->view('comunes/cabecera')?></head>
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
	            	/* var v_saldo = jQuery.parseJSON(resultado);
	                $("#resultado").html("Saldo: " + v_saldo[0].saldo); */
	            	if(resultado){
			            $("#resultado").html("Usuario Registrado"); 				
			        }else{
			            $("#resultado").html("Usuario no Registrado");
				    }
	            }
	        });
		}
	</script>
<html>
<body>
<?php $this->load->view('comunes/menu')?>
<div class="content">
<form method="post" action="billetera/agregar_usuario">
	<h2>Registro de Usuario</h2>
	Nombre de usuario: <input type="text" name="usuario" id="usuario"><br>
	Contrase&ntildea: <input type="password" name="password" id="password"><br>
	<h3>Datos Personales</h3>
	Nombre: <input type="text" name="nombre" id="nombre" ><br>
	Apellido: <input type="text" name="apellido" id="apellido"><br>
	Genero: <input type="checkbox" name="genero" value="M" id="M"> Masculino<br>
 	<input type="checkbox" name="genero" value="F" checked="checked" id="F"> Femenino<br>
  	Numero de Documento: <input type="text" name="nro_ci" id="nro_ci"><br>
  	Direccion: <input type="text" name="direccion" id="direccion"><br>
  	Email: <input type="text" name="email" id="email"><br>
  	Telefono: <input type="text" name="telefono" id="telefonos"><br>
  	<input type="button" href="javascript:;" onclick="registrar_usuario($('#usuario').val(), $('#password').val(), $('#nombre').val(), $('#apellido').val(), $('#genero').val(), $('#nro_ci').val(), $('#direccion').val(), $('#email').val(), $('#telefono').val());return false;" value="Registrar"/>
	<div id="resultado"></div>
</form>
</div>
</body>
</html>
