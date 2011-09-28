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
		}
		else
		{
			$session = $this->session->all_userdata();
			$this->owner = $session['username'];
		}
		
		$this->db->query("INSERT INTO tblList (fldName,fldType,fldOwner,fldAccessLevel) VALUES ('$this->name' ,$this->owner, '$this->type' , '$this->access')");
				
	}
	
	function getOwner($listId)
	{
		
		$query = $this->db->query("SELECT fldOwner FROM tblList WHERE fkListId=$listId");
		$result = $query->row();
		$owner = $result->fldOwner;

		return $owner;
	}
	
	function delete($listId)
	{
		$query = $this->db->query("UPDATE tblList SET fldActive=0 WHERE pkListId=$listId");
	}
}