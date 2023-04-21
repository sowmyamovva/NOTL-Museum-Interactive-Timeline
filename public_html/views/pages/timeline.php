<?php
require_once '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/controllers/ContentController.php';
$controller = new ContentController();
$events = $controller->getEvents();
$sub_events = $controller->getSubEvents();
$cnt1 = 0;
$cnt2 = 0;
$year_info = array(array());
foreach ($events as $row)
{
    $cnt2 = 0;
    $year_info[$cnt1][$cnt2++] = $row["id"];
    $year_info[$cnt1][$cnt2++] = $row["image_front"];
    $year_info[$cnt1][$cnt2++] = $row["image_back"];
    $year_info[$cnt1][$cnt2++] = $row["date"];
    $year_info[$cnt1][$cnt2++] = $row["date_marker"];
    $year_info[$cnt1][$cnt2++] = $row["date_title"];
    $year_info[$cnt1][$cnt2++] = $row["sub_events"];
    $cnt1++;
}

  $cnt1 = 0;
  $cnt2 = 0;
  $sub_info = array(array());
  $event_ids= array();
  foreach($sub_events as $row) 
  {
     if(in_array($row["event_id"], $event_ids))
     {
        
      $index = array_search($row["event_id"], $event_ids);
      $sub_info[$index][0] = $sub_info[$index][0].",".$row["id"];
      $sub_info[$index][1] = $sub_info[$index][1].",".$row["image_front"];
      $sub_info[$index][2] = $sub_info[$index][2].",".$row["image_back"];
     }
    else{
      $cnt2 = 0;
      $sub_info[$cnt1][$cnt2++] = $row["id"];
      $sub_info[$cnt1][$cnt2++] = $row["image_front"];
      $sub_info[$cnt1][$cnt2++] = $row["image_back"];
      $sub_info[$cnt1][$cnt2++] = $row["event_id"];
      $event_ids[$cnt1] = $row["event_id"];
     $cnt1++;
    }
  }

require_once '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/config/config.php';
$config = new Config();
$connection = $config->getConnection();

include '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/includes/header.php';
?>
<link rel="stylesheet" href="https://badger-timeline.infinityfreeapp.com/public_html/assets/CSS/all_features.css" /> 
<body>
 <div class = "outer-container">

