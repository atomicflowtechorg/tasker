<?
$session = $this->session->all_userdata();
if(isset($session['logged_in']) && $session['logged_in']==TRUE){
?>
<nav id="appnav"> 
    <ul>
        <a href="/individual/"><li class="blueRing" title="Your Tasks">Individual</li></a>

        <a href="/teams/"><li class="greenRing" title="Your Team's Tasks">Team</li></a>

        <a href="/universal/"><li class="yellowRing" title="Every Task In The System">Universal</li></a>

        <a href="/grabBag/"><li class="orangeRing" title="All Unassigned Tasks">Grab Bag</li></a>

    </ul>
</nav>
<?
}
else{
	
}
?>
<div id="content">