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
		$url = url_title($this->name);
		$session = $this->session->all_userdata();
		if(isset($session['logged_in']) && $session['logged_in']==TRUE){
			$currentUser = $session['username'];
			$tblTeam = array('pkTeamName' => $this->name, 'fldUrl' => $url);
			$tblTeamTasker = array('fkTeamName' => $this->name, 'fkUsername'=> $currentUser, 'fldRole'=>'Creator');
			$this->db->insert('tblTeam', $tblTeam);
			$this->db->insert('tblTeamTasker', $tblTeamTasker);
		}
		else
		{
			return 'error creating team';
		}
	}
	
	function getUsersForTeam($team = null, $inTeam){
		
		if($inTeam){ $condition = 'IN';}
		else{$condition = 'NOT IN';}
		if($team == null)
		{
			throw new Exception("Team can't be null", 1);
		}
		
		$queryString = "SELECT pkUsername, fldFirstname,fldLastname,fldProfileImage,fldLastLoggedIn,fldEmail
						FROM tblTasker
						WHERE pkUsername $condition
						(SELECT DISTINCT fkUsername FROM tblTeamTasker WHERE fkTeamName = '$team')";
		$query = $this->db->query($queryString);
		
		return $query->result();
	}
	
	function getTeamsForUser($user){
		
		$queryString = "SELECT fkTeamName FROM tblTeamTasker WHERE fkUsername ='$user'";
		$query = $this->db->query($queryString);
		
		return $query->result();
	}
	
	function addUserToTeam($tasker = null,$team = null)
	{
		if($tasker==null){
			$tasker = $this->input->post('username');
		}
		
		if($team==null){
			$team = $this->input->post('team');
		}
		
		$role = 'Member';
		
		$query = $this->db->query("INSERT INTO tblTeamTasker (fkTeamName,fkUsername,fldRole) VALUES ('$team','$tasker','$role')");
	}
	
	function isMember($team,$user)
	{
		$query = $this->db->query("SELECT COUNT(DISTINCT fkUsername) AS inTeam FROM tblTeamTasker WHERE fkTeamName = '$team' AND fkUsername = '$user'");
		foreach($query->result() as $row){
			$count = $row->inTeam;
		}
		if($count == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function deleteMember($team,$user)
	{
		$this->db->query("DELETE FROM tblTeamTasker WHERE fkTeamName = '$team' AND fkUsername = '$user'");
	}
	
	function getTeamNameFromUrl($url)
	{
		$query =$this->db->query("SELECT * FROM tblTeam WHERE fldUrl = '$url'");
		return $query->result();
	}
}