<?php 

class Tasks extends CI_Controller {

    public function index()
    {
		redirect('/', 'location');
    }
	
	public function delete($pkTaskId)
	{
		
		$this->load->model('TaskModel');
		$this->load->helper('form');
		
		$this->TaskModel->deleteTask($pkTaskId);
		redirect('/','location');
	}
	
	public function view($pkTaskId,$teamMember = null)
	{
		$this->load->helper('MY_Form_helper');
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest")
		{
			$this->load->model('TaskModel');
			$this->load->model('UserModel');
			$this->load->library('form_validation');
			$this->load->helper('form');
			$this->lang->load('task');
			
			//TODO: Requires javascript validation to prevent new page load on invalid update
			
			$session = $this->session->all_userdata();
			if(isset($session['logged_in']) && $session['logged_in']==TRUE){
				$data['task'] = $this->TaskModel->getTaskData($pkTaskId);
				$data['users'] = $this->UserModel->get_all_usernames();
				$data['statusOptions'] = $this->TaskModel->getAllStatusOptions();
				$this->load->view('tasks/view',$data);
			}
        }
        else
        {
			$this->load->model('TaskModel');
			$this->load->model('UserModel');
			$this->load->library('form_validation');
			$this->load->helper('form');
			$this->lang->load('task');
			
			$this->form_validation->set_rules('name', 'name', 'required');
			
			$session = $this->session->all_userdata();
			if(isset($session['logged_in']) && $session['logged_in']==TRUE){
				$data['task'] = $this->TaskModel->getTaskData($pkTaskId);
				$data['users'] = $this->UserModel->get_all_usernames();
				$data['statusOptions'] = $this->TaskModel->getAllStatusOptions();
				$this->load->view('default/header');
				$this->load->view('default/nav',$data);

				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('tasks/view',$data);
				}
				else
				{
					$data['update'] = $this->TaskModel->update();
					redirect('/','location');
				}
			}//end if loggid in
			
			$this->load->view('default/footer');
	        } 
	}
	
	public function assignTo($pkTaskId,$teamMember = null)
	{
		$this->load->model('Listmodel');
		$this->load->helper('MY_Form_helper');

		$this->load->model('TaskModel');
		$this->load->model('UserModel');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->lang->load('task');
		
		$this->form_validation->set_rules('username', 'username', 'alpha');
		
	
		$data['task'] = $this->TaskModel->getTaskData($pkTaskId);
		$data['users'] = $this->UserModel->get_all_usernames();
		$data['statusOptions'] = $this->TaskModel->getAllStatusOptions();
		$data['availableList'] = $this->Listmodel->getAllLists();

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('tasks/assignTo',$data);
		}
		else
		{
			$data['update'] = $this->TaskModel->updateUser();
			redirect('/','location');
		}
	}

	function create($username = null)
	{
		$this->load->model('TaskModel');
		$this->load->model('UserModel');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->lang->load('task');
		
		$this->form_validation->set_rules('taskName', 'taskName', 'required');
		$session = $this->session->all_userdata();
			
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('tasks/create');
		}
		else
		{
			$this->TaskModel->addTask();
			redirect('/','location');
		}
	}
}