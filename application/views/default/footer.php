<footer>
    <p>&copy; Copyright  by AtomicFlow Creative</p>
</footer>
<!-- overlayed element -->
<div class="simple_overlay" id="overlay">

    <!-- the external content is loaded inside this tag -->
    <div class="contentWrap"></div>
</div>
<!-- JQUERY LIBRARIES LOAD -->
<!-- USE MINIFIED JS 
<script type="text/javascript" src="/js/jquery-1.6.2.js"></script>
<script type="text/javascript" src="/js/blend/jquery.blend.js"></script>
<script type="text/javascript" src="/js/taskscript.js"></script> 
-->

<!-- Minified JS -->
<script>
    var individual_url = "<?php echo site_url('individual'); ?>";
    var username = "<?php echo $session['username'] ?>";
    var userImage = "<?php     $default = base_url() . "images/profiles/default.jpg";
    echo "http://www.gravatar.com/avatar/" . md5(strtolower(trim($session['email']))) . "?d=" . urlencode($default) . "&s=40";?>";
</script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/webSockets/socket.io.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/blend/jquery.blend.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.tools.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jqueryslidemenu.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.contentcarousel.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/taskscript.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/searchBox/searchBox.js"></script> 

<script type="text/javascript" src="<?php echo base_url(); ?>js/webSockets/scripts.js"></script> 
