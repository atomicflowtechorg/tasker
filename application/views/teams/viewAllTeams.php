<article class='listView'>
	<h2>My Task List</h2>
	
	<ol class="teamList">
		<li class="teamItem">
			Create New Team
			<div class ='teamOptions'>
				<a href='<?php echo site_url("teams/create"); ?>' title='Create New Team'>Create New Team</a>
			</div>
		</li>
		<li class="teamItem">
			All Users
			<div class ='teamOptions'>
				<a href='<?php echo site_url("teams/allUsers"); ?>' title='View All Taskers'>View</a>
			</div>
		</li>


<?php
$session = $this->session->all_userdata();
$count = 0;
$modifyLink = '';

foreach($teams as $row)
{
	$countUsers = 0;
	foreach($users[$count] as $user)
	{
		if($users[$count][$countUsers]->pkUsername == $session['username'])
		{
			$modifyLink = "<a href='".site_url("teams/modify/$row->fldUrl")."'>Modify</a>";
		}
		$countUsers++;
	}

	
	
	echo "<li class='teamItem'>";
	echo $row->pkTeamName;
	echo "<div class='teamOption' >";
	echo "<a href='".site_url("teams/show/$row->fldUrl")."' title='view $row->pkTeamName'>View</a>";
	echo $modifyLink;
	echo "</div>";
	echo "</li>";
	$modifyLink = '';
	$count++;
}

?>
	</ol>
</article>