<!-- Login Form -->
<div id="login">
	<div id="errorConsole">
	</div>
	
	<?php
	$session = $this->session->all_userdata();
	if(!isset($session['logged_in']) || $session['logged_in']==FALSE)
	{
		echo validation_errors();
		$attributes = array('class' => 'clearfix', 'id' => 'signUpForm', 'name' =>'signUpForm', 'class'=>'unAuthenticatedForm');
		echo form_open('authentication/signUp',$attributes);
		echo form_fieldset("<h1>New User Registration</h1>");
		
		echo form_label('First Name:','fldFirstname');
		$firstName = array(
					  'name'        => 'fldFirstname',
					  'type'		=> 'text',
					  'id'          => 'fldFirstname',
					  'class'		=> 'field',
					  'value'       => set_value('fldFirstname'),
					  'maxlength'   => '60',
					  'size'        => '23',
					  'required'	=> '',
					);			
		echo form_input($firstName);
		
		echo form_label('Last Name:','fldLastname');
		$lastName = array(
					  'name'        => 'fldLastname',
					  'type'		=> 'text',
					  'id'          => 'fldLastname',
					  'class'		=> 'field',
					  'value'       => set_value('fldLastname'),
					  'maxlength'   => '60',
					  'size'        => '23',
					  'required'	=> '',
					);			
		echo form_input($lastName);
		
		echo form_label('Email:','fldEmail');
		$email = array(
					  'name'        => 'fldEmail',
					  'type'		=> 'email',
					  'id'          => 'fldEmail',
					  'class'		=> 'field',
					  'value'       => set_value('fldEmail'),
					  'maxlength'   => '120',
					  'size'        => '23',
					  'required'	=> '',
					);			
		echo form_input($email);
		
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

		echo form_label('Password:','fldPassword1');
		$password = array(
					  'name'        => 'fldPassword1',
					  'type'		=> 'password',
					  'id'          => 'fldPassword1',
					  'class'		=> 'field',
					  'value'       => set_value('fldPassword1'),
					  'maxlength'   => '60',
					  'size'        => '25',
					  'required'	=> '',
					);
		echo form_password($password);
		
		echo form_label('Confirm Password:','fldPassword2');
		$passwordConfirm = array(
					  'name'        => 'fldPassword2',
					  'type'		=> 'password',
					  'id'          => 'fldPassword2',
					  'class'		=> 'field',
					  'value'       => set_value('fldPassword2'),
					  'maxlength'   => '60',
					  'size'        => '25',
					  'required'	=> '',
					);
		echo form_password($passwordConfirm);

		$submit = array(
					  'name'        => 'submit',
					  'id'          => 'submitBtn',
					  'class'       => 'bt_createUser',
					  'value'       => 'Create User',
					);
		echo	"<div class='clear'></div>";
		echo form_submit($submit);
		
		echo form_fieldset_close();
		echo form_close();
		
		}
		?>
</div><!-- LoginForm End -->