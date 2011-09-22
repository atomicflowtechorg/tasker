<?php 

class Individual extends CI_Controller {


    public function index()
    {
		$this->load->model('Task');
		$this->load->helper('form');
	
		$this->load->view('default/header');
		$this->load->view('authentication/loginForm');	
		
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
			$data['results'] = $this->Task->getTasksForTasker();
			$this->load->view('default/nav',$data);
			$this->load->view('individual',$data);
		}
		


        $this->load->view('default/footer');
    }

	public function show($username=null)
	{
		$this->load->model('Task');
		$this->load->helper('form');
	
		$this->load->view('default/header');
		$this->load->view('authentication/loginForm');	
		
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
		
			if($username==null || $username == $session['username'])
			{
				redirect('/individual', 'location');
			}
			
			$data['results'] = $this->Task->getTasksForTasker($username);
			$data['user'] = $username;
			$this->load->view('default/nav',$data);
			$this->load->view('individual',$data);
		}
        $this->load->view('default/footer');
		
	}
}