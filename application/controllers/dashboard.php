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
                $this->load->model('TaskModel');
		$this->load->helper('form');
                
		$data['session'] = $session = $this->session->all_userdata();
                
                //load current users tasks by default
                $data['user'] = $session['username'];
		$data['title'] = lang('individual_title',array('My'));
                $data['taskList'] = $this->TaskModel->getTasksForTasker($data['user']);
		$data['listUrl'] = site_url("lists/showUserLists/".$data['user']);
		$data['empty_list'] = lang('error_user_noTasks',array($data['user'],$data['user']));
                
                
                $teams = $this->teamModel->getTeamsForUser($session['username']);               
                $team = $teams[0]->fkTeamName;
                $data['teams'] = $teams;
                $data['users'] = $this->teamModel->getUsersForTeam(true , $team);
                foreach($data['users'] as $user){
                    $email = "someone@somewhere.com";
                    $default = base_url()."images/profiles/default.jpg";
                    $size = 100;
                    $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $user->fldEmail ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
                    $user->fldProfileImage = $grav_url;
                }
                $this->lang->load('authentication');
                $this->lang->load('team');

		$this->load->library('form_validation');
		$this->load->view('default/head');
		$this->load->view('default/toolbar',$data);
                
                $this->load->view('teams/viewTeam', $data);
                
                $this->load->view('default/searchBox');
		$this->load->view('taskListMasterView',$data);
		$this->load->view('default/footer');
	}
}		