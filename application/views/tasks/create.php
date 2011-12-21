<?php
echo validation_errors(); 
$attributes = array('class' => 'addTask');
echo form_open('tasks/create/',$attributes);

$addTask = array(
      'name'        => 'taskName',
      'id'          => 'taskName',
      'placeholder' => lang('task_create_name_placeholder'),
      'maxlength'   => '30',
      'size'        => '30',
    );
echo form_input($addTask);
echo form_submit('addTaskButton',lang('task_create_button'));
echo form_close();
?>