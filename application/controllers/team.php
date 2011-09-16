<?php 

class Team extends CI_Controller {


    public function index()
    {
    	//Page content configuration
        $this->load->library('image_lib');
        $this->load->library('form_validation');
        $this->load->helper('date');
		
		//User display test
		$this->load->model('User');
		
		$this->load->view('default/header');
		$this->load->view('authentication/loginForm');
		
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
			$data['users'] = $this->User->get_all_users();
			$this->load->view('default/nav');
			$this->load->view('team',$data);
		}
        $this->load->view('default/footer');
	}
	
}