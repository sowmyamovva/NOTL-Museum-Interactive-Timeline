var years = ["1810", "1811", "1812", "1813", "1814", "1815", "1816", "1817", "1818", "1819"];

var user_images = [ // User's Images
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

  'img/card_front.png',
  'img/card_back.png',

  'img/card_front.png',
  'img/card_back.png',
];

var info = [ // Processed info
  "<div class='flip-container'><div class='flipper'><div class='front'><img src="+user_images[0]+" alt='1730s' class='overlay' title='This is an image of the 1730s'> </div><div class='back'><img src="+user_images[1]+" alt='1753s' class='overlay' title='This is an image of the 1753s'></div></div></div>",
  "<div class='flip-container'><div class='flipper'><div class='front'><img src="+user_images[2]+" alt='1730s' class='overlay' title='This is an image of the 1730s'> </div><div class='back'><img src="+user_images[3]+" alt='1753s' class='overlay' title='This is an image of the 1753s'></div></div></div>",
  "<div class='flip-container'><div class='flipper'><div class='front'><img src="+user_images[4]+" alt='1730s' class='overlay' title='This is an image of the 1730s'> </div><div class='back'><img src="+user_images[5]+" alt='1753s' class='overlay' title='This is an image of the 1753s'></div></div></div>",
  "<div class='flip-container'><div class='flipper'><div class='front'><img src="+user_images[6]+" alt='1730s' class='overlay' title='This is an image of the 1730s'> </div><div class='back'><img src="+user_images[7]+" alt='1753s' class='overlay' title='This is an image of the 1753s'></div></div></div>",
  "<div class='flip-container'><div class='flipper'><div class='front'><img src="+user_images[8]+" alt='1730s' class='overlay' title='This is an image of the 1730s'> </div><div class='back'><img src="+user_images[9]+" alt='1753s' class='overlay' title='This is an image of the 1753s'></div></div></div>",
  "<div class='flip-container'><div class='flipper'><div class='front'><img src="+user_images[10]+" alt='1730s' class='overlay' title='This is an image of the 1730s'> </div><div class='back'><img src="+user_images[11]+" alt='1753s' class='overlay' title='This is an image of the 1753s'></div></div></div>",
  "<div class='flip-container'><div class='flipper'><div class='front'><img src="+user_images[12]+" alt='1730s' class='overlay' title='This is an image of the 1730s'> </div><div class='back'><img src="+user_images[13]+" alt='1753s' class='overlay' title='This is an image of the 1753s'></div></div></div>",
  "<div class='flip-container'><div class='flipper'><div class='front'><img src="+user_images[14]+" alt='1730s' class='overlay' title='This is an image of the 1730s'> </div><div class='back'><img src="+user_images[15]+" alt='1753s' class='overlay' title='This is an image of the 1753s'></div></div></div>",
  "<div class='flip-container'><div class='flipper'><div class='front'><img src="+user_images[16]+" alt='1730s' class='overlay' title='This is an image of the 1730s'> </div><div class='back'><img src="+user_images[17]+" alt='1753s' class='overlay' title='This is an image of the 1753s'></div></div></div>",
  "<div class='flip-container'><div class='flipper'><div class='front'><img src="+user_images[16]+" alt='1730s' class='overlay' title='This is an image of the 1730s'> </div><div class='back'><img src="+user_images[17]+" alt='1753s' class='overlay' title='This is an image of the 1753s'></div></div></div>",
]


// Swapper Function 
//   "<div class='flip-container'><div class='flipper'><div class='front'><img src='img/card_front.png' alt='1730s' class='overlay front-image' title='This is an image of the 1730s' onclick='swapImages()> </div><div class='back'><img src='img/card_back.png' alt='1753s' class='overlay back-image' title='This is an image of the 1753s'></div></div></div><img src='img/1753.png' alt='1753s' class='overlay front-image' title='This is an image of the 1753s' onclick='swapImages()'>",
// Click Function
// "<div class='flip-card ' onclick='flipImage(this)'><div class='flip-card-inner'><div class='flip-card-front'><img src='img/card_front.png' alt='1730s' class='overlay' title='This is an image of the 1730s'></div><div class='flip-card-back'><img src='img/card_back.png' alt='1776s' class='overlay' title='This is an image of the 1776s' width='400' height='300'></div></div></div>",

var content = [
"img/1776.png"+'',
"img/1777.png",
"img/1778.png"
]


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
    const year_tooltip = info[years.indexOf(year)];
    const label = document.createElement('div');
    label.textContent = year;
    label.classList.add('event-label');

    if (isTextDisplayed) {
      const label2 = document.getElementById('label');
      label2.parentNode.removeChild(label2);
    }
    isTextDisplayed = true;

    const rect = event.getBoundingClientRect();

//Top: 150
    var year_info = ' <div id="label" class="event-label" style="top: ' + (rect.top - 410) + 'px; left: ' + (rect.left + rect.width / 2) + 'px; display: block;height: 400px; max-width:250px; white-space: normal; overflow:hidden; "><time>' + year + '</time>' + year_tooltip + '</div>';

    timeline.insertAdjacentHTML('beforeend', year_info);
  });
});

// Flip image on click
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
