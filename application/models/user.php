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
	
	function get_all_usernames()
    {
        $query = $this->db->query('SELECT pkusername 
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

	function getLists($username)
	{
		$query = $this->db->query("SELECT * FROM `tblList` 
		WHERE fldOwner = '$username' OR fldOwner=(SELECT fkTeamName 
		FROM  `tblTeamTasker` where fkUsername='$username')");
		return $query->result();
	}

	function UserExistsFromEmail($email)
	{
		$queryString = "SELECT pkUsername,fldFirstname, fldLastname,fldProfileImage,fldLastLoggedIn,fldEmail,fldStatus 
		FROM  `tblTasker`
		WHERE fldEmail = '$email'
		ORDER BY `fldLastLoggedIn` DESC";
		$query = $this->db->query($queryString);
		return $query->result();
	}
	
	function preResetPassword($username,$resetKey){
		$data = array('fldResetKey' => $resetKey);
		$where = "pkUsername = '$username'";
		$queryString = $this->db->update_string('tblTasker',$data,$where);
		$this->db->query($queryString);
	}
	
	function confirmResetKey($username,$resetKey){
		$queryString = "SELECT 1 FROM tblTasker WHERE pkUsername='$username' AND fldResetKey='$resetKey' LIMIT 1";
		$query = $this->db->query($queryString);
		return $query->result();
	}
	
	function resetPassword(){
		$this->password = $this->input->post('fldPassword1');
		$this->username = $this->input->post('fldUsername');
		
		$data = array('fldPassword' => $this->password, 'fldResetKey' => "");
		$where = "pkUsername = '$this->username'";
		$queryString = $this->db->update_string('tblTasker',$data,$where);
		$query = $this->db->query($queryString);
	}
}

?>