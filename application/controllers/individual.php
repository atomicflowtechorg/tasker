<?php 

class Individual extends CI_Controller {
	

    public function index()
    {
		$this->load->model('TaskModel');
		$this->load->helper('form');
		
		$data['title'] = lang('individual_title',array('My'));
		
		$this->load->view('default/header');
		$this->load->view('authentication/loginForm');	
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
			$data['user'] = $session['username'];
			$data['taskList'] = $this->TaskModel->getTasksForTasker();
			$data['listUrl'] = site_url("lists/showUserLists/".$data['user']);
			$data['empty_list'] = lang('error_user_noTasks',array($data['user'],$data['user']));
			$this->load->view('default/nav');
			$this->load->view('taskListMasterView',$data);
		}

        $this->load->view('default/footer');
    }

	public function show($username=null)
	{
		$this->load->model('TaskModel');
		$this->load->helper('form');
	
		$this->load->view('default/header');
		$this->load->view('authentication/loginForm');	
		
		$session = $this->session->all_userdata();
		
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
		
			if($username==null || $username == $session['username'])
			{
				redirect(site_url('individual'), 'location');
			}
			else
			{
				$data['taskList'] = $this->TaskModel->getTasksForTasker($username);
				$data['user'] = $username;
				$data['listUrl'] = site_url("lists/showUserLists/".$data['user']);
				$data['title'] = lang('individual_title',array($username));
				$data['empty_list'] = lang('error_user_noTasks',array($username,$username));
				$this->load->view('default/nav');
				$this->load->view('taskListMasterView',$data);
			}
		}
        $this->load->view('default/footer');
		
	}
}