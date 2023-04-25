<html>
<link rel="stylesheet" href="/CSS/all_features3.css" /> 
<body>
 <div class = "outer-container">

<div class="filter-bar">
    <div class="select-filter" id="filter">
    <select id="filter_title">
      <option value="all">All Categories</option>
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
var years_all_info =[["1","IndigenousA","IndigenousB","9000","BC","<1500","0"],
                    ["2","EurContactA","EurContactB","1500",null,"1500s","0"],
                    ["3","FortNiagaraA","FortNiagaraB","1764",null,"1764","0"],
                    ["4","WhyNiagaraA","WhyNiagaraB","1790",null,"1790","0"],
                    ["5","UsRevolutionA","UsRevolutionB","1791",null,"1791","0"],
                    ["6","WarA","WarB","1812",null,"1812","1"],
                    ["7","RebuildA","RebuildB","1815",null,"1815","0"],
                    ["8","ShippingA","ShippingB","1831",null,"1831","0"],
                    ["9,","ShippingA","ShippingB","1832",null,"1832","0"],
                    ["10","ShippingA","ShippingB","1833",null,"1833","0"],
                    ["11","ShippingA","ShippingB","1834",null,"1834","0"],
                    ["12","ShippingA","ShippingB","1835",null,"1835","0"],
                    ["13","ShippingA","ShippingB","1836",null,"1836","0"],
                    ["14","ShippingA","ShippingB","1837",null,"1837","0"],
                    ["15","ShippingA","ShippingB","1838",null,"1838","0"],
                    ["16","ShippingA","ShippingB","1839",null,"1839","0"],
                    ["17","ShippingA","ShippingB","1840",null,"1840","0"],
                    ["18","ShippingA","ShippingB","1941",null,"1941","0"],
                    ["19","ShippingA","ShippingB","1942",null,"1942","0"],
                    ["20","ShippingA","ShippingB","1943",null,"1943","0"],
                    ["21","ShippingA","ShippingB","2023",null,"2023","0"]];
//  var trial_events = <?php //echo json_encode($events); ?>;
//  var trial_sub_events = <?php // echo json_encode($sub_events); ?>;
  const arrayColumn = (arr, n) => arr.map(x => x[n]);

 var additional_info = {"1":"Relavant content to Indigenous people around 9000 BC",
                        "2":"Relevant content to European contact around 1500",
                        "5":"Relevant content to USRevolution  around 1791",
                        "6":"Relevant content to WarA and WarB contact around 1812",
                      };

function process_images(year_index){
    var time ="";
    if (years_all_info[year_index][4] !=null)
    {
        time = ( years_all_info[year_index][3]+" "+years_all_info[year_index][4]) ;
    }

    // var year_tooltip = "<div class='flip-container'><div class='flipper'><div class='front'><img style ='max-height:260px; max-width:min-content;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+years_all_info[year_index][1]+"?raw=true' alt='1730s'  title='"+years_all_info[3]+"_"+years_all_info[4]+"'> </div><div class='back'><img style ='max-height:260px;max-width:min-content;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+years_all_info[year_index][2]+"?raw=true' alt='1753s'  title='Information on "+years_all_info[year_index][5] +"'></div></div></div>";
//image with button
var year_tooltip = "<div class='flip-container'><div class='flipper'><div id = "+years_all_info[year_index][0]+"A class='front'><img style ='max-height:260px;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+years_all_info[year_index][1]+".jpg?raw=true' alt='1730s'  title='"+years_all_info[3]+"_"+years_all_info[4]+"'> </div><div id = "+years_all_info[year_index][0]+"B class='back'><img style ='max-height:260px;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+years_all_info[year_index][2]+".jpg?raw=true' alt='1753s'  title='Information on "+years_all_info[year_index][5] +"'></div></div></div></div>"; //put overlay3 here if you want it to be relative to the timeline
    var year_info = ' <div id="label" class="event-label" style=" display: block;height: 300px; white-space: normal; "><time>' +time + '</time>' + year_tooltip + '</div>';

    return year_info;
}

