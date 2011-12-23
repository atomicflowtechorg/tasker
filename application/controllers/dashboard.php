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
		$data['session'] = $this->session->all_userdata();
                $this->lang->load('authentication');

		$this->load->library('form_validation');
		$this->load->view('default/head');
		$this->load->view('default/toolbar',$data);
                
		$this->load->view('default/nav');
		$this->load->view('default/footer');
	}
}		