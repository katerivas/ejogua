<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class logs_m extends CI_Model {
	/**
	 * Modelo para manejo de consulta de saldo
	 */
	public function __construct(){
		parent::__construct();
	}

	public function get_logs(){

		$this->db->select('*');
		$resultado = $this->db->get('query_logs');
		return $resultado;
	}
}
