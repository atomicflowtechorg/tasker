$(document).ready ->
  timeStamp = ->
    a_p = ""
    d = new Date()
    curr_hour = d.getHours()
    if curr_hour < 12
      a_p = "AM"
    else
      a_p = "PM"
    curr_hour = 12  if curr_hour is 0
    curr_hour = curr_hour - 12  if curr_hour > 12
    curr_min = d.getMinutes()
    curr_min = curr_min + ""
    curr_min = "0" + curr_min  if curr_min.length is 1
    now = curr_hour + ":" + curr_min + " " + a_p
    now
  socket = io.connect()
  $("#chatForm").bind "submit", ->
    messageObj =
      username: username
      userImage: userImage
      messageText: $("#chatBoxInput").val()
      timeStamp: timeStamp()

    socket.emit "message", messageObj
    $("#chatBoxInput").val ""
    false

  socket.on "server_message", (data) ->
    textArea = $("#chatForm .conversation")
    textArea.append "<div class=\"message\"><a href=\"" + individual_url + "/" + data.username + "\" class=\"ajax_anchor_load\"><img src=\"" + data.userImage + "\" title=\"" + data.username + "\"></a><p class=\"messageText\">" + data.messageText + "</p><div class=\"clearfix\"></div></div>"
    textArea.animate
      scrollTop: textArea.prop("scrollHeight") - textArea.height()
    , 300
    $.gritter.add
      title: "New Message from " + data.username
      text: data.messageText
      image: data.userImage
      sticky: true
      timeStamp: data.timeStamp