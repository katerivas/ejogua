<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class password_m extends CI_Model {
	/**
	 * Modelo para manejo de consulta de saldo
	 */
	public function __construct(){
		parent::__construct();
	}

	public function modificar_password($data){
    $id_usuario = $data['id_usuario'];

    $this->db->where('id_usuario', $id_usuario);
		$this->db->update('usuarios', $data);
		return true;
	}
}
