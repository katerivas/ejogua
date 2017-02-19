<!DOCTYPE html>
<html>
<head>
  <?php $this->load->view('comunes/cabecera')?>
  <?php $this->load->view('comunes/menu')?>
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

              //var respuesta = JSON.parse(resultado);
              console.log(resultado);

              if(resultado.resultado){
                  $("#resultado_error").hide();
                  $("#resultado").html("Contrase&ntilde modificada");
                  $("#resultado").show();
              }else{
                   $("#resultado").hide();
                   $("#resultado_error").html(resultado.error);
                   $("#resultado_error").show();
              }
          }
      });
}

</script>
	<title>Cambiar Password para <?php echo $username ?></title>
</head>
<body>
<form action="post">
    <div class="content well">
  <?php echo form_open('form_validation/check_validation');?>
  <div><?php echo validation_errors(); ?></div>
  <h2> Cambiar contrase&ntildea de <?php echo $username ?></h2>
  <label>Password:
  <input type="password" class="form-control"  name="password" id="password">
  <label>Confirm Password:
  <input type="password" class="form-control"name="conf_password" id="conf_password"><br>
  <input type="button" class="btn btn-primary" href="javascript:;" onclick="cambiar($('#password').val(),$('#conf_password').val());return false;" value="Cambiar"/>
</form>
<div class="alert alert-success" id="resultado" hidden="true"></div>
<div class="alert alert-success" id="resultado_error" hidden="true"></div>
<?php echo  form_close();?>
</div>
</body>
</html>
