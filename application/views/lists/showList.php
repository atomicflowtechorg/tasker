<?
$session = $this->session->all_userdata();

if($nav ==TRUE){
	?>
	<div class="tasksNav">
		<a href="/tasks/create/<? echo uri_string(); ?>" rel="#overlay" title="Create a task"> + </a>
		<a href="/lists/showUserLists/<? echo $user; ?>/" rel="#overlay" title="Load List"> --- </a>
	</div>
	<?
}
?>

	<ol class="taskList">
	<?
	if(count($tasks)==0)
	{
		echo '<li class="taskItem">No tasks exist for list <span class="showUsername">'.$listName.'</span> OR list <span class="showUsername">'.$listName.'</span> doesn'."'".'t exist</li>';
	}
	else{
		foreach ($tasks as $row) {
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
	}
	?>


