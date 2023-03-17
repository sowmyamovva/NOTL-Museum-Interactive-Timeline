// Main Timeline

var years = ["1810", "1811", "1812", "1813", "1814", "1815", "1816", "1817", "1818", "1819"];

var user_images = [ // User's Images
  'img/card_front.png',  
  'img/card_back.png',  
  
  'img/1753.png', 
  'img/1770.png', 

  'img/card_front.png', 
  'img/card_back.png', 

  'img/card_front.png', 
  'img/card_back.png', 

  'img/card_front.png', 
  'img/card_back.png', 

  'img/card_front.png',
  'img/card_back.png',

  'img/card_front.png',
  'img/card_back.png',

  'img/card_front.png',
  'img/card_back.png',

  'img/card_front.png',
  'img/card_back.png',
];

function process_images(year_index){
    return "<div class='flip-container'><div class='flipper'><div class='front'><img src="+user_images[year_index*2]+" alt='1730s' class='overlay' title='This is an image of the 1730s'> </div><div class='back'><img src="+user_images[year_index*2+1]+" alt='1753s' class='overlay' title='This is an image of the 1753s'></div></div></div>"
}

// Swapper Function 
//   "<div class='flip-container'><div class='flipper'><div class='front'><img src='img/card_front.png' alt='1730s' class='overlay front-image' title='This is an image of the 1730s' onclick='swapImages()> </div><div class='back'><img src='img/card_back.png' alt='1753s' class='overlay back-image' title='This is an image of the 1753s'></div></div></div><img src='img/1753.png' alt='1753s' class='overlay front-image' title='This is an image of the 1753s' onclick='swapImages()'>",
// Click Function
// "<div class='flip-card ' onclick='flipImage(this)'><div class='flip-card-inner'><div class='flip-card-front'><img src='img/card_front.png' alt='1730s' class='overlay' title='This is an image of the 1730s'></div><div class='flip-card-back'><img src='img/card_back.png' alt='1776s' class='overlay' title='This is an image of the 1776s' width='400' height='300'></div></div></div>",


//
for (let i = 0; i < years.length; i++) {
  pathOnDiv(years[i], (i / (years.length - 1)));
}


function pathOnDiv(text, pos) {
  var path = document.getElementById("mypath");
  var pathLength = path.getTotalLength();
  var loc = path.getPointAtLength(pos * (pathLength - 10));
  var point = '<circle id=' + text  + ' cx="' + (loc.x + 8) + '" cy="' + loc.y + '" r="5" fill="white" class="event message" data-year="' + text + '" />';
  document.getElementById('timeline').insertAdjacentHTML('beforeend', point);
}


const timeline = document.getElementById('timeline_box');
const events = timeline.querySelectorAll('.event');

let isTextDisplayed = false;
let displayedYear = '';

events.forEach(event => {
  event.addEventListener('click', () => {
  
    const label2 = document.getElementById('label');

    if (label2 && displayedYear === event.getAttribute('data-year')) {
      label2.parentNode.removeChild(label2);
      isTextDisplayed = false;
      displayedYear = '';
      return;
    }
    displayedYear = event.getAttribute('data-year');
    const year = displayedYear;
    const year_tooltip = process_images(years.indexOf(year)) //info[years.indexOf(year)];
    const label = document.createElement('div');
    label.textContent = year;
    label.classList.add('event-label');
    if (isTextDisplayed) {
      const label2 = document.getElementById('label');
      label2.parentNode.removeChild(label2);
    }
    isTextDisplayed = true;


    const rect = event.getBoundingClientRect();

    //Top 150                                                                                                                                                                                                                                                        //year_tooltip                              
    var year_info = ' <div id="label" class="event-label" style="top: ' + (rect.top - 410) + 'px; left: ' + (rect.left + rect.width / 2) + 'px; display: block;height: 400px; max-width:250px; white-space: normal; overflow:hidden; "><time>' + year + '</time>' + year_tooltip + '</div>';

    timeline.insertAdjacentHTML('beforeend', year_info);
  });
});

var months = ["January", "April", "August"];
var data = [
  "Vor dem Gesetz steht ein Türhüter. Zu diesem Türhüter kommt ein Mann vom Lande und bittet um Eintritt in das Gesetz. Aber der Türhüter sagt, daß ",
  "er ihm jetzt den Eintritt nicht gewähren könne. Der Mann überlegt und fragt dann, ob er also später werde eintreten dürfen. Es ist möglich, sagt der Türhüter, etzt aber nicht. Da das Tor zum Gesetz",
  "wie immer und der Türhüter beiseite tritt, bückt sich"
];

var processed_data = [
  
]


//sub-timeline
function createTimeline(){
  for (let i = 0; i < months.length; i++) {
    subPathOnDiv(months[i], (i / (months.length - 1))); 
  }
}
createTimeline();

//SUB-TIMELINE
function subPathOnDiv(text, pos) {
  var sub_path = document.getElementById("subPath");
  var subPathLength = sub_path.getTotalLength();
  var loc = sub_path.getPointAtLength(pos * (subPathLength));
  var point = '<circle id=' + text  + ' cx="' + (loc.x) + '" cy="' + (loc.y)+ '" r="5" fill="white" class="event message" data-month"' + text + '" />';
  document.getElementById('timeline2').insertAdjacentHTML('beforeend', point);
}

var num = events.length;
const timeline2 = document.getElementById('timeline_box');
const events2 = timeline2.querySelectorAll('.event');

let isTextDisplayed2 = false;
let displayedMonth = '';

events2.forEach(event => {
  event.addEventListener('click', () => {
    const label2 = document.getElementById('label2');

    if (label2 && displayedMonth === event.getAttribute('data-month')) {
      label2.parentNode.removeChild(label2);
      isTextDisplayed2 = false;
      displayedMonth = '';
      return;
    }
    displayedMonth = event.getAttribute('data-month');
    const month = displayedMonth;
    const month_tooltip = data[months.indexOf(month)];

    isTextDisplayed2 = true;

    const rect2 = event.getBoundingClientRect();

    var month_info = ' <div id="label2" class="event-label2" style="top: ' + (rect2.top - 410) + 'px; left: ' + (rect2.left + rect2.width / 2) + 'px; display: block;height: 400px; max-width:250px; white-space: normal; overflow:hidden; "><time>' + month + '</time>' + month_tooltip + '</div>';
   timeline2.insertAdjacentHTML('beforeend', month_info);
  });
});





// click to flip image
function flipImage(card) {
  card.classList.toggle("flip-card-flipped");
}

// Stack images Swapping function
function swapImages() {
  const backImage = document.querySelector(".back-image");
  const frontImage = document.querySelector(".front-image");

  if (frontImage.style.zIndex === "1") {
    frontImage.style.zIndex = "2";
    backImage.style.zIndex = "1";
  } else {
    frontImage.style.zIndex = "1";
    backImage.style.zIndex = "2";
  }
}
