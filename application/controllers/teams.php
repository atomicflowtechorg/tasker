<?php 

class Teams extends CI_Controller {


    public function index()
    {
    	//Page content configuration
        $this->load->library('image_lib');
        $this->load->library('form_validation');
        $this->load->helper('date');
		
		//User display test
		$this->load->model('User');
		$this->load->model('Team');
		$this->load->view('default/header');
		$this->load->view('authentication/loginForm');
		
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
			$data['teams'] = $this->Team->getTeams();
			$this->load->view('default/nav');
			$this->load->view('teams/viewAllTeams',$data);
		}
        $this->load->view('default/footer');
	}
	
	public function allUsers(){
		
    	//Page content configuration
        $this->load->library('image_lib');
        $this->load->library('form_validation');
        $this->load->helper('date');
		
		//User display test
		$this->load->model('User');
		$this->load->model('Team');
		$this->load->view('default/header');
		$this->load->view('authentication/loginForm');
		
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
			$data['users'] = $this->User->get_all_users();
			$this->load->view('default/nav');
			$this->load->view('teams/viewAll',$data);
		}
        $this->load->view('default/footer');
	}
	
	public function create(){
		
    	//Page content configuration
        $this->load->library('image_lib');
        $this->load->library('form_validation');
        $this->load->helper('date');
		
		//User display test
		$this->load->model('User');
		$this->load->model('Team');
		$this->load->view('default/header');
		$this->load->view('authentication/loginForm');
		$this->form_validation->set_rules('teamName', 'teamName', 'required');
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
		
			$this->load->view('default/nav');
			
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('teams/create');
			}
			else
			{	
				$this->Team->createTeam();
				$data['teams'] = $this->Team->getTeams();
				$this->load->view('teams/viewAllTeams',$data);
			}
		}
        $this->load->view('default/footer');
	}
	
	public function show($team = null)
	{	
		$teamNameUrl = str_replace("%20", "-", $team);
		$this->uri->segment(3, $teamNameUrl);
    	//Page content configuration
        $this->load->library('image_lib');
        $this->load->library('form_validation');
        $this->load->helper('date');
		
		//User display test
		$this->load->model('User');
		$this->load->model('Team');
		$this->load->view('default/header');
		$this->load->view('authentication/loginForm');
		
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
			$data['users'] = $this->Team->getUsersForTeam($team);
			$this->load->view('default/nav');
			$this->load->view('teams/viewTeam',$data);
		}
        $this->load->view('default/footer');
	}
	
}