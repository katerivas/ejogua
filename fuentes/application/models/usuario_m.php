<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Usuario_m extends CI_Model{
	function login($usuario, $password)
	{
		$this-> db -> select('id_usuario, usuario');
		$this-> db -> from('usuarios');
		$this-> db -> where('usuario', $usuario);
		$this-> db -> where('password', md5($password));
		$this-> db -> limit(1);
		$query = $this -> db -> get();
		return $query;
	}

	public function read_user_information($username) {

		$condition = "usuario =" . "'" . $username . "'";
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where($condition);
		$this->db->limit(1);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
		return $query->result();
		} else {
		return false;
		}
	}

	public function is_admin($id_usuario){
		$this->db->select('r.id_rol as id_rol');
		$this->db->where('u.id_usuario',$id_usuario);
		$this->db->join('roles r', 'u.id_rol =  r.id_rol');
		$this->db->where('r.detalle', 'administrador');
		return $this->db->get('usuarios u');
	}

	public function agregar_usuario($data){
		$resultado = $this->db->insert('usuarios', $data);
		return $resultado;
	}

	public function ver_datos_usuario($id_usuario){
		$this->db->select('*');
		$this->db->where('id_usuario', $id_usuario);
		$query = $this->db->get('usuarios');
		return $query->result();
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

	public function ver_usuarios()
	{
		$this->db->select('u.id_usuario as id_usuario,
											u.usuario as usuario,
											r.detalle as detalle_rol,
											g.detalle as detalle_grupo,
											e.detalle as detalle_estado');
		$this->db->from('usuarios u');
		$this->db->join('roles r', 'u.id_rol = r.id_rol');
		$this->db->join('grupos g', 'u.id_grupo = g.id_grupo');
		$this->db->join('estados e', 'u.id_estado = e.id_estado');
		$query = $this->db->get();
		return $query->result();
	}

	public function actualizar($id_usuario,$data){
		$this->db->where('id_usuario', $id_usuario);
		return $this->db->update('usuarios', $data);
	}

	public function mostrar_id_usuario_seleccionado($id_usuario){
		$this->db->select('*');
		$this->db->from('usuarios');
		$this->db->where('id_usuario', $id_usuario);
		$query = $this->db->get();
		return $query->result();

	}


	public function actualizar_usuario($id_usuario,$data){
		$this->db->where('id_usuario', $id_usuario);
		$this->db->update('usuarios', $data);
		return true;
	}

	public function select_roles(){
		$this->db->select('*');
		$resultado = $this->db->get('roles');
		return $resultado->result();
	}

	function existe($usuario)
		{
			$this->db->where('usuario', $usuario);
			$query = $this->db->get('usuarios');
			if ($query->num_rows() > 0){
				return true;
			}
			else{
				return false;
			}
		}

	// public function ver_datos_por_id($id_estado){
	// 	$this->db->select('*');
	// 	$this->db->from('usuarios');
	// 	$this->db->where('id_estado', $id_estado);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }


}
