<?php

class TaskModel extends CI_Model {

    var $pkTaskId = '';
    var $fldAssignedTo = '';
    var $fldName = '';
    var $fldStatus = '';
    var $fldNotes = '';
    var $fldDateDue = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function addTask() {
        $this->fldName = $this->input->post('taskName');
        $this->fldStatus = 'Available';

        $tblTask = array('fldName' => $this->fldName, 'fldStatus' => $this->fldStatus);

        $this->db->insert('tblTask', $tblTask);
        return $this;
    }

    function showAll($searchTerm = null) {
        if ($searchTerm === null) {
            $query = $this->db->query('SELECT * FROM tblTask');
            return $query->result();
        } 
        elseif ($searchTerm == "NotLikeDeleted") {
            $query = $this->db->query("SELECT * FROM tblTask WHERE fldStatus NOT LIKE 'Deleted'");
        }
        else {
            $this->load->library('SearchResult');
            $results = array();
            $query = $this->db->query("SELECT pkTaskId,fldName,fldStatus,fldNotes 
                    FROM tblTask 
                    WHERE tblTask.fldName LIKE '%$searchTerm%' 
                    OR tblTask.fldNotes LIKE '%$searchTerm%' ");

            foreach ($query->result() as $row) {
                $resultObject = new SearchResult;
                $resultObject->type = "task";
                $resultObject->link = site_url("tasks/view/" . $row->pkTaskId . "/");
                $resultObject->title = $row->fldName;
                array_push($results, $resultObject);
            }
            return $results;
        }
    }

    function showAllUnassigned() {
        $query = $this->db->query('SELECT pkTaskId,fldName,fldStatus
                                FROM tblTask
                                WHERE NOT EXISTS
                                (SELECT fkTaskId
                                FROM tblTaskerTask
                                WHERE tblTaskerTask.fkTaskId = tblTask.pkTaskId) AND fldStatus != "Deleted"
                                ORDER BY pkTaskId DESC
                                ');
        return $query->result();
    }
    
    function getAllStatusOptions() {

        $query = $this->db->query('SELECT * FROM tblTaskStatus');

        return $query->result();
    }

    function getTasksForList($listId) {
        $query = $this->db->query("SELECT pkTaskId,fldName,fldStatus,fldNotes,fldDateDue,fkListId FROM tblTask
LEFT JOIN tblListTask
ON tblTask.pkTaskId = tblListTask.fkTaskId
WHERE fkListId=$listId");
        return $query->result();
    }

    function addTaskToList($taskId = null, $listId = null) {

        if ($taskId == null) {
            $taskId = $this->input->post('taskId');
        }

        if ($listId == null) {
            $listId = $this->input->post('listId');
        }

        //TODO: validate taskId and listId exists

        $query = $this->db->query("INSERT INTO tblListTask (fkListId,fkTaskId) VALUES ('$listId','$taskId')");
    }

    function getTasksForTasker($tasker = null) {

        $session = $this->session->all_userdata();
        if ($tasker == null) {
            $tasker = $session['username'];
        }

        $query = $this->db->query("SELECT * FROM tblTask WHERE EXISTS(
SELECT fkTaskId
FROM tblTaskerTask
WHERE fkUsername='$tasker' AND fkTaskId=pkTaskId) AND fldStatus != 'Deleted' AND fldStatus != 'Completed'");
        return $query->result();
    }

    function addTaskToTasker($pkTaskId = null, $tasker = null) {
        if ($pkTaskId == null) {
            $this->pkTaskId = $this->input->post('pkTaskId');
        } else {
            $this->pkTaskId = $pkTaskId;
        }

        if ($tasker == null) {
            $session = $this->session->all_userdata();
            $tasker = $session['username'];
        }

        $query = $this->db->query("INSERT INTO tblTaskerTask (fkUsername,fkTaskId) VALUES ('" . $tasker . "','" . $this->pkTaskId . "')");
        $query = $this->db->query("UPDATE tblTask SET fldStatus='Assigned' WHERE pkTaskId = $this->pkTaskId");
    }

    function deleteTask($taskId) {
        $query = $this->db->query("UPDATE tblTask SET fldStatus='Deleted' WHERE pkTaskId='$taskId'");
    }

    function getTaskData($taskId) {
        $taskerTask = $this->db->query("SELECT fkUsername FROM tblTaskerTask WHERE fkTaskId=$taskId");
        $listTask = $this->db->query("SELECT fkListId FROM tblListTask WHERE fkTaskId=$taskId");
        $listQueryParams = $listQuery = $taskQueryParams = $taskQuery = "";

        if ($listTask->num_rows === 1) {
            $listQueryParams = ",d.fldListName, d.pkListId";
            $listQuery = "INNER JOIN tblListTask e ON a.pkTaskId = e.fkTaskId INNER JOIN tblList d ON e.fkListId = d.pkListId";
        }
        if ($taskerTask->num_rows == 1) {
            $taskQueryParams = ",c.pkUsername, c.fldProfileImage, c.fldEmail";
            $taskQuery = "INNER JOIN tblTaskerTask b ON a.pkTaskId = b.fkTaskId INNER JOIN tblTasker c ON b.fkUsername = c.pkUsername";
        }

        $queryString = "SELECT DISTINCT a.pkTaskId, a.fldName, a.fldStatus, a.fldNotes, a.fldDateDue $listQueryParams $taskQueryParams
			FROM tblTask a
			$taskQuery
			$listQuery
			WHERE a.pkTaskId=$taskId";
        $query = $this->db->query($queryString);

        return $query->result();
    }

    function update($taskId, $taskProperties) { //properties is an object
        $this->load->helper('date');

        $this->pkTaskId = $taskId;
        $this->fldName = $taskProperties->fldName;
        $this->fldAssignedTo = $taskProperties->fldAssignedTo;
        $this->fldStatus = $taskProperties->fldStatus;
        $this->fldNotes = $taskProperties->fldNotes;
        $this->fldDateDue = $taskProperties->fldDateDue;
        $this->fldDateCompleted;
        //code that checks if updating for an unassigned task
        $query = $this->db->query("SELECT COUNT(*) AS total FROM tblTaskerTask WHERE fkTaskId = '$this->pkTaskId'");
        foreach ($query->result() as $row) {
            $hasTasker = $row->total;
        }

        switch ($hasTasker) {

            default :
                echo $this->fldAssignedTo;
                echo "FAILURE!!!!";
                break;
            case 0 :
                if ($this->fldAssignedTo == '') {
                    
                } else {
                    $this->db->query("INSERT INTO tblTaskerTask (fkUsername, fkTaskId ) VALUES ('$this->fldAssignedTo', '$this->pkTaskId')");
                    $this->fldStatus = 'Assigned';
                }
                break;
            case 1 :
                if ($this->fldAssignedTo != '') {
                    $this->db->query("UPDATE tblTaskerTask SET fkUsername='$this->fldAssignedTo' WHERE fkTaskId = '$this->pkTaskId'");
                } else {
                    $this->db->query("DELETE FROM tblTaskerTask WHERE fkTaskId = '$this->pkTaskId'");
                    $this->fldStatus = 'Available';
                }
                break;
        }


        if ($this->fldStatus == 'Completed') {
            $this->fldDateCompleted = date('Y-m-d H:i:s', time());
        }
        //updates task
        $tblTask = array('fldName' => $this->fldName, 'fldStatus' => $this->fldStatus, 'fldNotes' => $this->fldNotes, 'fldDateDue' => $this->fldDateDue, 'fldDateCompleted' => $this->fldDateCompleted);

        $where = "pkTaskId = $this->pkTaskId";
        $update[] = $this->db->update_string('tblTask', $tblTask, $where);
        $this->db->query($update[0]);
        //doesnt actually use the returned value...
        return $this;
    }

    function updateUser() {
        $this->pkTaskId = $this->input->post('taskId');
        $this->fldAssignedTo = $this->input->post('username');
        $this->pkListId = $this->input->post('list');
        if (empty($this->pkListId)) {
            $this->pkListId = null;
        }
        $query = $this->db->query("SELECT COUNT(*) AS total FROM tblTaskerTask WHERE fkTaskId = '$this->pkTaskId'");
        $queryLists = $this->db->query("SELECT COUNT(*) AS total FROM tblListTask WHERE fkTaskId = '$this->pkTaskId'");

        $hasTasker = $hasList = '';
        foreach ($query->result() as $row) {
            $hasTasker = $row->total;
        }

        foreach ($queryLists->result() as $row) {
            $hasList = $row->total;
        }
        switch ($hasTasker) {
            default :
                echo $this->fldAssignedTo;
                echo "FAILURE!!!!";
                break;
            case 0 ://Has no current tasker
                if ($this->fldAssignedTo == '') {//from not assigned to assigned
                    if ($hasList == 0 && $this->pkListId != null) {
                        $this->db->query("INSERT INTO tblListTask (fkListId, fkTaskId ) VALUES ('$this->pkListId', '$this->pkTaskId')");
                    } else if ($hasList == 1 && $this->pkListId == null) {
                        $this->db->query("DELETE FROM tblListTask WHERE fkTaskId = '$this->pkTaskId'");
                    } else {
                        $this->db->query("UPDATE tblListTask SET fkListId = $this->pkListId WHERE fkTaskId = $this->pkTaskId");
                    }
                } else {//from not assigned to assigned
                    $this->db->query("INSERT INTO tblTaskerTask (fkUsername, fkTaskId ) VALUES ('$this->fldAssignedTo', '$this->pkTaskId')");
                    $this->db->query("UPDATE tblTask SET fldStatus = 'Assigned' WHERE pkTaskId=$this->pkTaskId");
                    if ($hasList == 0 && $this->pkListId != null) {
                        $this->db->query("INSERT INTO tblListTask (fkListId, fkTaskId ) VALUES ('$this->pkListId', '$this->pkTaskId')");
                    } else if ($hasList == 0 && $this->pkListId == null) {
                        
                    } else if ($hasList == 1 && $this->pkListId == null) {
                        $this->db->query("DELETE FROM tblListTask WHERE fkTaskId = '$this->pkTaskId'");
                    } else {
                        $this->db->query("UPDATE tblListTask SET fkListId = $this->pkListId WHERE fkTaskId = $this->pkTaskId");
                    }
                }
                break;
            case 1 ://has current tasker
                if ($this->fldAssignedTo != '') {//changing tasker
                    $this->db->query("UPDATE tblTaskerTask SET fkUsername='$this->fldAssignedTo' WHERE fkTaskId = '$this->pkTaskId'");
                    if ($hasList == 0 && $this->pkListId != null) {
                        $this->db->query("INSERT INTO tblListTask (fkListId, fkTaskId ) VALUES ('$this->pkListId', '$this->pkTaskId')");
                    } else if ($hasList == 1 && $this->pkListId == null) {
                        $this->db->query("DELETE FROM tblListTask WHERE fkTaskId = '$this->pkTaskId'");
                    } else {
                        $this->db->query("UPDATE tblListTask SET fkListId = $this->pkListId WHERE fkTaskId = $this->pkTaskId");
                    }
                } else {//removing assigned tasker
                    $this->db->query("DELETE FROM tblTaskerTask WHERE fkTaskId = '$this->pkTaskId'");
                    $this->db->query("UPDATE tblTask SET fldStatus = 'Available' WHERE pkTaskId=$this->pkTaskId");
                    if ($hasList == 0 && $this->pkListId != null) {
                        $this->db->query("INSERT INTO tblListTask (fkListId, fkTaskId ) VALUES ('$this->pkListId', '$this->pkTaskId')");
                    } else if ($hasList == 1 && $this->pkListId == null) {
                        $this->db->query("DELETE FROM tblListTask WHERE fkTaskId = '$this->pkTaskId'");
                    } else {
                        $this->db->query("UPDATE tblListTask SET fkListId = $this->pkListId WHERE fkTaskId = $this->pkTaskId");
                    }
                }
                break;
        }
        return 'Update Complete';
    }

}

?>