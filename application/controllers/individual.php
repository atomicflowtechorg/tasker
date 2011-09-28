<?php 

class Individual extends CI_Controller {


    public function index()
    {
		$this->load->model('Task');
		$this->load->model('User');
		$this->load->helper('form');
	
		$this->load->view('default/header');
		$this->load->view('authentication/loginForm');	
		
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
			$username = $session['username'];
			$data['user'] = $this->User->get_user_info($username);
			$this->load->view('default/nav',$data);
			$this->load->view('individual',$data);
		}
		


        $this->load->view('default/footer');
    }

	public function show($username=null)
	{
		$this->load->model('Task');
		$this->load->model('User');
		$this->load->helper('form');
	
		$this->load->view('default/header');
		$this->load->view('authentication/loginForm');	
		
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
		
			if($username==null || $username == $session['username'])
			{
				//TODO: manage only editing your own page, do a compare to username param to session
				//redirect('/individual', 'location');
			}
			
			$data['user'] = $this->User->get_user_info($username);

			$this->load->view('default/nav',$data);
			$this->load->view('individual',$data);
		}
        $this->load->view('default/footer');
		
	}
	
		public function teams($username=null)
	{
		$this->load->model('Task');
		$this->load->model('User');
		$this->load->model('Team');
		$this->load->helper('form');
	
		$this->load->view('default/header');
		$this->load->view('authentication/loginForm');	
		
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
		
			if($username==null || $username == $session['username'])
			{
				//TODO: manage only editing your own page, do a compare to username param to session
				//redirect('/individual', 'location');
			}
			$data['teams'] = $this->Team->getTeamsForUser($username);
			$data['user'] = $this->User->get_user_info($username);

			$this->load->view('default/nav',$data);
			$this->load->view('individual/teams',$data);
		}
        $this->load->view('default/footer');
		
	}
}