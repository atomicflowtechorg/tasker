<div id="login">
	<div id="errorConsole">
	</div>
<?php
	if(isset($message)){
		echo $message;
	}
	echo validation_errors();
	$attributes = array('class' => 'clearfix', 'id' => 'emailForm', 'name' =>'emailForm', 'class'=>'unAuthenticatedForm');
	echo form_open('authentication/forgot',$attributes);
	echo form_fieldset("<h1>Forgot your password?</h1>");
	echo form_label('Email:','fldEmail');
	$email = array(
				  'name'        => 'fldEmail',
				  'type'		=> 'email',
				  'id'          => 'fldEmail',
				  'class'		=> 'field',
				  'value'       => set_value('fldEmail'),
				  'maxlength'   => '60',
				  'size'        => '23',
				  'required'	=> '',
				);			
	echo form_input($email);

	$submit = array(
				  'name'        => 'submit',
				  'id'          => 'submitBtn',
				  'class'       => 'bt_login',
				  'value'       => 'Send Email',
				);
	echo	"<div class='clear'></div>";
	echo form_submit($submit);
	
	echo form_fieldset_close();
	echo form_close();
	?>
</div><!-- LoginForm End -->