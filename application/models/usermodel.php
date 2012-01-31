<?php

class UserModel extends CI_Model {

    var $id = '';
    var $username = '';
    var $password = '';
    var $firstname = '';
    var $lastname = '';
    var $email = '';
    var $lastLoggedIn = '';
    var $authKey = '';

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_all_users($searchTerm = null) {
        if ($searchTerm === null) {
            $query = $this->db->query('SELECT * 
                                FROM  `tblTasker` 
                                ORDER BY  `fldLastLoggedIn` DESC ');
            return $query->result();
        } else {
            $this->load->library('SearchResult');
            $results = array();
            $query = $this->db->query("SELECT pkUsername, fldFirstname, fldLastname, fldEmail, fldStatus
                    FROM tblTasker WHERE 
                    tblTasker.pkUsername LIKE '%$searchTerm%'
                    OR tblTasker.fldFirstname LIKE '%$searchTerm%'
                    OR tblTasker.fldLastname LIKE '%$searchTerm%'
                    OR tblTasker.fldEmail LIKE '%$searchTerm%'
                    OR tblTasker.fldStatus LIKE '%$searchTerm%' ");

            foreach ($query->result() as $row) {
                $resultObject = new SearchResult;
                $resultObject->type = "tasker";
                $resultObject->link = site_url("individual/" . $row->pkUsername . "/");
                $resultObject->title = $row->pkUsername;
                array_push($results, $resultObject);
            }
            return $results;
        }
    }
    
    function get_user($username){
        $query = $this->db->query("SELECT pkUsername, fldFirstname, fldLastname, fldLastLoggedIn, fldEmail, fldStatus 
                FROM  `tblTasker`
                WHERE pkUsername = '$username' ");
            return $query->result();
    }

    function get_all_usernames() {
        $query = $this->db->query('SELECT pkusername 
                                FROM  `tblTasker` 
                                ORDER BY  `fldLastLoggedIn` DESC ');
        return $query->result();
    }

    function insert_user() {
        $this->load->helper('security');

        $date = getdate();
        $datetime = $date['year'] . "-" . $date['mon'] . "-" . $date['mday'] . " " . $date['hours'] . ':' . $date['minutes'] . ':' . $date['seconds'];

        $this->firstname = $this->input->post('fldFirstname');
        $this->lastname = $this->input->post('fldLastname');
        $this->email = $this->input->post('fldEmail');
        $this->username = $this->input->post('fldUsername');
        $this->password = $this->input->post('fldPassword1');
        $this->authKey = do_hash(time(), 'md5'); // MD5 resetKey
        $this->lastLoggedIn = $datetime;

        $data = array('pkUsername' => $this->username, 'fldPassword' => $this->password, 'fldFirstname' => $this->firstname, 'fldLastname' => $this->lastname, 'fldLastLoggedIn' => $this->lastLoggedIn, 'fldEmail' => $this->email, 'fldAuthKey' => $this->authKey);

        $queryString = $this->db->insert_string('tblTasker', $data);
        $this->db->query($queryString);
        return $this;
    }

    function check_user() {
        $this->username = $this->input->post('fldUsername');
        $this->password = $this->input->post('fldPassword');

        //returns true if exists and password is correct, otherwise returns false
        $query = $this->db->query("SELECT pkUsername,fldPassword,fldLevel,fldFirstname,fldLastname,fldEmail FROM tblTasker WHERE pkUsername='" . $this->username . "' AND fldPassword='" . $this->password . "'");
        return $query;
    }

    function check_user_registration() {
        $this->username = $this->input->post('fldUsername');
        $this->email = $this->input->post('fldEmail');

        //returns true if exists and password is correct, otherwise returns false
        $query = $this->db->query("SELECT pkUsername,fldEmail FROM tblTasker WHERE pkUsername='$this->username' OR fldEmail='$this->email'");
        return $query;
    }

    function user_login() {
        $date = getdate();
        $datetime = $date['year'] . "-" . $date['mon'] . "-" . $date['mday'] . " " . $date['hours'] . ':' . $date['minutes'] . ':' . $date['seconds'];

        $this->username = $this->input->post('fldUsername');
        $this->password = $this->input->post('fldPassword');

        $this->lastLoggedIn = $datetime;

        $query = $this->db->query("SELECT pkUsername,fldPassword,fldFirstname,fldLastname,fldEmail FROM tblTasker WHERE pkUsername='" . $this->username . "' AND fldPassword='" . $this->password . "'");

        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
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

        return $this;
    }

    function getLists($username) {
        $query = $this->db->query("SELECT pkListId,fldListName,fldType,fldOwner,fldAccessLevel,fldActive FROM tblList WHERE fldOwner ='$username'");
        return $query->result();
    }

    function UserExistsFromEmail($email) {
        $queryString = "SELECT pkUsername,fldFirstname, fldLastname,fldProfileImage,fldLastLoggedIn,fldEmail,fldStatus 
		FROM  `tblTasker`
		WHERE fldEmail = '$email'
		ORDER BY `fldLastLoggedIn` DESC";
        $query = $this->db->query($queryString);
        return $query->result();
    }

    function preResetPassword($username, $resetKey) {
        $data = array('fldAuthKey' => $resetKey);
        $where = "pkUsername = '$username'";
        $queryString = $this->db->update_string('tblTasker', $data, $where);
        $this->db->query($queryString);
    }

    function confirmAuthKey($username, $authKey) {
        $queryString = "SELECT 1 FROM tblTasker WHERE pkUsername='$username' AND fldAuthKey='$authKey' LIMIT 1";
        $query = $this->db->query($queryString);
        return $query->result();
    }

    function resetPassword() {
        $this->password = $this->input->post('fldPassword1');
        $this->username = $this->input->post('fldUsername');

        $data = array('fldPassword' => $this->password, 'fldAuthKey' => "");
        $where = "pkUsername = '$this->username'";
        $queryString = $this->db->update_string('tblTasker', $data, $where);
        $query = $this->db->query($queryString);
    }

    function setAccountActive($username) {
        $this->username = $username;

        $data = array('fldLevel' => 1);
        $where = "pkUsername = '$this->username'";
        $queryString = $this->db->update_string('tblTasker', $data, $where);
        $query = $this->db->query($queryString);
    }

}

?>