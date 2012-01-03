<?php 
/**
* @property CI_Loader $load
* @property CI_Form_validation $form_validation
* @property CI_Input $input
* @property CI_Email $email
* @property CI_DB_active_record $db
*/
class Search extends CI_Controller {
    public function index()
    {
        $searchTerm = $this->input->post('searchBoxInput');
        
        $this->load->model('listModel');
        $this->load->model('taskModel');
        $this->load->model('teamModel');
        $this->load->model('userModel');
        
        $this->load->helper('url');
        
        //search each object seperately return as 
        $results = array();
        
        $lists = $this->listModel->getAllLists($searchTerm);
        $results = array_merge($results, $lists);
        $tasks = $this->taskModel->showAll($searchTerm);
        $results = array_merge($results, $tasks);
        $teams = $this->teamModel->getTeams($searchTerm);
        $results = array_merge($results, $teams);
        $taskers = $this->userModel->get_all_users($searchTerm);
        $results = array_merge($results, $taskers);
        
        //load view for all results
        $data['results'] = $results;
        $data['title'] = count($results)." Results for: ". $searchTerm;
        $this->load->view('searchResults/template/resultList',$data);
        
    }
}
