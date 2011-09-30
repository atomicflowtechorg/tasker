<?	
echo validation_errors(); 
$attributes = array('class' => 'addTask');
echo form_open('tasks/create/'.$location,$attributes);

$addTask = array(
      'name'        => 'taskName',
      'id'          => 'taskName',
      'placeholder' => 'Add a task...',
      'maxlength'   => '30',
      'size'        => '30',
    );
echo form_input($addTask);
echo form_submit('addTaskButton','Add Task');
echo form_close();
?>