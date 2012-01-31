<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
 */
// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller {
    
    function user_get() {
        $this->load->model('UserModel');
        if (!$this->get('username')) {
            $this->response(NULL, 400);
        }
        $user = $this->UserModel->get_user($this->get('username'));
        if ($user) {
            $this->response($user, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }

    function users_get() {
        $this->load->model('UserModel');
        $users = $this->UserModel->get_all_users();

        if ($users) {
            $this->response($users, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }
    
    /* TASK API SECTION ***********************************************/
    
    function task_get() {
        $this->load->model('TaskModel');
        
        if (!$this->get('id')) {
            $this->response(NULL, 400);
        }
        $task = $this->TaskModel->getTaskData($this->get('id'));
        if ($task) {
            $this->response($task, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'User could not be found'), 404);
        }
    }

    function task_post() {
        $this->load->model('TaskModel');
        
        $task;//new task object
        $taskId = $this->input->post('taskId');
        $taskProperties->fldName = $this->post('name');
        $taskProperties->fldAssignedTo = $this->post('username');
        $taskProperties->fldStatus = $this->post('status');
        $taskProperties->fldNotes = $this->post('notes');
        $taskProperties->fldDateDue = $this->post('dateDue');
        
        if (!$this->post('taskId')) {
            $this->response(NULL, 400);
        }
        
        $updateTask = $this->TaskModel->update($taskId, $taskProperties);
        if ($updateTask) {
            $this->response($updateTask, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Task could not be found'), 404);
        }
    }

    function task_create() {
        $this->load->model('TaskModel');

    }
    
    function task_delete() {
        $this->load->model('TaskModel');

    }
    
    function tasks_get() {
        $this->load->model('TaskModel');
    }

}