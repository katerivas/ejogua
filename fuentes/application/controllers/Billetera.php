<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Billetera extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('billetera_m', 'billetera');
		$this->load->library('form_validation');
		$this->load->helper('form');
	}

	public function index(){
		$this->load->view('paginas/billetera');
	}
	
	public function v_versaldo(){
		$this->load->view('paginas/billetera');
	}

	public function v_cargarsaldo(){
		$this->load->view('paginas/cargar_saldo');
	}

	public function consultar_saldo(){
		$this->form_validation->set_rules('numero_tarjeta','numero_tarjeta', 'required|numeric');
		if($this->form_validation->run()==true){
			$nro_tarjeta = $this->input->post('numero_tarjeta', true);
			$resultado = $this->billetera->listarSaldo($nro_tarjeta)->result();
			
			// Vista billetera.
			$data['datos'] = $resultado;
			$data['success'] = true;
			echo json_encode($data);
		}else{
			 // Vista billetera.
			 $data['error'] = form_error('numero_tarjeta');
			 $data['success'] = false;
			 echo json_encode($data);
		}
	}

	public function cargar_saldo(){
		$this->form_validation->set_rules('numero_tarjeta','numero_tarjeta', 'required|numeric');
		$this->form_validation->set_rules('monto','monto', 'required|numeric');
		if($this->form_validation->run()==true){
			$id_usuario = $this->session->userdata('id_usuario');
			$data = array(
				'numero_tarjeta' => $this->input->post('numero_tarjeta', true),
				'saldo' => $this->input->post('monto', true),
				'id_usuario' => $id_usuario
			);
			$this->load->model('billetera_m'); // load the model first
			if($this->billetera_m->cargar_saldo($data)) // call the method from the model
			{
				echo 'Ok Actualizado';
				// update successful
			}
			
		}else{
				$data['error'] = validation_errors();
				$data['success'] = false;
				echo json_encode($data);
				// update not successful
			}
	}


}
