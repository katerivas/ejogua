<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Itinerarios extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('Mpdf/mpdf');
		$this->load->model('itinerarios_m', 'itinerarios');
		if ( $this->session->userdata('logged_in'))
		{
				// Allow some methods?
				$allowed = array(

				);
				if ( in_array($this->router->fetch_method(), $allowed))
				{
						// $this->load->helper('url');
						// redirect('/paginas/error');
						// $this->load->view('/paginas/error');
						// $this->load->view('/paginas/error');
						$this->load->helper('url');
						redirect('/itinerarios/error', 'location');


				}
		}

}

public function error(){
	$this->load->view('/paginas/error');
}


	public function index()
	{
		$resultado = $this->itinerarios->get_listado_itinerarios();
		$data = array('datos'=> $resultado->result());
		$this->load->view('paginas/reporte_itinerarios', $data);
	}

}
