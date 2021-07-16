// Start your project's JS here.

// Initialize Fullcalendar.io
document.addEventListener('DOMContentLoaded', function() {
  console.log( CALDATA.events );
  var events = CALDATA.events

  var calendarEl = document.getElementById('calendar');
  
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    events: events,
  });

  calendar.render();
});