<?php
/**
* @property CI_Loader $load
* @property CI_Form_validation $form_validation
* @property CI_Input $input
* @property CI_Email $email
* @property CI_DB_active_record $db
*/
class Dashboard extends CI_Controller {

	public function index()
	{   
                $this->load->model('teamModel');
		$data['session'] = $session = $this->session->all_userdata();
                $teams = $this->teamModel->getTeamsForUser($session['username']);               
                $team = $teams[0]->fkTeamName;
                $data['users'] = $this->teamModel->getUsersForTeam(true , $team);
                $this->lang->load('authentication');
                $this->lang->load('team');

		$this->load->library('form_validation');
		$this->load->view('default/head');
		$this->load->view('default/toolbar',$data);
                
                $this->load->view('teams/viewTeam', $data);
                
		$this->load->view('default/nav');
		$this->load->view('default/footer');
	}
}		