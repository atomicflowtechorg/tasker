@Tasker ?= {}

class Notification extends Spine.Model
  @configure "Notification", "title",  "active"
  title = "Default Title"
  display: (title,text) ->
  	$.gritter.add
  		title: @title
  		text: @text
Tasker.Notification = Notification
note1 = new Notification(title:"Notification1")
note2 = new Notification(title:"Notification2")
# console.log $.gritter
note2.display()
