<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<head>
<?php $this->load->view('comunes/cabecera')?></head></head>
<title></title>


<script>
	function modificar_usuario(nombre, apellido, nro_ci, direccion, email, telefono){
	
	var parametros = {
        "nombre" : nombre,
        "apellido" : apellido,
        "nro_ci" : nro_ci,
        "direccion" : direccion,
        "email" : email,
        "telefono" : telefono

    };
   
    $.ajax({
        data: parametros,
        url:   '/usuario/ver_datos_usuario',
        type:  'post',
        beforeSend: function () {
            //$("#resultado").html("Procesando, espere por favor...");
        },
        success: function (respuesta) {
        	//var respuesta = JSON.parse(resultado);
        	if(resultado.success){
	            $("#resultado").html("Usuario Modificado"); 				
	        }
        }
    });
} 
</script>

<html>
<body>
<?php $this->load->view('comunes/menu')?>
<div class="content">
<div><?php echo validation_errors(); ?></div>
<form method="post" action="usuario/ver_datos_usuario">
<div class="form-group">
<?php 
foreach ($resultado as $r){?>
 	<label>Nombre</label>
    <input type="text" class="form-control" id="nombre"value="<?php echo $r->nombre;?>" />
    <label>Apellido</label>
    <input type="text" class="form-control" id="apellido"value="<?php echo $r->apellido;?>" />
    <label>Numero de Cedula de Identidad</label>
    <input type="text" class="form-control" id="nro_ci"value="<?php echo $r->nro_ci;?>" />
    <label>Direccion</label>
    <input type="text" class="form-control" id="direccion"value="<?php echo $r->direccion;?>" />
    <label>Email</label>
    <input type="text"  class="form-control" id="email"value="<?php echo $r->email;?>" />
    <label>Telefono</label>
    <input type="text"class="form-control" id="telefono"value="<?php echo $r->telefono;?>" />

<?php } ?> 
<br>
<input type="button" class="btn btn-primary" value="Modificar" href="javascript:;" onclick="modificar_usuario($('#nombre').val(),$('#apellido').val(),$('#nro_ci').val(),$('#direccion').val(),$('#email').val(),$('#telefono').val());return false;" >
</div>

<div id="resultado"></div>
</form>
</div>

</body>
</html>