

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
		<h2>Reporte de Itinerarios </h2>
		
		<table>
			<tr>
			<th>Numero de Itinerario </th>
			<th>Hora de Salida </th>
			<th>Hora de Llegada </th>
			<th>Ciudad</th>
			<th>Linea</th>
			<th>Estacion Inicio</th>
			<th>Estacion Final </th>
			</tr>
		";
foreach ($datos as $row) {
	
	/* $html = $html . '<b> ' . $row->id_itinerario . '</b>' ; */
	$html = $html . '
			
			<tr>
			<td>'. $row->id_itinerario .' </td>' .
			'<td>'. $row->hora_salida . '</td>' .
			'<td>'. $row->hora_llegada .'</td>' .
			'<td>' . $row->nombre_ciudad . '</td>'. 
			'<td>'. $row->detalle_linea .'</td>' .
			'<td>'. $row->detalle_estacion_inicio .'</td>' .
			'<td>'. $row->detalle_estacion_final .'</td>' .
			'</tr>';

}
	$html .= '</table>';

$mpdf->WriteHTML($html );

$mpdf->Output();