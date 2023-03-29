<!DOCTYPE html>
<html>
<head>

  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="../CSS/all_features.css"> 
</head>
<body>
  <div class = "outer-container">
<!-- <div id="filter">

  <select id="filter_title">
    <option value="all">All Titles</option>
  </select>

  <label for="from-year">From:</label>
  <input type="number" id="from-year" name="from-year" min="1700" max="2010" value="1812" step="10">
  <label for="to-year">To:</label>
  <input type="number" id="to-year" name="to-year" min="1990" max="2010" value="2010">
  <button id="filter-button">Filter</button>
</div> -->

<div class="filter-bar">
    <div class="select-filter" id="filter">
    <select id="filter_title">
      <option value="all">All Titles</option>
    </select>
   </div>
    <div class="range-filter">
    <label for="from-year">From:</label>
    <input type="number" id="from-year" name="from-year" min="1700" max="2010" value="1812" step="10">
    <label for="to-year">To:</label>
    <input type="number" id="to-year" name="to-year" min="1990" max="2010" value="2010">
    <button id="filter-button">Filter</button>
    </div>
  </div>

<div id="timeline_container" class="scroll-container">

  <div id="timeline_box" class="scroll-content">

    <svg id="timeline" cache-id="16de89faabdb48d1a0a46f23dde4f4b1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 400 400" shape-rendering="geometricPrecision" text-rendering="geometricPrecision"  x="0px" y="0px">
      <defs>
        <linearGradient id="e0YvEuspUTQ2-stroke" x1="0" y1="150" x2="300" y2="150" spreadMethod="pad" gradientUnits="userSpaceOnUse" gradientTransform="translate(0 0)">
          <!-- <stop id="e0YvEuspUTQ2-stroke-0" offset="0%" stop-color="#fc259b" />
          <stop id="e0YvEuspUTQ2-stroke-1" offset="100%" stop-color="#f85e08" /> -->
          <stop id="e0YvEuspUTQ2-stroke-0" offset="0%" stop-color="#94b8b4" />
          <stop id="e0YvEuspUTQ2-stroke-1" offset="100%" stop-color="#ac80b0" />
        </linearGradient>
      </defs>

      <line id="mypath" x1="-1600" y1="180" x2="2000" y2="180" fill="#1c278a" stroke="url(#e0YvEuspUTQ2-stroke)" stroke-width="13" />
      
       <line id = "mypath2" class="second-line hidden"  y1="300" y2="300"  fill="#1c278a" pathLength="90" stroke="url(#e0YvEuspUTQ2-stroke)" stroke-width="11" />
       <!--  <circle class="second-circle hidden" cx="100" cy="250" r="10" />
        <circle class="second-circle hidden" cx="200" cy="250" r="10" />
        <circle class="second-circle hidden" cx="300" cy="250" r="10" />
        <circle class="second-circle hidden" cx="400" cy="250" r="10" /> -->
        <g id ="sub_timeline" class="arrow">
            <style type="text/css">
                .st0{fill:none;stroke:whitesmoke;stroke-miterlimit:10;stroke-width: 3;z-index: 11;}
            </style>
            <line id="sub_line1" class="st0" x1="186" y1="180" x2="185.5" y2="340"/>
            <line id="sub_line2" class="st0" x1="8.5" y1="340" x2="181.5" y2="340"/>
            <line id="sub_line3" class="st0" x1="362.5" y1="340" x2="181.5" y2="340"/>
            <line id="sub_line4" class="st0" x1="8.5" y1="380" x2="8.5" y2="340"/>
            <line id="sub_line5" class="st0" x1="362.5" y1="380" x2="362.5" y2="340"/>
        </g>
        
    </svg>

  </div>
</div>

</div>
<div class="left hidden" id = "left_arrow">
    <i class="material-icons" style='font-size:30px;color:white'>chevron_left</i>
  </div>
