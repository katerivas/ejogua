<?php
Class Usuario_m extends CI_Model
{
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
}
?>