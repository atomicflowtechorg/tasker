(function() {
  var $, Task, task, tasks, _i, _len,
    __hasProp = Object.prototype.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor; child.__super__ = parent.prototype; return child; };

  $ = jQuery;

  if (this.Tasker == null) this.Tasker = {};

  Task = (function(_super) {

    __extends(Task, _super);

    function Task() {
      Task.__super__.constructor.apply(this, arguments);
    }

    Task.configure("Task", "id", "name");

    Task.extend(Spine.Events);

    Task.extend(Spine.Model.Local);

    Task.extend(Spine.Model.Ajax);

    Task.url = "/tasker/index.php/api/tasks/username/" + username;

    return Task;

  })(Spine.Model);

  Tasker.Task = Task;

  Task.fetch();

  tasks = Task.all();

  for (_i = 0, _len = tasks.length; _i < _len; _i++) {
    task = tasks[_i];
    console.log(task);
  }

}).call(this);
