<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tarjeta extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('tarjeta_m', 'tarjeta');
		$this->load->library('form_validation');
		$this->load->helper('form');
		if (! $this->session->userdata('logged_in'))
		{
				// Allow some methods?
				$allowed = array(
						'index',
						'obtener_datos_tarjeta',
						'vista_usuario',
						'mostrar_id_tarjeta',
						'actualizar_tarjeta',
						'registro_tarjeta'
				);
				if ( in_array($this->router->fetch_method(), $allowed))
				{
						// $this->load->helper('url');
						// redirect('/paginas/error');
						// $this->load->view('/paginas/error');
						// $this->load->view('/paginas/error');
						$this->load->helper('url');
						redirect('/tarjeta/error', 'location');


				}
		}
	}
	public function error(){
		$this->load->view('/paginas/error');
	}
	public function index()
	{
		//$this->load->helper(array('form'));
		$this->load->view('paginas/registro_tarjeta');

	}

	public function obtener_datos_tarjeta(){
		$numero_tarjeta = $this->input->post('numero_tarjeta', true);
		$codigo_seguridad =$this->input->post('codigo_seguridad', true);
		$tipo_tarjeta =$this->input->post('tipo_tarjeta', true);
		$id_usuario = $this->input->post('id_usuario', true);
		$resultado = $this->tarjeta->registro_tarjeta( $numero_tarjeta, $codigo_seguridad, $tipo_tarjeta);
	}

	public function vista_usuario(){
		$this->load->view('paginas/registro_tarjeta');
	}


	public function mostrar_id_tarjeta(){

		if (isset($this->session->userdata['logged_in'])) {
			$username = ($this->session->userdata['logged_in']['usuario']);
			$id_usuario = ($this->session->userdata['logged_in']['id_usuario']);
			$id_tarjeta = $this->uri->segment(3);
			$this->load->model('tarjeta_m');
			$data['tarjetas'] = $this->tarjeta_m->mostrar_tarjetas_usuario($id_usuario);
			$data['tarjeta_seleccionada'] = $this->tarjeta_m->mostrar_id_tarjeta_seleccionada($id_tarjeta);
			$this->load->view('paginas/ver_tarjetas',$data);
		}
		else {
			header("location: login");
		}
	}

	public function actualizar_tarjeta(){
		// $this->form_validation->set_rules('numero_tarjeta','numero_tarjeta', 'required|numeric');
		$this->form_validation->set_rules('codigo_seguridad','codigo_seguridad', 'required|numeric');
		if($this->form_validation->run()==true){
			$id_tarjeta = $this->input->post('id_tarjeta',true);
			$data = array(
				// 'numero_tarjeta' =>$this->input->post('numero_tarjeta', true),
				'tipo_tarjeta' => $this->input->post('tipo_tarjeta', true),
				'codigo_seguridad' =>$this->input->post('codigo_seguridad', true),
				'id_estado' =>$this->input->post('id_estado',true)
			);

			$this->load->model('tarjeta_m');
			// $numero_tarjeta = $this->input->post('numero_tarjeta', true);
			// $existe = $this->tarjeta_m->validar_tarjeta($numero_tarjeta);
			// if($existe == false){
				if($this->tarjeta_m->actualizar_tarjeta($id_tarjeta,$data))
				{
						$resultado = $this->tarjeta_m->actualizar_tarjeta($id_tarjeta,$data);
						//$data['datos'] = $resultado;
						$data['resultado'] = $resultado;
						$data['success'] = true;
						echo json_encode($data);
				}
			// }else{
			// 	$data['success'] = false;
			// 	$data['error'] = "Error al modificar. El n&uacutemero de tarjeta ya existe.";
			// 	echo json_encode($data);
			// }
		}else{

					$data['error'] = validation_errors();
					$data['success'] = false;
					echo json_encode($data);
		// //este si funciona!
		// $this->tarjeta_m->actualizar_tarjeta($id_tarjeta,$data);
		// $data['datos'] = $resultado->result();
		// // var_dump($data);
		// die();

	}

}
	public function registro_tarjeta(){
		if (isset($this->session->userdata['logged_in'])) {
			$username = ($this->session->userdata['logged_in']['usuario']);
			$id_usuario = ($this->session->userdata['logged_in']['id_usuario']);
			$this->form_validation->set_rules('numero_tarjeta','numero_tarjeta', 'required|numeric');
			$this->form_validation->set_rules('codigo_seguridad','codigo_seguridad', 'required|numeric');
			if($this->form_validation->run()==true){
					// $id_usuario = $this->session->userdata('id_usuario');
					$data = array(
						'id_usuario' => $id_usuario,
						'numero_tarjeta' =>$this->input->post('numero_tarjeta', true),
						'codigo_seguridad' => $this->input->post('codigo_seguridad', true),
						'tipo_tarjeta' =>$this->input->post('tipo_tarjeta',true),
						'id_estado' => $this->input->post('id_estado'),
						'saldo' => 0
					 );
					//$this->load->model('tarjeta_m', 'tarjeta');
					$this->load->model('tarjeta_m');
					$numero_tarjeta = $this->input->post('numero_tarjeta', true);
					$existe = $this->tarjeta_m->validar_tarjeta($numero_tarjeta);
					if($existe == false){
						$resultado = $this->tarjeta->registro_tarjeta($data);
						// Vista tarjeta.
						$data['datos'] = $resultado;
						$data['success'] = true;
						echo json_encode($data);
					}else{
							$data['error'] = "No se pudo agregar. La tarjeta ya existe";
							$data['success'] = false;
							echo json_encode($data);
					}
				}else{
						//$data['error'] = "La tarjeta ya existe";
						$data['error'] = validation_errors();
						$data['success'] = false;
						echo json_encode($data);
					}
				}
	}

}
