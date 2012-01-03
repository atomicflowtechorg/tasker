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
		
		$data['teams'] = $this->TeamModel->getTeams();
		foreach($data['teams'] as $team)
		{
			$data['users'][] = $this->TeamModel->getUsersForTeam(true, $team->pkTeamName);
		}
		$this->load->view('teams/viewAllTeams',$data);
		
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
		
		$session = $this->session->all_userdata();

		$data['users'] = $this->UserModel->get_all_users();
		$this->load->view('teams/viewAll',$data);

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

		$this->form_validation->set_rules('teamName', 'teamName', 'required');
		$session = $this->session->all_userdata();

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('teams/create');
		}
		else
		{	
			$this->TeamModel->createTeam();
			
			$data['teams'] = $this->TeamModel->getTeams();
			foreach($data['teams'] as $team)
			{
				$data['users'][] = $this->TeamModel->getUsersForTeam(true, $team->pkTeamName);
			}
			redirect('dashboard','location');
		}
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
		
		$teamName = $this->TeamModel->getTeamNameFromUrl($team);
		foreach($teamName as $row){
			$team = $row->pkTeamName;
			$teamUrl = $row->fldUrl;
		}
	
		try{
			$data['users'] = $this->TeamModel->getUsersForTeam(true , $team);
			$this->load->view('teams/template/teamSlider',$data);
		}
		catch(exception $e){
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
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

	function delete($team,$user)
	{
		$this->load->library('image_lib');
        $this->load->library('form_validation');
        $this->load->helper('date');
		$this->lang->load('team');
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
		
		if($this->TeamModel->isMember($team,$session['username'])){
			$this->TeamModel->deleteMember($team,$user);
			
			$data['teams'] = $this->TeamModel->getTeams();
			foreach($data['teams'] as $team)
			{
				$data['users'][] = $this->TeamModel->getUsersForTeam(true, $team->pkTeamName);
			}
			$this->load->view('teams/viewAllTeams',$data);
		}
		else{
			echo "failed to delete team";
		}
		
	}
}