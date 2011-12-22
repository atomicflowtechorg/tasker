<?php

class Dashboard extends CI_Controller {

	public function index()
	{
		$this->load->library('form_validation');
		
		$this->load->view('default/header');
		$this->load->view('authentication/loginForm');
		$this->load->view('default/nav');
		$this->load->view('default/footer');
	}
}		