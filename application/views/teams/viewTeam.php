<?php
foreach($users as $row)
{
echo "<div class='userInfo' style='float:left;'>";
echo "<a href='".site_url("individual/$row->pkUsername")."' title='$row->pkUsername' class='ajax_anchor_load'>
<img src='".base_url().$row->fldProfileImage."' alt='".$row->fldFirstname." ".$row->fldLastname." class='userProfileImage' style='max-height:80px;'/>
</a>";
echo "<p>".lang('team_user_status_title')."</p>";
echo "<p>".$row->fldStatus."</p>";
echo $row->fldFirstname." ".$row->fldLastname;
echo "<br/>".lang('team_user_lastLoggedIn_text').": ".$row->fldLastLoggedIn;
echo "</div>";		
}
?>