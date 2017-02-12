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
		console.log(parametros);
    $.ajax({
        data: parametros,
        url:   '/usuario/modificar_usuario',
        type:  'post',
				success: function (resultado) {
						var respuesta = JSON.parse(resultado);
						if(respuesta.success){
							$("#resultado").html("Saldo Cargado");
					}else{
						 $("#resultado").html(respuesta.error);
						 $("#resultado").show();
				}
        }
    });
}
</script>

<html>
<body>
<?php $this->load->view('comunes/menu')?>

<div class="content well">
<?php echo form_open('form_validation/check_validation');?>
<div><?php echo validation_errors(); ?></div>
<form method="post" action="usuario/modificar_usuario">
<div class="form-group">
<?php
foreach ($resultado as $r){?>
 	<label>Nombre</label>
    <input type="text" class="form-control" id="nombre"value="<?php echo $r->nombre;?>" />
    <label>Apellido</label>
    <input type="text" class="form-control" id="apellido"value="<?php echo $r->apellido;?>" />
    <label>Cedula de Identidad</label>
    <input type="text" class="form-control" id="nro_ci"value="<?php echo $r->nro_ci;?>" />
    <label>Direcci&oacuten</label>
    <input type="text" class="form-control" id="direccion"value="<?php echo $r->direccion;?>" />
    <label>Email</label>
    <input type="text" class="form-control" id="email"value="<?php echo $r->email;?>" />
    <label>Tel&eacutefono</label>
    <input type="text" class="form-control" id="telefono"value="<?php echo $r->telefono;?>" />
<?php } ?>
<br>
<input type="button" class="btn btn-primary" value="Modificar" href="javascript:;" onclick="modificar_usuario($('#nombre').val(),$('#apellido').val(),$('#nro_ci').val(),$('#direccion').val(),$('#email').val(),$('#telefono').val());return false;" >
</div>

<div id="resultado" class="alert alert-danger" hidden="true"></div>
</form>
</div>

</body>
</html>
