<!-- VIEW DEFAULT NAV.PHP -->
<?php
$session = $this->session->all_userdata();
if(isset($session['logged_in']) && $session['logged_in']==TRUE){
?>
<nav id="appnav"> 
    <ul>
        <a href="<?php echo site_url('individual'); ?>" class="ajax_anchor_load"><li class="blueRing" title="<?php echo lang('nav_individual_anchor_title'); ?>"><?php echo lang('nav_individual_anchor_text'); ?></li></a>

        <a href="<?php echo site_url('teams'); ?>" class="ajax_anchor_load"><li class="greenRing" title="<?php echo lang('nav_team_anchor_title'); ?>"><?php echo lang('nav_team_anchor_text'); ?></li></a>

        <a href="<?php echo site_url('universal'); ?>" class="ajax_anchor_load"><li class="yellowRing" title="<?php echo lang('nav_universal_anchor_title'); ?>"><?php echo lang('nav_universal_anchor_text'); ?></li></a>

        <a href="<?php echo site_url('grabBag'); ?>" class="ajax_anchor_load"><li class="orangeRing" title="<?php echo lang('nav_grabbag_anchor_title'); ?>"><?php echo lang('nav_grabbag_anchor_text'); ?></li></a>

    </ul>
</nav>
<?php
}
else{
	
}
?>
<div id="content" class="container_20">