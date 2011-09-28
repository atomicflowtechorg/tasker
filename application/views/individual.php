<article class='listView'>
	<h2>My Page</h2>
	
	<?	
		// echo validation_errors(); 
		// $attributes = array('class' => 'addTask');
		// echo form_open('grabBag',$attributes);
// 		
		// $addTask = array(
	          // 'name'        => 'taskName',
	          // 'id'          => 'taskName',
	          // 'placeholder' => 'Add a task...',
	          // 'maxlength'   => '30',
	          // 'size'        => '30',
	        // );
		// echo form_input($addTask);
		// echo form_submit('addTaskButton','Add Task');
		// echo form_close();
	?>
	<?
	foreach($user as $row)
	{
		echo "<div class='userInfo' style='float:left;'>";
		echo "<a href='/individual/$row->pkUsername' title='$row->pkUsername'><img src='".$row->fldProfileImage."' alt='".$row->fldFirstname." ".$row->fldLastname." class='userProfileImage' style='max-height:80px;'/></a>";
		echo "<p>Status: ".$row->fldStatus."</p>";
		echo $row->fldFirstname." ".$row->fldLastname;
		echo "<br/>Last Logged in: ".$row->fldLastLoggedIn;
		echo "</div>";
		?>
		<div class="myButtons">
		<a href="/individual/teams/<? echo $row->pkUsername; ?>" title="View My Teams">Teams</a>
		<a href="#" title="View My Lists">Lists</a>
		<a href="#" title="View My Tasks">Tasks</a>
		</div>
		<?
	}
	?>
	
	

</article>

