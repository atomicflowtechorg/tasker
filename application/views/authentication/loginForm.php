<!-- Login Form -->
<div id="login">
	<div id="errorConsole">
	</div>
	
	<?php
	$session = $this->session->all_userdata();
	if(!isset($session['logged_in']) || $session['logged_in']==FALSE)
	{
		if(isset($message)){
			echo $message;
		}
		echo validation_errors();
		$attributes = array('class' => 'clearfix', 'id' => 'loginForm', 'name' =>'loginForm', 'class'=>'unAuthenticatedForm');
		echo form_open('authentication',$attributes);
		echo form_fieldset("<h1>Client Login</h1>");
		echo form_label('Username:','fldUsername');
		$username = array(
					  'name'        => 'fldUsername',
					  'type'		=> 'text',
					  'id'          => 'fldUsername',
					  'class'		=> 'field',
					  'value'       => set_value('fldUsername'),
					  'maxlength'   => '60',
					  'size'        => '23',
					  'required'	=> '',
					);			
		echo form_input($username);

		echo form_label('Password:','fldPassword');
		$password = array(
					  'name'        => 'fldPassword',
					  'type'		=> 'password',
					  'id'          => 'fldPassword',
					  'class'		=> 'field',
					  'value'       => set_value('fldPassword'),
					  'maxlength'   => '60',
					  'size'        => '25',
					  'required'	=> '',
					);
		echo form_password($password);

		echo "<label>";
		echo "&nbsp;Remember me</label>";
		$rememberMe = array(
			'name'        => 'rememberme',
			'id'          => 'rememberme',
			'value'       => 'forever',
			'checked'     => TRUE,
			);
		echo form_checkbox($rememberMe);
		

		$submit = array(
					  'name'        => 'submit',
					  'id'          => 'submitBtn',
					  'class'       => 'bt_login',
					  'value'       => 'Login',
					);
		echo	"<div class='clear'></div>";
		echo form_submit($submit);
		
		echo form_fieldset_close();
		echo anchor('authentication/forgot','Lost password? Ask Celery Man.','class="lost-pwd"');
		echo form_close();
		
		}
		?>
	<a href="<?php echo site_url('authentication/checkLogout');?>" id="logout" title="Log Out">Log Out</a>
</div><!-- LoginForm End -->