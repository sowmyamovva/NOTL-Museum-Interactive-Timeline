var years = ["1810", "1811", "1812", "1813", "1814", "1815", "1816", "1817", "1818", "1819"];
// var info = ["At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium", "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium", "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium", "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium", "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium", "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium", "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium", "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium", "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium", "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium"];

// var info = [
//   "<div class='overlay-container'>",
//   "<img src='img/1700s.png' alt='1700s' class='overlay' title='This is an image of the 1700s'>",
//   "<img src='img/1730s.webp' alt='1730s' class='overlay' title='This is an image of the 1730s'>",
//   "<img src='img/1753.png' alt='1753s' class='overlay' title='This is an image of the 1753s'>",
//   "<img src='img/1760.png' alt='1760s' class='overlay' title='This is an image of the 1760s'>",
//   "<img src='img/1776.png' alt='1776s' class='overlay' title='This is an image of the 1776s'>",
//   "<img src='img/1776.png' alt='1776s' class='overlay' title='This is an image of the 1776s'>",
//   "<img src='img/1776.png' alt='1776s' class='overlay' title='This is an image of the 1776s'>",
//   "<img src='img/1776.png' alt='1776s' class='overlay' title='This is an image of the 1776s'>",
//   "<img src='img/1776.png' alt='1776s' class='overlay' title='This is an image of the 1776s'>",
//   "<img src='img/1776.png' alt='1776s' class='overlay' title='This is an image of the 1776s'>",
//   "</div>"
// ];

var info = [
  "<img src='img/1700s.png' alt='1700s' class='overlay' title='This is an image of the 1700s'>",
  "<div class='flip-card ' onclick='flipImage(this)'><div class='flip-card-inner'><div class='flip-card-front'><img src='img/card_front.png' alt='1730s' class='overlay' title='This is an image of the 1730s'></div><div class='flip-card-back'><img src='img/card_back.png' alt='1776s' class='overlay' title='This is an image of the 1776s' width='400' height='300'></div></div></div>",
  "<div class='flip-card'><div class='flip-card-inner'><div class='flip-card-front'><img src='img/card_front.png' alt='1730s' class='overlay' title='This is an image of the 1730s'></div><div class='flip-card-back'><img src='img/card_back.png' alt='1776s' class='overlay' title='This is an image of the 1776s'></div></div></div>",
  "<div class='flip-container'><div class='flipper'><div class='front'><img src='img/card_front.png' alt='1730s' class='overlay' title='This is an image of the 1730s'> </div><div class='back'><img src='img/card_back.png' alt='1753s' class='overlay' title='This is an image of the 1753s'></div></div></div>",
  "<div class = 'image-container'><img src='img/1753.png' alt='1753s' class='overlay back-image' title='This is an image of the 1753s' onclick='swapImages()'><img src='img/1700s.png' alt='1700s' class='overlay front-image' title='This is an image of the 1700s' onclick='swapImages()'></div>", // Stack tester
  "<img src='img/1760.png' alt='1760s' class='overlay' title='This is an image of the 1760s'>",
  "<img src='img/1776.png' alt='1776s' class='overlay' title='This is an image of the 1776s'>",
  "<img src='img/1776.png' alt='1776s' class='overlay' title='This is an image of the 1776s'>",
  "<img src='img/1776.png' alt='1776s' class='overlay' title='This is an image of the 1776s'>",
  "<img src='img/1776.png' alt='1776s' class='overlay' title='This is an image of the 1776s'>",
  "<img src='img/1776.png' alt='1776s' class='overlay' title='This is an image of the 1776s'>",
  "<img src='img/1776.png' alt='1776s' class='overlay' title='This is an image of the 1776s'>",
  "<div class='overlay'>",
  "<div class='overlay-content'>",
  "<div class='flip-card'>",
  "<div class='flip-card-inner'>",
  "<div class='flip-card-front'>",
  "<img src='' alt=''>",
  "</div>",
  "<div class='flip-card-back'>",
  "<img src='' alt=''>",
  "</div>",
  "</div>",
  "</div>",
  "</div>",
  "</div>",
  "</div>",
  "</div>"
];

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

// Alert
// events.forEach(event => {
//   // add click event listener to circle element
//   event.addEventListener('click', () => {
//     // display alert with message when circle is clicked
//     alert('Circle with data-year="' + event.getAttribute('data-year') + '" was clicked!');
//   });
// });


// Message
// const messageElement = document.getElementsByClassName('message');

// events.forEach(event => {
//   // add click event listener to circle element
//   event.addEventListener('click', () => {
//     // set message with data-year when circle is clicked
//     if (messageElement) {
//       messageElement.innerHTML = 'Circle with data-year="' + event.getAttribute('data-year') + '" was clicked!';
//     }
//   });
// });


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
