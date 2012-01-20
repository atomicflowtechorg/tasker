/* Author: YOUR NAME HERE
*/

$(document).ready(function() {   

  var socket = io.connect();

  $('#chatForm').bind('submit', function() {
      
      var messageObj = {
          username: username,
          userImage: userImage,
          messageText: $("#chatBoxInput").val()
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
  });
});