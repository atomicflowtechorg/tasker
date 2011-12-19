<div class="taskItem">
<?php
$currentUser = "";
$currentList = "";
foreach($task as $row)
{

	if( isset($row->pkUsername))
	{
		$currentUser = $row->pkUsername;
	}
	if( isset($row->pkListId))
	{
		$currentList = $row->pkListId;
	}
	
	echo validation_errors(); 
	
	$attributes = array('class' => 'tasksView');
	echo form_open('tasks/assignTo/'.$row->pkTaskId, $attributes);
	
	$taskId = array('taskId' => $row->pkTaskId);
	echo form_hidden($taskId);
	
	echo "<h2>".$row->fldName."</h2>";

	echo form_label('Assigned to User:', 'username');
	$options['']='';
	foreach($users as $user)
	{
		$options[$user->pkusername] = $user->pkusername;
	}
	
	echo form_dropdown('username',$options,$currentUser);
	
	echo form_label('List:', 'list');
	
	$lists['']='';
	foreach($availableList as $option)
	{
		$lists[$option->pkListId] = $option->fldListName;
	}
	
	echo form_dropdown('list', $lists, $currentList);
	
	echo form_submit('assign', 'Assign');
}
?>
</br>
</div>