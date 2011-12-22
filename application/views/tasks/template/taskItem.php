<li class="taskItem">
<?php echo $fldName; ?>
	
<div class="taskOptions">
	<a href='<?php echo site_url("tasks/view/".$pkTaskId); ?>' rel="#overlay" title="<?php echo lang('anchor_task_view'); ?>">i</a>
	<a href='<?php echo site_url("tasks/assignTo/".$pkTaskId); ?>' rel="#overlay" title="<?php echo lang('anchor_task_assign'); ?>">+</a>
	<a href='<?php echo site_url("tasks/delete/".$pkTaskId); ?>' title="Delete" class="<?php echo lang('anchor_task_delete'); ?>">X</a>
</div>
</li>