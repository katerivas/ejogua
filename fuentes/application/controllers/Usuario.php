<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class usuario extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('usuario_m', 'usuario');
	}

	public function index(){
		//$this->load->helper(array('form'));
		$this->load->view('paginas/login');
	}

	public function login(){
		$usuario = $this->input->post('usuario', true);
		$password =$this->input->post('password', true);
		$resultado = $this->usuario->login($usuario, $password);

		if($resultado->num_rows()>0){
			$resultado_bd = $resultado->row();
			$usuario_sesion = array(
					'id_usuario' => $resultado_bd->id_usuario,
					'usuario'  =>$resultado_bd->usuario,
					'logged_in' => TRUE
			);
			$this->session->set_userdata($usuario_sesion);


			$this->load->view('inicio/inicio');
		}else{
			 //redirect("/usuario","refresh");
			 $data['mensaje'] = 'Usuario o password incorrecto';
			 $this->load->view('paginas/login', $data);
		}

	}


	public function vista_usuario(){
		$this->load->view('paginas/registro_usuario');
	}

	public function agregar_usuario(){
		 $data = array(
			 'usuario' => $this->input->post('usuario',true),
			 'password' => $this->input->post('password',true),
			 'nombre' => $this->input->post('nombre',true),
			 'apellido' => $this->input->post('apellido',true),
			 'genero' => $this->input->post('genero',true),
			 'nro_ci' =>$this->input->post('nro_ci',true),
			 'direccion' =>$this->input->post('direccion',true),
			 'email' =>$this->input->post('email',true),
			 'telefono' =>$this->input->post('telefono',true),
			 'tipo_usuario' => 1,
			 'id_rol'=> 1,
			 'id_grupo'=> 1,
			 'id_descuento'=> 1
		 );
		/*  var_dump($data);
		 die(); */
		$this->load->model('usuario_m', 'usuario');
		$resultado = $this->usuario->agregar_usuario($data);
		var_dump($resultado);
		die();
	}
}

?>
