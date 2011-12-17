<div class="taskItem">
<?php 
foreach($task as $row)
{
	if( isset($row->pkUsername))
	{
		echo validation_errors(); 
		
		$attributes = array('class' => 'tasksView');
		echo form_open('tasks/assignTo/'.$location.'/'.$row->pkTaskId, $attributes);
		
		$taskId = array('taskId' => $row->pkTaskId);
		echo form_hidden($taskId);
		
		echo "<h2>".$row->fldName."</h2>";

		echo form_label('Assigned to:', 'username');
		$options['']='';
		foreach($users as $user)
		{
			$options[$user->pkusername] = $user->pkusername;
		}
		
		echo form_dropdown('username',$options,$row->pkUsername);
		
		echo form_submit('assign', 'Assign');
	}
	else
	{
		echo validation_errors(); 
		
		$attributes = array('class' => 'tasksView');
		echo form_open('tasks/assignTo/'.$location.'/'.$row->pkTaskId, $attributes);
		
		$taskId = array( 'taskId'  => $row->pkTaskId);
		
		echo form_hidden($taskId);
		
		echo "<h2>".$row->fldName."</h2>";
		
		echo form_label('Assigned to:', 'username');
		$options['']='';
		foreach($users as $user)
		{
			$options[$user->pkusername] = $user->pkusername;
		}
		
		echo form_dropdown('username',$options,'');
		
		echo form_submit('assign', 'Assign');
	}

}
?>
</br>
</div>