var calendar;
var Calendar = FullCalendar.Calendar;
var events = [];

$(function() {
    if (!!scheds) {
        Object.keys(scheds).map(k => {
            var row = scheds[k];
            var startDateTime = row.sdate + 'T' + row.start_time; // Combine date and start time
            var endDateTime = row.sdate + 'T' + row.end_time; // Combine date and end time

            events.push({
                id: row.id,
                title: row.title, // Using 'Name' as the title
                start: startDateTime, // Start datetime for the event
                end: endDateTime // End datetime for the event
            });
        });
    }

    calendar = new Calendar(document.getElementById('calendar'), {
        headerToolbar: {
            left: 'prev,next today',
            right: 'dayGridMonth,dayGridWeek,list',
            center: 'title',
        },
        selectable: true,
        themeSystem: 'bootstrap',
        events: events,
        eventClick: function(info) {
            var _details = $('#event-details-modal');
            var id = info.event.id;
            if (!!scheds[id]) {
                _details.find('#title').text(scheds[id].title); // Display the Name
                _details.find('#description').text(scheds[id].description); // Display Services
                _details.find('#aesthetician').text(scheds[id].aesthetician);
                _details.find('#apt_date').text(scheds[id].sdate); // Display formatted date
                _details.find('#apt_time').text(scheds[id].apt_time); // Display original time range
                _details.find('#total_cost').text(scheds[id].total_cost); // Display Total Cost
                _details.find('#payment_status').text(scheds[id].payment_status); // Display Payment Status
                // _details.find('#edit,#delete').attr('data-id', id);
                $('#edit').parent('a').attr('href', './view-appointment.php?viewid=' + id);

                _details.modal('show');
            } else {
                alert("Event is undefined");
            }
        },
        eventDidMount: function(info) {
            // Do Something after events mounted
        },
        editable: true
    });

    calendar.render();

    // Form reset listener
    $('#schedule-form').on('reset', function() {
        $(this).find('input:hidden').val('');
        $(this).find('input:visible').first().focus();
    });

    // Edit Button
    $('#edit').click(function() {
        var id = $(this).attr('data-id');
        if (!!scheds[id]) {
            var _form = $('#schedule-form');
            _form.find('[name="id"]').val(id);
            _form.find('[name="title"]').val(scheds[id].title); // Set the Name
            _form.find('[name="description"]').val(scheds[id].description); // Set the Services
            _form.find('[name="aesthetician"]').val(scheds[id].aesthetician);
            _form.find('[name="apt_date"]').val(scheds[id].sdate); // Set the appointment date
            _form.find('[name="apt_time"]').val(scheds[id].apt_time); // Set the original time range
            _form.find('[name="total_cost"]').val(scheds[id].total_cost); // Set Total Cost
            _form.find('[name="payment_status"]').val(scheds[id].payment_status); // Set Payment Status
            $('#event-details-modal').modal('hide');
            _form.find('[name="title"]').focus();
        } else {
            // alert("Event is undefined");
        }
    });

    // Delete Button / Deleting an Event
    $('#delete').click(function() {
        var id = $(this).attr('data-id');
        if (!!scheds[id]) {
            var _conf = confirm("Are you sure to delete this scheduled event?");
            if (_conf === true) {
                location.href = "./delete_schedule.php?id=" + id;
            }
        } else {
            alert("Event is undefined");
        }
    });
});
