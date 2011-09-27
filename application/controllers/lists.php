<?php 

class Lists extends CI_Controller {

    public function index()
    {
		echo "Lists";
    }
	
	public function create($createLocation)
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
				$data['location'] = $createLocation;
				$this->load->view('lists/create',$data);
			}
			else
			{
				$this->ListModel->createList();
				redirect('/'.$createLocation, 'location');
			}
		}//end if loggid in
		
		$this->load->view('default/footer');
	}
	
	public function delete($location,$listId)
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
				redirect('/'.$location, 'location');
			}
			else
			{
				redirect('/'.$location, 'location');
			}
		}//end if loggid in
		
		$this->load->view('default/footer');
	}
}

?>