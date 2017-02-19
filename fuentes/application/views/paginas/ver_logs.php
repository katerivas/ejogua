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
		<h2>Logs </h2>

		<table>
			<tr>
			<th>ID</th>
			<th>Query </th>
			<th>Fecha / Hora </th>
			<th>ID Usuario</th>
			<th>Uri_String</th>
			<th>Params</th>

			</tr>
		";
foreach ($datos as $row) {

	/* $html = $html . '<b> ' . $row->id_itinerario . '</b>' ; */
	$html = $html . '

			<tr>
			<td>'. $row->id .' </td>' .
			'<td>'. $row->query . '</td>' .
			'<td>'. $row->fecha_hora .'</td>' .
			'<td>' . $row->id_usuario . '</td>'.
			'<td>'. $row->uri_string .'</td>' .
			'<td>'. $row->params .'</td>' .

			'</tr>';

}
	$html .= '</table>';

$mpdf->WriteHTML($html );

$mpdf->Output();
