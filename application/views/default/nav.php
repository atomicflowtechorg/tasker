<?php
$session = $this->session->all_userdata();
if(isset($session['logged_in']) && $session['logged_in']==TRUE){
?>
<nav id="appnav"> 
    <ul>
        <a href="<?php echo site_url('individual'); ?>"><li class="blueRing" title="Your Tasks">Individual</li></a>

        <a href="<?php echo site_url('teams'); ?>"><li class="greenRing" title="Your Team's Tasks">Team</li></a>

        <a href="<?php echo site_url('universal'); ?>"><li class="yellowRing" title="Every Task In The System">Universal</li></a>

        <a href="<?php echo site_url('grabBag'); ?>"><li class="orangeRing" title="All Unassigned Tasks">Grab Bag</li></a>

    </ul>
</nav>
<?php
}
else{
	
}
?>
<div id="content">