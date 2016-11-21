

<?php

$mpdf=new MPDF('UTF-8','A4','','',20,15,48,25,10,10);

$mpdf->shrink_tables_to_fit=1;
$mpdf->keep_table_proportions = true;

$i=0;

$html = "	<style>
	table {
	    /* border-collapse: collapse; */
		border:1px;
	    width: 100%;
	}

	th, td {
	    text-align: center;
	    padding: 8px;
	}

	tr:nth-child(even){
		background-color: #f2f2f2
	}

	th {
	    background-color: #4CAF50;
	    color: white;
	}
	</style>
		<h2>Reporte de Tarifas </h2>

		<table>
			<tr>
			<th>Linea </th>
			<th>Estacion de Inicio </th>
			<th>Estacion Final</th>
			<th>Tipo de Usuario</th>
			<th>Tarifa</th>

			</tr>
		";
foreach ($datos as $row) {

	/* $html = $html . '<b> ' . $row->id_itinerario . '</b>' ; */
	$html = $html . '
		
			<tr>
			<td>'. $row->detalle_linea .' </td>' .
			'<td>'. $row->estacion_inicio_detalle .'</td>' .
			'<td>'. $row->estacion_final_detalle .'</td>' .
			'<td>'. $row->tipo_usuario_detalle . '</td>' .
			'<td>'. $row->monto .'</td>' .
			'</tr>';

}
$html .= '</table>';

$mpdf->WriteHTML($html );

$mpdf->Output();