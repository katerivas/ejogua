<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class tarjeta_m extends CI_Model{


	public function registro_tarjeta($data){
		$resultado = $this->db->insert('tarjeta', $data);
		return $resultado;
	}

function existe($numero_tarjeta)
	{
		$this->db->where('numero_tarjeta', $numero_tarjeta);
		$query = $this->db->get('tarjeta');
		if ($query->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}
}
