<?php

class Dashboard extends CI_Controller {

	public function index()
	{
		$data['session'] = $this->session->all_userdata();
			
		$this->load->library('form_validation');
		$this->load->view('default/head');
		$this->load->view('default/toolbar',$data);
		
		$this->lang->load('authentication');
		
		$this->load->view('default/header');
		$this->load->view('authentication/loginForm');
		$this->load->view('default/nav');
		$this->load->view('default/footer');
	}
}		