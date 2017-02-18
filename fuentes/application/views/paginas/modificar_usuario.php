<!DOCTYPE html>
<head>
	<?php $this->load->view('comunes/cabecera')?>
	<?php
	if (isset($this->session->userdata['logged_in'])) {
	$username = ($this->session->userdata['logged_in']['usuario']);
	$id_usuario = ($this->session->userdata['logged_in']['id_usuario']);

	} else {
	header("location: login");
	}?>

</head>
<title>Modificar mi usuario</title>
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
        url:   '/usuario/modificar_usuario',
        type:  'post',
				success: function (resultado) {
						var respuesta = JSON.parse(resultado);
						if(respuesta.success){
							$("#resultado").html("Usuario Modificado");
							$("#resultado").show();
					}else{
						 $("#resultado_error").html(respuesta.error);
						 $("#resultado_error").show();
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
<div class="form-group">
<?php
foreach ($resultado as $r){?>
 	<label>Nombre</label>
		<input type="hidden" class="form-control" id="id_usuario" value="<?php echo $id_usuario?>">
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

<div id="resultado" class="alert alert-success" hidden="true"></div>
<div id="resultado_error" class="alert alert-danger" hidden="true"></div>

</div>

</body>
</html>