function process_sub_images(front,back,title){

    var year_tooltip = "<div class='flip-container'><div class='flipper'><div class='front'><img style ='max-height:260px;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+front+".jpg?raw=true' alt='1730s'  title='"+title+"'> </div><div class='back'><img style ='max-height:260px;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+back+"?raw=true' alt='1753s'  title='"+title+"'></div></div></div>";

    var year_info = ' <div id="label" class="event-label" style=" display: block;height: 300px; white-space: normal; ">' + year_tooltip + '</div>';

    return year_tooltip;
}
var categories =["Indigenous_History","European_Settlers","War","Transportation","Fishing","Historical_Figures"];
for (let i = 0; i < categories.length; i++) {
  //console.log("here");
  let text = categories[i]; 
  var op_view = text.replace("_", " ");
  var option = " <option value=" + categories[i] + ">" + op_view  + "</option>";
  document
    .getElementById("filter_title")
    .insertAdjacentHTML("beforeend", option);
}

  //CREATE CIRCLES ON TIMELINE
  function create_circles(){
  var pos = 0;
  var position = []
  var year1 = 0;
  var year2 = 0;


  position[0] = 0
  for (let i = 0; i < years_all_info.length; i++) {

    if (i != 0){    
      year1 = years_all_info[i-1][3];
      year2 = years_all_info[i][3];
      if (Math.abs(year1 - year2) > 2000) // If distance is bigger than 2000 reduce it to a fixed large value for normalization
        position[i] = 3;
      else if (Math.abs(Math.abs(year1-year2)<300 && Math.abs(year1-year2)>=200)) {// If distance is bigger than 2000 reduce it to a fixed large value for normalization
        position[i] = 2;
        }
      else if (Math.abs(year1-year2)<200 && Math.abs(year1-year2)>=50){
        position[i] = 1.6;
      }
      else if (Math.abs(year1-year2)<50 && Math.abs(year1-year2)>=20){
        position[i] = 1.4;
      }
      else if (Math.abs(year1-year2)<20 && Math.abs(year1-year2)>=5){
        position[i] = 1.2;
      }
      else{
        position[i] = 1
      }
    }
  }
  
  const sum = position.reduce((acc, curr) => acc + curr, 0); // calculate the sum of all the values
  position = position.map((val) => val / sum); // normalize each value by dividing by the sum

  for (let i = 0; i < years_all_info.length; i++) {
    pos += position[i]; // Keep adding distance to the previous distance
    pathOnDiv(( years_all_info[i][3]+"_"+years_all_info[i][4]), pos, years_all_info[i][5] , years_all_info[i][6], years_all_info[i][0], years_all_info[i][9], years_all_info[i][10]);
  }
}
create_circles();
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

function pathOnDiv(text, pos, title,sub,id,event_title,category) {
  var path = document.getElementById("mypath");
  var pathLength = path.getTotalLength();
  var loc = path.getPointAtLength(pos * (pathLength));
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
    "'data-eventtitle='" +
    event_title +
    "'data-category='" +
    category +
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
      selectedValue === "all" || circle.getAttribute("data-category") == selectedValue ) 
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
//console.log(circles2);


const timeline_box = document.getElementById('timeline_box');


