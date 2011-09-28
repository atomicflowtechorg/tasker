<article class='listView'>
	<h2>My Teams</h2>
	
	<?
	$session = $this->session->all_userdata();
	
	foreach($teams as $row)
	{

		echo "<li class='teamItem'>";
		echo $row->fkTeamName;
		echo "<div class='teamOption' >";
		echo "<a href='/teams/show/$row->fldUrl' title='view $row->fkTeamName'>View</a>";
		echo "</div>";
		echo "</li>";
	}
	?>
	<div class="myButtons">
		<a href="#" title="View My Teams">Teams</a>
		<a href="#" title="View My Lists">Lists</a>
		<a href="#" title="View My Tasks">Tasks</a>
	</div>
	

</article>

