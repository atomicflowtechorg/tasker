<?php 

class GrabBag extends CI_Controller {


    public function index()
    {
		$this->load->model('Task');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('taskName', 'Task Name', 'required');
		
		//if($_POST){
		//	$this->Task->addTask();
		//}
		
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
			}
		
			$data['results'] = $this->Task->showTasksForListId(10);
			$this->load->view('default/nav',$data);
			$this->load->view('grabBag',$data);
		}
        $this->load->view('default/footer');
    }
}