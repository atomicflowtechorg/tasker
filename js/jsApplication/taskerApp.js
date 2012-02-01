$(function(){
    window.Task = Backbone.Model.extend({
        url: "http://localhost/tasker/index.php/api/task"
    });
    
    window.TaskList = Backbone.Collection.extend({
        model: Task,
        url: "http://localhost/tasker/index.php/api/tasks/username/" + username
    });
     
    window.tasks = new TaskList();
   
    window.AppView = Backbone.View.extend({
        initialize: function() {
            tasks.fetch({
                success: function() {
                    console.log(tasks.toJSON());
                }
            });   
        }
    });

    window.App = new AppView;
});

//Example Link to test functionality
$('#fetch').click(function(){
    alert(tasks.url);
    
    var tasksNames = tasks.pluck("fldName");
    alert(JSON.stringify(tasksNames));
});