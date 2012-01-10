<?php

/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 */
class Dashboard extends CI_Controller {

    public function index() {
        $this->load->model('teamModel');
        $this->load->model('TaskModel');
        $this->load->model('userModel');
        $this->load->helper('form');

        $data['session'] = $session = $this->session->all_userdata();

        //load current users tasks by default
        $data['user'] = $session['username'];
        $data['title'] = lang('individual_title', array('My'));
        $data['taskList'] = $this->TaskModel->getTasksForTasker($data['user']);
        $data['listUrl'] = site_url("lists/showUserLists/" . $data['user']);
        $data['empty_list'] = lang('error_user_noTasks', array($data['user'], $data['user']));
        
        $teams = $this->teamModel->getTeamsForUser($session['username']);
        
        $hasTeam = false;
        if (count($teams) == 0) {
            
        } else {
            $hasTeam = true;
            $team = $teams[0]->fkTeamName;
            $data['users'] = $this->teamModel->getUsersForTeam(true, $team);

            //Set current user as first 
            $users = $data['users'];
            $pos = 0;
            foreach ($users as $user) {
                if ($user->pkUsername == $session['username']) {
                    $currentUser = $users[$pos];
                    unset($users[$pos]);
                    array_unshift($users, $currentUser);
                }
                $pos++;
            }
            $data['users'] = $users;
            //END Set current user as first

            $data['teams'] = $teams;

            foreach ($data['users'] as $user) {
                $default = base_url() . "images/profiles/default.jpg";
                $size = 100;
                $grav_url = "http://www.gravatar.com/avatar/" . md5(strtolower(trim($user->fldEmail))) . "?d=" . urlencode($default) . "&s=" . $size;
                $user->fldProfileImage = $grav_url;
            }
        }// end have team check


        $this->lang->load('authentication');
        $this->lang->load('team');

        $this->load->library('form_validation');
        $this->load->view('default/head');
        $this->load->view('default/toolbar', $data);
        
        if($hasTeam){
            $this->load->view('teams/viewTeam', $data);
            $this->load->view('default/searchBox');
            $this->load->view('taskListMasterView', $data);
        }else{
            $this->load->view('teams/none',$data);
        }
        
        $this->load->view('default/footer');
    }

}

