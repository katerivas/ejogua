<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<?php $this->load->view('comunes/cabecera')?>
<?php $this->load->view('comunes/menu')?>
<title></title>

</head>
<body>

<div class="content well">
	<table class="table table-striped table-hover">
	<thead>
	<tr class="bg-primary">

		<th>Id Tarjeta</th>
		<th>Numero de Tarjeta</th>
		<th>Codigo de Seguridad </th>
		<th>Tipo de Tarjeta</th>
		<th>Estado</th>
	</tr>
	</thead>
	<tbody>

		<?php
		foreach ($tarjetas as $t): ?>
		<tr>
			<td><?php echo $t->id_tarjeta; ?></td>
			<td><a href="<?php echo base_url() . "tarjeta/mostrar_id_tarjeta/" . $t->id_tarjeta;?>"><?php echo $t->numero_tarjeta; ?></a></td>
			<td><?php echo $t->codigo_seguridad; ?></td>
			<td><?php echo $t->tipo_tarjeta; ?></td>
			<td><?php echo $t->id_estado; ?></td>
			<?php endforeach?>
			</tr>
	</tbody>
	</table>
    <form method="post" action="/tarjeta/actualizar_tarjeta">

    	<?php
    	foreach ($tarjeta_seleccionada as $r):?>
    		<input type="hidden" name="id_tarjeta" id="id_tarjeta" class="form-control" value="<?php echo $r->id_tarjeta;?>">
    		<label>Numero de Tarjeta:</label>
    		<input type="text" name="numero_tarjeta" id="numero_tarjeta" class="form-control" value="<?php echo $r->numero_tarjeta;?>"><br>
    		<label>Codigo de Seguridad: </label>
    		<input type="text" name="codigo_seguridad" id="codigo_seguridad"class="form-control"value="<?php echo $r->codigo_seguridad;?>">
    		<br><label>Tipo de Tarjeta:</label>
    		<select name="tipo_tarjeta" id="tipo_tarjeta" class="form-control">
    			<option value="Visa">Visa</option>
    			<option value="Master Card">Master Card</option>
    		</select><br>
    		<label>Estado:</label>

    		<br><input type="submit" class="btn btn-primary" value="Modificar">
    	<?php endforeach?>

	</form>
</div>

</body>
</html>
