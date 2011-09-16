<div id="toppanel">
	<div id="panel" style="display: none; ">
		<div class="content clearfix">
			<div class="left">
				<!--<h1>Welcome to AtomicFlow</h1>	-->
				<!--<p class="grey"></p> class for grey text-->
				<!--<h2>class for header 2</h2>-->
				<img src="/images/logos/logoSymbol_login.png" alt="" />
			</div>
			<div class="left">
				<!-- Login Form -->
				<form class="clearfix" action="#" method="post">
					<h1>Client Login</h1>
					<label class="grey" for="log">Username:</label>
					<input class="field" type="text" name="log" id="log" value="" size="23">
					<label class="grey" for="pwd">Password:</label>
					<input class="field" type="password" name="pwd" id="pwd" size="23">
	            	<label><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever"> &nbsp;Remember me</label>
        			<div class="clear"></div>
					<input type="submit" name="submit" value="Login" class="bt_login">
					<a class="lost-pwd" href="#">Lost password? Ask Celery Man.</a>
				</form>
			</div>
			<div class="left right">			
				<!-- Register Form -->
				<form action="#" method="post">
					<h1>Seriously? Not a client yet?</h1>
					<h2>Have <span class="orangeText">YOUR PEOPLE</span> call <span class="blueText"> OUR PEOPLE.</span></h2>			
					<label class="grey" for="signup">Your Name:</label>
					<input class="field" type="text" name="signup" id="signup" value="" size="23">
					<label class="grey" for="email">Email:</label>
					<input class="field" type="text" name="email" id="email" size="23">
					<label>Don't worry. We'll fix this together.</label>
					<input type="submit" name="submit" value="SEND" class="bt_register">
				</form>
			</div>
		</div>
</div> <!-- /login -->	



	<!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
			<li class="left">&nbsp;</li>
			<li>Hello Guest!</li>
			<li class="sep">|</li>
			<li id="toggle">
				<a id="open" class="open" href="#" style="display: block; ">Log In | Register</a>
				<a id="close" style="display: none; " class="close" href="#">Close Panel</a>			
			</li>
			<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->
</div><!--#end login panel" -->
