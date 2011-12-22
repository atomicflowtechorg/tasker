<?php 

class Universal extends CI_Controller {


    public function index()
    {
		$this->load->model('TaskModel');
		$this->load->helper('form');
		
		$session = $this->session->all_userdata();

		$data['title'] = lang('universal_title');
		$data['taskList'] = $this->TaskModel->showAll();
		$data['listUrl'] = site_url("lists");
		$data['empty_list'] = lang('error_universal_noTasks');
		$this->load->view('taskListMasterView',$data);
    }
}