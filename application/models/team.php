<?php 
class Team extends CI_Model {
    var $name = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function getTeams(){
		
		$query = $this->db->query('SELECT * FROM tblTeam');
		
		return $query->result();
	}
	
	function createTeam(){
		$this->name = $this->input->post('teamName');
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
			$currentUser = $session['username'];
			$tblTeam = array('pkTeamName' => $this->name);
			$tblTeamTasker = array('fkTeamName' => $this->name, 'fkUsername'=> $currentUser, 'fldRole'=>'Creator');
			$this->db->insert('tblTeam', $tblTeam);
			$this->db->insert('tblTeamTasker', $tblTeamTasker);
		}
		else
		{
			return 'error creating team';
		}
	}
	
	function getUsersForTeam($team = null){
		
		$query = $this->db->query("SELECT pkUsername, fldFirstname, fldLastname,fldProfileImage,fldLastLoggedIn,fldEmail,fldRole 
									FROM tblTasker 
									INNER JOIN tblTeamTasker on tblTasker.pkUsername = tblTeamTasker.fkUsername
									WHERE tblTeamTasker.fkTeamName = 'Lucas is the best'");
		
		return $query->result();
	}
}