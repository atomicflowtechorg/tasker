@Tasker ?= {}

class Notification extends Spine.Model
  @configure "Notification", "name", "active"
  name = "default name"
  active: true

Tasker.Notification = Notification
note1 = new Notification(name:"DefaultTestNotification")

console.log(note1)

