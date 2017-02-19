<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Buscador_itinerarios extends CI_Controller {
	function __construct(){
		parent::__construct();
      $this->load->model('buscador_itinerarios_m');

			if (! $this->session->userdata('logged_in'))
			{
					// Allow some methods?
					$allowed = array(
							'index',
							'mostrar_itinerario_seleccionado'
					);
					if ( in_array($this->router->fetch_method(), $allowed))
					{
						$this->load->helper('url');
						redirect('/buscador_itinerarios/error', 'location');
					}
			}
  }

	public function buscar_itinerarios(){
		$this->index();
	}

	public function error(){
		$this->load->view('/paginas/error');
	}

  	public function index(){
       		// retrieve the album and add to the data array
          $this->load->model('buscador_itinerarios_m');
          $data1['estaciones'] = $this->buscador_itinerarios_m->get_estaciones();
					$this->load->view('paginas/buscador_itinerarios',$data1);
					//$this->mostrar_itinerario_seleccionado();
    }

		public function mostrar_itinerario_seleccionado(){
				$id_estacion_inicio = $this->input->post('id_estacion_inicio');
				$id_estacion_final = $this->input->post('id_estacion_final');
				// $id_estacion_inicio = 1;
				// $id_estacion_final = 2;
				$this->load->model('buscador_itinerarios_m');
				$resultado = $this->buscador_itinerarios_m->ver_itinerarios($id_estacion_inicio, $id_estacion_final);
				// var_dump($resultado);
				// die();
				if($resultado->num_rows()>0){
					$data['datos'] = $resultado->result();
					// $data = array('datos' => $resultado->result());
					//$this->load->view('paginas/buscador_itinerarios', $data);
					// $this->output->set_output(json_encode($data));
					$data['success'] = true;
					echo json_encode($data);
				}else{
					$data['success'] = false;
					echo json_encode($data);
				}
				// return json_encode($data);
		}

}
