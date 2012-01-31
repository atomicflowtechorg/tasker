$ = jQuery
@Tasker ?= {}

class Task extends Spine.Model
	@configure "Task", "id", "name"
	@extend Spine.Events
	@extend Spine.Model.Local
	@extend Spine.Model.Ajax
	@url: "/tasker/index.php/api/tasks/username/#{username}"
Tasker.Task = Task
Task.fetch()
tasks = Task.all()
console.log task for task in tasks


# testTask1.save()
# testTask2.save()





# Tasker.Task = Task
# Tasker.TaskApp = TaskApp














# class Notification extends Spine.Model
#   @configure "Notification", "title",  "active"
#   title = "Default Title"
#   display: (title,text) ->
#   	$.gritter.add
#   		title: @title
#   		text: @text
# Tasker.Notification = Notification
# note1 = new Notification(title:"Notification1")
# note2 = new Notification(title:"Notification2")
# # console.log $.gritter
# note2.display()
