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


		public function mostrar_tarjetas_usuario($id_usuario){
			$this->db->select('id_usuario, id_tarjeta, numero_tarjeta, codigo_seguridad, tipo_tarjeta, id_estado');
			$this->db->from('tarjeta');
			$this->db->where('id_usuario', $id_usuario);
			$query = $this->db->get();

			return $query->result();
		}

	//funcion para ver informacion sobre la tarjeta seleccionada
	public function mostrar_id_tarjeta_seleccionada($id_tarjeta){
		$this->db->select('*');
		$this->db->from('tarjeta');
		$this->db->where('id_tarjeta', $id_tarjeta);
		$query = $this->db->get();
		return $query->result();
	}

	public function actualizar_tarjeta($id_tarjeta,$data){
		$this->db->where('id_tarjeta', $id_tarjeta);
		$this->db->update('tarjeta', $data);
		return true;
	}
}
