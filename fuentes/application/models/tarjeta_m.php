<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class tarjeta_m extends CI_Model
{


	public function registro_tarjeta($data){
		$resultado = $this->db->insert('tarjeta', $data);
		return $resultado;
	}
}
?>