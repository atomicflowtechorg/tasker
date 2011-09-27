<?php 
class ListModel extends CI_Model {
	var $id = '';
	var $name = '';
	var $type = '';
	var $access = '';
	var $owner = '';
	
	 function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function createList()
	{
		$this->name = $this->input->post('name');
		$this->type = $this->input->post('type');
		$this->access = $this->input->post('access');
		
		$dbTable = '';
		
		if($this->type == 'Team')
		{
			$this->owner = $this->input->post('owner');
			$dbTable = 'tblListTeam';
		}
		else
		{
			$session = $this->session->all_userdata();
			$this->owner = $session['username'];
			$dbTable = 'tblListTasker';
		}
		
		$this->db->trans_start();
		$this->db->query("INSERT INTO tblList (fldName,fldType,fldAccessLevel) VALUES ('$this->name' , '$this->type' , '$this->access')");
		$this->db->query("INSERT INTO $dbTable VALUES (LAST_INSERT_ID(),'$this->owner' )");
		$this->db->trans_complete();
				
	}
	
	function getOwner($listId)
	{
		
		$query = $this->db->query("SELECT fldType FROM tblList WHERE pkListId=$listId");
		$result = $query->row();
		$type = $result->fldType;
		if($type=='Personal')
		{
			$query = $this->db->query("SELECT fkUsername FROM tblListTasker WHERE fkListId=$listId");
			$result = $query->row();
			$owner = $result->fkUsername;
		}
		else
		{
			$query = $this->db->query("SELECT fkTeamName FROM tblListTeam WHERE fkListId=$listId");
			$result = $query->row();
			$owner = $result->fkTeamName;
		}
		
		return $owner;
	}
	
	function delete($listId)
	{
		$query = $this->db->query("UPDATE tblList SET fldActive=0 WHERE pkListId=$listId");
	}
}