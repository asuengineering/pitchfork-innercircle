// Start your project's JS here.

// Initialize Fullcalendar.io
document.addEventListener('DOMContentLoaded', function() {
  console.log( CALDATA.events );
  var events = CALDATA.events;

  var calendarEl = document.getElementById('calendar');
  
  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    events: events,
    nextDayThreshold: '03:00:00',
    eventColor: '#ffc627',
    eventTextColor: '#191919',
    headerToolbar: {
      start: 'title',
      end: 'today prev,next dayGridMonth,listMonth',
    },

    eventClick: function(info) {
      info.jsEvent.preventDefault(); // keep from opening a new window.
      info.el.focus();

      let eventPreview = document.querySelector('#event-preview');
      let newEvent = document.createElement('div');
      newEvent.id = 'event-preview';

      // Agenda string
      let agendaStr = '';
      if (info.event.extendedProps.agenda) {
        agendaStr = '<p>' + info.event.extendedProps.agenda + '</p>';
      }

      // CTA Link
      let ctaLink = '';
      if (info.event.extendedProps.cta_link) {
        let ctaInfo = info.event.extendedProps.cta_link;
        ctaLink = '<p><a href="' + ctaInfo.url + '" target="' + ctaInfo.target + '">' + ctaInfo.title + '</a></p>';
      }

      // Display read more button
      let postLink = '<p><a class="btn btn-md btn-maroon href="' + info.event.url + '">Read More</a></p>';

      // Date string formatting depending on the event type.
      let startStr = '';
      let endStr = '';
      let dateFormatFull = {dateStyle: 'long', timeStyle: 'short'};
      let dateFormatDay = {dateStyle: 'long'};
      let dateFormatTime = {timeStyle: 'short'};

      switch (info.event.extendedProps.date_string) {
        case 'dates' : 
          // Marked as all day on the calendar. May span multple days.
          // Check for an end date first, change label for start date accordingly.
          if (info.event.end) {
            startStr = 
            '<p><span class="far fa-calendar"></span>Start: '
            endStr = 
            '<p><span class="far fa-calendar"></span>End: ' + info.event.end.toLocaleDateString('en-us', dateFormatDay) + '</p>';
          } else {
            // No end date, so no need for the "start" label.
            startStr = 
            '<p><span class="far fa-calendar"></span>';
          }

          startStr += info.event.start.toLocaleDateString('en-us', dateFormatDay) + '</p>'
          break;

        case 'deadline' :
          // Assumes a start date & time, all day and no end date displayed. 
          console.log(info.event.start); 
          console.log(info.event.end); 
          startStr = 
            '<p><span class="far fa-calendar"></span>' + 
            info.event.start.toLocaleDateString('en-us', dateFormatDay) + 
            ' by ' + 
            info.event.start.toLocaleTimeString('en-us', dateFormatTime)
            '</p>';
            break;
        
        case 'agenda' :
          startStr = 
          '<p><span class="far fa-calendar"></span>' + info.event.start.toLocaleDateString('en-us', dateFormatDay) + '</p>';
          break;
                
        case 'standard' :
        default: 
          // Check to see if the start date and end date are the same.
          const datesAreOnSameDay = (first, second) =>
            first.getFullYear() === second.getFullYear() &&
            first.getMonth() === second.getMonth() &&
            first.getDate() === second.getDate();

          if (datesAreOnSameDay(info.event.start, info.event.end)) {
            startStr = 
              '<p><span class="far fa-calendar"></span>' + info.event.start.toLocaleDateString('en-us', dateFormatDay) + '</p>';

            endStr = 
              '<p><span class="far fa-clock"></span>' + 
              info.event.start.toLocaleTimeString('en-us', dateFormatTime) + 
              ' to ' +
              info.event.end.toLocaleTimeString('en-us', dateFormatTime) +
              '</p>';
          } else {
            startStr = '<p><span class="far fa-calendar"></span>Start: ' + info.event.start.toLocaleString('en-us', dateFormatFull) + '</p>';
            endStr = '<p><span class="far fa-calendar"></span>End: ' + info.event.end.toLocaleString('en-us', dateFormatFull) + '</p>';
          }
          break;
      }

      newEvent.innerHTML = 
        startStr + endStr +
        '<h3>' +  info.event.extendedProps.post_title + '</h3>' +
        '<h4>' + info.event.title + '</h4>' + 
        '<p>' + info.event.extendedProps.description + '</p>' +
        agendaStr + ctaLink + postLink;


      eventPreview.replaceWith(newEvent);

    }
  });

  calendar.render();
});