<section id="toolBar">
	<div>
		
	</div>
	<div id="updateMessage">
		
	</div>
	<div id="accountDropDown">
		<span class="username"><?php echo $session['username']; ?></span>
		<div class="dropDownList">
			<ul>
				<li><a href="<?php echo site_url('authentication/preferences'); ?>"><?php echo lang('user_dropdown_preferences'); ?></a></li>
				<li><a href="<?php echo site_url('authentication/help'); ?>"><?php echo lang('user_dropdown_help'); ?></a></li>
				<li><a href="<?php echo site_url('authentication/checkLogout'); ?>"><?php echo lang('user_dropdown_logout'); ?></a></li>
			</ul>
		</div>
	</div>
</section>