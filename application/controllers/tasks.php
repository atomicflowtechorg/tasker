<?php 

class Tasks extends CI_Controller {

    public function index()
    {
		redirect('/', 'location');
    }
	
	public function delete($pkTaskId)
	{
		
		$this->load->model('Task');
		$this->load->helper('form');
		
		$this->Task->deleteTask($pkTaskId);
		redirect('/','location');
	}
	
	public function view($pkTaskId,$teamMember = null)
	{
		$this->load->helper('MY_Form_helper');
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest")
		{
			$this->load->model('Task');
			$this->load->model('User');
			$this->load->library('form_validation');
			$this->load->helper('form');
			
			//TODO: Requires javascript validation to prevent new page load on invalid update
			
			$session = $this->session->all_userdata();
			if(isset($session['logged_in']) && $session['logged_in']==TRUE){
				$data['task'] = $this->Task->getTaskData($pkTaskId);
				$data['users'] = $this->User->get_all_usernames();
				$data['statusOptions'] = $this->Task->getAllStatusOptions();
				$this->load->view('tasks/view',$data);
			}
        }
        else
        {
			$this->load->model('Task');
			$this->load->model('User');
			$this->load->library('form_validation');
			$this->load->helper('form');
			
			$this->form_validation->set_rules('name', 'name', 'required');
			
			$session = $this->session->all_userdata();
			if(isset($session['logged_in']) && $session['logged_in']==TRUE){
				$data['task'] = $this->Task->getTaskData($pkTaskId);
				$data['users'] = $this->User->get_all_usernames();
				$data['statusOptions'] = $this->Task->getAllStatusOptions();
				$this->load->view('default/header');
				$this->load->view('default/nav',$data);

				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('tasks/view',$data);
				}
				else
				{
					$data['update'] = $this->Task->update();
					redirect('/','location');
				}
			}//end if loggid in
			
			$this->load->view('default/footer');
	        } 
	}
	
	public function assignTask($pkTaskId,$Tasker)
	{
		
		$this->load->model('Task');
		$this->load->helper('form');
			
		$data['task'] = $this->Task->getTaskData($pkTaskId);
		$this->load->view('tasks/task',$data);
	}
	
	public function assignTo($pkTaskId,$teamMember = null)
	{
		$this->load->model('Listmodel');
		$this->load->helper('MY_Form_helper');
		
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest")
		{
			$this->load->model('Task');
			$this->load->model('User');
			$this->load->library('form_validation');
			$this->load->helper('form');
				
			$session = $this->session->all_userdata();
			if(isset($session['logged_in']) && $session['logged_in']==TRUE){
				$data['task'] = $this->Task->getTaskData($pkTaskId);
				$data['users'] = $this->User->get_all_usernames();
				$data['statusOptions'] = $this->Task->getAllStatusOptions();
				$data['availableList'] = $this->Listmodel->getAllLists();
				$this->load->view('tasks/assignTo',$data);
			}
        }
        else
        {
			$this->load->model('Task');
			$this->load->model('User');
			$this->load->library('form_validation');
			$this->load->helper('form');
			
			$this->form_validation->set_rules('username', 'username', 'alpha');
			
			$session = $this->session->all_userdata();
			if(isset($session['logged_in']) && $session['logged_in']==TRUE){
				$data['task'] = $this->Task->getTaskData($pkTaskId);
				$data['users'] = $this->User->get_all_usernames();
				$data['statusOptions'] = $this->Task->getAllStatusOptions();
				$data['availableList'] = $this->Listmodel->getAllLists();
				$this->load->view('default/header');
				$this->load->view('default/nav',$data);

				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('tasks/assignTo',$data);
				}
				else
				{
					$data['update'] = $this->Task->updateUser();
				}
			}//end if loggid in
			
			$this->load->view('default/footer');
	        } 
	}

	function create($username = null)
	{
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest")
		{
			$this->load->model('Task');
			$this->load->model('User');
			$this->load->library('form_validation');
			$this->load->helper('form');
			
			$this->form_validation->set_rules('name', 'name', 'required');
			$session = $this->session->all_userdata();
			if(isset($session['logged_in']) && $session['logged_in']==TRUE){
				
				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('tasks/create');
				}
				else
				{
					$this->Task->addTask();
					redirect('/','location');
				}
			}
        }
        else
        {
			$this->load->model('Task');
			$this->load->model('User');
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			
			$this->form_validation->set_rules('taskName', 'task name', 'required');
			
			$this->load->view('default/header');
			$this->load->view('authentication/loginForm');
			
			$session = $this->session->all_userdata();
			if(isset($session['logged_in']) && $session['logged_in']==TRUE){
				
				if ($this->form_validation->run() == FALSE)
				{

				}
				else
				{
					$this->Task->addTask();
					redirect('/','location');
				}
				$this->load->view('default/nav');
				$this->load->view('tasks/create');
			}
		
		$this->load->view('default/footer');
       }
	}
}