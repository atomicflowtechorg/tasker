<?php 

class Lists extends CI_Controller {

    public function index()
    {
		echo "Lists";
    }
	
	public function create()
	{
		$this->load->model('ListModel');
		$this->load->model('User');
		$this->load->model('Team');
		$this->load->library('form_validation');
		$this->load->helper('form');
		
		$this->form_validation->set_rules('name', 'name', 'required');
		
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){

			$this->load->view('default/header');
			$this->load->view('default/nav');

			if ($this->form_validation->run() == FALSE)
			{
				$data['teams'] = $this->Team->getTeamsForUser($session['username']);
				$this->load->view('lists/create',$data);
			}
			else
			{
				$this->ListModel->createList();
			}
		}//end if loggid in
		
		$this->load->view('default/footer');
	}
	
	public function delete($listId)
	{
		$this->load->model('ListModel');
		$this->load->model('User');
		$this->load->model('Team');
		$this->load->library('form_validation');
		$this->load->helper('form');
		
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){

			$this->load->view('default/header');
			$this->load->view('default/nav');
			
			$owner = $this->ListModel->getOwner($listId);
			$userTeams = $this->Team->getTeamsForUser($session['username']);
			if ($session['username']==$owner || in_array($owner,$userTeams))
			{
				$this->ListModel->delete($listId);
			}
			else
			{
				echo "Can't delete unowned task";
			}
		}//end if loggid in
		
		$this->load->view('default/footer');
	}
	
	function show($username,$listId)
	{
		$this->load->model('Task');
		$this->load->helper('form');
		
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest")
		{
			
		}
		else
		{
			$this->load->view('default/header');
			$this->load->view('authentication/loginForm');	
			$session = $this->session->all_userdata();
			if(isset($session['logged_in']) && $session['logged_in']==TRUE){
				$data['user'] = $username;
				$data['listName'] = $listId;
				$data['tasks'] = $this->Task->getTasksForList($listId);
				$data['nav'] = TRUE;
				$this->load->view('default/nav');
				$this->load->view('lists/showList',$data);
			}
	        $this->load->view('default/footer');
		}
	}
	
	function showUserLists($username)
	{
		$this->load->model('ListModel');
		$this->load->model('User');
		$data['lists'] = $this->User->getLists($username);
		$data['user'] = $username;
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest")
		{
			$session = $this->session->all_userdata();
			if(isset($session['logged_in']) && $session['logged_in']==TRUE){
				$this->load->view('lists/view',$data);
			}
        }
        else
        {
        	$this->load->view('default/header');
			$session = $this->session->all_userdata();
			if(isset($session['logged_in']) && $session['logged_in']==TRUE){
				$this->load->view('default/nav');
				$this->load->view('lists/view',$data);
			}
		$this->load->view('default/footer');
        }
	}
}

?>