<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Itinerarios extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('Mpdf/mpdf');
		$this->load->model('itinerarios_m', 'itinerarios');
	}

	public function v_itinerarios()
	{
		$this->load->view('paginas/reporte_itinerarios');
	}

	public function index()
	{
		$resultado = $this->itinerarios->get_listado_itinerarios();
		$data = array('datos'=> $resultado->result());
		$this->load->view('paginas/reporte_itinerarios', $data);
	}

	public function generar_reporte(){
		$this->load->view('paginas/reporte_itinerarios');
	}
}
