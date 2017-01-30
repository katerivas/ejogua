<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Usuario_m extends CI_Model{
	function login($usuario, $password)
	{
		$this-> db -> select('id_usuario, usuario');
		$this-> db -> from('usuarios');
		$this-> db -> where('usuario', $usuario);
		$this-> db -> where('password', $password);
		$this-> db -> limit(1);
		$query = $this -> db -> get();
		return $query;
	}
	
	public function agregar_usuario($data){
		$resultado = $this->db->insert('usuarios', $data);
		return $resultado;
	}

//we will use the select function
	public function obtener_datos_usuario()
	{
		$this->db->select('*');
		$this->db->where('usuario', $usuario_sesion);
		//data is retrive from this query
		$query = $this->db->get('usuarios');
		return $query->result();
	}
	
	public function ver_datos_usuario($id_usuario)
	{
	
		$this->db->select('nombre, apellido, nro_ci, direccion, email, telefono');
		$this->db->where('id_usuario', $id_usuario);
		$this->db->from('usuarios');
		$query = $this->db->get();
		return $query->result();
	
	}
	
	public function actualizar($id_usuario,$data){
		$this->db->where('id_usuario', $id_usuario);
		$this->db->update('usuarios', $data);
		return true;
	}
}
