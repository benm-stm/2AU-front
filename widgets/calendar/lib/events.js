$(document).ready(function() {

    var date = new Date();
    var d = date.getDate();
    var m = date.getMonth();
    var y = date.getFullYear();
    calendar = $('#calendar');

    calendar.fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        selectable: true,
        selectHelper: true,
        editable: true,
        events: {
			url: '/widgets/calendar/main.php',
			error: function() {
                alert('there was an error while fetching events!');
            }
		},
        allDayDefault: false,

        // create
        select: function(start, end, allDay) {

                $('#EventCreationModal').modal({
                    backdrop: 'static',
                    keyboard: false
                })
                .one('click', '#createEvent', function() {
            var title = $('#title').val();
            var instance = $('#instance').val();
            if (title && instance) {
                start = $.fullCalendar.formatDate(start, "yyyy-MM-dd HH:mm:ss");
                end = $.fullCalendar.formatDate(end, "yyyy-MM-dd HH:mm:ss");

                $.ajax({
                    url: '/widgets/calendar/main.php',
                    data: 'type=create&instance=' + instance +'&title=' + title + '&start=' + start + '&end=' + end,
                    type: "POST",
                    success: function(json) {
                        calendar.fullCalendar('removeEvents');
                        calendar.fullCalendar('refetchEvents');
                        refresh_recent_new();
                    }
                });
                calendar.fullCalendar('renderEvent', {
                        title: title,
                        start: start,
                        end: end,
                        allDay: allDay
                    },
                    true // make the event "stick"
                );
            }
            calendar.fullCalendar('unselect');
            $('#title').val('');
            $('#instance').val('');
        });},

        //update on drag
        editable: true,
        eventDrop: function(event, delta) {
            start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
            end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");

            $.ajax({
                url: '/widgets/calendar/main.php',
                data: 'type=update&instance=' + event.instance + '&title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                type: "POST",
                success: function(json) {
					refresh_recent_new();
				}
            });
        },
        eventResize: function(event) {
            start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
            end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");

            $.ajax({
                url: '/widgets/calendar/main.php',
                data: 'type=update&title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                type: "POST",
                success: function(json) {
					refresh_recent_new();
				}
            });
        },

        //delete & update
        eventClick: function(event) {
			$('#title_update').val(event.title);
			$('#instance_update').val(event.instance);

            $('#confirm').modal().one('click', '#delete', function() {
                    $.ajax({
                        url: '/widgets/calendar/main.php',
                        data: 'type=delete&id=' + event.id,
                        type: "POST",
                        success: function(json) {
                            calendar.fullCalendar('removeEvents');
                            calendar.fullCalendar('refetchEvents');
                            refresh_recent_new();
                        }
                    });
                });
                $('#confirm').modal().one('click', '#update', function() {
					start = $.fullCalendar.formatDate(event.start, "yyyy-MM-dd HH:mm:ss");
					end = $.fullCalendar.formatDate(event.end, "yyyy-MM-dd HH:mm:ss");
                    $.ajax({
						url: '/widgets/calendar/main.php',
						data: 'type=update&instance=' + $('#instance_update').val() + '&title=' + $('#title_update').val() + '&start=' + start + '&end=' + end + '&id=' + event.id,
						type: "POST",
						success: function(json) {
							calendar.fullCalendar('removeEvents');
                            calendar.fullCalendar('refetchEvents');
						}
					});
                });
        }
    });
});

function refresh_recent_new() {
        $.ajax({
                url: 'widgets/recent_news/main.php',
                data: "",
                type: 'POST',
                success: function(recent_news) {
                        $("#recent_news").html(recent_news).hide().fadeIn(1000);
                }
        });
}
