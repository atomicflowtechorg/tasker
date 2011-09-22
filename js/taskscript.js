$(document).ready(function(){
	$("#appnav li").blend();
	$('#appnav').hide();
	$('#appnav').fadeIn("fast");
	
	
	//SPECIAL TAYNE CODE!!
	if(window.addEventListener){
		console.log("Ready to do this thang.");
		//makin dem variables heeeeyah
		var keypresses = [];
		taynecode = "52,68,51,68,51,68,51,32";
		
		window.addEventListener("keydown",function(e){
			//pushin dem keys to dem arrays
			keypresses.push(e.keyCode);
			
			//check see if dem sexytaynez been activaytidz
			if(keypresses.toString().indexOf(taynecode) >= 0){
				//aaaaah yeah iz go time
				//window.open ("http://edge.ebaumsworld.com/mediaFiles/picture/5197/81343034.gif","mywindow","status=1");
				$('body').css("background-image", "url(http://edge.ebaumsworld.com/mediaFiles/picture/5197/81343034.gif)");
				//resettin dem rays
				keypresses = [];
			};
		}, true);
		
		
	};
})//end ready function
