ocument.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: [
            {
                title: 'Event 1',
                start: '2024-04-16',
                end: '2024-04-18'
            },
            {
                title: 'Event 2',
                start: '2024-04-20',
                end: '2024-04-22'
            }
            // Add more events here as needed
        ]
    });
    calendar.render();
});