<div class="filter-bar">
    <div class="select-filter" id="filter">
    <select id="filter_title">
      <option value="all">All Titles</option>
    </select>
   </div>
    <div class="range-filter">
    <label for="from-year">From:</label>
    <input type="number" id="from-year" name="from-year" min="0" max="2010" value="0" step="10">
    <label for="to-year">To:</label>
    <input type="number" id="to-year" name="to-year" min="0" max="2010" value="2010">
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
    
        <g id ="sub_timeline" class="arrow_sub">
            <style type="text/css">
                .st0{fill:none;stroke:whitesmoke;stroke-miterlimit:10;stroke-width: 5;z-index: 11;}
                .st1{ r: 15 !important;
                    fill:url(#e0YvEuspUTQ2-stroke);
                    stroke: white;
                    stroke-width: 3;}
            </style>
            <line id="sub_line1" class="st0" x1="186" y1="180" x2="185.5" y2="340"/>
            <circle id ="sub_circle" class="st1 hidden" cx = "186" cy = "340" />
            <!-- <line id="sub_line2" class="st0" x1="8.5" y1="340" x2="181.5" y2="340"/>
            <line id="sub_line3" class="st0" x1="362.5" y1="340" x2="181.5" y2="340"/>
            <line id="sub_line4" class="st0" x1="8.5" y1="380" x2="8.5" y2="340"/>
            <line id="sub_line5" class="st0" x1="362.5" y1="380" x2="362.5" y2="340"/> -->
        </g>
        
    </svg>

  </div>
</div>

</div>
<div class="left_arrow hidden" id = "left_arrow">
    <i class="material-icons" style='font-size:30px;color:white'>chevron_left</i>
  </div>
<div class = "right_arrow hidden" id = "right_arrow"  >
  <i class="material-icons" style='font-size:30px;color:white'>chevron_right</i>
</div>


<div class="main-div">

    <div class="expandend-div hidden">
        <h1 id = "sub_heading">heading</h1>
        <div class="grid" id="sub_events_container">
            <!-- <div><h2>first</h2></div>
            <div><h2>second</h2></div>
            <div><h2>third</h2></div> -->
        </div>
        
        <button class="close" onclick="off()">x</button>
    </div>
    
</div>


<div id="calendar"></div>
<div class="addSpace"><div id = "video-container"></div></div>
<div class = "overlay hidden" id ="overlay" onclick="off()">
    <div>

    </div>
</div>

<h1>Events</h1>
  <div id="eventscontainer"></div>

<script>
//  var trial_events = <?php //echo json_encode($events); ?>;
//  var trial_sub_events = <?php // echo json_encode($sub_events); ?>;
  const arrayColumn = (arr, n) => arr.map(x => x[n]);
  var years_all_info = <?php echo json_encode($year_info); ?>;
  var sub_events = <?php echo json_encode($sub_info); ?>;


function process_images(year_index){
    var time ="";
    if (years_all_info[year_index][4] !=null)
    {
        time = ( years_all_info[year_index][3]+" "+years_all_info[year_index][4]) ;
    }

    var year_tooltip = "<div class='flip-container'><div class='flipper'><div class='front'><img style ='max-height:260px; max-width:min-content;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+years_all_info[year_index][1]+"?raw=true' alt='1730s'  title='"+years_all_info[3]+"_"+years_all_info[4]+"'> </div><div class='back'><img style ='max-height:260px;max-width:min-content;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+years_all_info[year_index][2]+"?raw=true' alt='1753s'  title='Information on "+years_all_info[year_index][5] +"'></div></div></div>";

    var year_info = ' <div id="label" class="event-label" style=" display: block;height: 300px; white-space: normal; "><time>' +time + '</time>' + year_tooltip + '</div>';

    return year_info;
}

function process_sub_images(front,back,title){

    var year_tooltip = "<div class='flip-container'><div class='flipper'><div class='front'><img style ='max-height:260px;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+front+".jpg?raw=true' alt='1730s'  title='"+title+"'> </div><div class='back'><img style ='max-height:260px;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+back+".jpg?raw=true' alt='1753s'  title='"+title+"'></div></div></div>";

    var year_info = ' <div id="label" class="event-label" style=" display: block;height: 300px; white-space: normal; ">' + year_tooltip + '</div>';

    return year_tooltip;
}

for (let i = 0; i < years_all_info.length; i++) {
  //console.log("here");
  var option = " <option value=" + years_all_info[i][5] + ">" + years_all_info[i][5]  + "</option>";
  document
    .getElementById("filter_title")
    .insertAdjacentHTML("beforeend", option);
}

for (let i = 0; i < years_all_info.length; i++) {
  pathOnDiv(( years_all_info[i][3]+"_"+years_all_info[i][4]), i / (years_all_info.length - 1), years_all_info[i][5] , years_all_info[i][6], years_all_info[i][0]);
}

// Get all the circles in the timeline
const circles_year = document.querySelectorAll('.first-circle');

// Iterate over each circle and create a new text element for it
circles_year.forEach((circle, index) => {
  var svg = circle.closest('svg');
  // Create a new text element
  var text = document.createElementNS('http://www.w3.org/2000/svg', 'text');
  text.setAttribute('class', 'circle-label');
   text.setAttribute('id', index);
  // Set the text content to the circle's index + 1
  text.textContent = years_all_info[index][5] ;
  
  // Set the x and y attributes to the center of the circle
  const x = circle.getAttribute('cx');
  const y = circle.getAttribute('cy');
  text.setAttribute('x', x);
  text.setAttribute('y', y - circle.getAttribute('r') - 40);
  
  // Add the text element to the SVG element
  svg.appendChild(text);
});


var cnt = 0;

function pathOnDiv(text, pos, title,sub,id) {
  var path = document.getElementById("mypath");
  var pathLength = path.getTotalLength();
  var loc = path.getPointAtLength(pos * (pathLength - 10));
  var point =
    "<circle id=" + text +" cx='" + (loc.x + 8) + "' cy='" +  loc.y +
    "'  class=' unselected_circle event first-circle' data-year='" +
    text +
    "'data-title='" +
    title +
    "'data-subevents='" +
    sub +
    "'data-eventid='" +
    id +
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

});

