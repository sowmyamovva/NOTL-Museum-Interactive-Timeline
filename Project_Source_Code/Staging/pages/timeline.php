<!DOCTYPE html>
<html>
<head>
    
<style>
  *,
*::before,
*::after {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
.event_name {
  position: fixed;
  background-color: white;
 /* padding: 5px;*/
  border: 1px solid black;
}
.scroll-container {
  overflow-x: scroll;
  white-space: nowrap;
}

.scroll-content {
  display: inline-block;
  height: 60vh;
}

.scroll-container:hover {
 /* overflow-x: auto;*/
  overflow-y: none;
}
.scroll-container::-webkit-scrollbar {
  width: 0px !important;
}
.scroll-container:hover::-webkit-scrollbar {
  /*display: none;*/
}
.hidden {
    display:none !important;
}
.left_arrow{
    max-height: fit-content;
    max-width: fit-content;
    margin: 0px;
    z-index: 4;
    position: relative;
    padding: 3px 4px 0px 4px;
    top: -58vh;
    left:2%;
    background: dimgray;
    border-radius: 5%;
}
.right_arrow{
    max-height: fit-content;
    max-width: fit-content;
    margin: 0px;
    z-index: 5;
    position: relative;
    padding: 3px 4px 0px 4px;
    top: -58vh;
    left:95%;
    background: dimgray;
    border-radius: 5%;
}
/*
before this
*/

body {
   box-sizing: border-box;
  margin: 0;
  padding: 0;
  color: #fff;
  font-family: 'Montserrat', sans-serif !important;
  background-color: #242424 !important;
}

.event-label time {
  display: block;
  font-size: 0.8rem;
  font-weight: bold;
  margin-bottom: 4px;
}

#timeline {
  height: 200px;
  width: 2000px;
  /* Set the width of the timeline to a large value */
  position: relative;
}

.event:hover {
  cursor: pointer;
}

.event-label {
  position: absolute;
  top: -30px;
  left: 50%;
  transform: translateX(-50%);
  /* background-color: black; */
  color: white;
  /* border: 1px solid black; */
  padding: 5px;
  display: none;
}
.filter-bar {
  background-color: #94b8b4;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px;
}

.range-filter label,
.select-filter label {
  color: #fff;
  margin-right: 10px;
  font-size:20px;
}

.range-filter input[type="number"] {
  width: 80px;
  background-color: #3c3c3c;
  color: #fff;
  border: none;
  border-radius: 5px;
  /* padding: 5px; */
  margin-right: 10px;
  padding: 10px 15px;
  font-size: 16px;
}

.select-filter select {
  background-color: #3c3c3c;
   color: #fff;
    border: none;
  border-radius: 5px;
  /* padding: 5px; */
  margin-right: 10px;
  padding: 10px 15px;
  font-size: 16px;
  }
#filter-button {
 background-color: #3c3c3c;
  color: #fff;
  border: none;
  border-radius: 5px;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
  box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

#filter-button:hover {
 background-color: #242424;
}

#timeline_box::-webkit-scrollbar {
  width: 0 !important;
}


div.overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.8);
  z-index: 10;
  opacity: 0.8;
  cursor: pointer; /* Add a pointer on hover */
}

.dynamic-timeline {
  position: fixed;
  bottom: 0;
  width: 100%;
  height: 100px;
  background-color: white;
  z-index: 10000;
  display: none;
}

.selected_circle{
   r: 28;
   fill:url(#e0YvEuspUTQ2-stroke);
   stroke: white;
   stroke-width: 5;
}

.unselected_circle {
   r: 24;
   fill:white;
   stroke: #242424;
   stroke-width: 5;
  
}

.flip-card {
  position: absolute;
  background-color: transparent;
  perspective: 1000px;
  width: 100%;
  height: 100%;
}

.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.6s;
  transform-style: preserve-3d;
}


.flip-card-flipped .flip-card-inner {
  transform: rotateY(180deg);
}

.flip-card-front, .flip-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}


.flip-card-front {
  z-index: 2;
   transform: rotateY(0deg);  
}

.flip-card-back {
  transform: rotateY(180deg);
}

/* Experimental Flip */
.flip-container {
  perspective: 1000px;
  height: 100%;
  width: 100%;
  display: inline-block;
}

.flipper {
  position: relative;
  height: 100%;
  width: 100%;
  transform-style: preserve-3d;
  transition: all 0.6s ease;
}

.flip-container:hover .flipper,
.flip-container.hover .flipper {
  transform: rotateY(180deg);
}

.front, .back {
  backface-visibility: hidden;
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
}

.front {
  z-index: 2;
}

.back {
  transform: rotateY(180deg);
}


.show-back {
  transform: rotateY(180deg);
}

