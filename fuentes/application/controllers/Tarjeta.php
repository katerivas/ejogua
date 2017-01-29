<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tarjeta extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('tarjeta_m', 'tarjeta');
		$this->load->library('form_validation');
		$this->load->helper('form');
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
		$resultado = $this->tarjeta->registro_tarjeta($numero_tarjeta, $codigo_seguridad, $tipo_tarjeta);
		
/* 		if($resultado->num_rows()>0){
			$this->load->view('tarjeta/inicio');
		}else{
			//redirect("/usuario","refresh");
			$data['mensaje']='Usuario o password incorrecto';
			$this->load->view('paginas/login',$data);
		} */
			
	}
	
	public function vista_usuario(){
		$this->load->view('paginas/registro_tarjeta');
	}
	
	public function registro_tarjeta(){
		$this->form_validation->set_rules('numero_tarjeta','numero_tarjeta', 'required|numeric');
		$this->form_validation->set_rules('codigo_seguridad','codigo_seguridad', 'required|numeric');
		if($this->form_validation->run()==true){
			$id_usuario = $this->session->userdata('id_usuario');
			$data = array(
			'id_usuario' => $id_usuario,
			'numero_tarjeta' =>$this->input->post('numero_tarjeta', true),
			'codigo_seguridad' => $this->input->post('codigo_seguridad', true),
			'tipo_tarjeta' =>$this->input->post('tipo_tarjeta',true)
			 );
			 
			/*  var_dump($data);
			 die(); */
		
			$this->load->model('tarjeta_m', 'tarjeta');
			$resultado = $this->tarjeta->registro_tarjeta($data);
			// Vista tarjeta.
			echo json_encode($resultado);
		}else{
				$data['error'] = validation_errors();
				$data['success'] = false;
				echo json_encode($data);
				// update not successful
	}
	}
	}


?>