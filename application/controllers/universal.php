<?php 

class Universal extends CI_Controller {


    public function index()
    {
		$this->load->model('TaskModel');
		$this->load->helper('form');
	
		$this->load->view('default/header');
		$this->load->view('authentication/loginForm');	
		
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
			$data['results'] = $this->TaskModel->showAll();
			$this->load->view('default/nav',$data);
			$this->load->view('universal',$data);
		}
		
        $this->load->view('default/footer');
    }
}