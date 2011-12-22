<?php 

class Lists extends CI_Controller {

    public function index()
    {
		$this->load->model('ListModel');
		$this->load->model('UserModel');
		$this->lang->load('list');
		
		$data['lists'] = $this->ListModel->getAllLists();

		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
			$this->load->view('lists/viewAll',$data);
		}
    }
	
	public function create()
	{
		$this->load->model('ListModel');
		$this->load->model('UserModel');
		$this->load->model('TeamModel');
		$this->load->library('form_validation');
		$this->load->helper('form');
		$this->lang->load('list');
		
		$this->form_validation->set_rules('name', 'name', 'required');
		
		$session = $this->session->all_userdata();


		if ($this->form_validation->run() == FALSE)
		{
			$data['teams'] = $this->TeamModel->getTeamsForUser($session['username']);
			$this->load->view('lists/create',$data);
		}
		else
		{
			$this->ListModel->createList();
		}
	}
	
	public function delete($listId)
	{
		$this->load->model('ListModel');
		$this->load->model('UserModel');
		$this->load->model('TeamModel');
		$this->load->library('form_validation');
		$this->load->helper('form');
		
		$session = $this->session->all_userdata();

			
		$owner = $this->ListModel->getOwner($listId);
		$userTeams = $this->TeamModel->getTeamsForUser($session['username']);
		if ($session['username']==$owner || in_array($owner,$userTeams))
		{
			$this->ListModel->delete($listId);
		}
		else
		{
			echo "Can't delete unowned list";
		}

	}
	
	function show($listId,$username = null)
	{
		$this->load->model('TaskModel');
		$this->load->model('ListModel');
		$this->load->helper('form');
		$this->lang->load('list');
		
		$session = $this->session->all_userdata();

		$data['user'] = $username;
		$data['listId'] = $listId;
		$listData = $this->ListModel->getListData($listId);
		
		//TODO: Do not force object creation here.
		$list = new ListModel();
		$list->fldListName = $this->uri->segment(4);
		
		if(!empty($listData)){
			$list = $listData[0];
		}

		$data['listData'] = $listData;
		$data['listName'] = $list->fldListName;
		$data['taskList'] = $this->TaskModel->getTasksForList($listId);
		$data['title'] = lang('list_view_tasks_label')." ".$listId." - ".$list->fldListName;
		$data['listUrl'] = site_url("lists");
		$data['empty_list'] = lang('error_list_noTasks',array($data['listName'],$data['listName']));

		$this->load->view('taskListMasterView',$data);
	}
	
	function showUserLists($username)
	{
		$this->load->model('ListModel');
		$this->load->model('UserModel');
		$this->lang->load('list');
		
		$data['lists'] = $this->UserModel->getLists($username);
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