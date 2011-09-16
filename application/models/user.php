<?php 
class User extends CI_Model {
    var $id = '';
    var $username   = '';
    var $password = '';
	var $firstname = '';
	var $lastname = '';
	var $email = '';
    var $lastLoggedIn = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
    function get_all_users()
    {
        $query = $this->db->query('SELECT * 
                                FROM  `tblTasker` 
                                ORDER BY  `fldLastLoggedIn` DESC ');
        return $query->result();
    }

    function insert_user()
    {
		$date = getdate();
		$datetime = $date['year']."-".$date['mon']."-".$date['mday']." ".$date['hours'].':'.$date['minutes'].':'.$date['seconds'];
		
		//todo: take into account new user verification here:
		// check duplicates, validate password and confirm password
		
        $this->username = $this->input->post('fldUsername');
        $this->password = $this->input->post('fldPassword');
		$this->email = $this->input->post('fldEmail');
        $this->lastLoggedIn = $datetime;

        $this->db->insert('tblTasker', $this);
    }
	
	function check_user()
	{
		$this->username = $this->input->post('fldUsername');
		$this->password = $this->input->post('fldPassword');
		//returns true if exists and password is correct, otherwise returns false
		$query = $this->db->query("SELECT pkUsername,fldPassword,fldFirstname,fldLastname FROM tblTasker WHERE pkUsername='".$this->username."' AND fldPassword='".$this->password."'");
		return $query;
	}
	
	function user_login()
	{
		$date = getdate();
		$datetime = $date['year']."-".$date['mon']."-".$date['mday']." ".$date['hours'].':'.$date['minutes'].':'.$date['seconds'];
		
		$this->username = $this->input->post('fldUsername');
		$this->password = $this->input->post('fldPassword');
        $this->lastLoggedIn = $datetime;
		
		$query = $this->db->query("SELECT pkUsername,fldPassword,fldFirstname,fldLastname,fldEmail FROM tblTasker WHERE pkUsername='".$this->username."' AND fldPassword='".$this->password."'");
		
		if ($query->num_rows() == 1)
		{
		   foreach ($query->result() as $row)
		   {
			  $this->firstname = $row->fldFirstname;
			  $this->lastname = $row->fldLastname;
			  $this->email = $row->fldEmail;
		   }
		}
		
		$data = array(
               'fldLastLoggedIn' => $this->lastLoggedIn
            );
		
        $this->db->where('pkUsername', $this->username);
		$this->db->where('fldPassword', $this->password);
		$this->db->update('tblTasker', $data);

		return	$this;
	}
}

?>