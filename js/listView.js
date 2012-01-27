/* Author: Lucas Paulger*/
var Task = Spine.Model.sub();
Task.configure("Task", "id","title","status");

Task.extend({

});

Task.include({

    });


var List = {
    tasks: new Array(),
    add: function(taskItem){
        this.tasks.push(taskItem)
    }
}

$.ajax({
    url: "http://localhost/tasker/index.php/tasks/load/"+username,
    cache: false,
    success: function(data){
        for (task in data){
            task = new Task({id:task.pkTaskId,title:task.fldName,status:task.fldStatus})
            List.add(task);
        }
    }
});

for(task in List.tasks){
    var info = "ID: " + task.id + "title: " + task.title;
}   



