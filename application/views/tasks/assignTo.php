<div class="taskItem">
<?
foreach($task as $row)
{
	if( isset($row->pkUsername))
	{
		//echo "<h3>".$row->fldName."</h3>";
		//echo "<a href='/individual/show/$row->pkUsername' title='$row->pkUsername'><img src='".$row->fldProfileImage."' title='".$row->pkUsername."' class='taskProfileImage'/></a>";
		//echo "<p>Assigned to: ".$row->pkUsername."</p>";
		//echo "<p>DueDate: ".$row->fldDateDue."</p>";
		//echo "<p>Notes: ".$row->fldNotes."</p>";
		
		echo validation_errors(); 
		
		$attributes = array('class' => 'tasksView');
		echo form_open('tasks/assignTo/'.$location.'/'.$row->pkTaskId, $attributes);
		
		$taskId = array('taskId' => $row->pkTaskId);
		echo form_hidden($taskId);
		
		echo "<h2>".$row->fldName."</h2>";

		echo form_label('Assigned to:', 'username');
		$options['grabbag']='';
		foreach($users as $user)
		{
			$options[$user->pkusername] = $user->pkusername;
		}
		
		echo form_dropdown('username',$options,$options['grabbag']);
		
		echo form_submit('assign', 'Assign');
	}
	else
	{
		// echo "<h3>".$row->fldName."</h3>";
		// echo "<img src='/images/noImage.jpg' title='profileImage' class='taskProfileImage'/>";
		// echo "<p>Assigned to: No one</p>";
		// echo "<p>DueDate: ".$row->fldDateDue."</p>";
		// echo "<p>Notes: ".$row->fldNotes."</p>";
		
		
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