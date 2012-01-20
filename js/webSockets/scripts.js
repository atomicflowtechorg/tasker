/* Author: YOUR NAME HERE
*/

$(document).ready(function() {  

function timeStamp(){
var time = new Date();
var hours = time.getHours();
var minutes = time.getMinutes();
var now = " - " + String(hours.valueOf()) +":"+ minutes.valueOf();
return now;
} 

  var socket = io.connect();

  $('#chatForm').bind('submit', function() {
      
      var messageObj = {
          username: username,
          userImage: userImage,
          messageText: $("#chatBoxInput").val(),
		  timeStamp: timeStamp()
      }
   socket.emit('message', messageObj); 
   $("#chatBoxInput").val("");
   return false
  });

  socket.on('server_message', function(data){
      var textArea = $('#chatForm .conversation');
   textArea.append(
   '<div class="message"><a href="'+individual_url +'/'+ data.username + '" class="ajax_anchor_load"><img src="'+data.userImage+'" title="'+ data.username + '"></a><p class="messageText">'+data.messageText+'</p><div class="clearfix"></div></div>');
   textArea.animate({ scrollTop: textArea.prop("scrollHeight") - textArea.height() }, 300);
   
   
   $.gritter.add({
	title: data.username,
	// (string | mandatory) the text inside the notification
	text: data.messageText + data.timeStamp,
	image:data.userImage,
	sticky:false,
	time:8000
	});
   
  });
});