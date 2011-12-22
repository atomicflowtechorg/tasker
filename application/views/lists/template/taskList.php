	<ol class="taskList">
	<?php
	if(count($taskList)==0)
	{
		echo '<li class="taskItem">'.$empty_list.'</li>';
	}
	else{
		foreach ($taskList as $task) {
			$this->load->view('tasks/template/taskItem',$task);
		}
	}
	?>
	</ol>