<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class reclamos extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('reclamos_m', 'reclamos');
	}

	
	public function index()
	{
		//$this->load->helper(array('form'));
		$this->load->view('paginas/registro_reclamos');
	}

	public function obtener_datos_reclamos(){
		$tipo_reclamo = $this->input->post('tipo_reclamo', true);
		$detalle_reclamo =$this->input->post('detalle_reclamo', true);
		$resultado = $this->reclamo->registro_reclamo($tipo_reclamo, $detalle_reclamo);
	}

	public function vista_usuario(){
		$this->load->view('paginas/registro_reclamos');
	}

	public function registro_reclamos(){
		$data = array(
				/* 'usuario' => $this->input->post('usuario',true), */
				'tipo_reclamo' =>$this->input->post('tipo_reclamo', true),
				'detalle_reclamo' => $this->input->post('detalle_reclamo', true),
				
		);
			
		/*  var_dump($data);
		 die(); */

		$this->load->model('reclamos_m', 'reclamos');
		$resultado = $this->reclamos->registro_reclamos($data);
		var_dump($resultado);
		die();

	}
}

?>