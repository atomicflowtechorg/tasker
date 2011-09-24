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
		
		if($this->type == 'team')
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
		
		$query = $this->db->query("START TRANSACTION;
									INSERT INTO tblList (fldName,fldType,fldAccessLevel) VALUES ('$this->name','$this->type','$this->access');
									INSERT INTO $dbTable VALUES (LAST_INSERT_ID(),'$this->owner' );
									COMMIT;");
		
	}
}