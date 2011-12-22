
function loadLink(link, area){
	$("#" + area).fadeOut(500, function(){
		$.ajax({
		  url: $(link).attr("href"),
		  cache: false,
		  success: function(html){
		  	$("#" + area).fadeIn(500).html(html);
		  }
		});
	});
}

$(document).ready(function(){
	$("#appnav li").blend();
	$('#appnav').hide();
	$('#appnav').fadeIn("fast");
	
	
	
	//******* ajax load link data *******************************************************
	$(".ajax_anchor_load").live("click", function(){
		loadLink(this, "content");
		return false;
	});

	$("a[rel]").live('click', function (e) {
   		e.preventDefault(); //prevent default link action

	    $(this).overlay({
	        mask: '#3B5872',
	        api: true,
	        onBeforeLoad: function () {
	            var wrap = this.getOverlay().find(".contentWrap");
	            wrap.load(this.getTrigger().attr("href"));
	        },
	        load: true
	    });
	});





	//SPECIAL TAYNE CODE!!
	/*
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
	END SPECIAL TAYNE CODE */
	
})//end ready function
