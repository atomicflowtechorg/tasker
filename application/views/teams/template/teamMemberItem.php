<div class='userInfo' style='float:left;'>
	<a href='<?php echo site_url("individual/$pkUsername"); ?>' title='<?php echo $pkUsername; ?>' class='ajax_anchor_load'>
		<img src='<?php echo base_url().$fldProfileImage; ?>' alt='<?php echo $fldFirstname." ".$fldLastname; ?> class='userProfileImage' style='max-height:80px;'/>
	</a>
	<p><?php echo lang('team_user_status_title'); ?></p>
	<p><?php echo $fldStatus; ?></p>
	<?php echo $fldFirstname." ".$fldLastname; ?>
	<br/><?php echo lang('team_user_lastLoggedIn_text').": ".$fldLastLoggedIn; ?>
</div>	