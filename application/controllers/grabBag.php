<?php 

class GrabBag extends CI_Controller {
    public function index()
    {
		$this->load->model('TaskModel');
		$this->load->helper('form');
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('taskName', 'Task Name', 'required');
		
		$session = $this->session->all_userdata();
		
		$data['taskList'] = $this->TaskModel->showAllUnassigned();
		$data['title'] = $this->lang->line('grabbag_title');
		$data['listUrl'] = site_url("lists");
		$data['empty_list'] = lang('error_grabbag_noTasks',array(lang('grabbag_text')));
		$this->load->view('taskListMasterView',$data);
    }
}