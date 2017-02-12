<!DOCTYPE html>
<html>
<?php
if (isset($this->session->userdata['logged_in'])) {
$username = ($this->session->userdata['logged_in']['usuario']);
$id_usuario = ($this->session->userdata['logged_in']['id_usuario']);

} else {
header("location: login");
}?>
<head>
<title>Ejogua</title>
	<!-- Cabecera -->
	<?php $this->load->view('comunes/cabecera')?>

</head>
<body>
    <!-- Menu -->
	<?php $this->load->view('comunes/menu')?>
	<div class="content well">
    <p>Bienvenido. <?php echo $username?> Seleccione las opciones de Ejogua!!!</p>

	</div>
</body>
</html>
