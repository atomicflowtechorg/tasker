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
echo "<a href='/individual/$row->pkUsername' title='$row->pkUsername'>
<img src='".base_url().$row->fldProfileImage."' alt='".$row->fldFirstname." ".$row->fldLastname." class='userProfileImage' style='max-height:80px;'/>
</a>";
echo $row->fldFirstname." ".$row->fldLastname;
echo "<br/>Last Logged in: ".$row->fldLastLoggedIn;
?>
<div class='userOptions'>
	<a href='/teams/delete/<?php echo $teamUrl.'/'.$row->pkUsername;  ?>' title='Remove User'>Remove</a>
	<a href='#' title='Update Role'>Update Role</a>
</div>
<?php
echo "</div>";		
}
?>