const timeline = document.getElementById("timeline_box");
const events = timeline.querySelectorAll(".first-circle");
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
var circles = document.querySelectorAll(".first-circle");

filterButton.addEventListener("click", () => {
  const fromYear = parseInt(document.querySelector("#from-year").value);
  const toYear = parseInt(document.querySelector("#to-year").value);

  circles.forEach((circle,index) => {
    const year = parseInt(circle.dataset.year);
    var card_id = "circle_"+index;
    console.log("card_id "+card_id);
    if (year >= fromYear && year <= toYear) {
      circle.style.display = "inline";
      document.getElementById(index).classList.remove("hidden");
      if (document.getElementById(card_id) !==null)
      {
        document.getElementById(card_id).classList.remove("hidden");
      }
    } else {
      circle.style.display = "none";
       document.getElementById(index).classList.add("hidden");
       if (document.getElementById(card_id) !==null)
      {
       document.getElementById(card_id).classList.add("hidden");
      }
    }
  });
});

var filterSelect = document.querySelector("#filter_title");
const circles_title = document.querySelectorAll(".first-circle");
filterSelect.addEventListener("change", function() {
  var selectedValue = this.value;
  circles_title.forEach((circle,index) => {
   // console.log(selectedValue + " and " + circle.getAttribute("data-title"));
   
   var card_id = "circle_"+index;
   console.log("card_id "+card_id);
    if (
      selectedValue === "all" || circle.getAttribute("data-title") == selectedValue ) 
      {
      circle.classList.remove("hidden");
      document.getElementById(index).classList.remove("hidden");
      if (document.getElementById(card_id) !==null)
      {
      document.getElementById(card_id).classList.remove("hidden");
      }
    } else {
      circle.classList.add("hidden");
      document.getElementById(index).classList.add("hidden");
      if (document.getElementById(card_id) !==null)
      {
      document.getElementById(card_id).classList.add("hidden");
      }
    }
  });
});
const firstLine = document.querySelector('#mypath');
/* const secondLine = document.querySelector('.second-line'); */
/* const secondCircle = document.querySelector('.second-circle'); */
var circle_index = 0;
var circles2 = document.querySelectorAll(".first-circle");
console.log(circles2);

circles2.forEach((circle) => {

  const div = document.createElement("div");
  //div.textContent = circle.getAttribute("data-title");
  var year_tooltip = process_images(circle_index);
  div.innerHTML = year_tooltip;
 // div.id = circle.getAttribute("data-title");
  div.id = "circle_"+years_all_info[circle_index][0];
  div.classList.add("event_name");
  // var img = document.createElement("IMG");
  //   img.src = "clubs_ace.svg";
  //   div.appendChild(img);
  circle.addEventListener("mousedown", () => {
  
    //secondLine.classList.add('hidden');
    //secondCircle.classList.add('hidden');
    console.log(circle);
    console.log(div);
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
    div.style.left = `${circle.getBoundingClientRect().left +10}px`;
  
    document.body.appendChild(div);
  });

  document.getElementById("timeline_container").addEventListener("scroll", () => {

    div.style.top = `${circle.getBoundingClientRect().top + 70}px`;
    div.style.left = `${circle.getBoundingClientRect().left +10}px`;
  });
  circle_index++;
});


