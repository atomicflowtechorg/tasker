/* Author: YOUR NAME HERE
*/

$(document).ready(function() {  

function timeStamp(){
var a_p = "";
var d = new Date();
var curr_hour = d.getHours();
if (curr_hour < 12)
   {
   a_p = "AM";
   }
else
   {
   a_p = "PM";
   }
if (curr_hour == 0)
   {
   curr_hour = 12;
   }
if (curr_hour > 12)
   {
   curr_hour = curr_hour - 12;
   }

var curr_min = d.getMinutes();

curr_min = curr_min + "";

if (curr_min.length == 1)
   {
   curr_min = "0" + curr_min;
   }

now = curr_hour + ":" + curr_min + " " + a_p

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
	title: "New Message from " + data.username,
	// (string | mandatory) the text inside the notification
	text: data.messageText ,
	image:data.userImage,
	sticky:true,
	timeStamp: data.timeStamp,
	/* time:8000 */
	});
   
  });
});