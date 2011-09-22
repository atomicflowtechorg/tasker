<?php 

class Authentication extends CI_Controller {


    public function index()
    {
		//User display test
		$this->load->model('User');
		$data['users'] = $this->User->get_all_users();
		
        //Page content configuration
        $this->load->helper('date');
		$this->load->library('form_validation');
		$data['page'] = 'Login';
        $data['description'] = 'Login page for '.base_url();
		
		$this->form_validation->set_rules('fldUsername', 'Username', 'required');
		$this->form_validation->set_rules('fldPassword', 'Password','required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('default/header',$data);
			$this->load->view('authentication/loginForm');
			$session = $this->session->all_userdata();
			if(isset($session['logged_in']) && $session['logged_in']==TRUE){
				$this->load->view('default/nav');
			}
			$this->load->view('default/footer',$data);
		}
		else
		{
			if($_POST){
				$exists = $this->User->check_user();
				$objArray = get_object_vars($exists);
				$resultItem = $objArray['num_rows'];
				if ($resultItem==1)
				{
					$user = $this->User->user_login();
					$data['username'] = $user->firstname;
					$data['success'] = true;
					$data['message'] = "you've successfully logged in";
					
					
					$newdata = array(
	                   'username'  => $user->username,
	                   'firstname' => $user->firstname,
	                   'email'     => $user->email,
	                   'logged_in' => TRUE
	               );
	
				$this->session->set_userdata($newdata);
				}
				redirect('/', 'location');
			}
			else
			{
				$this->load->view('default/header',$data);
				$this->load->view('authentication/loginForm');
				$session = $this->session->all_userdata();
				if(isset($session['logged_in']) && $session['logged_in']==TRUE){
					$this->load->view('default/nav');
				}
				$this->load->view('default/footer',$data);
			}
		}
    }
	
	public function checkLogin()
	{
		$this->load->library('encrypt');
		$this->load->helper('date');
		$this->load->model('User');
		//DO encryption and stop tags and such in user model
		if($_POST){
			$exists = $this->User->check_user();
			$objArray = get_object_vars($exists);
			$resultItem = $objArray['num_rows'];
			if ($resultItem==1)
			{
				$user = $this->User->user_login();
				$data['username'] = $user->firstname;
				$data['success'] = true;
				$data['message'] = "you've successfully logged in";
				$data['navigation'] = '<a href="/authentication/checkLogout" id="logout" title="Log Out">Log Out</a><nav id="appnav"> 
    <ul>
        <a href="/individual/"><li class="blueRing">Individual</li></a>

        <a href="/team/"><li class="greenRing">Team</li></a>

        <a href="/unversal/"><li class="yellowRing">Universal</li></a>

        <a href="/grabBag/"><li class="orangeRing">Grab Bag</li></a>

    </ul>
</nav>';
				$newdata = array(
                   'username'  => $user->username,
                   'firstname' => $user->firstname,
                   'email'     => $user->email,
                   'logged_in' => TRUE
               );

			$this->session->set_userdata($newdata);
			}
			else
			{
				$data['success'] = false;
				$data['error'] = "Invalid attempt, please try again";
			}
			
			$json = json_encode($data);
			$result['json'] = $json;
			$this->load->view('authentication/checkLogin',$result);
		}
	}
	
	public function checkLogout(){
		$newdata = array(
		   'logged_in' => FALSE
	    );

		$this->session->set_userdata($newdata);
		
		$data['message'] = "you've successfully logged out";
		$json = json_encode($data);
		$result['json'] = $json;
		
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			$this->load->view('authentication/checkLogout',$result);
		}
		else{
			redirect('/', 'location');
		}
	}
}
?>