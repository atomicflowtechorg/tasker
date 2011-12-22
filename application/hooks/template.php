<?php
class Template{
	var $CI;
	function Template() {
        $this->CI =& get_instance();
    }
	
	function authenticationCheck() {

		$session = $this->CI->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
			
		}
		else{
			$controller = $this->CI->uri->segment(1);
			if($controller !== "authentication"){
				$this->CI->load->library('form_validation');
				$this->CI->lang->load('authentication');
				
				$this->CI->load->view('default/header');
				$this->CI->load->view('authentication/loginForm');
				$this->CI->load->view('default/footer');
			}
		}
	}
}
