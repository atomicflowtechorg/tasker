<?php 

class Teams extends CI_Controller {


    public function index()
    {
    	//Page content configuration
        $this->load->library('image_lib');
        $this->load->library('form_validation');
        $this->load->helper('date');
		$this->lang->load('team');
		//User display test
		$this->load->model('UserModel');
		$this->load->model('TeamModel');
		$this->load->view('default/header');
		$this->load->view('authentication/loginForm');
		
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
			$data['teams'] = $this->TeamModel->getTeams();
			foreach($data['teams'] as $team)
			{
				$data['users'][] = $this->TeamModel->getUsersForTeam(true, $team->pkTeamName);
			}
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
		$this->lang->load('team');
		
		//User display test
		$this->load->model('UserModel');
		$this->load->model('TeamModel');
		$this->load->view('default/header');
		$this->load->view('authentication/loginForm');
		
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
			$data['users'] = $this->UserModel->get_all_users();
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
		$this->lang->load('team');
		
		//User display test
		$this->load->model('UserModel');
		$this->load->model('TeamModel');
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
				$this->TeamModel->createTeam();
				redirect('/teams', 'location');
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
		$this->lang->load('team');
		
		//User display test
		$this->load->model('UserModel');
		$this->load->model('TeamModel');
		$this->load->view('default/header');
		$this->load->view('authentication/loginForm');
		
		$teamName = $this->TeamModel->getTeamNameFromUrl($team);
		foreach($teamName as $row){
			$team = $row->pkTeamName;
			$teamUrl = $row->fldUrl;
		}
		
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
			$this->load->view('default/nav');
			try{
				$data['users'] = $this->TeamModel->getUsersForTeam(true , $team);
				$this->load->view('teams/viewTeam',$data);
			}
			catch(exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			
		}
        $this->load->view('default/footer');
	}
	
	public function modify($team = null){
    	//Page content configuration
        $this->load->library('image_lib');
        $this->load->library('form_validation');
        $this->load->helper('date');
		$this->lang->load('team');
		
		$this->form_validation->set_rules('username', 'Username', 'required');
		
		//User display test
		$this->load->model('UserModel');
		$this->load->model('TeamModel');
		
		//convert from URL friendly to team name
		$teamName = $this->TeamModel->getTeamNameFromUrl($team);
		foreach($teamName as $row){
			$team = $row->pkTeamName;
			$teamUrl = $row->fldUrl;
		}
		$this->load->view('default/header');
		$this->load->view('authentication/loginForm');
		
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
			$this->load->view('default/nav');
			
			if ($this->form_validation->run() == FALSE)
			{
				
			}
			else
			{
				$this->TeamModel->addUserToTeam();
			}
			
			try{
				$data['team'] = $team;
				$data['teamUrl'] = $teamUrl;
				$data['users'] = $this->TeamModel->getUsersForTeam(true , $team);
				$data['nonUsers'] = $this->TeamModel->getUsersForTeam(false , $team);
				$this->load->view('teams/modify',$data);
			}
			catch(exception $e){
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
			
		}
        $this->load->view('default/footer');
	}

	function delete($team,$user)
	{
		$this->load->library('image_lib');
        $this->load->library('form_validation');
        $this->load->helper('date');
		//User display test
		$this->load->model('UserModel');
		$this->load->model('TeamModel');
		
		//convert from URL friendly to team name
		$teamName = $this->TeamModel->getTeamNameFromUrl($team);
		foreach($teamName as $row){
			$team = $row->pkTeamName;
			$teamUrl = $row->fldUrl;
		}
		
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){

			if($this->TeamModel->isMember($team,$session['username'])){
				$this->TeamModel->deleteMember($team,$user);
			}
		}
		echo "test"; 
		redirect('/teams/modify/'.$teamUrl, 'location');
	}
}