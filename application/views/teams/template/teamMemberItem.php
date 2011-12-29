<div class="ca-item">
    <div class="ca-item-main">
        <div class="ca-icon">
            <a href='<?php echo site_url("individual/$pkUsername"); ?>' title='<?php echo $pkUsername; ?>' class='ajax_anchor_load'>
                <img src='<?php echo base_url() . $fldProfileImage; ?>' alt='<?php echo $fldFirstname . " " . $fldLastname; ?> class='userProfileImage' style='max-height:80px;'/>
            </a>
        </div>
        <h3><?php echo $fldFirstname . " " . $fldLastname; ?></h3>
        <a href="#" class="ca-more"><?php echo lang('team_more_link'); ?></a>
    </div>
    <div class="ca-content-wrapper">
        <div class="ca-content">
            <h6><?php echo $fldFirstname . " " . $fldLastname; ?></h6>
            <a href="#" class="ca-close">close</a>
            <div class="ca-content-text">
                <h4>
                    <span>
                        <p><?php echo lang('team_user_status_title'); ?>:  <?php echo $fldStatus; ?>
                            <span><?php echo lang('team_user_lastLoggedIn_text') . ": " . $fldLastLoggedIn; ?></span>
                        </p>
                    </span>
                </h4>
            </div>
        </div>
    </div>
</div>