.outer-container{
    margin: 50px 20px;
    height: 70vh;
    border: 0.5px solid black;
    padding: 5px;
}
.circle-label {
  font-size: 30px;
  fill: #ffffff;
  text-anchor: middle;
}
::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}

::-webkit-scrollbar-thumb {
  background-color: #ccc;
  border-radius: 4px;
  width: 2px;
}

::-webkit-scrollbar-thumb:hover {
  background-color: #aaa;
}

.arrow_sub{
width:100%;
}
.arrow_sub{
    stroke-dasharray: 1000;
    stroke-dashoffset: 1000;
   
    animation-delay: 0.5s;
    animation-duration: 0.5s;
    animation-name: iconMove;
    animation-fill-mode: both;
    /*filter: drop-shadow(0px 1px 3px black);*/
}
@keyframes iconAnimation{
    0%{
        
        fill:white;
    }

    100%{
    stroke-dashoffset: 0;
    }
}
@keyframes iconMove{
    100%{
        transform: translateX(0%);
    }
}
.icon-active {
    animation: iconAnimation 2s linear forwards;
    fill:black;
 
}
.div-active{
animation: moveup 1s linear forwards;
}
.expandend-div{

position: relative;

bottom: 35vh;

height: 350px;

background:#3c3c3c;

opacity:0;

overflow:hidden;

width:80%;

animation-delay: 0.2s;

transform: translateY(-78px);

z-index: 11;

}
.close {
  position: absolute;
  top: 2px;
  right: 7px;
  background-color: transparent;
  border: none;
  color: #fff;
  font-size: 20px;
  cursor: pointer;
}
@keyframes expand{
100%{
opacity:1;
}
}
.grid{
display:flex;
    justify-content: space-evenly;
}
.grid > div{
/* background:white; */
padding:0;
}

.main-div{
width:100%;
text-align: -webkit-center;
}
@keyframes moveup{
0%{
transform:translateY(50px);
opacity:0;
}
100%{
transform:translateY(-50px);
opacity:1;
}
} 
@keyframes scaleIn{
0% {
    transform: scale(.5, .5);
    opacity: .5;
}
100% {
    transform: scale(2.5, 2.5);
    opacity: 0;
}
} 
.click_active
{
    display: block;
    position: absolute;
    background: white;
    border-radius: 100%;
    height: 20px;
    width: 20px;
    /* top: -70.75rem; */
    left: 106px;
    margin: 0;
    box-shadow: 2px 2px 4px #888;
    opacity: 0;
    animation: scaleIn 4s infinite cubic-bezier(.36, .11, .89, .32);
    z-index: 11;
}
</style>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!-- <link rel="stylesheet" href="C:/RS/COSC 4P02/all_features.css"> -->
  <link rel="stylesheet" href="calendar.css">
</head>
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
<!-- <script src='all_features.js'></script> -->


<div class="main-div">
    <?xml version="1.0" encoding="utf-8"?>

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

<div class = "overlay hidden" id ="overlay" onclick="off()">
    <div>

    </div>
</div>
<button id="show-div-button">Show Div Block</button>
<div id="calendar">
  <button id="close-button">X</button>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
<script src='calendar.js'></script> 
<script>

    </script>
<script>
const arrayColumn = (arr, n) => arr.map(x => x[n]);
var years_all_info =[["1","IndigenousA","IndigenousB","9000","BC","11,000 years ago","0"],
                    ["2","EurContactA","EurContactB","1500",null,"1500s","0"],
                    ["3","FortNiagaraA","FortNiagaraB","1764",null,"1764","0"],
                    ["4","WhyNiagaraA","WhyNiagaraB","1790",null,"1790","0"],
                    ["5","UsRevolutionA","UsRevolutionB","1791",null,"1791","0"],
                    ["6","WarA","WarB","1812",null,"1812","1"],
                    ["7","RebuildA","RebuildB","1815",null,"1815","0"],
                    ["8","ShippingA","ShippingB","1831",null,"1831","0"]];
var sub_events = [["1,2,3,4,5,6","WarSubA,WarSubC,WarSubE,WarSubG,WarSubI,WarSubK","WarSubB,WarSubD,WarSubF,WarSubH,WarSubJ,WarSubL","6"]];


function process_images(year_index){
    var time ="";
    if (years_all_info[year_index][4] !=null)
    {
        time = ( years_all_info[year_index][3]+" "+years_all_info[year_index][4]) ;
    }

    var year_tooltip = "<div class='flip-container'><div class='flipper'><div class='front'><img style ='max-height:260px;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+years_all_info[year_index][1]+".jpg?raw=true' alt='1730s'  title='"+years_all_info[3]+"_"+years_all_info[4]+"'> </div><div class='back'><img style ='max-height:260px;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+years_all_info[year_index][2]+".jpg?raw=true' alt='1753s'  title='Information on "+years_all_info[year_index][5] +"'></div></div></div>";

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
    console.log("circles?");
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
</body>
</html>


