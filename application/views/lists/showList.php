<?php 
$session = $this->session->all_userdata();

if($nav ==TRUE){
	?>
	<div class="tasksNav">
		<a href="<?php echo site_url("tasks/create/".uri_string()); ?>" rel="#overlay" title="Create a task"> + </a>
		<a href="<?php echo site_url("lists/showUserLists/$user");?>" rel="#overlay" title="Load List"> --- </a>
	</div>
	<?php
}
?>

	<ol class="taskList">
	<?php
	if(count($tasks)==0)
	{
		echo '<li class="taskItem">No tasks exist for list <span class="showUsername">'.$listName.'</span> OR list <span class="showUsername">'.$listName.'</span> doesn'."'".'t exist</li>';
	}
	else{
		foreach ($tasks as $row) {
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
	}
	?>


