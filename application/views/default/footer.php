            </div><!-- end of content -->
	</div> <!-- end container --> 
    <footer>
     <p>&copy; Copyright  by AtomicFlow Creative</p>
     <?php
     	 $session = $this->session->all_userdata();
     	 print_r($session);
     ?>
    </footer>
  </div>
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
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/blend/jquery.blend.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.tools.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jqueryslidemenu.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.contentcarousel.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/taskscript.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/searchBox/searchBox.js"></script> 
<?php
$session = $this->session->all_userdata();
if(!isset($session['logged_in']) || $session['logged_in']==FALSE){
?>
<!-- JQUERY LOGOUT BUTTON -->
<script>
	$(document).ready(function(){
		$('#logout').hide();
	});
</script>
<?php
}
?>
</body>
</html>
