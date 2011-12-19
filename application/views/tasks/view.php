<div class="taskView">
<?php
$currentUser = "";
$currentList = "";
$currentProfile = "";
foreach($task as $row)
{
	if( isset($row->pkUsername))
	{
		$currentUser = $row->pkUsername;
		$currentProfile = $row->fldProfileImage;
	}
	
	if( isset($row->pkListId))
	{
		$currentList = "List: ".$row->fldListName;
	}
	
	echo validation_errors(); 
	
	$attributes = array('class' => 'tasksView');
	echo form_open('tasks/view/'.$row->pkTaskId, $attributes);
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
	echo form_dropdown('username',$options,$currentUser);
	echo "<a href='".site_url("individual/$currentUser")."' title='$currentUser'><img src='../".$currentProfile."' title='".$currentUser."' class='taskProfileImage'/></a>";
	
	
	
	echo form_label('Status:', 'status');
	foreach($statusOptions as $option)
	{
		$statusOption[$option->pkStatus] = $option->pkStatus;
	}
	
	echo form_dropdown('status', $statusOption, $row->fldStatus);
	
	echo $currentList;
	
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
?>
</div>