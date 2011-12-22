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
			$data['title'] = lang('universal_title');
			$data['taskList'] = $this->TaskModel->showAll();
			$data['listUrl'] = site_url("lists");
			$data['empty_list'] = lang('error_universal_noTasks');
			$this->load->view('default/nav',$data);
			$this->load->view('taskListMasterView',$data);
		}
		
        $this->load->view('default/footer');
    }
}