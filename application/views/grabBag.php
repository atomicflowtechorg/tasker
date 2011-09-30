<article class='listView'>
	<h2>GrabBag List</h2>
	
	<div class="tasksNav">
		<a href="/tasks/create/<? echo uri_string(); ?>" rel="#overlay" title="Create a task"> + </a>
	</div>

	<ol class="taskList">
	<?
	foreach ($results as $row) {
		?>
		<li class="taskItem">
		<? echo $row->fldName; ?>
		
		<div class="taskOptions">
			<a href='/tasks/view/<? echo uri_string()."/".$row->pkTaskId; ?>' rel="#overlay" title="Information" >i</a>
			<a href='/tasks/assignTo/<? echo uri_string()."/".$row->pkTaskId; ?>' title="Assign Task">+</a>
			<a href='/tasks/delete/<? echo uri_string()."/".$row->pkTaskId; ?>' title="Delete" class="deleteTask">X</a>
		</div>
		
		</li>
		<?
	}
	?>
	</ol>
</article>
