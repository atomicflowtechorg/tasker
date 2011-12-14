<div class="taskView">
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
		echo form_open('tasks/view/'.$location.'/'.$row->pkTaskId, $attributes);
		echo form_fieldset();
		$taskId = array(
				  'taskId'  => $row->pkTaskId
				);
		echo form_hidden($taskId);
		
		echo form_label('Name:', 'name');
		$taskName = array(
				  'name'        => 'name',
				  'id'          => 'name',
				  'value'       => $row->fldName,
				  'maxlength'   => '140',
				  'size'        => '50',
				);
		echo form_input($taskName);
		
		echo form_label('Assigned to:', 'username');
		
		$options['']='';
		
		foreach($users as $user)
		{
			$options[$user->pkusername] = $user->pkusername;
		}
		echo form_dropdown('username',$options,$row->pkUsername);
		echo "<a href='".site_url("individual/$row->pkUsername")."' title='$row->pkUsername'><img src='../".$row->fldProfileImage."' title='".$row->pkUsername."' class='taskProfileImage'/></a>";
		echo form_label('Status:', 'status');
		foreach($statusOptions as $option)
		{
			$statusOption[$option->pkStatus] = $option->pkStatus;
		}
		
		echo form_dropdown('status', $statusOption, $row->fldStatus);

		
		echo form_label('Date Due:', 'dateDue');
		$dueDate = array(
				  'name'        => 'dateDue',
				  'id'          => 'dateDue',
				  'value'       => $row->fldDateDue,
				  'maxlength'   => '140',
				  'size'        => '50',
				);
		echo form_input($dueDate);
		
		echo "<br/>";
		
		echo form_label('Notes:', 'notes');
		$notes = array(
				  'name'        => 'notes',
				  'id'          => 'notes',
				  'value'       => $row->fldNotes,
				  'rows'  		=> 10,
				  'cols'        => 50,
				);
		echo form_textarea($notes);
		
		echo form_submit('update', 'Update');
		echo form_fieldset_close();
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
		echo form_open('tasks/view/'.$location.'/'.$row->pkTaskId, $attributes);
		
		$taskId = array(
				  'taskId'  => $row->pkTaskId
				);
		echo form_hidden($taskId);
		
		echo form_label('Name:', 'name');
		$taskName = array(
				  'name'        => 'name',
				  'id'          => 'name',
				  'value'       => $row->fldName,
				  'maxlength'   => '140',
				  'size'        => '50',
				);
		echo form_input($taskName);
		
		echo form_label('Assigned to:', 'username');
		$options['']='';
		foreach($users as $user)
		{
			$options[$user->pkusername] = $user->pkusername;
		}
		
		
		echo form_dropdown('username',$options,'');

		echo "<img src='../images/noImage.jpg' title='profileImage' class='taskProfileImage'/>";
		echo form_label('Status:', 'status');

		foreach($statusOptions as $option)
		{
			$statusOption[$option->pkStatus] = $option->pkStatus;
		}
		
		echo form_dropdown('status', $statusOption, $row->fldStatus);
		
		
		
		echo form_label('Date Due:', 'dateDue');
		$dueDate = array(
				  'name'        => 'dateDue',
				  'id'          => 'dateDue',
				  'value'       => $row->fldDateDue,
				  'maxlength'   => '140',
				  'size'        => '50',
				);
		echo form_input($dueDate);
		
		echo "<br/>";
		
		echo form_label('Notes:', 'notes');
		$notes = array(
				  'name'        => 'notes',
				  'id'          => 'notes',
				  'value'       => $row->fldNotes,
				  'rows'  		=> 10,
				  'cols'        => 50,
				);
		echo form_textarea($notes);
		
		echo form_submit('update', 'Update');
	}

}
?>
</div>