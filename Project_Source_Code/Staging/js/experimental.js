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

var artifacts = [
  'img/art_1.webp', 
  'img/art_2.png', 

  'img/art_1.webp', 
  'img/art_2.png', 

  'img/art_1.webp', 
  'img/art_2.png', 

  'img/art_1.webp', 
  'img/art_2.png', 

  'img/art_1.webp', 
  'img/art_2.png', 

  'img/art_1.webp', 
  'img/art_2.png', 

  'img/art_1.webp', 
  'img/art_2.png', 

  'img/art_1.webp', 
  'img/art_2.png', 
]
function process_artifacts(year_index){
  return "<img src="+artifacts[year_index*2]+" alt='1730s' class='overlay2 front-image' title='This is an image of the 1730s' onclick='swapImages()'><img src="+artifacts[year_index*2+1]+" alt='1753s' class='overlay2 back-image' title='This is an image of the 1753s' onclick='swapImages()'>"
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
    const a_label = document.getElementById('artifact_label');

    if (label2 && displayedYear === event.getAttribute('data-year')) {
      label2.parentNode.removeChild(label2);
      a_label.parentNode.removeChild(a_label)

      isTextDisplayed = false;
      displayedYear = '';
      return;
    }
    displayedYear = event.getAttribute('data-year');
    const year = displayedYear;
    const year_tooltip = process_images(years.indexOf(year)) //info[years.indexOf(year)];
    const artifact_tooltip = process_artifacts(years.indexOf(year));
    const label = document.createElement('div');
    label.textContent = year;
    label.classList.add('event-label');

    if (isTextDisplayed) {
      const label2 = document.getElementById('label');
      label2.parentNode.removeChild(label2);
      a_label.parentNode.removeChild(a_label)
    }
    isTextDisplayed = true;


    const rect = event.getBoundingClientRect();

//Top: 150                                                                                                                                                                                                                                                        //year_tooltip                              
    var year_info = ' <div id="label" class="event-label" style="top: ' + (rect.top - 410) + 'px; left: ' + (rect.left + rect.width / 2) + 'px; display: block;height: 400px; max-width:250px; white-space: normal; overflow:hidden; "><time>' + year + '</time>' + year_tooltip + '</div>';
    var artifact_info = ' <div id="artifact_label" class="event-label" style="top: ' + (rect.top+20) + 'px; left: ' + (rect.left + rect.width / 2 ) + 'px; display: block;height: 500px; max-width:400px; white-space: normal; overflow:hidden; "><time>' + year + '</time>' + artifact_tooltip + '</div>';
    timeline.insertAdjacentHTML('beforeend', year_info);
    timeline.insertAdjacentHTML('beforeend', artifact_info);
  });
});






// VERTICAL TIMELINE
for (let i = 0; i < years.length; i++) {
  pathOnDiv2(years[i], (i / (years.length - 1)));
}
// }
function pathOnDiv2(text, pos) {
 var path2 = document.getElementById("path2");
 var pathLength2 = path2.getTotalLength();
 var loc2 = path2.getPointAtLength(pos * (pathLength2 + 500));
 var point2 = '<circle id=' + text  + ' cx="' + (loc2.x) + '" cy="' + (loc2.y) + '" r="5" fill="white" class="event message" data-year="' + text + '" />';
 document.getElementById('timeline2').insertAdjacentHTML('beforeend', point2);
}


const timeline2 = document.getElementById('timeline_box2');
const events2 = timeline2.querySelectorAll('.event');

let isTextDisplayed2 = false;
let displayedYear2 = '';

events2.forEach(event => {
 event.addEventListener('click', () => {
 
   const label3 = document.getElementById('label2');
   const a_label2 = document.getElementById('artifact_label2');

   if (label3 && displayedYear2 === event.getAttribute('data-year')) {
     label3.parentNode.removeChild(label3);
     a_label2.parentNode.removeChild(a_label2)

     isTextDisplayed2 = false;
     displayedYear2 = '';
     return;
   }
   displayedYear2 = event.getAttribute('data-year');
   const year2 = displayedYear2;
   const year_tooltip2 = process_images(years.indexOf(year2)); //info[years.indexOf(year)];
   const artifact_tooltip2 = process_artifacts(years.indexOf(year2));
   const label = document.createElement('div');
   label.textContent = year2;
   label.classList.add('event-label2');

   if (isTextDisplayed2) {
     const label3 = document.getElementById('label2');
     label3.parentNode.removeChild(label3);
     a_label2.parentNode.removeChild(a_label2)
   }
   isTextDisplayed2 = true;

   // Used to fix images in place
   const containerRect = timeline2.getBoundingClientRect();
   const tooltipLeft = containerRect.left  - parseFloat(event.getAttribute('cx')) + 950 - window.scrollX;
   const tooltipTop = containerRect.top + parseFloat(event.getAttribute('cy')) + window.scrollY -100;

   const tooltipLeft2 = containerRect.left  - parseFloat(event.getAttribute('cx')) + 1400 - window.scrollX;
   const tooltipTop2 = containerRect.top + parseFloat(event.getAttribute('cy')) + window.scrollY -100;

   var year_info2 = ' <div id="label2" class="event-label2" style="top: ' + tooltipTop + 'px; left: ' + tooltipLeft + 'px; display: block;height: 400px; max-width:250px; white-space: normal; overflow:hidden; "><time>' + year2 + '</time>' + year_tooltip2 + '</div>';
   var artifact_info2 = ' <div id="artifact_label2" class="event-label2" style="top: ' + tooltipTop2 + 'px; left: ' + tooltipLeft2 + 'px; display: block;height: 500px; max-width:400px; white-space: normal; overflow:hidden; "><time>' + year2 + '</time>' + artifact_tooltip2 + '</div>';

   timeline2.insertAdjacentHTML('beforeend', year_info2);
   timeline2.insertAdjacentHTML('beforeend', artifact_info2);
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


// This section is for toggling on and off either timelines
// Get the timelines and the buttons
const timeline_1 = document.getElementById("timeline_box");
const timeline_2 = document.getElementById("timeline_box2");
const button1 = document.getElementById("toggle-btn1");
const button2 = document.getElementById("toggle-btn2");

// Hide the both timelines by default
timeline_1.style.visibility = "hidden"; // For some reason if the display of timeline_1 is set to none, timeline 2 stops functionaing as expected.
timeline_2.style.display = "none";       // The workaround was to make it hidden as opposed to setting its display to none
// Add a click event listener to the first button
var b1 = false
button1.addEventListener("click", function() {
  // Show the first timeline and hide the second one
  if (b1 === false){
  timeline_1.style.visibility = "visible";
  timeline_2.style.display = "none";
  b1 = true;
  }
  else {
    timeline_1.style.visibility = "hidden";
    timeline_2.style.display = "none";
    b1 = false;
  }
});




// Add a click event listener to the second button
var b2 = false;
button2.addEventListener("click", function() {
  // Show the second timeline and hide the first one
  if (b2 === false){
  timeline_2.style.display = "inline-block";
  timeline_1.style.visibility = "hidden";
  b2 = true;
  }
  else {
    timeline_1.style.visibility = "hidden";
    timeline_2.style.display = "none";
     b2 = false;
  }
});

