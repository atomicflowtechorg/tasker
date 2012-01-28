(function() {
  var Notification, note1, note2,
    __hasProp = Object.prototype.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor; child.__super__ = parent.prototype; return child; };

  if (this.Tasker == null) this.Tasker = {};

  Notification = (function(_super) {
    var title;

    __extends(Notification, _super);

    function Notification() {
      Notification.__super__.constructor.apply(this, arguments);
    }

    Notification.configure("Notification", "title", "active");

    title = "Default Title";

    Notification.prototype.display = function(title) {
      return $.gritter.add({
        title: this.title,
        text: "This is some text"
      });
    };

    return Notification;

  })(Spine.Model);

  Tasker.Notification = Notification;

  note1 = new Notification({
    title: "Notification1"
  });

  note2 = new Notification({
    title: "Notification2"
  });

  note2.display();

}).call(this);
