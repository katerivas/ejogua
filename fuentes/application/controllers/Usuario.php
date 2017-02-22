<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuario extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('usuario_m', 'usuario');
		$this->load->library('form_validation');
		$this->load->library('session');
		if (! $this->session->userdata('logged_in'))
		{
				// Allow some methods?
				$allowed = array(

						'logout',
						'ver_datos_usuario',
						'modificar_usuario',
						'vista_usuario',
						'ver_usuarios',
						'agregar_usuario',
						'mostrar_usuarios',
						'actualizar_usuario'
						);
				if ( in_array($this->router->fetch_method(), $allowed))
				{
						// $this->load->helper('url');
						// redirect('/paginas/error');
						// $this->load->view('/paginas/error');
						// $this->load->view('/paginas/error');
						$this->load->helper('url');
						redirect('/usuario/error', 'location');


				}
		}
}

public function error(){
	$this->load->view('/paginas/error');
}

	public function index(){
		$this->load->view('paginas/login');
	}
	function logout()
	{
			$this->session->sess_destroy();
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
			$this->session->set_userdata('logged_in', $usuario_sesion);
					$this->load->view('inicio/inicio');
		}else{
			 //redirect("/usuario","refresh");
			 $data['mensaje'] = 'Usuario o password incorrecto';
			 $this->load->view('paginas/login', $data);
		}
	}

	public function ver_datos_usuario(){
		if (isset($this->session->userdata['logged_in'])) {
			$username = ($this->session->userdata['logged_in']['usuario']);
			$id_usuario = ($this->session->userdata['logged_in']['id_usuario']);
			$this->load->model('usuario_m');
			$data['resultado'] = $this->usuario_m->ver_datos_usuario($id_usuario);
			$this->load->view('paginas/modificar_usuario',$data);
		} else {
			header("location: login");
		}
	}

	public function modificar_usuario(){
		$this->form_validation->set_rules('nombre','nombre', 'required');
		$this->form_validation->set_rules('apellido','apellido', 'required');
		$this->form_validation->set_rules('nro_ci','nro_ci', 'required|numeric');
		$this->form_validation->set_rules('direccion','direccion', 'required');
		$this->form_validation->set_rules('email','email', 'required');
		$this->form_validation->set_rules('telefono','telefono', 'required');

		if($this->form_validation->run()==true){
			if (isset($this->session->userdata['logged_in'])) {
				$username = ($this->session->userdata['logged_in']['usuario']);
				$id_usuario = ($this->session->userdata['logged_in']['id_usuario']);
				$data = array(
						'nombre' => $this->input->post('nombre'),
						'apellido' => $this->input->post('apellido'),
						'nro_ci' => $this->input->post('nro_ci'),
						'direccion' => $this->input->post('direccion'),
						'email' => $this->input->post('email'),
						'direccion' => $this->input->post('email'),
						'telefono' => $this->input->post('telefono'),
				);
				$this->load->model('usuario_m');
				$v_data['resultado'] = $this->usuario_m->actualizar($id_usuario, $data);
				$v_data['success'] = true;
				echo json_encode($v_data);
			}
		}else{
		     $v_data['error'] = validation_errors();
			   $v_data['success'] = false;
			   echo json_encode($v_data);
		}
	}

	public function vista_usuario(){
		$this->load->view('paginas/registro_usuario');
	}

  //Menu vista del usuario
	public function ver_usuarios(){
		$id_usuario = ($this->session->userdata['logged_in']['id_usuario']);
		//buscar id rol del usuario obtenido
		$id_rol = $this->usuario->is_admin($id_usuario);


		if($id_rol->num_rows()> 0){
				$this->mostrar_usuarios();
		}else{
			$this->load->view('paginas/admin');
		}

	}

	public function agregar_usuario(){
		$this->form_validation->set_rules('nombre','nombre', 'required');
		$this->form_validation->set_rules('apellido','apellido', 'required');
		$this->form_validation->set_rules('nro_ci','nro_ci', 'required|numeric');
		$this->form_validation->set_rules('direccion','direccion', 'required');
		$this->form_validation->set_rules('email','email', 'required');
		$this->form_validation->set_rules('telefono','telefono', 'required');
		if($this->form_validation->run()==true){
		 $data = array(
			 'usuario' => $this->input->post('usuario',true),
			 'password' => md5($this->input->post('password',true)),
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
			 'id_descuento'=> 1,
			 'id_estado' => 1
		 );

		 $this->load->model('usuario_m');
		 $usuario = $this->input->post('usuario', true);
		 $existe = $this->usuario_m->existe($usuario);
		 if($existe == false){
				$this->load->model('usuario_m', 'usuario');
				$resultado = $this->usuario->agregar_usuario($data);
				$data['success'] = true;
				echo json_encode($data);
			}else{
				$data['success'] = false;
				$data['error'] = "Error al agregar nuevo usuario. El usuario ya existe.";
				echo json_encode($data);
			}
	}else{
		$data['success'] = false;
		$data['error'] = validation_errors();
		echo json_encode($data);
	}
	}


	public function mostrar_usuarios(){
		$id_usuario = ($this->session->userdata['logged_in']['id_usuario']);
		//buscar id rol del usuario obtenido
		$id_rol = $this->usuario->is_admin($id_usuario);


		if($id_rol->num_rows()> 0){
			$id_usuario = $this->uri->segment(3);
			$this->load->model('usuario_m');
			$data['usuarios'] = $this->usuario_m->ver_usuarios();
			$data['usuario_seleccionado'] = $this->usuario_m->mostrar_id_usuario_seleccionado($id_usuario);
			$data['roles'] = $this->usuario_m->select_roles();
			$this->load->view('paginas/administrar_usuarios',$data);

		}else{
			$this->load->view('paginas/admin');
		}



	}

	public function actualizar_usuario(){
		$id_usuario = ($this->session->userdata['logged_in']['id_usuario']);
		//buscar id rol del usuario obtenido
		$id_rol = $this->usuario->is_admin($id_usuario);
		//echo "last query: " . $this->db->last_query();
		// var_dump($id_rol->result());
		// die();
		if($id_rol->num_rows()> 0){
			//es admin
			//$this->form_validation->set_rules('usuario','usuario', 'required|alpha');
			if($this->form_validation->run()==false){
					$data = array(
						// 'usuario' =>$this->input->post('usuario', true),
						'id_rol' =>$this->input->post('id_rol', true),
						'id_estado' => $this->input->post('id_estado',true)
						// 'password' => $this->input->post(md5('password'),true)
					);
					// $this->load->model('usuario_m');
					// $usuario = $this->input->post('usuario', true);
					// $existe = $this->usuario_m->existe($usuario);
					// if($existe == false){
						$this->load->model('usuario_m');
						$id_usuario = $this->input->post('id_usuario', true);
						$resultado = $this->usuario_m->actualizar_usuario($id_usuario,$data);
						$data['resultado'] = $resultado;
						$data['success'] = true;
						echo json_encode($data);
				// }else{
				// 	$data['success'] = false;
				// 	$data['error'] = "Usuario no modificado. El nombre de usuario que intenta  modificar ya existe.";
				// 	echo json_encode($data);
				// }
		}else{
			$data['success'] = false;
			$data['error'] = "Hubo un error";
			echo json_encode($data);
		}
	}else{
		$this->load->view('paginas/admin');
	}
}
}
