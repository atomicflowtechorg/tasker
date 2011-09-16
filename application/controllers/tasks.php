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
		echo "Tasks";
    }

	public function delete($deleteLocation,$pkTaskId)
	{
		
		$this->load->model('Task');
		$this->load->helper('form');
		
		$this->Task->deleteTask($pkTaskId);
		
		redirect('/'.$deleteLocation, 'location');
		
	}
	
	public function view($pkTaskId)
	{
		
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest")
		{
			$this->load->model('Task');
			$this->load->helper('form');
				
			$data['task'] = $this->Task->getTaskData($pkTaskId);
			$this->load->view('tasks/task',$data);
        }
        else
        {
			$this->load->model('Task');
			$this->load->helper('form');
				
			$data['task'] = $this->Task->getTaskData($pkTaskId);
			$this->load->view('default/header');
			$this->load->view('authentication/loginForm');
			$this->load->view('default/nav');
			$this->load->view('tasks/task',$data);
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
	
	public function assignTo($pkTaskId)
	{
		
		$this->load->model('Task');
		$this->load->helper('form');
			
		$data['task'] = $this->Task->getTaskData($pkTaskId);
		$this->load->view('tasks/assignTo',$data);
	}
}