<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class tarifas extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('Mpdf/Mpdf');
		$this->load->model('tarifas_m', 'tarifas');
		if (! $this->session->userdata('logged_in'))
		{
				// Allow some methods?
				$allowed = array(
						'index',
						'get_listado_tarifas'
				);
				if ( in_array($this->router->fetch_method(), $allowed))
				{
						// $this->load->helper('url');
						// redirect('/paginas/error');
						// $this->load->view('/paginas/error');
						// $this->load->view('/paginas/error');
						$this->load->helper('url');
						redirect('/reclamos/error', 'location');


				}
		}
	}
	public function error(){
		$this->load->view('/paginas/error');
	}

	public function index()
	{
		$resultado = $this->tarifas->get_listado_tarifas();
		$data = array('datos'=> $resultado->result());
		$this->load->view('paginas/reporte_tarifas', $data);
	}

	public function get_listado_tarifas(){
		$this->load->view('paginas/reporte_tarifas');
	}
}
