<?php
$session = $this->session->all_userdata();
$title = "My Task List";
if(isset($user)){
	$title = "$user Task List";
}
?>
<article class='listView'>
	<h2><?php echo $title; ?></h2>
	
	<div class="tasksNav">
		<a href="<?php echo site_url("tasks/create/".uri_string()); ?>" rel="#overlay" title="Create a task"> + </a>
		<a href="<?php echo site_url("lists/showUserLists/$user");?>" rel="#overlay" title="Load List"> --- </a>
	</div>
	
	<ol class="taskList">
	<?php
	if(count($results)==0)
	{
		echo '<li class="taskItem">No tasks exist for user <span class="showUsername">'.$user.'</span> OR user <span class="showUsername">'.$user.'</span> doesn'."'".'t exist</li>';
	}
	else{
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
	}
	?>
	</ol>
</article>

