
const arrayColumn = (arr, n) => arr.map(x => x[n]);
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
var sub_events = [["1,2,3,4,5,6","WarSubA,WarSubC,WarSubE,WarSubG,WarSubI,WarSubK","WarSubB,WarSubD,WarSubF,WarSubH,WarSubJ,WarSubL","6"]];

// This dictionary is used to determine which circle has an additional overlay. It also contains the additional info.
 var additional_info = {"1":"Relavant content to Indigenous people around 9000 BC",
                        "2":"Relevant content to European contact around 1500",
                        "5":"Relevant content to USRevolution  around 1791",
                        "6":"Relevant content to WarA and WarB contact around 1812",
                      }
// Stacking example
//var year_tooltip = "<img style ='max-height:260px;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+years_all_info[year_index][2]+".jpg?raw=true' alt='1730s' title='Information on "+years_all_info[year_index][5] +"' class='overlay2 back-image' onclick='swapImages()'><img style ='max-height:260px;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+years_all_info[year_index][1]+".jpg?raw=true' alt='1730s'  title='"+years_all_info[3]+"_"+years_all_info[4]+"' class='overlay2 front-image' onclick='swapImages()'>";

 /* { // COMMENTED OUT PHP
  const arrayColumn = (arr, n) => arr.map(x => x[n]);
  var years_all_info = <?php echo json_encode($year_info); ?>;
  var sub_events = <?php echo json_encode($sub_info); ?>; }*/


// To change the card that shows up on clicking circles on teh subtimeline make edits here
function process_images(year_index){
    var time ="";
    if (years_all_info[year_index][4] !=null){
        time = ( years_all_info[year_index][3]+" "+years_all_info[year_index][4]) ;
    }

    // stacked images format
    // var year_tooltip = "<img style ='max-height:260px;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+years_all_info[year_index][2]+".jpg?raw=true' alt='1730s' title='Information on "+years_all_info[year_index][5] +"' class='overlay2 back-image' onclick='swapImages()'><img style ='max-height:260px;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+years_all_info[year_index][1]+".jpg?raw=true' alt='1730s'  title='"+years_all_info[3]+"_"+years_all_info[4]+"' class='overlay2 front-image' onclick='swapImages()'>";

    //image with button
    var year_tooltip = "<div class='flip-container'><div class='flipper'><div id = "+years_all_info[year_index][0]+"A class='front'><img style ='max-height:260px;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+years_all_info[year_index][1]+".jpg?raw=true' alt='1730s'  title='"+years_all_info[3]+"_"+years_all_info[4]+"'> </div><div id = "+years_all_info[year_index][0]+"B class='back'><img style ='max-height:260px;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+years_all_info[year_index][2]+".jpg?raw=true' alt='1753s'  title='Information on "+years_all_info[year_index][5] +"'></div></div></div></div>"; //put overlay3 here if you want it to be relative to the timeline

    // var year_tooltip = "<div class='flip-container'><div class='flipper'><div class='front'><img style ='max-height:260px;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+years_all_info[year_index][1]+".jpg?raw=true' alt='1730s'  title='"+years_all_info[3]+"_"+years_all_info[4]+"'> </div><div class='back'><img style ='max-height:260px;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+years_all_info[year_index][2]+".jpg?raw=true' alt='1753s'  title='Information on "+years_all_info[year_index][5] +"'></div></div></div>";

    var year_info = ' <div id="label" class="event-label" style=" display: block;height: 300px; white-space: normal; "><time>' +time + '</time>' + year_tooltip + '</div>';

    return year_info;
}

  // SImilarly for teh cards in sub-timeline make edits here
function process_sub_images(front,back,title){

    var year_tooltip = "<div class='flip-container'><div class='flipper'><div class='front'><img style ='max-height:260px;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+front+".jpg?raw=true' alt='1730s'  title='"+title+"'> </div><div class='back'><img style ='max-height:260px;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+back+".jpg?raw=true' alt='1753s'  title='"+title+"'></div></div></div>";

    var year_info = ' <div id="label" class="event-label" style=" display: block;height: 300px; white-space: normal; ">' + year_tooltip + '</div>';

    return year_tooltip;
}


  // This collects all titles available and  makes them into an option under the select
