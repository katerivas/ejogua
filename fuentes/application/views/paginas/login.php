<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Ejogua</title>
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
 </body>
</html>