<article class='listView'>
	<h2>GrabBag List</h2>
	
	<?	
		$attributes = array('class' => 'addTask');
		echo form_open('grabBag',$attributes);
		
		$addTask = array(
	          'name'        => 'taskName',
	          'id'          => 'taskName',
	          'maxlength'   => '140',
	          'size'        => '30',
			  'placeholder' => 'Add a task...',
	        );
		echo form_input($addTask);
		echo form_submit('addTaskButton','Add Task');
		echo form_close();
	?>
	
	
	<ol class="taskList">
	<?
	foreach ($results as $row) {
		?>
		<li class="taskItem">
		<? echo $row->fldName; ?>
		
		<div class="taskOptions">
			<a href='/tasks/view/<? echo uri_string()."/".$row->pkTaskId; ?>' rel="#overlay" title="Information" >i</a>
			<a href='/tasks/assignTo/<? echo $row->pkTaskId; ?>' title="Assign Task">+</a>
			<a href='/tasks/delete/<? echo uri_string()."/".$row->pkTaskId; ?>' title="Delete" class="deleteTask">X</a>
		</div>
		
		</li>
		<?
	}
	?>
	</ol>
</article>
