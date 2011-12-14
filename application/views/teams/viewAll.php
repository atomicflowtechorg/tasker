<?php
foreach($users as $row)
{
echo "<div class='userInfo' style='float:left;'>";
echo "<a href='".site_url("individual/$row->pkUsername")."' title='$row->pkUsername'><img src='../".$row->fldProfileImage."' alt='".$row->fldFirstname." ".$row->fldLastname." class='userProfileImage' style='max-height:80px;'/></a>";
echo "<p>Status</p>";
echo "<p>".$row->fldStatus."</p>";
echo $row->fldFirstname." ".$row->fldLastname;
echo "<br/>Last Logged in: ".$row->fldLastLoggedIn;
echo "</div>";		
}
?>
