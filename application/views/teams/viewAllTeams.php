<article class='listView'>
	<h2>Teams</h2>
	
	<ol class="teamList">
		<li class="teamItem">
			<?php echo lang('team_create'); ?>
			<div class ='teamOptions'>
				<a href='<?php echo site_url("teams/create"); ?>' title='<?php echo lang('team_create'); ?>'  class="ajax_anchor_load"><?php echo lang('team_create'); ?></a>
			</div>
		</li>
		<li class="teamItem">
			All Users
			<div class ='teamOptions'>
				<a href='<?php echo site_url("teams/allUsers"); ?>' title='<?php echo lang('team_view_all_title'); ?>'  class="ajax_anchor_load"><?php echo lang('team_view_text'); ?></a>
			</div>
		</li>


<?php
$session = $this->session->all_userdata();
$count = 0;
$modifyLink = "";

foreach($teams as $row)
{
	$countUsers = 0;
	foreach($users[$count] as $user)
	{
		if($users[$count][$countUsers]->pkUsername == $session['username'])
		{
			$modifyLink = "<a href='".site_url("teams/modify/$row->fldUrl")."'title='".lang('team_modify_title',array($row->pkTeamName))."'  class='ajax_anchor_load'>".lang('team_modify_text')."</a>";
		}
		$countUsers++;
	}

	
	
	echo "<li class='teamItem'>";
	echo $row->pkTeamName;
	echo "<div class='teamOption' >";
	echo "<a href='".site_url("teams/show/$row->fldUrl")."' title='".lang('team_view_text')." $row->pkTeamName' class='ajax_anchor_load'>".lang('team_view_text')."</a>";
	echo " ".$modifyLink;
	echo "</div>";
	echo "</li>";
	$modifyLink = '';
	$count++;
}

?>
	</ol>
</article>