circles2.forEach((circle) => {
  const div = document.createElement("div");
  
  var year_tooltip = process_images(circle_index);
  div.innerHTML = year_tooltip;
  div.id = "circle_"+years_all_info[circle_index][0]; //circle id
  div.classList.add("event_name");
  // div.style.width = "300px";
  
  // Circle Position in regards to the timline
  const cx = parseFloat(circle.getAttribute('cx'));
  const cy = parseFloat(circle.getAttribute('cy'));

  // Timeline top position used to deftermine vertical position of divs with respect to timeline 
  const c_timeline = document.querySelector("#timeline");// Timeline with respect to the circle
  const top_val = parseInt(getComputedStyle(c_timeline).getPropertyValue('top')); //top value of timeline

  // Position Divs relevant to timeline
  const leftSmallOffset = 85; // Offsets the small images to the left
  const leftBigOffset = 130; // Offsets the big images to the left      
  const topOddOffset = 300; // Offsets the odd images to be below timeline 1000
  const topEvenOffset = -100; // Offsets the even images to be above timeline 600

  // Div get image
  const event_id = parseInt(circle.dataset.eventid, 10);


  circle.addEventListener("mousedown", () => {

  // Create a new DOMParser object
  const parser = new DOMParser();
  // Parse the HTML string as an HTML document
  const doc = parser.parseFromString(year_tooltip, "text/html");
  // Get the image element and its source path
  const img2 = doc.querySelector("img");
  const img = document.createElement('img');
  img.src = img2.getAttribute("src");
  // Wait for the image to load and render
  // Get the image width
  const imgWidth = img.naturalWidth;
  const imgHeight = img.naturalHeight;
  img.remove();

    // const event_id = parseInt(circle.dataset.eventid, 10);




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


    // This controls the vertical positioning of all images


    // We want to center the div based on how big the images are.
    if (event_id % 2 == 1){  // Odd Numbered Image
        div.style.top = `${top_val+topOddOffset}px`; //`${circle.getBoundingClientRect().top}px`; // 350
        if (imgWidth < imgHeight){ // Check to see if we're dealing with small image
            div.style.left = `${circle.getBoundingClientRect().left - leftSmallOffset}px`;
        }
        else{ // We're dealing with bigger image
            div.style.left = `${circle.getBoundingClientRect().left - leftBigOffset}px`;
            }
    }
    else{ // Even Numbered Image
      div.style.top = `${top_val+topEvenOffset}px`; //`${cy+400}px`;
        if (imgWidth < imgHeight){ // Check to see if we're dealing with small image
            div.style.left = `${circle.getBoundingClientRect().left - leftSmallOffset}px`;
        }
        else{ // We're dealing with bigger image
            div.style.left = `${circle.getBoundingClientRect().left - leftBigOffset}px`;
            }
    }
    //Reformats first div to be uniform with the rest of the bottom divs.
    if (event_id == 1){
      div.style.top = `${top_val+topOddOffset - 30}px`; //`${cy+700}px`;
      if (imgWidth < imgHeight){ // Check to see if we're dealing with small image
          div.style.left = `${circle.getBoundingClientRect().left - leftSmallOffset}px`;
      }
      else{ // We're dealing with bigger image
          div.style.left = `${circle.getBoundingClientRect().left - leftBigOffset}px`;
          }
    }    
    
    
    // div.style.top = `${circle.getBoundingClientRect().top + 70}px`;
    // div.style.left = `${circle.getBoundingClientRect().left +10}px`;

    // console.log("hi");
    document.body.appendChild(div); 
    // div.style.width = "0px";
    
    const d_img = document.getElementById(event_id+'A'); 
    // Add buttons to the div
    var cid = circle.dataset.eventid;
    const myImage = document.getElementById(cid+"B"); // The back image we're adding buttons to
    extra_info(div, cid, myImage);
  });

  document.getElementById("timeline_container").addEventListener("scroll", () => {
    // div.style.top = `${circle.getBoundingClientRect().top + 70}px`;
    // div.style.left = `${circle.getBoundingClientRect().left +10}px`;

    // Check to see if we are moving a div
    const d_img = document.getElementById(event_id+'A'); 
    if (d_img == null){
      return;
    }
    console.log("");
    // The image that is used to determine how to center it to its corresponding circle based on size
    // const d_img = document.getElementById(event_id+'A'); 
    const d_width = d_img.scrollWidth;

    /* Here, we keep track of the event_id so that we know whether we are at an enen or odd numbered image.
     * This way, we can alternate the y coordinate of each Image
     */

    // We want to center the dive based on how big the images are.
    if (event_id % 2 ==1){  // Odd Numbered Image
        div.style.top = `${top_val + topOddOffset}px`;
        if (d_width < 210){ // Check to see if we're dealing with small image
            div.style.left = `${circle.getBoundingClientRect().left - leftSmallOffset}px`;
        }
        else{ // We're dealing with bigger image
            div.style.left = `${circle.getBoundingClientRect().left -leftBigOffset}px`;
            }
    }
    else{ // Even Numbered Image
      div.style.top = `${top_val + topEvenOffset}px`;
        if (d_width < 210 ){ // Check to see if we're dealing with small image
            div.style.left = `${circle.getBoundingClientRect().left -leftSmallOffset}px`;
        }
        else{ // We're dealing with bigger image
            div.style.left = `${circle.getBoundingClientRect().left -leftBigOffset}px`;
            }
    }
    //Reformats first div to be uniform with the rest of the bottom divs.
    if (event_id == 1){
      div.style.top = `${top_val + topOddOffset - 30}px`;
      if (d_width < 210){ // Check to see if we're dealing with small image
          div.style.left = `${circle.getBoundingClientRect().left - leftSmallOffset}px`;
      }
      else{ // We're dealing with bigger image
          div.style.left = `${circle.getBoundingClientRect().left - leftBigOffset}px`;
          }
    }
    console.log("");
    // BUG FIXES
  });
  circle_index++;
});
// This boolean value tells us if we have content already contained within the subetimeline overlay
var overlayPopulated = false; // BUG FIX

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
     // If sub-timeline already contains content, do not add it again.
     if (!overlayPopulated) {  /*BUG FIXES*/
    // populate the overlay with front_images and back_imagesconst 
    for (let i = 0; i < front_images.length; i++) {
        var grid_elements = process_sub_images(front_images[i],back_images[i],("Before "+circleElemAfter.getAttribute("data-title")));
        sub_events_container.insertAdjacentHTML('beforeend',grid_elements);
    }    
    overlayPopulated = true;
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


  circles2.forEach((circle) => {
    // div.classList.add("event_name");
    var cid = circle.dataset.eventid;
    var c_div = document.getElementById('circle_'+cid);
    if(circle.classList.contains('selected_circle')){
      circle.classList.remove('selected_circle');
      circle.classList.add('unselected_circle');
      c_div.style.display="none";
    }
  });
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
   
    
    const circleX = circle.getBoundingClientRect().left - firstLine.getBoundingClientRect().left + circle.r.baseVal.value;

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

    const circleX = circle.getBoundingClientRect().left - firstLine.getBoundingClientRect().left + circle.r.baseVal.value;
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

function extra_info (c_div, cid, backImage) {
// Check to see if circle has additional info
  if (!(cid in additional_info)){ // if circle does not have any additional info then don't add any buttons to it.
    return;
  }

  // Check if button already exists in div
  if (c_div.querySelector('button') !== null) {
    return; // Exit function if button already exists
  }
  
  // Create a new button element
  const button = document.createElement("button");

  // Set the button text
  button.innerHTML = "...";

  // Set any other properties or attributes for the button as needed
  button.setAttribute("class", "my-button" + cid);

  // Set the button click event handler
  button.onclick = function() {
    // ADD EXTRA INFO OVERLAY
    if (cid in additional_info) { // Check to see if there is additional info for circle
      const overlay = document.getElementById("overlay3");
      const text = document.createElement("p");
      text.textContent = additional_info[cid];
      const img = document.createElement("img");
      img.src = "https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/" + years_all_info[cid - 1][1] + ".jpg?raw=true";

      // Check if overlay content already exists and remove it if it does
      const existingContent = overlay.querySelector('.overlay-content');
      if (existingContent) {
        overlay.removeChild(existingContent);
      }

      // Create a new div element to hold the overlay content
      const content = document.createElement('div');
      content.classList.add('overlay-content');

      // Create the speak button element or update the existing one
      let speakButton = overlay.querySelector('#speak-button');
      if (!speakButton) {
        speakButton = document.createElement('button');
        speakButton.id = 'speak-button';
        speakButton.textContent = 'Speak';
        content.appendChild(speakButton);
      }
      speakButton.addEventListener("click", () => {
        const msg = new SpeechSynthesisUtterance();
        msg.text = text.textContent;
        window.speechSynthesis.speak(msg);
      });

      content.appendChild(text);
      content.appendChild(img);
      overlay.appendChild(content);

      // Show the overlay when the button is clicked
      overlay.style.display = "block";

      // Hide the overlay when clicked outside the content area
      overlay.addEventListener("click", function(e) {
        if (e.target === overlay) {
          overlay.style.display = "none";
        }
      });
    }
  };

  // Button CSS
  button.style.position = "absolute";
  button.style.left = "0px";
  button.style.top = "0px";
  button.style.color = "lightcoral";
  button.style.backgroundColor = "aqua";
  button.style.fontSize = "24px";

  // Append the button to the back image
  backImage.appendChild(button);
} // extra_info

// Text-To-Speech JS
const speakButtons = document.querySelectorAll(".speak-button");
const textToSpeaks = document.querySelectorAll(".text-to-speak2");

speakButtons.forEach((speakButton, index) => {
  speakButton.addEventListener("click", () => {
    const msg = new SpeechSynthesisUtterance();
    msg.text = textToSpeaks[index].textContent;
    window.speechSynthesis.speak(msg);
  });
});
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
      eventDiv.setAttribute('id', 'event-' + event.date_title+"_"+event.event_title);
      eventDiv.setAttribute('class', 'event_more_info');
      eventDiv.innerHTML = '<h2>' + event.date_title + '</h2><p>' + event.date + ' ' + event.date_marker + '</p>';
      eventsContainer.appendChild(eventDiv);
    }

    // Check if there is a search parameter in the URL
    var params = new URLSearchParams(window.location.search);
    var searched_value = params.get('search');
    if (searched_value) {
     var searchedValue = searched_value.replace(" ", "_");
    
      // Scroll to the corresponding div
      scrollToDiv('event-' + searchedValue);
    }


// Sceoll to Div or overlay
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


