<div class="ca-item">
			<div class="ca-item-main">
				<div class="ca-icon">
                                    <a href='<?php echo site_url("individual/$pkUsername"); ?>' title='<?php echo $pkUsername; ?>' class='ajax_anchor_load'>
                                        <img src='<?php echo base_url().$fldProfileImage; ?>' alt='<?php echo $fldFirstname." ".$fldLastname; ?> class='userProfileImage' style='max-height:80px;'/>
                                    </a>
                                </div>
				<h3><?php echo $fldFirstname." ".$fldLastname; ?></h3>
				<h4>
					<span class="ca-quote">“</span>
					<span>
                                            <p><?php echo lang('team_user_status_title'); ?></p>
                                            <p><?php echo $fldStatus; ?></p>
                                            <?php echo $fldFirstname." ".$fldLastname; ?>
                                            <br/><?php echo lang('team_user_lastLoggedIn_text').": ".$fldLastLoggedIn; ?>
                                        </span>
				</h4>
					<a href="#" class="ca-more">more...</a>
			</div>
			<div class="ca-content-wrapper">
				<div class="ca-content">
					<h6>Animals are not commodities</h6>
					<a href="#" class="ca-close">close</a>
					<div class="ca-content-text">
						<p>Some more text...</p>
					</div>
					<ul>
						<li><a href="#">Read more</a></li>
						<li><a href="#">Share this</a></li>
						<li><a href="#">Become a member</a></li>
						<li><a href="#">Donate</a></li>
					</ul>
				</div>
			</div>
		</div>