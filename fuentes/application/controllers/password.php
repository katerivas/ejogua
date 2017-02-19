<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class password extends CI_Controller {
	public function __construct(){
		parent::__construct();
    $this->load->model('password_m');
    $this->load->library('form_validation');
    $this->load->helper('form');
    $this->load->library('session');
    $this->load->helper('url');
  }

public function index(){
  $this->load->view('paginas/cambiar_password');
}

public function check_password(){
  $this->form_validation->set_rules('conf_password', 'conf_password', 'trim|required|matches[password]');
  $this->form_validation->set_rules('password', 'password', 'trim|required');
  if (isset($this->session->userdata['logged_in'])) {
    $username = ($this->session->userdata['logged_in']['usuario']);
    $id_usuario = ($this->session->userdata['logged_in']['id_usuario']);
    if($this->form_validation->run()==true){
      $password = $this->input->post('password');
      $conf_password = $this->input->post('conf_passsword');

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
        echo"error";
        $data['success'] = false;
        $data['error'] = "No se puede modificar";
        echo json_encode($data);
      }
    }else{
        echo"error";
        $data['success'] = false;
        $data['error'] = validation_errors();
        echo json_encode($data);
    }
  }
}
}
?>
