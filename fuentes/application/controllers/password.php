<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class password extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if (! $this->session->userdata('logged_in'))
		{
				// Allow some methods?
				$allowed = array(
							'index',
							'check_password'
				);
				if ( in_array($this->router->fetch_method(), $allowed))
				{
						// $this->load->helper('url');
						// redirect('/paginas/error');
						// $this->load->view('/paginas/error');
						// $this->load->view('/paginas/error');
						$this->load->helper('url');
						redirect('/password/error', 'location');


				}
		}


    $this->load->model('password_m');
    $this->load->library('form_validation');
    $this->load->helper('form');
    $this->load->library('session');
    $this->load->helper('url');
  }

		public function error(){
			$this->load->view('/paginas/error');
		}

public function index(){
  $this->load->view('paginas/cambiar_password');
}

public function check_password(){
  $this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('conf_password', 'conf_password', 'trim|required|matches[password]');
  if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['usuario']);
    $id_usuario = ($this->session->userdata['logged_in']['id_usuario']);
    if($this->form_validation->run()==true){
      $password = $this->input->post('password');
      $conf_password = $this->input->post('conf_password');

      if($password == $conf_password){
          //agregar a la bd
          $data = array(
              'password' => $this->input->post('password', true),
              'id_usuario' => $this->session->userdata['logged_in']['id_usuario'],
          );

          $this->load->model('password_m');
          $resultado = $this->password_m->modificar_password($data);
          $data['resultado'] = $resultado;
          $data['success'] = true;
          echo json_encode($data);
      }else{
           $data['success'] = true;
           $data['error'] = "No se puede modificar";
           echo json_encode($data);
      }
    }else{
        $data['success'] = true;
        $data['error'] = validation_errors();
        echo json_encode($data);
    }

		//poner el else del isset
  }
}
}
?>
