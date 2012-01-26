(function() {
  var Notification, note1,
    __hasProp = Object.prototype.hasOwnProperty,
    __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor; child.__super__ = parent.prototype; return child; };

  if (this.Tasker == null) this.Tasker = {};

  Notification = (function(_super) {
    var name;

    __extends(Notification, _super);

    function Notification() {
      Notification.__super__.constructor.apply(this, arguments);
    }

    Notification.configure("Notification", "name", "active");

    name = "default name";

    Notification.prototype.active = true;

    return Notification;

  })(Spine.Model);

  Tasker.Notification = Notification;

  note1 = new Notification({
    name: "DefaultTestNotification"
  });

  console.log(note1);

}).call(this);
