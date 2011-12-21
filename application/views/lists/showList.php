<article class='listView'>
	<h2><?php echo lang('list_view_tasks_label')." ".$listId." - ".$listName; ?></h2>
<?php 
$session = $this->session->all_userdata();

if($nav == TRUE){
	?>
	<div class="tasksNav">
		<a href="<?php echo site_url("tasks/create/".uri_string()); ?>" rel="#overlay" title="<?php echo lang('anchor_task_create'); ?>"> + </a>
		<a href="<?php echo site_url("lists");?>" rel="#overlay" title="<?php echo lang('anchor_list_load'); ?>"> --- </a>
	</div>
	<?php
}
?>

	<ol class="taskList">
	<?php
	if(count($tasks)==0)
	{
		echo '<li class="taskItem">'.$empty_list.'</li>';
	}
	else{
		foreach ($tasks as $row) {
			?>
			<li class="taskItem">
				<?php echo $row->fldName; ?>
				
			<div class="taskOptions">
				<a href='<?php echo site_url("tasks/view/".$row->pkTaskId); ?>' rel="#overlay" title="<?php echo lang('anchor_task_view'); ?>">i</a>
				<a href='<?php echo site_url("tasks/assignTo/".$row->pkTaskId); ?>' rel="#overlay" title="<?php echo lang('anchor_task_assign'); ?>">+</a>
				<a href='<?php echo site_url("tasks/delete/".$row->pkTaskId); ?>' title="Delete" class="<?php echo lang('anchor_task_delete'); ?>">X</a>
			</div>
			</li>
			<?php
		}
	}
	?>
</article>

