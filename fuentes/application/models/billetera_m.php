<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class billetera_m extends CI_Model {
	/**
	 * Modelo para manejo de consulta de saldo
	 */
	public function __construct(){
		parent::__construct();
	}

	public function listarSaldo($nro_tarjeta){
	  	$this->db->select("saldo");
	  	$this->db->where("id_tarjeta", $nro_tarjeta);
	  	$v_consulta = $this->db->get('billetera');
	  	return $v_consulta;
    }

	public function cargar_saldo($data) {
      	$numero_tarjeta = $data['id_tarjeta'];
      	$saldo_obtenido = $this->obtener_saldo($numero_tarjeta);
      	if ($saldo_obtenido	-> num_rows() > 0){
      		$resultado = $saldo_obtenido->row();
      		$saldo = $resultado -> saldo;
      		$data['saldo'] = $data['saldo'] + $saldo;
     		$this->db->where('id_tarjeta', $data['id_tarjeta']);
      		$this->db->update('billetera', $data);
      		//echo $this->db->last_query();
      		//die();
      		return true;
      	}
	}

    public function obtener_saldo($numero_tarjeta){
      	$this->db->select('saldo');
      	$this->db->where('id_tarjeta', $numero_tarjeta);
      	$resultado = $this->db->get('billetera');
      	return $resultado;
      }
}
