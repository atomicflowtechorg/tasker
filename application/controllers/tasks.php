<?php 

class Tasks extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -  
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */

    public function index()
    {
		redirect('/', 'location');
    }

	public function delete($deleteLocation,$pkTaskId)
	{
		
		$this->load->model('Task');
		$this->load->helper('form');
		
		
		$this->Task->deleteTask($pkTaskId);
		
		redirect('/'.$deleteLocation, 'location');
		
	}
	
	public function view($updateLocation,$pkTaskId,$teamMember = null)
	{
		if(!is_numeric($pkTaskId))
		{
			$updateLocation = $updateLocation.'/'.$pkTaskId;
			$pkTaskId = $teamMember;
		}
		
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
				$data['location'] = $updateLocation;
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
				$data['location'] = $updateLocation;
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
					redirect('/'.$updateLocation, 'location');
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
	
	public function assignTo($updateLocation,$pkTaskId,$teamMember = null)
	{
		if(!is_numeric($pkTaskId))
		{
			$updateLocation = $updateLocation.'/'.$pkTaskId;
			$pkTaskId = $teamMember;
		}
		
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
				$data['location'] = $updateLocation;
				$data['users'] = $this->User->get_all_usernames();
				$data['statusOptions'] = $this->Task->getAllStatusOptions();
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
				$data['location'] = $updateLocation;
				$data['users'] = $this->User->get_all_usernames();
				$this->load->view('default/header');
				$this->load->view('default/nav',$data);

				if ($this->form_validation->run() == FALSE)
				{
					$this->load->view('tasks/assignTo',$data);
				}
				else
				{
					$data['update'] = $this->Task->updateUser();
					redirect('/'.$updateLocation, 'location');
				}
			}//end if loggid in
			
			$this->load->view('default/footer');
	        } 
	}

	function create($location,$username = null)
	{
		$data['location'] = $location."/".$username;
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

				}
				else
				{
					$this->Task->addTask();
					redirect('/'.$data['location'],'location');
				}
				$this->load->view('tasks/create',$data);
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
					redirect('/'.$data['location'],'location');
				}
				$this->load->view('default/nav');
				$this->load->view('tasks/create',$data);
			}
		
		$this->load->view('default/footer');
       }
	}
}