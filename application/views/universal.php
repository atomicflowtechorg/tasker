<article class='listView'>
	<h2>Universal Task List</h2>
	

	<ol class="taskList">
	<?php
	foreach ($results as $row) {
		?>
		<li class="taskItem">
			<?php echo $row->fldName; ?>
			
		<div class="taskOptions">
			<a href='<?php echo site_url("tasks/view/".$row->pkTaskId); ?>' rel="#overlay" title="Information" >i</a>
			<a href='<?php echo site_url("tasks/assignTo/".$row->pkTaskId); ?>' rel="#overlay" title="Assign Task">+</a>
			<a href='<?php echo site_url("tasks/delete/".$row->pkTaskId); ?>' title="Delete" class="deleteTask">X</a>
		</div>
		</li>
		<?php
	}
	?>
	</ol>
</article>
