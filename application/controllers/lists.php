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
		$this->load->library('form_validation');
		$this->load->helper('form');
		
		$this->form_validation->set_rules('name', 'name', 'required');
		
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){

			$this->load->view('default/header');
			$this->load->view('default/nav');

			if ($this->form_validation->run() == FALSE)
			{
				$data['location'] = $createLocation;
				$this->load->view('lists/create',$data);
			}
			else
			{
				redirect('/'.$createLocation, 'location');
			}
		}//end if loggid in
		
		$this->load->view('default/footer');
	}
	
}

?>