firstLine.addEventListener('click', (event) => {
       

  const clickedX = event.clientX - event.target.getBoundingClientRect().left;
  const circleBefore = (findCircleBeforeX(clickedX)).cx.baseVal.value;
  const circleAfter = (findCircleAfterX(clickedX)).cx.baseVal.value;
  const circleElemAfter = findCircleAfterX(clickedX);
  const circleElemBefore = findCircleBeforeX(clickedX);
  var flag = circleElemAfter.getAttribute('data-subevents');
  console.log(" here");
  /* console.log(circleBefore.cx.baseVal.value + " here " + circleAfter.cx.baseVal.value) */
  if (circleBefore != 0 && circleAfter != 0 && flag == 1) {
    const centerX = (circleBefore + circleAfter) / 2;
    var offset =800;
    var sub_line1 = document.querySelector('#sub_line1');
    sub_line1.setAttribute('x1', centerX);
    sub_line1.setAttribute('x2', centerX);
    var sub_circle = document.querySelector("#sub_circle");
    sub_circle.setAttribute('cx', centerX);
    // var sub_line2 = document.querySelector('#sub_line2');
    // sub_line2.setAttribute('x1', (centerX-offset));
    // sub_line2.setAttribute('x2', centerX);

    // var sub_line3 = document.querySelector('#sub_line3');
    // sub_line3.setAttribute('x2', centerX);
    // sub_line3.setAttribute('x1', (centerX+offset));

    // var sub_line4 = document.querySelector('#sub_line4');
    // sub_line4.setAttribute('x1', (centerX-offset));
    // sub_line4.setAttribute('x2', (centerX-offset));

    // var sub_line5 = document.querySelector('#sub_line5');
    // sub_line5.setAttribute('x1', (centerX+offset));
    // sub_line5.setAttribute('x2', (centerX+offset));

    var event_id = circleElemAfter.getAttribute("data-eventid");
    // console.log(circleElemAfter);
    var ids =arrayColumn(sub_events, 3);
    // console.log(ids);
    var index = ids.indexOf(event_id);
    // console.log(index);
    var front_images = sub_events[index][1].split(",");
    var back_images = sub_events[index][2].split(",");
    const sub_events_container = document.querySelector("#sub_events_container");
    for (let i = 0; i < front_images.length; i++) {
        var grid_elements = process_sub_images(front_images[i],back_images[i],("Before "+circleElemAfter.getAttribute("data-title")));
        sub_events_container.insertAdjacentHTML('beforeend',grid_elements);
    }

    var sub_events_heading = circleElemBefore.getAttribute("data-title")+" - "+circleElemAfter.getAttribute("data-title");
    document.querySelector("#sub_heading").innerHTML = sub_events_heading;
    var over = document.querySelector(".overlay");
    over.classList.remove("hidden");
    var x = document.querySelector(".arrow_sub");
    if(x.classList.contains("icon-active")){
       x.classList.remove("icon-active");
       document.querySelector("#sub_circle").classList.add("hidden");
    document.querySelector(".expandend-div").classList.remove("div-active");
    document.querySelector(".expandend-div").classList.add("hidden");
    }
    else{
        document.querySelector("#sub_circle").classList.remove("hidden");
    document.querySelector(".arrow_sub").classList.add("icon-active");
    document.querySelector(".expandend-div").classList.add("div-active");
    document.querySelector(".expandend-div").classList.remove("hidden");
    }


  } 
});



function off() {
  document.getElementById("overlay").classList.add("hidden");
  var x = document.querySelector(".arrow_sub");
    if(x.classList.contains("icon-active")){
       x.classList.remove("icon-active");
       document.querySelector("#sub_circle").classList.add("hidden");
    document.querySelector(".expandend-div").classList.remove("div-active");
    document.querySelector(".expandend-div").classList.add("hidden");
    }
}


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

<?php 
include '../../includes/footer.php'; 
?>
<script id = "search_timeline">


    var eventsContainer = document.getElementById('eventscontainer');
console.log(trial_events);
    for (var i = 0; i < trial_events.length; i++) {
    // must add a more_info section
      var event = trial_events[i];
      var eventDiv = document.createElement('div');
      eventDiv.setAttribute('id', 'event-' + event.date_title);
      eventDiv.setAttribute('class', 'event_more_info');
      eventDiv.innerHTML = '<h2>' + event.date_title + '</h2><p>' + event.date + ' ' + event.date_marker + '</p>';
      eventsContainer.appendChild(eventDiv);
    }

    // Check if there is a search parameter in the URL
    var params = new URLSearchParams(window.location.search);
    var searchedValue = params.get('search');
    if (searchedValue) {
      // Scroll to the corresponding div
      scrollToDiv('event-' + searchedValue);
    }

    function scrollToDiv(divId) {
        var element = document.getElementById(divId);
        console.log(element);
        if (element) 
        {
            element.scrollIntoView({ behavior: 'smooth' });
        }
    }
</script>
</body>
</html>


