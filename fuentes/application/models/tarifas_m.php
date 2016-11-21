<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class tarifas_m extends CI_Model {
	/**
	 * Modelo para manejo de consulta de saldo
	 */
	public function __construct(){
		parent::__construct();
	}

	public function get_listado_tarifas(){

		$this->db->select('l.detalle as detalle_linea,
					e.detalle as estacion_inicio_detalle,
					e1.detalle as estacion_final_detalle,
					u.detalle as tipo_usuario_detalle,
					tar.monto');
		$this->db->from('tarifas tar');
		$this->db->join('lineas l', 'l.id_linea = tar.id_linea');
		$this->db->join('estaciones e', 'e.id_estacion = tar.estacion_inicio');
		$this->db->join('estaciones e1', 'e1.id_estacion = tar.estacion_final');
		$this->db->join('tipos_usuario u', 'u.tipo_usuario = tar.tipo_usuario');
		$resultado = $this->db->get();
		/* 		echo "last query: " . $this->db->last_query();
			die();  */
	/* 	var_dump($resultado);
		die(); */
		return $resultado;
	}
}
