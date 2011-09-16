<div id="login">
<script>
    $(document).ready(function(){
		$('#errorConsole').hide();
		$('#logOut').hide();
		//navigation action 
		$("#logOut").click(function(){
			$('#errorConsole').html('you have successfully logged out').slideDown().delay(2000).slideUp();		
			$('#loginForm').fadeIn(1500);
			$('#logOut').slideUp();
		});

		$('form[name=loginForm]').submit(function(){
			$('#errorConsole').slideUp();
			$.post('/index.php/authentication/checkLogin',{fldUsername: $('[name=fldUsername]').val(),fldPassword: $('[name=fldPassword]').val()},
			function(data)
			{
				if(data.success)
				{
					$('#loginForm').slideUp(1000).fadeOut(500);
					
					$('#errorConsole').html(data.message).slideDown().delay(1000).slideUp();
					$('#logOut').fadeIn(1500);
				}
				else
				{
					$('#errorConsole').html(data.error).slideDown();
				}
			}, 'json');
			return false;
		});
	});
</script>
<div id="errorConsole">

</div>
<a href="#" id="logOut">log out</a>

<?php
echo validation_errors();
$attributes = array('class' => 'clearfix', 'id' => 'loginForm', 'name' =>'loginForm');
echo form_open('authentication',$attributes);
echo "<h1>Client Login</h1>";
echo form_label('Username:','fldUsername');
$username = array(
              'name'        => 'fldUsername',
			  'type'		=> 'text',
              'id'          => 'fldUsername',
              'value'       => set_value('fldUsername'),
              'maxlength'   => '23',
              'size'        => '23',
            );			
echo form_input($username);

echo form_label('Password:','fldPassword');
$password = array(
              'name'        => 'fldPassword',
			  'type'		=> 'password',
              'id'          => 'fldPassword',
              'value'       => set_value('fldPassword'),
              'maxlength'   => '25',
              'size'        => '25',
            );
echo form_password($password);

echo "<label>";
$rememberMe = array(
    'name'        => 'rememberme',
    'id'          => 'rememberme',
    'value'       => 'forever',
    'checked'     => TRUE,
    );
echo form_checkbox($rememberMe);
echo "&nbsp;Remember me</label>";

$submit = array(
              'name'        => 'submit',
              'id'          => 'submitBtn',
              'class'       => 'bt_login',
              'value'       => 'Login',
            );
echo "<br/>";
echo form_submit($submit);
echo form_fieldset_close();
echo site_url('authentication/forgot','Lost password? Ask Celery Man.','class="lost-pwd"');


?>
</div>