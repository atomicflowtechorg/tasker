<?php 
class Task extends CI_Model {
    var $pkTaskId = '';
	var $fkdAssignedTo = '';
	var $fldName = '';
	var $fldStatus = '';
	var $fldNotes = '';
	var $fldDateDue = '';

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
	
	function addTask(){
		$this->fldName = $this->input->post('taskName');
		$this->fldStatus = 'Available';
		
		$this->db->insert('tblTask', $this);
	}
	
	function showAll(){
		
		$query = $this->db->query('SELECT * FROM tblTask');
		
		return $query->result();
	}
	
	function showAllUnassigned(){
		
		$query = $this->db->query(
		'SELECT pkTaskId,fldName,fldStatus 
		FROM tblTask
		WHERE NOT EXISTS
		(SELECT fkTaskId 
		FROM tblTaskerTask 
		WHERE tblTaskerTask.fkTaskId = tblTask.pkTaskId)
		ORDER BY pkTaskId DESC 
		');
		
		return $query->result();
	}
	
	function getAllStatusOptions(){
		
		$query = $this->db->query('SELECT * FROM tblTaskStatus');
		
		return $query->result();
	}
	
	function getTasksForTasker($tasker=null){
			
		$session = $this->session->all_userdata();
		if($tasker==null){
			$tasker = $session['username'];
		}

		$query = $this->db->query(
		"SELECT * FROM tblTask WHERE EXISTS(
		SELECT fkTaskId 
		FROM tblTaskerTask 
		WHERE fkUsername='$tasker' AND fkTaskId=pkTaskId)"
		);
		return $query->result();
	}
	
	function addTaskToTasker($pkTaskId=null,$tasker = null){
		if($pkTaskId==null){
			$this->pkTaskId = $this->input->post('pkTaskId');
		}
		else{
			$this->pkTaskId = $pkTaskId;
		}
		
		if($tasker==null){
			$session = $this->session->all_userdata();
			$tasker = $session['username'];
		}
		
		
		$query = $this->db->query("INSERT INTO tblTaskerTask (fkUsername,fkTaskId) VALUES ('".$tasker."','".$this->pkTaskId."')");
		$query = $this->db->query("UPDATE tblTask SET fldStatus='Assigned' WHERE pkTaskId = $this->pkTaskId");
		
	}
	
	function deleteTask($taskId)
	{
		$query = $this->db->query("DELETE FROM tblTask WHERE pkTaskId='$taskId'");
		$query = $this->db->query("DELETE FROM tblTaskerTask WHERE fkTaskId='$taskId'");
		$query = $this->db->query("DELETE FROM tblListTask WHERE tblListTask.fkTaskId='$taskId'");
	}
	
	function getTaskData($taskId)
	{
		$exists = $this->db->query("SELECT fkUsername FROM tblTaskerTask WHERE fkTaskId=$taskId");
		if($exists->num_rows == 1)
		{
			$query= $this->db->query("SELECT DISTINCT a.pkTaskId, a.fldName, a.fldStatus, a.fldNotes, a.fldDateDue, c.pkUsername, c.fldProfileImage
			FROM tblTask a INNER JOIN tblTaskerTask b
			ON a.pkTaskId = b.fkTaskId
			INNER JOIN tblTasker c
			ON b.fkUsername = c.pkUsername
			WHERE a.pkTaskId=$taskId");
		}
		
		
		else
		{
			$query= $this->db->query("SELECT DISTINCT a.pkTaskId, a.fldName, a.fldStatus, a.fldNotes, a.fldDateDue
			FROM tblTask a 
			WHERE a.pkTaskId=$taskId");
		}
		
		return $query->result();
	}
	function update()
	{
		$this->pkTaskId = $this->input->post('taskId');
		$this->fldName = $this->input->post('name');
		$this->fldAssignedTo = $this->input->post('username');
		$this->fldStatus = $this->input->post('status');
		$this->fldNotes = $this->input->post('notes');
		$this->fldDateDue = $this->input->post('dateDue');
		
		$tblTask = array('fldName' => $this->fldName,'fldStatus' => $this->fldStatus,'fldNotes' => $this->fldNotes,'fldDateDue' => $this->fldDateDue);
		$tblTaskerTask = array('fkUsername' => $this->fldAssignedTo,'fkTaskId' => $this->pkTaskId);
		
		
		$where = "pkTaskId = $this->pkTaskId";
		$update[] = $this->db->update_string('tblTask',$tblTask,$where);
		$this->db->query($update[0]);
		$where = "fkTaskId = $this->pkTaskId";
		$update[] = $this->db->update_string('tblTaskerTask',$tblTaskerTask,$where);
		$this->db->query($update[1]);
		return 'Update Complete';
	}
}

?>