"use strict";
var basic_calendar = {
    init: function () {
        $("#cal-agenda-view").fullCalendar({
            header: {
                left: "prev,next today",
                center: "title",
                right: "month,agendaWeek,agendaDay",
            },
            defaultDate: new Date(),
            defaultView: "agendaWeek",
            editable: true,
            selectable: true,
            selectHelper: true,
            droppable: true,
            eventLimit: true,
            select: function (start, end, allDay) {
                var title = prompt("Event Title:");
                if (title) {
                    $("#cal-agenda-view").fullCalendar(
                        "renderEvent",
                        {
                            title: title,
                            start: start._d,
                            end: end._d,
                            allDay: allDay,
                        },
                        true
                    );
                }
                $("#cal-agenda-view").fullCalendar("unselect");
            },
            events: [
                {
                    title: "All Day Event",
                    start: "2016-06-01",
                },
            ],
        });
    },
};
(function ($) {
    "use strict";
    basic_calendar.init();
})(jQuery);
