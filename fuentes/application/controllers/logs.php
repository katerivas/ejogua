<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class logs extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('Mpdf/Mpdf');
		$this->load->model('logs_m');
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
						redirect('/logs/error', 'location');

				}
		}
	}
	public function error(){
		$this->load->view('/paginas/error');
	}

	public function index()
	{
		$resultado = $this->logs_m->get_logs();
		$data = array('datos'=> $resultado->result());

		$this->load->view('paginas/ver_logs', $data);
	}

	public function get_logs(){
		$this->load->view('paginas/ver_logs');
	}
}
