<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view('comunes/cabecera')?>
  <?php
  if (isset($this->session->userdata['logged_in'])) {
  $username = ($this->session->userdata['logged_in']['usuario']);
  $id_usuario = ($this->session->userdata['logged_in']['id_usuario']);

  } else {
  header("location: login");
  }?>

<script>
function cambiar(password, conf_password){
  var parametros = {
           "password" : password,
           "conf_password" : conf_password
      };
      $.ajax({
          data: parametros,
          url:   '/password/check_password',
          type:  'post',
          dataType: 'json',

          success: function (resultado) {
          var respuesta = JSON.parse(resultado);
// console.log(parametros);
              if(respuesta.success){
                $("#resultado").html("Contrase&ntilde modificada");
                $("#resultado").show();
            }else{
               $("#resultado_error").html(respuesta.error);
               $("#resultado_error").show();
          }
          }
      });
}

</script>
	<title>Cambiar Password</title>
</head>
<body>
<form action="post">
  <?php echo form_open('form_validation/check_validation');?>
  <div><?php echo validation_errors(); ?></div>
  <?php
  echo $id_usuario;
  ?>
  <label>Password:
  <input type="password" class="form-control"  name="password" id="password">
  <label>Confirm Password:
  <input type="password" class="form-control"name="conf_password" id="conf_password">
  <input type="button" class="btn btn-primary" href="javascript:;" onclick="cambiar($('#password').val(),$('#conf_password').val());return false;" value="Cambiar"/>
</form>
<div class="alert alert-success" id="resultado" hidden="true"></div>
<div class="alert alert-success" id="resultado_error" hidden="true"></div>
<?php echo  form_close();?>
</body>
</html>
