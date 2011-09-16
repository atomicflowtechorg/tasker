<?php 

class GrabBag extends CI_Controller {


    public function index()
    {
		$this->load->model('Task');
		$this->load->helper('form');
		
		if($_POST){
			$this->Task->addTask();
		}
		
		$this->load->view('default/header');
		$this->load->view('authentication/loginForm');
		
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
			$data['results'] = $this->Task->showAllUnassigned();
			$this->load->view('default/nav',$data);
			$this->load->view('grabBag',$data);
		}
        $this->load->view('default/footer');
    }
}