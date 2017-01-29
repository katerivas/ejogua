<!DOCTYPE html>
<html>
<head>
<!-- Cabecera -->
<?php $this->load->view('comunes/cabecera')?>
</head>
<body>
<h1>Login</h1>
 <p style="color:red">
<?php 
if(!empty($mensaje)){
	echo  $mensaje;
}
?>
</p>
 <?php echo form_error('usuario'); ?>
<div class="content well">
<h2>Login</h2>
<div class="form-group">
   <form action="usuario/login" method="post">
     <label for="usuario">Usuario:</label>
     <input type="text" size="20" id="usuario" name="usuario"/>
     <br/>
     <label for="password">Password:</label>
     <input type="password" size="20" id="passowrd" name="password"/>
     <br/>
     <a href="usuario/vista_usuario">Registrarse</a><br>
     <input type="submit" value="Login"/>
   </form>
   </form>
  </div>
 </body>
</html>