for (let i = 0; i < years_all_info.length; i++) {
  //console.log("here");
  var option = " <option value=" + years_all_info[i][5] + ">" + years_all_info[i][5]  + "</option>";
  document
    .getElementById("filter_title")
    .insertAdjacentHTML("beforeend", option);
}

  //CREATE CIRCLES ON TIMELINE
  // This iterates over every event we have and called pathondiv to make a circle element for it.

function create_circles(){
  var pos = 0;
  var position = []
  var year1 = 0;
  var year2 = 0;


  // Preprocess Lines
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

  console.log("");
  const sum = position.reduce((acc, curr) => acc + curr, 0); // calculate the sum of all the values
  position = position.map((val) => val / sum); // normalize each value by dividing by the sum

  console.log("");


  for (let i = 0; i < years_all_info.length; i++) {
     // pos = i / (years_all_info.length - 1);
    pos += position[i]; // Keep adding distance to the previous distance
    pathOnDiv(( years_all_info[i][3]+"_"+years_all_info[i][4]), pos, years_all_info[i][5] , years_all_info[i][6], years_all_info[i][0]);
    // pathOnDiv(( years_all_info[i][3]+"_"+years_all_info[i][4]), i / (years_all_info.length - 1), years_all_info[i][5] , years_all_info[i][6], years_all_info[i][0]);
  }
  // TL.setAttribute('width', width*scaleWidth);
  // path.setAttribute('x2',((width-100)*(scaleWidth)));
  // TL.setAttribute("viewBox", "0 0 "+ width*scaleWidth+ " 500");
  console.log("")
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
// This function makes the circle element for each event. This si where you can make changes to what data is shows and stores.
function pathOnDiv(text, pos, title,sub,id) {
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
    "' />";
  // To add additional data, simply add a data-name attribute and assign it values in the variable point.
  // The data can then be accessed by getting the circle element and using the function circle .getAttribute("data-name");
  
  //r="20" fill="white" stroke="#474e5d" stroke-width="3" stroke-r = "2"
  document.getElementById("timeline").insertAdjacentHTML("beforeend", point);
}
  
// The following function scrolls on Hover, change the type of function or numbers to edit the functionality
window.addEventListener("load", function() {
  const container = document.querySelector("#timeline_box");
  let prevX = 0;

  // if we want signifiers on click scroll - modify the following code by 
  //getting the signifier elements and changing the "mousemove" to "mousedown"
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

  
// The following code makes a particular signifier to show which way we are hover scrolling,
// modify the following code if the code for hover scrolling is modified
  //BEGIN
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

  //END of on scroll show functionality
  
  
//The following the range filter functionalty.  
const filterButton = document.querySelector("#filter-button");
var circles = document.querySelectorAll(".first-circle");

filterButton.addEventListener("click", () => {
  const fromYear = parseInt(document.querySelector("#from-year").value);
  const toYear = parseInt(document.querySelector("#to-year").value);
  const firstCircle = 0;
  const lastCircle = 0;

  // Go through the circles in remove them if need be
  circles.forEach((circle,index) => {
    const year = parseInt(circle.dataset.year);
    var card_id = "circle_"+index;
    console.log("card_id "+card_id);
    // if circle is greater than fromYear and less than toYear then don't remove them
    if (year >= fromYear && year <= toYear) {
      if (firstCircle == 0){
        firstCircle = index;
      }
      // lastCircle

      circle.style.display = "inline";
      document.getElementById(index).classList.remove("hidden");
      if (document.getElementById(card_id) !==null){
        document.getElementById(card_id).classList.remove("hidden");
      }
    } else { // Remove them
      circle.style.display = "none";
      document.getElementById(index).classList.add("hidden");
      if (document.getElementById(card_id) !==null){
      document.getElementById(card_id).classList.add("hidden");
      }
    }
  });
});

//The following is the title filter functionality
var filterSelect = document.querySelector("#filter_title");
const circles_title = document.querySelectorAll(".first-circle");
filterSelect.addEventListener("change", function() {
  var selectedValue = this.value;
  circles_title.forEach((circle,index) => {
   // console.log(selectedValue + " and " + circle.getAttribute("data-title"));
   
   var card_id = "circle_"+index;




   // Filter on timeline, buggy
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
//console.log(circles2);


const timeline_box = document.getElementById('timeline_box');
var isOpen = false;
  // The following code is for what a circle does on click  (CIRCLE CLICK) (ccl)
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

  const cx = parseFloat(circle.getAttribute('cx'));
  const cy = parseFloat(circle.getAttribute('cy'));

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
    else // circle is selected
    {
      circle.classList.remove('selected_circle');
      circle.classList.add('unselected_circle');
      div.style.display="none";
    }
  
    document.body.appendChild(div);

    // Get the circle id so that we can get the specific image that we want to add additional info to
    var cid = circle.dataset.eventid;
    const frontImage = document.getElementById(cid+"A"); // The front image we're adding buttons to
    const backImage = document.getElementById(cid+"B"); // The back image we're adding buttons to

    extra_info(div, cid, frontImage, backImage); // add additional info overlay
  });





  // The following code is to ensure the cards move with scroll. will have to add similar code
  // for document so it is consistent with scroll up and down.
  document.getElementById("timeline_container").addEventListener("scroll", () => {

    /* Here, we keep track of the event_id so that we know whether we are at an enen or odd numbered image.
     * This way, we can alternate the y coordinate of each Image
     */
    var event_id = parseInt(circle.dataset.eventid,10)
    var leftSmallOffset = 70; // Offsets the big images to the left
    var leftBigOffset = 150; // Offsets the big images to the left
    // We want to center the dive based on how big the images are.
    if (event_id % 2 !==1){  // Odd Numbered Image
        div.style.top = `${cy}px`;
        if (div.querySelector('img').naturalWidth < 400){ // Check to see if we're dealing with small image
            div.style.left = `${circle.getBoundingClientRect().left - leftSmallOffset}px`;
        }
        else{ // We're dealing with bigger image
            div.style.left = `${circle.getBoundingClientRect().left -leftBigOffset}px`;
            }
    }
    else{ // Even Numbered Image
      div.style.top = `${cy+400}px`;
        if (div.querySelector('img').naturalWidth < 400 ){ // Check to see if we're dealing with small image
            div.style.left = `${circle.getBoundingClientRect().left -leftSmallOffset}px`;
        }
        else{ // We're dealing with bigger image
            div.style.left = `${circle.getBoundingClientRect().left -leftBigOffset}px`;
            }
    }
    //Reformats first div to be uniform with the rest of the bottom divs.
    if (event_id == 1){
      div.style.top = `${cy+375}px`;
      if (div.querySelector('img').naturalWidth < 400){ // Check to see if we're dealing with small image
          div.style.left = `${circle.getBoundingClientRect().left -85}px`;
      }
      else{ // We're dealing with bigger image
          div.style.left = `${circle.getBoundingClientRect().left -150}px`;
          }
    }
    // BUG FIXES

  });
  
  circle_index++;
});
// This boolean value tells us if we have content already contained within the subetimeline overlay
var overlayPopulated = false; // BUG FIX

  // The following is for sub-timeline
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
    var offset = 800;
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
    //AFter setting all values in place only then show the subtimeline. Here we are using insertAdjacentHTML.
    // right before that we need to add code to clear out all elements from the sub_events_container element.
    const sub_events_container = document.querySelector("#sub_events_container");

    // If sub-timeline already contains content, do not add it again.
    if (!overlayPopulated) {  /*BUG FIXES*/
    // populate the overlay with front_images and back_images
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
  // This is used to close all the circles that are currently open on the timeline closeCircle
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


// This is function for the overlay functionality. since there are more than one ways 
  //the function is made separately and called for each type of trigger like click on overlay or cross button
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

// This is when a user clicks on timeline to view sub-timeline, the code has to find the circle before
  // and after to add the line-indicator for the subtimeline in the right position
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

// VIDEO EMBEDMENT

// HTML string
// User will be able to supply an embedded video by simply right clicking the video and copying the embedded video 

const videoHtml = '<iframe width="554" height="309" src="https://www.youtube.com/embed/bkUTrn_qeyA" title="The Battle of Lundy&#39;s Lane (July 1814)" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';

// create an iframe element
const iframe = document.createElement('iframe');

// extract attribute values from HTML string
const parser = new DOMParser();
const parsedHtml = parser.parseFromString(videoHtml, 'text/html');
const videoSrc = parsedHtml.querySelector('iframe').getAttribute('src');
const videoWidth = parsedHtml.querySelector('iframe').getAttribute('width');
const videoHeight = parsedHtml.querySelector('iframe').getAttribute('height');
const videoTitle = parsedHtml.querySelector('iframe').getAttribute('title');
const videoAllow = parsedHtml.querySelector('iframe').getAttribute('allow');
const videoAllowFullscreen = parsedHtml.querySelector('iframe').getAttribute('allowfullscreen');

// set the iframe source and attributes
iframe.src = videoSrc;
iframe.width = videoWidth;
iframe.height = videoHeight;
iframe.title = videoTitle;
iframe.allow = videoAllow;
iframe.allowFullscreen = videoAllowFullscreen;

// add the iframe element to the DOM
const video_container = document.getElementById('video-container');
video_container.appendChild(iframe);


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

// This function is used to create stacked images and append them to a container
// It takes in a list of lists and processes them in the same format as the years_all_info list
function stackerParser(years_all_info) { 
  var img1 = "https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+years_all_info[0][1]+".jpg?raw=true"
  var img2 = "https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+years_all_info[0][2]+".jpg?raw=true"
  var title1 = years_all_info[0][5];
  var title2 = years_all_info[0][4];

  var htmlString = "<img style='max-height:260px;' src='" + img2 + "' alt='1730s' title='Information on " + title1 + "' class='overlay2 back-image' onclick='swapImages()'>" +
    "<img style='max-height:260px;' src='" + img1 + "' alt='1730s' title='" + years_all_info[3] + "_" + title2 + "' class='overlay2 front-image' onclick='swapImages()'>";
  document.querySelector(".stacked-container").innerHTML = htmlString;
}
stackerParser(years_all_info);

// "<img style ='max-height:260px;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+years_all_info[year_index][2]+".jpg?raw=true' alt='1730s' title='Information on "+years_all_info[year_index][5] +"' class='overlay2 back-image' onclick='swapImages()'><img style ='max-height:260px;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+years_all_info[year_index][1]+".jpg?raw=true' alt='1730s'  title='"+years_all_info[3]+"_"+years_all_info[4]+"' class='overlay2 front-image' onclick='swapImages()'>";
//var years_all_info =[["1","IndigenousA","IndigenousB","9000","BC","<1500","0"],



/* This function is used to add an overlay button onto an image container that contains additional info.
 * Once the button is pressed, an overlay will appear below the timeline container.
 * Params: c_div: The circle div, cid: The circle ID, backImage: The back image we are adding the button to.
 */
function extra_info (c_div, cid, frontImage, backImage) {
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
  // button.style.opacity = 0;
  button.style.zIndex = 999;
  // Append the button to the front image
  backImage.appendChild(button);
  

  // Create dummy second button
  // const button2 = document.createElement("button");
  // button2.innerHTML = "...";
  // button2.setAttribute("class", "my-button" + cid+"B");
  // button2.style.position = "absolute";
  // button2.style.left = "0px";
  // button2.style.top = "0px";
  // button2.style.color = "lightcoral";
  // button2.style.backgroundColor = "aqua";
  // button2.style.fontSize = "24px";

  // // Append the button to the back image
  // backImage.appendChild(button2);

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