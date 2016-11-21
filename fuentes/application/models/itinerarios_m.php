<?php
class itinerarios_m extends CI_Model {
	/**
	 * Modelo para manejo de consulta de saldo
	 */
	public function __construct(){
		parent::__construct();
	}
	
	public function get_listado_itinerarios(){
		
			$this->db->select('i.id_itinerario, i.hora_salida,
					i.hora_llegada,
					c.nombre_ciudad,
					i.id_linea, 
					l.detalle as detalle_linea, 
					e.detalle as detalle_estacion_inicio,
					e1.detalle as detalle_estacion_final');
			$this->db->from('itinerarios i');
			$this->db->join('ciudades c', 'i.id_ciudad = c.id_ciudad');
			$this->db->join('lineas l', 'l.id_linea = i.id_linea');
			$this->db->join('estaciones e', 'e.id_estacion = i.estacion_inicio');
			$this->db->join('estaciones e1', 'e1.id_estacion = i.estacion_final');
			$resultado = $this->db->get();
/* 			echo "last query: " . $this->db->last_query();
			die(); */
			return $resultado;
		}
}
