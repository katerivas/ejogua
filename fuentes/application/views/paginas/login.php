<!DOCTYPE html>
<html>
<head>
<!-- Cabecera -->
<?php $this->load->view('comunes/cabecera')?>
</head>
<body>
	<?php echo form_error('usuario'); ?>
	<div class="content well">
	<h2>Login</h2>
	<div class="form-group">
	   <form action="/usuario/login" method="post">
	     <label for="usuario">Usuario:</label>
	     <input type="text" class="form-control" size="20" id="usuario" name="usuario"/>
	     <br/>
	     <label for="password">Password:</label>
	     <input type="password" class="form-control"size="20" id="password" name="password"/>
	     <br/>
	      <p style="color:red">

					<?php echo validation_errors(); ?>
		  <?php
	          if(!empty($mensaje)){
			      echo  $mensaje;
			  }
			?>
			</p>
	     <a href="usuario/vista_usuario">Registrarse</a><br>
	     <input type="submit" class="btn btn-warning" value="Login"/>
	   </form>
	  </div>
	</div>
</body>
</html>
