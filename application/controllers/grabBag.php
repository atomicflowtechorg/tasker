<?php 

class GrabBag extends CI_Controller {
    public function index()
    {
		$this->load->model('TaskModel');
		$this->load->helper('form');
		
		
		$data['title'] = $this->lang->line('grabbag_title')." ".$this->lang->line('task_list');
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('taskName', 'Task Name', 'required');
		
		$this->load->view('default/header');
		$this->load->view('authentication/loginForm');
		
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
			$data['results'] = $this->TaskModel->showAllUnassigned();
			$this->load->view('default/nav',$data);
			$this->load->view('grabBag',$data);
		}
        $this->load->view('default/footer');
    }
}