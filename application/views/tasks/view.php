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
		$currentList = lang('task_list_label')." ".$row->fldListName;
	}
	
	echo validation_errors(); 
	
	$attributes = array('class' => 'tasksView');
	echo form_open('tasks/view/'.$row->pkTaskId, $attributes);
	echo form_fieldset();
	$taskId = array(
			  'taskId'  => $row->pkTaskId
			);
	echo form_hidden($taskId);
	
	$taskName = array(
			  'name'        => 'name',
			  'id'          => 'name',
			  'value'       => $row->fldName,
			  'maxlength'   => '140',
			  'size'        => '30',
			);
	echo form_input($taskName);
	
	echo form_label(lang('task_assignTo_label'), 'username');
	
	$options['']='';
	
	foreach($users as $user)
	{
		$options[$user->pkusername] = $user->pkusername;
	}
	echo form_dropdown('username',$options,$currentUser);
	echo "<a href='".site_url("individual/$currentUser")."' title='$currentUser'><img src='$currentProfile' title='".$currentUser."' class='taskProfileImage'/></a>";
	
	
	
	echo form_label(lang('task_status_label'), 'status');
	foreach($statusOptions as $option)
	{
		$statusOption[$option->pkStatus] = $option->pkStatus;
	}
	
	echo form_dropdown('status', $statusOption, $row->fldStatus);
	
	echo "<p>".$currentList."</p>";
	
	echo form_label(lang('task_dueDate_label'), 'dateDue');
	$dueDate = array(
			  'name'        => 'dateDue',
			  'id'          => 'dateDue',
			  'value'       => $row->fldDateDue,
			  'maxlength'   => '140',
			  'size'        => '30',
			);
	echo form_input($dueDate);
	
	echo "<br/>";
	
	echo form_label(lang('task_notes_label'), 'notes');
	$notes = array(
			  'name'        => 'notes',
			  'id'          => 'notes',
			  'value'       => $row->fldNotes,
			  'rows'  	=> 10,
			  'cols'        => 30,
			);
	echo form_textarea($notes);
	
	echo form_submit('update', lang('task_update_button'));
	echo form_fieldset_close();
}
?>
</div>