<article class='listView'>
	<h2>Universal Task List</h2>
	

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
