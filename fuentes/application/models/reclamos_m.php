<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class reclamos_m extends CI_Model
{


	public function registro_reclamos($data){
		$resultado = $this->db->insert('reclamos', $data);
		return $resultado;
	}
}
?>