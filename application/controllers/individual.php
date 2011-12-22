<?php 

class Individual extends CI_Controller {

	public function index($username=null)
	{
		$this->load->model('TaskModel');
		$this->load->helper('form');
		
		$session = $this->session->all_userdata();

		if($username == null || $username == $session['username']){
			$data['user'] = $session['username'];
			$data['title'] = lang('individual_title',array('My'));
		}
		else{
			$data['user'] = $username;
			$data['title'] = lang('individual_title',array($username));
		}

		$data['taskList'] = $this->TaskModel->getTasksForTasker($username);
		$data['listUrl'] = site_url("lists/showUserLists/".$data['user']);
		
		$data['empty_list'] = lang('error_user_noTasks',array($username,$username));
		$this->load->view('taskListMasterView',$data);
	}
}