<article class='listView'>
	<h2>GrabBag List</h2>
	
	<div class="tasksNav">
		<a href="<?php echo site_url("tasks/create/".uri_string()); ?>" rel="#overlay" title="Create a task"> + </a>
	</div>

	<ol class="taskList">
	<?php
	foreach ($results as $row) {
		?>
		<li class="taskItem">
		<?php echo $row->fldName; ?>
		
		<div class="taskOptions">
			<a href='<?php echo site_url("tasks/view/".uri_string()."/".$row->pkTaskId); ?>' rel="#overlay" title="Information" >i</a>
			<a href='<?php echo site_url("tasks/assignTo/".uri_string()."/".$row->pkTaskId); ?>' title="Assign Task">+</a>
			<a href='<?php echo site_url("tasks/delete/".uri_string()."/".$row->pkTaskId); ?>' title="Delete" class="deleteTask">X</a>
		</div>
		
		</li>
		<?php
	}
	?>
	</ol>
</article>
