$(document).ready(function(){
	$('#loginForm').fadeIn(1500);
	$('#errorConsole').hide();
	
	$('form[name=loginForm]').submit(function(){
		$('#errorConsole').slideUp();
		$.post('authentication/checkLogin',{fldUsername: $('[name=fldUsername]').val(),fldPassword: $('[name=fldPassword]').val()},
		function(data)
		{
			if(data.success)
			{
				$('#errorConsole').html(data.message).slideDown().delay(1000).slideUp();
				$('#showUsername').fadeOut().html(data.username).fadeIn();
				$('#open').html('Show Panel');
				$('#loginForm').hide().replaceWith(data.navigation).fadeIn(1500);
			}
			else
			{
				$('#errorConsole').html(data.error).slideDown();
			}
		}, 'json');
		return false;
	});
});