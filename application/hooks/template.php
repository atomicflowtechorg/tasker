<?php

class Template {

    var $CI;

    function Template() {
        $this->CI = & get_instance();
    }

    function authenticationCheck() {
        $this->CI->load->model('teamModel');
        $session = $this->CI->session->all_userdata();
        
         if (isset($session['logged_in']) && $session['logged_in'] == TRUE) {
            
        } else {
            $controller = $this->CI->uri->segment(1);
            if ($controller !== "authentication") {
                redirect('authentication', 'location');
            }
        }
    }
}
