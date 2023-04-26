// Define an array of dates to assign to the events
var dates = ['2023-04-01', '2023-04-05', '2023-04-10', '2023-04-15'];

// eventName, calendarName, eventColor (possible colors include only blue, yellow, green, and orange)

var myEvent = [ "Event 1: 1812, Event 1, blue",
                "Event 2: Slavery, Event 2, yellow",
                "Event 3: Niagara Falls, Event 3, green",
                "Event 4: Native, Event 4, orange"]

const cDict = { };
const bookings = { };
var bookingOverlay;

!function() {
    // The current date
    var today = moment();

    var selected_day;

    function Calendar(selector, events) {
      this.el = document.querySelector(selector);
      this.events = events;
      this.current = moment().date(1);
      this.draw();
      var current = document.querySelector('.today');
      if(current) {
        var self = this;
        window.setTimeout(function() {
          self.openDay(current);
        }, 500);
      }

      // Add toggle button
      var toggleButton = createElement('button', 'toggle-button');
      toggleButton.innerText = 'Toggle Calendar';
      toggleButton.addEventListener('click', function() {
        self.el.classList.toggle('hide-calendar');
      });
      // this.header.appendChild(toggleButton);

      // Hide calendar initially
      this.el.classList.add('hide-calendar');
    }
  

    Calendar.prototype.draw = function() {
      var self = this; // Add this line
      //Create Header
      this.drawHeader();
  
      //Draw Month
      this.drawMonth();
  
      this.drawLegend();
    }
    
    // Calendar.prototype.toggleCalendar = function() {
    //   this.el.classList.display = 'none';
    // }
      

      Calendar.prototype.drawHeader = function() {
        var self = this;
        if(!this.header) {
          //Create the header elements
          this.header = createElement('div', 'header');
          this.header.className = 'header';
      
      
          this.title = createElement('h1');


          var right = createElement('div', 'right');
          right.addEventListener('click', function() { self.nextMonth(); });
      
          var left = createElement('div', 'left');
          left.addEventListener('click', function() { self.prevMonth(); });
      
          //Append the Elements
          this.header.appendChild(this.title); 
          this.header.appendChild(right);
          this.header.appendChild(left);
          var button = createElement('button','cButton','View Bookings');

          button.style.top = '2px';
          button.style.position = 'absolute';
          button.style.left = '50px';
          button.style.height = '40px';
          button.style.width = '80px';
          this.header.append(button);
          this.el.appendChild(this.header);

          // Create container for the overlay
          var overlayContainer = createElement('div', 'overlay-container');
          this.el.appendChild(overlayContainer);


          var overlay = document.createElement('div');
          overlay.className = 'bookings_overlay';
          overlayContainer.appendChild(overlay);
          overlay.style.display = 'none';
          bookingOverlay = overlay; // set this so we can get it in other functions
          // Add event listener to button
          button.addEventListener('click', function() {
            // Toggle 'active' class on button element
            button.classList.toggle('active');

            // Toggle bookings overlay on and off
            var overlay = document.querySelector('.bookings_overlay');
            if (overlay.style.display === 'none') {
              overlay.style.display = 'block';
            } else {
              overlay.style.display = 'none';
            }


          });
        }
      
        this.title.innerHTML = this.current.format('MMMM YYYY');
      }
      



    
  // This is where the the vents are added to a specific day
    Calendar.prototype.drawMonth = function() {
      var self = this;



    // Loop through each event and assign a date from the dates array
    this.events.forEach(function(ev, index) {
        ev.date = moment(dates[index]);
    });


    //   this.events.forEach(function(ev) {
    //    ev.date = self.current.clone().date(Math.random() * (29 - 1) + 1);
    //   });
      
      
      if(this.month) {
        this.oldMonth = this.month;
        this.oldMonth.className = 'month out ' + (self.next ? 'next' : 'prev');
        this.oldMonth.addEventListener('webkitAnimationEnd', function() {
          self.oldMonth.parentNode.removeChild(self.oldMonth);
          self.month = createElement('div', 'month');
          self.backFill();
          self.currentMonth();
          self.fowardFill();
          self.el.appendChild(self.month);
          window.setTimeout(function() {
            self.month.className = 'month in ' + (self.next ? 'next' : 'prev');
          }, 16);
        });
      } else {
          this.month = createElement('div', 'month');
          this.el.appendChild(this.month);
          this.backFill();
          this.currentMonth();
          this.fowardFill();
          this.month.className = 'month new';
      }
    }
  
    Calendar.prototype.backFill = function() {
      var clone = this.current.clone();
      var dayOfWeek = clone.day();
  
      if(!dayOfWeek) { return; }
  
      clone.subtract('days', dayOfWeek+1);
  
      for(var i = dayOfWeek; i > 0 ; i--) {
        this.drawDay(clone.add('days', 1));
      }
    }
  
    Calendar.prototype.fowardFill = function() {
      var clone = this.current.clone().add('months', 1).subtract('days', 1);
      var dayOfWeek = clone.day();
  
      if(dayOfWeek === 6) { return; }
  
      for(var i = dayOfWeek; i < 6 ; i++) {
        this.drawDay(clone.add('days', 1));
      }
    }
  
    Calendar.prototype.currentMonth = function() {
      var clone = this.current.clone();
  
      while(clone.month() === this.current.month()) {
        this.drawDay(clone);
        clone.add('days', 1);
      }
    }
  
    Calendar.prototype.getWeek = function(day) {
      if(!this.week || day.day() === 0) {
        this.week = createElement('div', 'week');
        this.month.appendChild(this.week);
      }
    }
  
    Calendar.prototype.drawDay = function(day) {
      var self = this;
      this.getWeek(day);
  
      //Outer Day
      var outer = createElement('div', this.getDayClass(day));
      outer.addEventListener('click', function() {
        self.openDay(this);
      });
  
      //Day Name
      var name = createElement('div', 'day-name', day.format('ddd'));
  
      //Day Number
      var number = createElement('div', 'day-number', day.format('DD'));
  
  
      //Events
      var events = createElement('div', 'day-events');
      this.drawEvents(day, events);
  
      outer.appendChild(name);
      outer.appendChild(number);
      outer.appendChild(events);
      this.week.appendChild(outer);
    }
  
    Calendar.prototype.drawEvents = function(day, element) {
      if(day.month() === this.current.month()) {
        var todaysEvents = this.events.reduce(function(memo, ev) {
          if(ev.date.isSame(day, 'day')) {
            memo.push(ev);
          }
          return memo;
        }, []);
  
        todaysEvents.forEach(function(ev) {
          var evSpan = createElement('span', ev.color);
          element.appendChild(evSpan);
        });
      }
    }
  
    Calendar.prototype.getDayClass = function(day) {
      classes = ['day'];
      if(day.month() !== this.current.month()) {
        classes.push('other');
      } else if (today.isSame(day, 'day')) {
        classes.push('today');
      }
      return classes.join(' ');
    }
  
    Calendar.prototype.openDay = function(el) {
      var details, arrow;
      var dayNumber = +el.querySelectorAll('.day-number')[0].innerText || +el.querySelectorAll('.day-number')[0].textContent;
      var day = this.current.clone().date(dayNumber);
      selected_day = day._d;
      var currentOpened = document.querySelector('.details');
  
      //Check to see if there is an open detais box on the current row
      if(currentOpened && currentOpened.parentNode === el.parentNode) {
        details = currentOpened;
        arrow = document.querySelector('.arrow');
      } else {
        //Close the open events on differnt week row
        //currentOpened && currentOpened.parentNode.removeChild(currentOpened);
        if(currentOpened) {
          currentOpened.addEventListener('webkitAnimationEnd', function() {
            currentOpened.parentNode.removeChild(currentOpened);
          });
          currentOpened.addEventListener('oanimationend', function() {
            currentOpened.parentNode.removeChild(currentOpened);
          });
          currentOpened.addEventListener('msAnimationEnd', function() {
            currentOpened.parentNode.removeChild(currentOpened);
          });
          currentOpened.addEventListener('animationend', function() {
            currentOpened.parentNode.removeChild(currentOpened);
          });
          currentOpened.className = 'details out';
        }
  
        //Create the Details Container
        details = createElement('div', 'details in');
  
        //Create the arrow
        var arrow = createElement('div', 'arrow');
  
        //Create the event wrapper
  
        details.appendChild(arrow);
        el.parentNode.appendChild(details);
      }
  
      var todaysEvents = this.events.reduce(function(memo, ev) {
        if(ev.date.isSame(day, 'day')) {
          memo.push(ev);
        }
        return memo;
      }, []);
  
      this.renderEvents(todaysEvents, details);
  
      arrow.style.left = el.offsetLeft - el.parentNode.offsetLeft + 27 + 'px';
    }
    
    // This funcion is for when a day is clicked (cday)
    Calendar.prototype.renderEvents = function(events, ele) {
      //Remove any events in the current details element
      var currentWrapper = ele.querySelector('.events');
      var wrapper = createElement('div', 'events in' + (currentWrapper ? ' new' : ''));
      wrapper.style.height = "125px";
      events.forEach(function(ev) {
        var div = createElement('div', 'event');
        var square = createElement('div', 'event-category ' + ev.color);
        var span = createElement('span', '', ev.eventName);
        
        div.appendChild(square);
        div.appendChild(span);
        wrapper.appendChild(div);
      });
      
      // If no events are present, add time slots
      if(!events.length) {
        var temp = selected_day.toDateString(); // format of date to get day "Wed Apr 19 2023"
        var temp2 = temp.split(' ');
        var day = temp2[2];
        var month = selected_day.getMonth();

        const key = month.toString()+day.toString();
        if (!(key in cDict)){ // If key doesn't exist in dict, create new one
          cDict[key] = [0,0,0,0,temp];
          bookings[key] = [''];
          bookingOverlay.style.overflow = 'auto';
        }

        var div = createElement('div', 'event empty');
        var span = createElement('span', '');
        span.innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Times&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Attendees<br>1:00 PM - 2:00 PM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+cDict[key][0]+"/15<br>2:00 PM - 3:00 PM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+cDict[key][1]+"/15<br>3:00 PM - 4:00 PM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+cDict[key][2]+"/15<br>4:00 PM - 5:00 PM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+cDict[key][3]+"/15"
        // Add booking button and bookings
        var button_1 = createElement('button','cButton','Book for 1PM');
        button_1.id = 'button_1';
        var button_2 = createElement('button','cButton','Book for 2PM');
        button_2.id = 'button_2';
        var button_3 = createElement('button','cButton','Book for 3PM');
        button_3.id = 'button_3';
        var button_4 = createElement('button','cButton','Book for 4PM');
        button_4.id = 'button_4';
        var button_5 = createElement('button','cButton','Book for 5PM');
        button_5.id = 'button_5';
        
        
        div.appendChild(span);
        wrapper.appendChild(div);
        div.append(button_1);
        div.append(button_2);
        div.append(button_3);
        div.append(button_4);

        // const bookings = { };
        // var bookingOverlay;

// Add a click event listener to the parent div
div.addEventListener('click', function(event) {
  // Check if the clicked element is a button
  if (event.target.tagName === 'BUTTON') {
    var textElement = createElement('div', 'event-text');

    // Increment the count based on which button was clicked
    switch (event.target.id) {
      case 'button_1':
        if (within_limit(cDict[key][0])){
          cDict[key][0]+=1;
          textElement.innerHTML = 'You have booked for the date ' + cDict[key][4] + ' for 1:00-2:00 PM.';
          bookingOverlay.appendChild(textElement);
        }
        break;
      case 'button_2':
        if (within_limit(cDict[key][1])){
          cDict[key][1]+=1;
          textElement.innerHTML = 'You have booked for the date ' + cDict[key][4] + ' for 2:00-3:00 PM.';
          bookingOverlay.appendChild(textElement);
        }
        break;
      case 'button_3':
        if (within_limit(cDict[key][2])){
          cDict[key][2]+=1;
          textElement.innerHTML = 'You have booked for the date ' + cDict[key][4] + ' for 3:00-4:00 PM.';
          bookingOverlay.appendChild(textElement);
        }
        break;
      case 'button_4':
        if (within_limit(cDict[key][3])){
          cDict[key][3]+=1;
          textElement.innerHTML = 'You have booked for the date ' + cDict[key][4] + ' for 4:00-5:00 PM.';
          bookingOverlay.appendChild(textElement);
        }
        break;
      default:
        break;
    }
    span.innerHTML = "Times&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Attendees<br>1:00 PM - 2:00 PM&nbsp;&nbsp;&nbsp;"+cDict[key][0]+"/15<br>2:00 PM - 3:00 PM&nbsp;&nbsp;&nbsp;"+cDict[key][1]+"/15<br>3:00 PM - 4:00 PM&nbsp;&nbsp;&nbsp;"+cDict[key][2]+"/15<br>4:00 PM - 5:00 PM&nbsp;&nbsp;&nbsp;"+cDict[key][3]+"/15"
    console.log("");
  }
});
console.log("");
}
  
      if(currentWrapper) {
        currentWrapper.className = 'events out';
        currentWrapper.addEventListener('webkitAnimationEnd', function() {
          currentWrapper.parentNode.removeChild(currentWrapper);
          ele.appendChild(wrapper);
        });
        currentWrapper.addEventListener('oanimationend', function() {
          currentWrapper.parentNode.removeChild(currentWrapper);
          ele.appendChild(wrapper);
        });
        currentWrapper.addEventListener('msAnimationEnd', function() {
          currentWrapper.parentNode.removeChild(currentWrapper);
          ele.appendChild(wrapper);
        });
        currentWrapper.addEventListener('animationend', function() {
          currentWrapper.parentNode.removeChild(currentWrapper);
          ele.appendChild(wrapper);
        });
      } else {
        ele.appendChild(wrapper);
      }
    }
  
  function within_limit(num){
    return num < 15;
  }  
    Calendar.prototype.drawLegend = function() {
      var legend = createElement('div', 'legend');
      var calendars = this.events.map(function(e) {
        return e.calendar + '|' + e.color;
      }).reduce(function(memo, e) {
        if(memo.indexOf(e) === -1) {
          memo.push(e);
        }
        return memo;
      }, []).forEach(function(e) {
        var parts = e.split('|');
        var entry = createElement('span', 'entry ' +  parts[1], parts[0]);
        legend.appendChild(entry);
      });
      this.el.appendChild(legend);
    }
  
    Calendar.prototype.nextMonth = function() {
      this.current.add('months', 1);
      this.next = true;
      this.draw();
    }
  
    Calendar.prototype.prevMonth = function() {
      this.current.subtract('months', 1);
      this.next = false;
      this.draw();
    }
  
    window.Calendar = Calendar;
  
    function createElement(tagName, className, innerText) {
      var ele = document.createElement(tagName);
      if(className) {
        ele.className = className;
      }
      if(innerText) {
        ele.innderText = ele.textContent = innerText;
      }
      return ele;
    }



  }();

  
  // Experimental
  // This function will map the myEvents data to a calendar's eventName, Calendar, and color.
  !function() {
    var data = myEvent.map(function(eventString) {
        var parts = eventString.split(", ");
        return {
          eventName: parts[0],
          calendar: parts[1],
          color: parts[2]
        };
      });
  
    function addDate(ev) {
      
    }

    var calendar = new Calendar('#calendar', data);
  }();

  var cal = document.getElementById("calendar");
  cal.style.display = "none";
  function toggleCalendar() {
    var calendar = document.getElementById("calendar");
    if (calendar.style.display === "none") {
      calendar.style.display = "block";
      calendar.style.position = 'absolute';
    } else {
      calendar.style.display = "none";
    }
  }
  

