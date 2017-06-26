App.extend({
    Components: {}
});
App.Components.Notification = (function ($, w) {

    var queue = [],
        pub = {
            name: 'App.Components.Notification',
            depends: ['App.Polyfills.Array'], /* Array.indexOf support needed for IE 8 and below */

            events: ['click'],
            wrapTemplate: '<div class="notification-wrap"></div>',
            notificationTemplate: '<div class="notification slide"><a class="notification__close">&times;</a></div>',
            transitionClass: 'sliding',
            transitionSpeed: 300,
            timeout: 5000,
            initializeNotifications: function () {
                var notifications = w.Notifications || [];
                for (var i = 0, l = notifications.length; i < l; i++) (function () {
                    var notification = notifications[i];
                    setTimeout(function () {
                        pub.add(notification.message, notification.type, notification.timeout);
                    }, i * 2 * pub.transitionSpeed);
                })();
            },
            addSuccess: function (message, timeout) {
                return this.add(message, 'success', timeout);
            },
            addError: function (message, timeout) {
                return this.add(message, 'error', timeout);
            },
            addInfo: function (message, timeout) {
                return this.add(message, 'info', timeout);
            },
            add: function (message, type, timeout) {
                if (typeof timeout === 'undefined') {
                    timeout = this.timeout;
                }
                var $notification = $($.parseHTML(this.notificationTemplate)),
                    transitionClass = this.transitionClass;

                $notification.prepend(message).addClass('notification--' + type).addClass(transitionClass);
                queue.push($notification);
                this.$wrap.append($notification);

                $notification.find('.notification__close').one(this.events.click, function () {
                    pub.remove($notification);
                });

                if (timeout) {
                    setTimeout(function () {
                        pub.remove($notification);
                    }, timeout);
                }

                setTimeout(function () {
                    $notification.addClass('in');
                }, 0);

                /* Using setTimeout over transitionend event to remove transition class for best browser support */
                setTimeout(function () {
                    $notification.removeClass(transitionClass);
                }, this.transitionSpeed);
            },
            remove: function ($notification) {
                $notification.addClass(this.transitionClass).removeClass('in');

                /* Use setTimeout to remove notification instead of transitionend event for best browser support */
                setTimeout(function () {
                    queue.splice(queue.indexOf($notification), 1);
                    $notification.remove();
                }, this.transitionSpeed);
            },
            init: function () {
                addNotificationWrap();
                this.initializeNotifications();
            }
        };

    /**
     * Add the notification wrap to body, save a reference to pub.
     */
    function addNotificationWrap() {
        var wrap = $.parseHTML(pub.wrapTemplate);
        pub.$wrap = $(wrap).appendTo('body');
    }

    return pub;
})(jQuery, window);

App.initModule(App.Components.Notification);
