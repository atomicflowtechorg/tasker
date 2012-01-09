<section id="toolBar" class="container_full">
    <div id="toolBarContent" class="container_20">
        <div id="toolbarLogo" class="grid_4">
            <a href="<?php echo base_url(); ?>"><h1>TeamTasker V1 by AFTech</h1></a>
        </div>
        <div id="updateMessage">

        </div>
        <div id="myslidemenu">
            <ul>
                <li>
                    <span class="username"><?php echo $session['username']; ?></span>
                    <ul>
                        <li><a href="<?php echo site_url('authentication/preferences'); ?>"><?php echo lang('user_dropdown_preferences'); ?></a></li>
                        <li><a href="<?php echo site_url('authentication/help'); ?>"><?php echo lang('user_dropdown_help'); ?></a></li>
                        <li><a href="<?php echo site_url('authentication/checkLogout'); ?>"><?php echo lang('user_dropdown_logout'); ?></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</section>