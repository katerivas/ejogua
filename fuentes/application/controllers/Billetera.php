<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Billetera extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('billetera_m', 'billetera');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->load->library('session');
		//Autenticación
		if ( $this->session->userdata('logged_in'))
    {
        // Allow some methods?
        $allowed = array(
            'index'

        );
        if ( in_array($this->router->fetch_method(), $allowed))
        {
						// $this->load->helper('url');
            // redirect('/paginas/error');
						// $this->load->view('/paginas/error');
						// $this->load->view('/paginas/error');
						$this->load->helper('url');
						redirect('/billetera/error', 'location');


        }
    }


	}

	public function error(){
		$this->load->view('paginas/error');
	}

	public function index(){
		$this->load->view('paginas/billetera');
	}

	public function v_versaldo(){
		$this->obtener_datos();
	}

	public function v_cargarsaldo(){
		$this->obtener_datos2();
	}

	// funciona ok!!!!
	//public function consultar_saldo(){
	// 	$this->form_validation->set_rules('numero_tarjeta','numero_tarjeta', 'required|numeric');
	// 	if($this->form_validation->run()==true){
	// 		$nro_tarjeta = $this->input->post('numero_tarjeta', true);
	// 		$resultado = $this->billetera->listarSaldo($nro_tarjeta)->result();
	//
	// 		// Vista billetera.
	// 		$data['datos'] = $resultado;
	// 		$data['success'] = true;
	// 		echo json_encode($data);
	// 	}else{
	// 		 // Vista billetera.
	// 		 $data['error'] = form_error('numero_tarjeta');
	// 		 $data['success'] = false;
	// 		 echo json_encode($data);
	// 	}
	// }
//combobox para mostrar tarjetas desde consulta de saldo
public function obtener_datos(){
	if (isset($this->session->userdata['logged_in'])) {
		$username = ($this->session->userdata['logged_in']['usuario']);
		$id_usuario = ($this->session->userdata['logged_in']['id_usuario']);
		$this->load->model('billetera_m');
		$data1['tarjetas'] = $this->billetera_m->get_tarjetas($id_usuario);
		$this->load->view('/paginas/billetera', $data1);
	// }else {
	// 	# code...
	// 	echo "Error de autenticacion";
	// 	header("location: login");
	// }
}
}
//combobox para mostrar tarjetas desde carga de saldo
	public function obtener_datos2(){
		if (isset($this->session->userdata['logged_in'])) {
			$username = ($this->session->userdata['logged_in']['usuario']);
			$id_usuario = ($this->session->userdata['logged_in']['id_usuario']);
			$this->load->model('billetera_m');
			$data1['tarjetas'] = $this->billetera_m->get_tarjetas($id_usuario);
			$this->load->view('/paginas/cargar_saldo', $data1);
		}
	}
	public function consultar_saldo()
	{
					$numero_tarjeta = $this->input->post('numero_tarjeta',true);
					$this->load->model('billetera_m');
					$resultado = $this->billetera_m->listarSaldo($numero_tarjeta);
					$data['datos'] = $resultado->result();
					// var_dump($data);
					// die();
					$data['success'] = true;
					echo json_encode($data);
	}

	public function cargar_saldo()
	{
		$this->form_validation->set_rules('monto','monto', 'required|numeric');
		if($this->form_validation->run()==true)
		{

				if (isset($this->session->userdata['logged_in']))
				{
					$username = ($this->session->userdata['logged_in']['usuario']);
					$id_usuario = ($this->session->userdata['logged_in']['id_usuario']);
					$data = array(
						'numero_tarjeta' => $this->input->post('numero_tarjeta', true),
						'saldo' => $this->input->post('monto', true),
						'id_usuario' => $id_usuario
					);
					$this->load->model('billetera_m'); // load the model first
					if($this->billetera_m->cargar_saldo($data))
					{
							$resultado = $this->billetera_m->cargar_saldo($data);
							$data['datos'] = $resultado;
							$data['success'] = true;
							echo 'Ok Actualizado';
					}

				// }else {
				// 		header("location: login");
				// }
	}else{
				echo "holaaa";
				$data['error'] = validation_errors();
				$data['success'] = false;
				// echo json_encode($data);
				// update not successful
			}
		}
}
}
