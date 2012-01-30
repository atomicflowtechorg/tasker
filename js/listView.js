/* Author: Lucas Paulger*/
var Task = Spine.Model.sub();
Task.configure("Task","id", "title","status");
Task.extend(Spine.Model.Ajax);
Task.extend({
    url: "/index.php/tasks/load/" + username
});

function List(){
    this.tasks = [];
    this.add = function(taskItem){
        this.tasks.push(taskItem);
    };
    this.empty = function(){
        this.tasks = [];
    }
    this.load = function(url){
        var self = this;
        self.empty();
        $.getJSON(
            url,
            function(data){
                $.each(data, function(key,val){
                    var task = new Task({
                        id:val.pkTaskId,
                        title:val.fldName,
                        status:val.fldStatus
                    });
                    console.log(task);
                    self.add(task);
                });
            }
            );
    }
}
//var taskList = new List();
//var test = "http://localhost/tasker/index.php/tasks/load/" + "brandonjf";
//taskList.load(test);
//
//var url = "http://localhost/tasker/index.php/tasks/load/" + username;
//taskList.load(url);