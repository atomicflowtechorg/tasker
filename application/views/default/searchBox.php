<div id="searchBoxContainer">
    <form id="searchForm" method="post" action="<?php echo site_url('search'); ?>">
        <div>
            <input id="searchBoxInput" name="searchBoxInput" placeholder="Search here..." type="text"/>
            <div id="searchHelpContainer">
                <nav> 
                    <ul>
                        <a href="<?php echo site_url('individual'); ?>" class="ajax_anchor_load"><li title="<?php echo lang('nav_individual_anchor_title'); ?>"><img src="<?php echo base_url('images/icons/user.png'); ?>"></img></li></a>
                        <a href="<?php echo site_url('teams'); ?>" class="ajax_anchor_load"><li title="<?php echo lang('nav_team_anchor_title'); ?>"><img src="<?php echo base_url('images/icons/group.png'); ?>"></img></li></a>
                        <a href="<?php echo site_url('universal'); ?>" class="ajax_anchor_load"><li title="<?php echo lang('nav_universal_anchor_title'); ?>"><img src="<?php echo base_url('images/icons/list2.png'); ?>"></img></li></a>
                        <a href="<?php echo site_url('grabBag'); ?>" class="ajax_anchor_load"><li title="<?php echo lang('nav_grabbag_anchor_title'); ?>"><img src="<?php echo base_url('images/icons/money_bag_dollar.png'); ?>"></img></li></a>
                    </ul>
                </nav>
            </div>
            <input type="submit" value="GO"/>
        </div>
    </form>
</div>