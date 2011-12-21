<?php
	
echo validation_errors(); 
$attributes = array('class' => 'inviteTasker');
echo form_open('teams/modify/'.$teamUrl,$attributes);

if(count($nonUsers)>0){
	foreach($nonUsers as $user)
	{
		$options[$user->pkUsername] = $user->pkUsername;
	}
	echo form_dropdown('username',$options,'');
	echo form_hidden('team',$team);
	echo form_submit('invite','Invite User');
	echo form_close();
}


foreach($users as $row)
{

echo "<div class='userInfo' style='float:left;'>";
echo "<a href='".site_url("individual/$row->pkUsername")."' title='$row->pkUsername'>
<img src='".base_url().$row->fldProfileImage."' alt='".$row->fldFirstname." ".$row->fldLastname." class='userProfileImage' style='max-height:80px;'/>
</a>";
echo "<p>".lang('team_user_status_title')."</p>";
echo "<p>".$row->fldStatus."</p>";
echo $row->fldFirstname." ".$row->fldLastname;
echo "<br/>".lang('team_user_lastLoggedIn_text').": ".$row->fldLastLoggedIn;
?>
<div class='userOptions'>
	<a href='<?php echo site_url("teams/delete/$teamUrl/$row->pkUsername"); ?>' title='<?php echo lang('team_user_remove_title'); ?>'><?php echo lang('team_user_remove_text'); ?></a>
	<a href='#' title='<?php echo lang('team_user_update_title'); ?>'><?php echo lang('team_user_update_text'); ?></a>
</div>
<?php
echo "</div>";		
}
?>