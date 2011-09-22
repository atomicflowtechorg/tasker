    </div><!-- end of content -->
	</div> <!-- end container --> 
    <footer>
     <p>&copy; Copyright  by AtomicFlow Creative</p>
     <?
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
<script type="text/javascript" src="/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="/js/blend/jquery.blend.min.js"></script>
<script type="text/javascript" src="/js/taskscript.min.js"></script> 
<script type="text/javascript" src="/js/jquery.tools.min.js"></script>

<!-- <script type="text/javascript" src="/js/loginForm.js"></script> -->
<!-- JQUERY LOGOUT BUTTON -->
<script>
	$(document).ready(function(){
		<?
		$session = $this->session->all_userdata();
		if(!isset($session['logged_in']) || $session['logged_in']==FALSE){
			echo "$('#logout').hide();";
		}
		?>
	});
</script>

<script>
	$(function() {

	// if the function argument is given to overlay,
	// it is assumed to be the onBeforeLoad event listener
	$("a[rel]").overlay({

		mask: 'darkred',

		onBeforeLoad: function() {

			// grab wrapper element inside content
			var wrap = this.getOverlay().find(".contentWrap");

			// load the page specified in the trigger
			wrap.load(this.getTrigger().attr("href"));
		}

	});
});
</script>

</body>
</html>