<div class = "right hidden" id = "right_arrow"  >
  <i class="material-icons" style='font-size:30px;color:white'>chevron_right</i>
</div>
<!-- <script src='all_features.js'></script> -->


<div class="main-div">
    <?xml version="1.0" encoding="utf-8"?>
    <!-- Generator: Adobe Illustrator 27.3.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
    <!-- <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
        viewBox="0 0 374.5 137.5" style="enable-background:new 0 0 374.5 137.5;" xml:space="preserve" class="arrow">
    <style type="text/css">
        .st0{fill:none;stroke:#000000;stroke-miterlimit:10;}
    </style>
    <line class="st0" x1="186" y1="9" x2="185.5" y2="91"/>
    <line class="st0" x1="8.5" y1="91" x2="181.5" y2="91"/>
    <line class="st0" x1="362.5" y1="91" x2="181.5" y2="91"/>
    <line class="st0" x1="8.5" y1="132.5" x2="8.5" y2="91"/>
    <line class="st0" x1="362.5" y1="132.5" x2="362.5" y2="91"/>
    </svg> -->
                            

    <div class="expandend-div">
        <h1>heading</h1>
        <div class="grid">
            <div><h2>first</h2></div>
            <div><h2>second</h2></div>
            <div><h2>third</h2></div>
        </div>
    </div>
</div>


<div id="calendar"></div>
<div class="addSpace"><div id = "video-container"></div></div>
<div class = "overlay hidden">
    <div>

    </div>
</div>

<script>

    </script>
<script>
  var years = [
  "1810",
  "1811",
  "1812",
  "1813",
  "1814",
  "1815",
  "1816",
  "1817",
  "1818",
  "1819"
];
var info = [
  "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium",
  "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium",
  "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium",
  "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium",
  "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium",
  "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium",
  "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium",
  "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium",
  "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium",
  "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium"
];
var titles = [
  "title1",
  "title2",
  "title3",
  "title4",
  "title5",
  "title6",
  "title7",
  "title8",
  "title9",
  "title10"
];
var user_images = [ // User's Images
  ['clubs_ace.svg',  
  'abstract.svg'],

  ['clubs_ace.svg',  
  'abstract.svg'],

  ['clubs_ace.svg',  
  'abstract.svg'],

  ['clubs_ace.svg',  
  'abstract.svg'],

  ['clubs_ace.svg',  
  'abstract.svg'],

  ['clubs_ace.svg',  
  'abstract.svg'],

  ['clubs_ace.svg',  
  'abstract.svg'],

  ['clubs_ace.svg',  
  'abstract.svg'],

  ['clubs_ace.svg',  
  'abstract.svg'],

  ['clubs_ace.svg',  
  'abstract.svg'],

  ['clubs_ace.svg',  
  'abstract.svg'],

  ['clubs_ace.svg',  
  'abstract.svg']
];

function process_images(year_index){


    var year_tooltip = "<div class='flip-container'><div class='flipper'><div class='front'><img style ='max-height:260px;' src="+user_images[year_index][0]+" alt='1730s'  title='This is an image of the 1730s'> </div><div class='back'><img style ='max-height:260px;' src="+user_images[year_index][1]+" alt='1753s'  title='This is an image of the 1753s'></div></div></div>";

    var year_info = ' <div id="label" class="event-label" style=" display: block;height: 300px; max-width:250px; white-space: normal; overflow:hidden; "><time>' + years[year_index] + '</time>' + year_tooltip + '</div>';

    return year_info;
}

for (let i = 0; i < titles.length; i++) {
  console.log("here");
  var option = " <option value=" + titles[i] + ">" + titles[i] + "</option>";
  document
    .getElementById("filter_title")
    .insertAdjacentHTML("beforeend", option);
}

for (let i = 0; i < years.length; i++) {
  pathOnDiv(years[i], i / (years.length - 1), titles[i]);
}

// for (let i = 0; i < years.length; i++) {
//   var id = "#"+years[i];
//   var circle_year = document.getElementById(id);
//   //const svg = circle.closest('svg');
// var svg = document.querySelector('#timeline');
// // Create a new text element
// const text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
// text.setAttribute('class', 'circle-label');

// // Set the text content to the circle's index + 1
// text.textContent =years[i];

// // Set the x and y attributes to the center of the circle
// const x = circle_year.getAttribute('cx');
// const y = circle_year.getAttribute('cy');
// text.setAttribute('x', x);
// text.setAttribute('y', y - circle_year.getAttribute('r') - 5);

// // Add the text element to the SVG element
// svg.appendChild(text);
// }

// Get all the circles in the timeline
const circles_year = document.querySelectorAll('.first-circle');

// Iterate over each circle and create a new text element for it
circles_year.forEach((circle, index) => {
  var svg = circle.closest('svg');
  // Create a new text element
  var text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
  text.setAttribute('class', 'circle-label');
  
  // Set the text content to the circle's index + 1
  text.textContent = years[index] ;
  
  // Set the x and y attributes to the center of the circle
  const x = circle.getAttribute('cx');
  const y = circle.getAttribute('cy');
  text.setAttribute('x', x);
  text.setAttribute('y', y - circle.getAttribute('r') - 40);
  
  // Add the text element to the SVG element
  svg.appendChild(text);
});


var cnt = 0;

function pathOnDiv(text, pos, title) {
  var path = document.getElementById("mypath");
  var pathLength = path.getTotalLength();
  var loc = path.getPointAtLength(pos * (pathLength - 10));
  var point =
    "<circle id=" + text +" cx='" + (loc.x + 8) + "' cy='" +  loc.y +
    "'  class=' unselected_circle event first-circle' data-year='" +
    text +
    "'data-title='" +
    title +
    "' />";
  //r="20" fill="white" stroke="#474e5d" stroke-width="3" stroke-r = "2"
  document.getElementById("timeline").insertAdjacentHTML("beforeend", point);
}
window.addEventListener("load", function() {
  const container = document.querySelector("#timeline_box");
  let prevX = 0;

  container.addEventListener("mousemove", function(e) {
    const x = e.clientX - container.offsetLeft;
    if (x < prevX) {
      container.scrollLeft -= 10;
    } else if (x > prevX) {
      container.scrollLeft += 10;
    }
    prevX = x;
  });
/*   var oldScrollX = container.scrollY;
  var directionText = document.getElementById('direction');
  container.onscroll = function(e) {
    if (oldScrollX < container.scrollX) {
      document.querySelector(".fa-angle-double-left").classList.add="hidden";
      document.querySelector(".fa-angle-double-right").classList.remove="hidden";
    } else {
       document.querySelector(".fa-angle-double-left").classList.remove="hidden";
      document.querySelector(".fa-angle-double-right").classList.add="hidden";
    }
    oldScrollX = container.scrollX;
  }
  
   */
});

const timeline = document.getElementById("timeline_box");
const events = timeline.querySelectorAll(".event");
// this messes up the div position for now

const container = document.querySelector(".scroll-container");
const content = document.querySelector("#timeline_box");
 var oldScrollX = 0;

 //console.log(left_arrow);
 const containerWidth = container.offsetWidth;
  const contentWidth = content.offsetWidth;
  const scrollPos = container.scrollLeft;
container.addEventListener("mousemove", (e) => {

  

  const hoverPos = e.pageX - container.offsetLeft;

  const hoverPercent = hoverPos / containerWidth;

  const scrollAmount = hoverPercent * (contentWidth - containerWidth);

  container.scrollLeft = scrollAmount;
 // console.log(left_arrow.classList);
   if (scrollAmount - oldScrollX >= 10) {
      left_arrow.classList.add("hidden");
      right_arrow.classList.remove("hidden");
    } else if (scrollAmount - oldScrollX <= -10) {
       left_arrow.classList.remove("hidden");
     right_arrow.classList.add("hidden");
    }
     oldScrollX = scrollAmount;
});

const filterButton = document.querySelector("#filter-button");
const circles = document.querySelectorAll("circle");

filterButton.addEventListener("click", () => {
  const fromYear = parseInt(document.querySelector("#from-year").value);
  const toYear = parseInt(document.querySelector("#to-year").value);

  circles.forEach((circle) => {
    const year = parseInt(circle.dataset.year);

    if (year >= fromYear && year <= toYear) {
      circle.style.display = "inline";
    } else {
      circle.style.display = "none";
    }
  });
});

var filterSelect = document.querySelector("#filter_title");
const circles_title = document.querySelectorAll("circle");
filterSelect.addEventListener("change", function() {
  var selectedValue = this.value;
  circles_title.forEach((circle) => {
   // console.log(selectedValue + " and " + circle.getAttribute("data-title"));
    if (
      selectedValue === "all" ||
      circle.getAttribute("data-title") == selectedValue
    ) {
      circle.classList.remove("hidden");
    } else {
      circle.classList.add("hidden");
    }
  });
});
const firstLine = document.querySelector('#mypath');
const secondLine = document.querySelector('.second-line');
const secondCircle = document.querySelector('.second-circle');
var circle_index = 0;
circles.forEach((circle) => {

  const div = document.createElement("div");
  //div.textContent = circle.getAttribute("data-title");
  var year_tooltip = process_images(circle_index);
  div.innerHTML = year_tooltip;
  div.id = circle.getAttribute("data-title");
  div.classList.add("event_name");
  // var img = document.createElement("IMG");
  //   img.src = "clubs_ace.svg";
  //   div.appendChild(img);
  circle.addEventListener("mousedown", () => {
  
    secondLine.classList.add('hidden');
    //secondCircle.classList.add('hidden');
    if(circle.classList.contains('unselected_circle'))
    {
    circle.classList.remove('unselected_circle');
    circle.classList.add('selected_circle');
    div.style.display="block";
    }
    else
    {
      circle.classList.remove('selected_circle');
      circle.classList.add('unselected_circle');
      div.style.display="none";
    }
    div.style.top = `${circle.getBoundingClientRect().top + 70}px`;
    div.style.left = `${circle.getBoundingClientRect().left }px`;
    document.body.appendChild(div);
  });

  document.getElementById("timeline_container").addEventListener("scroll", () => {

    div.style.top = `${circle.getBoundingClientRect().top + 70}px`;
    div.style.left = `${circle.getBoundingClientRect().left }px`;
  });
  circle_index++;
});


firstLine.addEventListener('click', (event) => {
       

  const clickedX = event.clientX - event.target.getBoundingClientRect().left;
  const circleBefore = (findCircleBeforeX(clickedX)).cx.baseVal.value;
  const circleAfter = (findCircleAfterX(clickedX)).cx.baseVal.value;

  console.log(" here");
  /* console.log(circleBefore.cx.baseVal.value + " here " + circleAfter.cx.baseVal.value) */
  if (circleBefore != 0 && circleAfter != 0) {


    
    const centerX = (circleBefore + circleAfter) / 2;
    // console.log(circleBefore + " here " + circleAfter);
    const secondLineX1 = centerX - 200;
    const secondLineX2 = centerX + 200;

    // var sub_timeline = document.querySelector('#sub_timeline');
//    var line_indicator =  '<line class="st0" x1="'+centerX+'" y1="180" x2="'+centerX+'" y2="340"/><line class="st0" x1="'+centerX-180+'" y1="340" x2="'+centerX+'" y2="340"/> <line class="st0" x1="'+centerX+180+'" y1="340" x2="'+centerX+'" y2="340"/><line class="st0" x1="'+centerX-180+'" y1="380" x2="'+centerX-180+'" y2="340"/><line class="st0" x1="'+centerX+180+'" y1="380" x2="'+centerX+180+'" y2="340"/>';

 //  sub_timeline.insertAdjacentHTML("beforeend",line_indicator);
    var offset =800;
    var sub_line1 = document.querySelector('#sub_line1');
    sub_line1.setAttribute('x1', centerX);
    sub_line1.setAttribute('x2', centerX);

    var sub_line2 = document.querySelector('#sub_line2');
    sub_line2.setAttribute('x1', (centerX-offset));
    sub_line2.setAttribute('x2', centerX);

    var sub_line3 = document.querySelector('#sub_line3');
    sub_line3.setAttribute('x2', centerX);
    sub_line3.setAttribute('x1', (centerX+offset));

    var sub_line4 = document.querySelector('#sub_line4');
    sub_line4.setAttribute('x1', (centerX-offset));
    sub_line4.setAttribute('x2', (centerX-offset));

    var sub_line5 = document.querySelector('#sub_line5');
    sub_line5.setAttribute('x1', (centerX+offset));
    sub_line5.setAttribute('x2', (centerX+offset));

    var over = document.querySelector(".overlay");
    over.classList.remove("hidden");
    var x = document.querySelector(".arrow");
    if(x.classList.contains("icon-active")){
       x.classList.remove("icon-active");
    document.querySelector(".expandend-div").classList.remove("div-active");
    }
    else{
    document.querySelector(".arrow").classList.add("icon-active");
    document.querySelector(".expandend-div").classList.add("div-active");
    }


    // secondLine.setAttribute('x1', secondLineX1);
    // secondLine.setAttribute('x2', secondLineX2);
//     for (let i = 0; i < years.length; i++) {
//   pathOnDiv(years[i], i / (years.length - 1), titles[i]);
// }

   // secondCircle.setAttribute('x', secondLineX1);
    // secondLine.classList.remove('hidden');
    // secondCircle.classList.remove('hidden');

    years2=['1801','1802','1803']
for (let i = 0; i < years2.length; i++) {
  var path2 = document.getElementById('mypath2');
  var pathLength = path2.getTotalLength();
  var loc = path2.getPointAtLength(i *0.5* (pathLength - 10));
  var point =
    "<circle id=" + years2[i] + ' cx="' + (loc.x + 8) + '" cy="' + loc.y + '"  r = 9 class=" unselected_circle event first-circle" data-year="' + years2[i]+ '" />"';
  //r="20" fill="white" stroke="#474e5d" stroke-width="3" stroke-r = "2"
 // document.getElementById("timeline").insertAdjacentHTML("beforeend", point);
}
  } else {
    // secondTimeline.classList.add('hidden');
  }
});


function findCircleBeforeX(x) {
  //console.log("findCircleBeforeX");
  const circles = document.querySelectorAll('.first-circle');
  let circleBefore = null;

  circles.forEach(function(circle) {
    // console.log(circle.cx);
    const circleX = circle.getBoundingClientRect().left - event.target.getBoundingClientRect().left + circle.r.baseVal.value;

    // console.log(circleX);
    // console.log(x);
    if (circleX <= x) {
      circleBefore = circle;
      // console.log(circle.cx.baseVal.value);
    }
  });

  return circleBefore;
}

function findCircleAfterX(x) {
  //console.log("findCircleAfterX");
  const circles = document.querySelectorAll('.first-circle');
  /* console.log(circles) */
  let circleAfter = null;

  var check = true;
  // Iterate over all the circles and find the one with the closest X coordinate that is greater than the clicked X
  circles.forEach(function(circle) {

    const circleX = circle.getBoundingClientRect().left - event.target.getBoundingClientRect().left + circle.r.baseVal.value;
    // console.log(circleX);
    // console.log(x);
    if (circleX > x && check) {
      check = false;
      // console.log(circle.cx.baseVal.value);
      circleAfter = circle;

    }
  });
  return circleAfter;
}






</script>
</body>
</html>
