<?php 

class GrabBag extends CI_Controller {
    public function index()
    {
		$this->load->model('TaskModel');
		$this->load->helper('form');
		
		$data['title'] = $this->lang->line('grabbag_title');
		$data['empty_list'] = lang('error_grabbag_noTasks',array(lang('grabbag_text')));
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