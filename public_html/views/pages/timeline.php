<?php
//echo getcwd() . "\n";
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
require_once '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/controllers/ContentController.php';
$controller = new ContentController();
$events = $controller->getEvents();
$sub_events = $controller->getSubEvents();
$cnt1 = 0;
$cnt2 = 0;
$year_info = array(array());
$year_more_info = array();
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
    $year_info[$cnt1][$cnt2++] = $row["information"];
    $year_info[$cnt1][$cnt2++] = $row["more_information"];
    $year_info[$cnt1][$cnt2++] = $row["event_title"];
    $year_info[$cnt1][$cnt2++] = $row["category"];
    if(strlen($row["more_information"])>=5)
    {
      $year_more_info[$row["id"]] = $row["more_information"];
    }
    $cnt1++;
}
// print_r($year_info);
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
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
require_once '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/config/config.php';
$config = new Config();
$connection = $config->getConnection();
// CloseCon($conn);
include '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/includes/header.php';
header('Cache-Control: max-age=3600');
?>

<?php
// get the current page URL
$current_url = $_SERVER['REQUEST_URI'];
?>

<?php if ((strpos($current_url, 'timeline') !== false || strpos($current_url, 'edit_content') !== false)&& !$guest && $user_header['user_role_id'] == 1): ?>
<style>
.tabs_button_container {
  margin-top: 20px;
  display: flex;
}

.view_button_un, .edit_button_un {
  background-color: #d3d3d3;
  border: none;
  color: #fff;
  padding: 10px;
  font-size: 16px;
  cursor: pointer;
  margin-right: 10px;
}

.edit_button_un {
  background-color: #adadad;
}

.view_button_un.active, .edit_button_un.active {
  opacity: 0.7;
  cursor: default;
  pointer-events: none;
}

.view_button_un:hover, .edit_button_un:hover {
  opacity: 0.8;
}

</style>
<div class="tabs_button_container">
  <button class="view_button_un <?php echo (strpos($current_url, 'timeline') !== false) ? 'active' : ''; ?>">View</button>
  <button class="edit_button_un <?php echo (strpos($current_url, 'edit_content') !== false) ? 'active' : ''; ?>">Edit</button>
</div>
<script>
const viewButton = document.querySelector('.view_button_un');
const editButton = document.querySelector('.edit_button_un');

viewButton.addEventListener('click', function() {
  if (!viewButton.classList.contains('active')) {
    window.location.href = 'https://badger-timeline.infinityfreeapp.com/public_html/views/pages/timeline';
  }
});

editButton.addEventListener('click', function() {
  if (!editButton.classList.contains('active')) {
    window.location.href = 'https://badger-timeline.infinityfreeapp.com/public_html/views/pages/edit_content';
  }
});
</script>
<?php endif; ?>

<head>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <!-- <link rel="stylesheet" href="/CSS/all_features.css">-->
 <!-- <link rel="stylesheet" href="/CSS/calendar.css">-->
 <!-- <link rel="stylesheet" href="CSS/timeline.css" />  -->

 <link rel="stylesheet" href="/CSS/sowmya.css" /> 
</head>

<!-- <link rel="stylesheet" href="/CSS/all_features.css" />  -->

<body>


  <!-- Filter Icon -->
<!-- <i class="fas fa-sliders-h" id="filterIcon"></i> -->

 <div class = "outer-container">
<div class="filter-bar" >

<i style = "padding: 5px" class="fas fa-filter" id="filterIcon"></i>
<!-- Modal -->
<div class="modal" tabindex="-1" role="dialog" id="filterModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Filter Range</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="from-year">From:</label>
        <input type="number" id = "from-year" name = "from-year" class="form-control"  placeholder="From">
        <label for="to-year">To:</label>
        <input type="number" id = "to-year" name = "to-year" class="form-control" placeholder="To">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="filter-button">Apply Filter</button>
      </div>
    </div>
  </div>
</div>

<!-- Category Icon -->
<i style = "padding: 5px" class="fas fa-list" id="categoryIcon"></i>

<!-- Category modal -->
<div class="modal" tabindex="-1" role="dialog" id="categoryModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select a Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="categorySelect">Category:</label>
        <select class="form-control" id="filter_title">
          <option value="all">All Categories</option>
         <!--  <option value="Indigenous_History">Indigenous History</option>
          <option value="European_Settlers">European Settlers</option>
          <option value="War">War</option>
          <option value="Transportation">Transportation</option>
          <option value="Fishing">Fishing</option>
          <option value="Historical_Figures">Historical Figures</option> -->
        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="applyCategory">Apply</button>
      </div>
    </div>
  </div>
</div>

  <!-- Dark Mode Icon -->
<i style = "padding: 5px" class="fas fa-moon" id="darkModeIcon"></i>
</div>
<!-- <div class="filter-bar" style = "">
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
  </div> -->

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

     <line id="mypath" x1="-9500" y1="180" x2="10000" y2="180" fill="#1c278a" stroke="url(#e0YvEuspUTQ2-stroke)" stroke-width="13" />
    
        <g id ="sub_timeline" class="arrow_sub">
            <style type="text/css">
                .st0{fill:none;stroke:whitesmoke;stroke-miterlimit:10;stroke-width: 5;z-index: 11;}
                .st1{ r: 15 !important;
                    fill:url(#e0YvEuspUTQ2-stroke);
                    stroke: white;
                    stroke-width: 3;}
            </style>
            <line id="sub_line1" class="st0" x1="186" y1="180" x2="185.5" y2="320"/>
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
 <div class="scroll-btns">
<div style="width: 40px; position: relative;top: -53vh;left:2vw; cursor:pointer;" id = "left_arrow">
   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="chevron-double-left"><path d="M17,17a1,1,0,0,1-.71-.29l-4-4a1,1,0,0,1,0-1.41l4-4a1,1,0,0,1,1.41,1.41L14.41,12l3.29,3.29A1,1,0,0,1,17,17Z"></path><path d="M11,17a1,1,0,0,1-.71-.29l-4-4a1,1,0,0,1,0-1.41l4-4a1,1,0,0,1,1.41,1.41L8.41,12l3.29,3.29A1,1,0,0,1,11,17Z"></path></svg>
  </div>
<div style="width: 40px; position: relative;top: -58vh; left:93.5vw;cursor:pointer;" id = "right_arrow"  >
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="chevron-double-right"><path d="M7,17a1,1,0,0,1-.71-1.71L9.59,12,6.29,8.71A1,1,0,0,1,7.71,7.29l4,4a1,1,0,0,1,0,1.41l-4,4A1,1,0,0,1,7,17Z"></path><path d="M13,17a1,1,0,0,1-.71-1.71L15.59,12,12.29,8.71a1,1,0,0,1,1.41-1.41l4,4a1,1,0,0,1,0,1.41l-4,4A1,1,0,0,1,13,17Z"></path></svg>
</div>
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
<div id="overlay3"><h1>More Information</h1></div>
<!-- <h1>Events</h1>
  <div id="eventscontainer"></div>
 -->
<script>

const arrayColumn = (arr, n) => arr.map(x => x[n]);
var years_all_info = <?php echo json_encode($year_info); ?>;
var sub_events = <?php echo json_encode($sub_info); ?>;
// var additional_info = {"10":"Relavant content to Indigenous people around 9000 BC",
//                     "12":"Relevant content to European contact around 1500",
//                     "15":"Relevant content to USRevolution  around 1791",
//                     "16":"Relevant content to WarA and WarB contact around 1812",
//                   };
var additional_info =<?php echo json_encode($year_more_info); ?>;

function process_images(year_index){
    var time ="";
    if (years_all_info[year_index][4] !=null)
    {
        time = ( years_all_info[year_index][3]+" "+years_all_info[year_index][4]) ;
    }

//image with buttonhttps://badger-timeline.infinityfreeapp.com/public_html/views/pages/timeline
var year_tooltip = "<div class='flip-container'><div class='flipper'><div id = "+years_all_info[year_index][0]+"A class='front'><img style ='max-height:260px;' src='https://badger-timeline.infinityfreeapp.com/public_html/assets/images/"+years_all_info[year_index][1]+"' alt='1730s'  title='"+years_all_info[3]+"_"+years_all_info[4]+"'> </div><div id = "+years_all_info[year_index][0]+"B class='back'><img style ='max-height:260px;' src='https://badger-timeline.infinityfreeapp.com/public_html/assets/images/"+years_all_info[year_index][2]+"' alt='1753s'  title='Information on "+years_all_info[year_index][5] +"'></div></div></div></div>"; //put overlay3 here if you want it to be relative to the timeline
    var year_info = ' <div id="label" class="event-label" style=" display: block;height: 300px; white-space: normal; ">' + year_tooltip + '</div>';

    return year_info;
}

function process_sub_images(front,back,title){

    var year_tooltip = "<div class='flip-container' style = 'width:300px !important'><div class='flipper'><div class='front'><img style ='max-height:260px;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+front+"?raw=true' alt='1730s'  title='"+title+"'> </div><div class='back'><img style ='max-height:260px;' src='https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/"+back+"?raw=true' alt='1753s'  title='"+title+"'></div></div></div>";

    var year_info = ' <div id="label" class="event-label" style=" display: block;height: 300px; white-space: normal; ">' + year_tooltip + '</div>';

    return year_tooltip;
}
// var categories =["Indigenous_History","European_Settlers","War","Transportation","Fishing","Historical_Figures"];
// for (let i = 0; i < categories.length; i++) {
//   let text = categories[i]; 
//   var op_view = text.replace("_", " ");
//   var option = " <option value=" + categories[i] + ">" + op_view  + "</option>";
//   document
//     .getElementById("filter_title")
//     .insertAdjacentHTML("beforeend", option);
// }
var categories = ["Indigenous_History", "European_Settlers", "War_History", "Transportation_History", "Fisheries_History", "Historical_Figures"];

var select = document.getElementById("filter_title");

for (var i = 0; i < categories.length; i++) {
  var text = categories[i]; 
  var op_view = text.replace("_", " ");
  var option = document.createElement("option");
  option.setAttribute("value", categories[i]);
  option.textContent = op_view;
  select.appendChild(option);
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
      if (Math.abs(year1 - year2) > 1000) // If distance is bigger than 2000 reduce it to a fixed large value for normalization
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
    // if(position[i] - position[i-1]>700)
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
  // var point =
  //   "<circle id=" + text +" cx='" + (loc.x + 8) + "' cy='" +  loc.y +
  //   "' r= '24'  class=' unselected_circle event first-circle' data-year='" +
  //   text +
  //   "'data-title='" +
  //   title +
  //   "'data-subevents='" +
  //   sub +
  //   "'data-eventid='" +
  //   id +
  //   "'data-eventtitle='" +
  //   event_title +
  //   "'data-category='" +
  //   category +
  //   "' />";
  // //r="20" fill="white" stroke="#474e5d" stroke-width="3" stroke-r = "2"
  // document.getElementById("timeline").insertAdjacentHTML("beforeend", point);
  var circle = document.createElementNS("http://www.w3.org/2000/svg", "circle");
  circle.setAttribute("id", text);
  circle.setAttribute("cx", loc.x + 8);
  circle.setAttribute("cy", loc.y);
  circle.setAttribute("r", 24);
  circle.setAttribute("class", "unselected_circle event first-circle");
  circle.setAttribute("data-year", text);
  circle.setAttribute("data-title", title);
  circle.setAttribute("data-subevents", sub);
  circle.setAttribute("data-eventid", id);
  circle.setAttribute("data-eventtitle", event_title);
  circle.setAttribute("data-category", category);

  // Insert the circle element into the timeline element
  var timeline = document.getElementById("timeline");
  timeline.appendChild(circle);
}


const scrollcontainer = document.getElementById('timeline_container');
const scrollcontent = document.getElementById('timeline_box');
const scrollLeft = document.getElementById('left_arrow');
const scrollRight = document.getElementById('right_arrow');

const scrollWidth = scrollcontent.scrollWidth - scrollcontainer.clientWidth;
const scrollAmount = 0.88 * scrollcontainer.clientWidth;

scrollLeft.addEventListener('click', () => {
  scrollcontainer.scrollBy({
    left: -scrollAmount,
    behavior: 'smooth'
  });
});

scrollRight.addEventListener('click', () => {
  scrollcontainer.scrollBy({
    left: scrollAmount,
    behavior: 'smooth'
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


const filterButton = document.querySelector("#filter-button");
var circles = document.querySelectorAll(".first-circle");

filterButton.addEventListener("click", () => {
  const fromYear = parseInt(document.querySelector("#from-year").value);
  const toYear = parseInt(document.querySelector("#to-year").value);

  circles.forEach((circle,index) => {
    const year = parseInt(circle.dataset.year);
    var card_id = "circle_"+index;
    // console.log("card_id "+card_id);
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
   // console.log("card_id "+card_id);
    if (selectedValue === "all" || circle.getAttribute("data-category") == selectedValue ) 
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
  const leftSmallOffset = -3; // Offsets the small images to the left
  const leftBigOffset = 0; // Offsets the big images to the left      
  const topEvenOffset = 230; // Offsets the odd images to be below timeline 1000
  const topOddOffset = -130; // Offsets the even images to be above timeline 600

  // Div get image
  const event_id = parseInt(circle.dataset.eventid, 10);

  // Circle is clicked here (ccl)
  circle.addEventListener("mousedown", () => {
  // create parser so we can get the attributes from year_tooltip
  // Create a new DOMParser object
  const parser = new DOMParser();
  // Parse the HTML string as an HTML document
  const doc = parser.parseFromString(year_tooltip, "text/html");
  // Get the image element and its source path
  const img2 = doc.querySelector("img");
  const img = document.createElement('img');
  img.src = img2.getAttribute("src");
 
  // Get the image width
  const imgWidth = img.naturalWidth;
  const imgHeight = img.naturalHeight;
//   const front = doc.querySelector("front");
 var containerDiv = doc.querySelector("#label .flip-container");

 // Here we are checking the size of the image and changing the div size according to its dimensions
  if (imgWidth > imgHeight){ // we are dealing with a big image
 
  containerDiv.style.width = "300px"; // change the width to 500 pixels

  // Update the div's innerHTML with the modified year_tooltip
  div.innerHTML = doc.documentElement.innerHTML;
  }
  else{ // we are dealing with a small image
  containerDiv.style.width = "200px"; // change the width to 500 pixels

  // Update the div's innerHTML with the modified year_tooltip
  div.innerHTML = doc.documentElement.innerHTML;
  }
  img.remove();
 
    // const event_id = parseInt(circle.dataset.eventid, 10);




    // console.log(circle);
    // console.log(div);
    if(circle.classList.contains('unselected_circle'))
    {
    circle.classList.remove('unselected_circle');
    circle.classList.add('selected_circle');
    circle.setAttribute('r', 28);
    div.style.display="block";
    }
    else
    { 
      circle.classList.remove('selected_circle');
      circle.classList.add('unselected_circle');
      circle.setAttribute('r', 24);
      div.style.display="none";
      var ci_d = circle.dataset.eventid;
      var back_card = document.getElementById(cid+"B");
        if (isSpeaking) {
        isSpeaking = false;
        
        // Cancel speech synthesis
        window.speechSynthesis.cancel();
      }

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

    document.getElementById('timeline_box').appendChild(div); 
    // div.style.width = "300px";

    var my_img = div.querySelector("img");
    // var my_img.width;
    // var my_img.height;
    // console.log("");
    // my_img.style.width = "300px";

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
  
    const d_width = d_img.scrollWidth;
 
    /* Here, we keep track of the event_id so that we know whether we are at an enen or odd numbered image.
     * This way, we can alternate the y coordinate of each Image
     */
     var bound = 0;

     bound = document.getElementById("timeline_container").getBoundingClientRect().right;
    // We want to center the dive based on how big the images are.
    if (event_id % 2 ==1){  // Odd Numbered Image
        div.style.top = `${top_val + topOddOffset}px`;
        if (d_width < 210){ // Check to see if we're dealing with small image

        if(circle.getBoundingClientRect().left<bound)
          {
            div.style = "display:block";

            div.style.top = `${top_val + topOddOffset}px`;
            div.style.left = `${circle.getBoundingClientRect().left - leftSmallOffset}px`;
          }
          else
          {
            div.style = "display:none";
          }
        }
        else
        { // We're dealing with bigger image
          if(circle.getBoundingClientRect().left<bound)
          {
            div.style = "display:block";

            div.style.top = `${top_val + topOddOffset}px`;
            div.style.left = `${circle.getBoundingClientRect().left -leftBigOffset}px`;
            }
          else
          {
            div.style = "display:none";
          }
        }
    }
    else{ // Even Numbered Image
      div.style.top = `${top_val + topEvenOffset}px`;
        if (d_width < 210 ){ // Check to see if we're dealing with small image
            if(circle.getBoundingClientRect().left<bound)
          {
            div.style = "display:block";

            div.style.top = `${top_val + topEvenOffset}px`;
            div.style.left = `${circle.getBoundingClientRect().left - leftSmallOffset}px`;
          }
          else
          {
            div.style = "display:none";
          }
        }
        else
        { // We're dealing with bigger image
            if(circle.getBoundingClientRect().left<bound)
          {
            div.style = "display:block";

            div.style.top = `${top_val + topEvenOffset}px`;
            div.style.left = `${circle.getBoundingClientRect().left -leftBigOffset}px`;
            }
          else
          {
            div.style = "display:none";
          }
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
  });
  circle_index++;
});
// This boolean value tells us if we have content already contained within the subetimeline overlay
var overlayPopulated = false; // BUG FIX

let isSpeaking = false;
 let speakData;
firstLine.addEventListener('click', (event) => {
       

  const clickedX = event.clientX - event.target.getBoundingClientRect().left;
  const circleBefore = (findCircleBeforeX(clickedX)).cx.baseVal.value;
  const circleAfter = (findCircleAfterX(clickedX)).cx.baseVal.value;
  const circleElemAfter = findCircleAfterX(clickedX);
  const circleElemBefore = findCircleBeforeX(clickedX);
  var flag = circleElemAfter.getAttribute('data-subevents');
  // console.log(" here");
  /* console.log(circleBefore.cx.baseVal.value + " here " + circleAfter.cx.baseVal.value) */
  if (circleBefore != 0 && circleAfter != 0 && flag == 1) {
    const centerX = (circleBefore + circleAfter) / 2;
    var offset = 800;
    var sub_line1 = document.querySelector('#sub_line1');
    sub_line1.setAttribute('x1', centerX);
    sub_line1.setAttribute('x2', centerX);
    var sub_circle = document.querySelector("#sub_circle");
    sub_circle.setAttribute('cx', centerX);
  

    var event_id = circleElemAfter.getAttribute("data-eventid");
    // console.log(circleElemAfter);
    var ids =arrayColumn(sub_events, 3);
    // console.log(ids);
    var index = ids.indexOf(event_id);
     console.log(index);
     console.log(arrayColumn(sub_events, 1)[index]);
	     var front_images = (arrayColumn(sub_events, 1)[index]).split(',');
       console.log(front_images);
    var back_images = (arrayColumn(sub_events, 2)[index]).split(',');
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

//speak button for info
var card_button = document.createElement("button");

  // Set the button text
  card_button.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M533.6 32.5C598.5 85.3 640 165.8 640 256s-41.5 170.8-106.4 223.5c-10.3 8.4-25.4 6.8-33.8-3.5s-6.8-25.4 3.5-33.8C557.5 398.2 592 331.2 592 256s-34.5-142.2-88.7-186.3c-10.3-8.4-11.8-23.5-3.5-33.8s23.5-11.8 33.8-3.5zM473.1 107c43.2 35.2 70.9 88.9 70.9 149s-27.7 113.8-70.9 149c-10.3 8.4-25.4 6.8-33.8-3.5s-6.8-25.4 3.5-33.8C475.3 341.3 496 301.1 496 256s-20.7-85.3-53.2-111.8c-10.3-8.4-11.8-23.5-3.5-33.8s23.5-11.8 33.8-3.5zm-60.5 74.5C434.1 199.1 448 225.9 448 256s-13.9 56.9-35.4 74.5c-10.3 8.4-25.4 6.8-33.8-3.5s-6.8-25.4 3.5-33.8C393.1 284.4 400 271 400 256s-6.9-28.4-17.7-37.3c-10.3-8.4-11.8-23.5-3.5-33.8s23.5-11.8 33.8-3.5zM301.1 34.8C312.6 40 320 51.4 320 64V448c0 12.6-7.4 24-18.9 29.2s-25 3.1-34.4-5.3L131.8 352H64c-35.3 0-64-28.7-64-64V224c0-35.3 28.7-64 64-64h67.8L266.7 40.1c9.4-8.4 22.9-10.4 34.4-5.3z"/></svg>';

  // Set any other properties or attributes for the button as needed
  card_button.setAttribute("class", "card_speak_button");

  card_button.style.position = "absolute";
  card_button.style.right = "0px";
  card_button.style.top = "0px";
  card_button.style.backgroundColor = "white";
  card_button.style.width = "24px";

  // Append the button to the back image
  backImage.appendChild(card_button);

let stop_button = document.createElement("button");
stop_button.style.display = "none";
let stop_button_icon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M301.1 34.8C312.6 40 320 51.4 320 64V448c0 12.6-7.4 24-18.9 29.2s-25 3.1-34.4-5.3L131.8 352H64c-35.3 0-64-28.7-64-64V224c0-35.3 28.7-64 64-64h67.8L266.7 40.1c9.4-8.4 22.9-10.4 34.4-5.3zM425 167l55 55 55-55c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-55 55 55 55c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-55-55-55 55c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l55-55-55-55c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0z"/></svg>';
stop_button.innerHTML = stop_button_icon;
stop_button.setAttribute("class", "card_stop_button");
 stop_button.style.position = "absolute";
  stop_button.style.right = "0px";
  stop_button.style.top = "0px";
  stop_button.style.backgroundColor = "white";
  stop_button.style.width = "24px";
backImage.appendChild(stop_button);

card_button.onclick = function() {
   if (!isSpeaking) {
    isSpeaking = true;
    card_button.style.display = "none";
    stop_button.style.display = "inline-block";
       let voices = getVoices();
  let rate = 1, pitch = 2, volume = 1;
  var ids =arrayColumn(years_all_info, 0);
  var id = ids.indexOf(cid);
  let text = years_all_info[id][7];

    speakData = new SpeechSynthesisUtterance();
    // Set event listener for when speech is finished
     speakData.addEventListener('end', function() {
      isSpeaking = false;
      card_button.style.display = "inline-block";
      stop_button.style.display = "none";
    });
    
  // speak_custom(text, voices[2], 1, 1, 1);
speak_custom(text, 1, 1, 1)
  }

};
// Add event listener to stop button
stop_button.addEventListener("click", function() {
  if (isSpeaking) {
    isSpeaking = false;
    card_button.style.display = "inline-block";
    stop_button.style.display = "none";
    
    // Cancel speech synthesis
    window.speechSynthesis.cancel();
  }
});


// Check to see if circle has additional info
  if (!(cid in additional_info)){ // if circle does not have any additional info then don't add any buttons to it.
    return;
  }

  // Check if button already exists in div
  if (c_div.querySelector('.my-button') !== null) {
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
      text.innerHTML  = additional_info[cid];
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

function getVoices() {
  let voices = speechSynthesis.getVoices();
  if(!voices.length){
    let utterance = new SpeechSynthesisUtterance("");
    speechSynthesis.speak(utterance);
    voices = speechSynthesis.getVoices();
  }
  return voices;
}

var flag_speak_custom = 0;
  if (flag_speak_custom==0)
{
    speakData = new SpeechSynthesisUtterance();
   flag_speak_custom = 1;
   speak_custom(" ", 1, 1, 0);
}
function speak_custom(text, rate, pitch, volume) {
  // create a SpeechSynthesisUtterance to configure the how text to be spoken

  let voices = getVoices(); 
  speakData = new SpeechSynthesisUtterance();
  speakData.volume = volume; // From 0 to 1
  speakData.rate = rate; // From 0.1 to 10
  speakData.pitch = pitch; // From 0 to 2
  speakData.text = text;
  speakData.lang = 'en';
  // speakData.voice = getVoices()[2];
  console.log("speaking");
  // pass the SpeechSynthesisUtterance to speechSynthesis.speak to start speaking 
  speechSynthesis.speak(speakData);

}



</script>

<script id = "search_timeline">


//Define your arrays
const date_titles = arrayColumn(years_all_info, 5);
 const event_titles = arrayColumn(years_all_info, 9);
// const categories_each = arrayColumn(years_all_info, 10);

// Check if the URL contains a search parameter
var searchParam = new URLSearchParams(window.location.search).get('search');
if (searchParam != "") {

  // Use regular expressions to parse the search parameter
  const regex = /^(\S+)\s*\|\s*(.+)$/;
  const match_array = regex.exec(searchParam);
  if (Array.isArray(match_array)) {

    const dateTitle = match_array[1];
    const eventTitle = match_array[2];

    // Check if the date title is in the date_titles array
  if(date_titles.indexOf(dateTitle)<0)
  {
  let bestMatchIndex = -1;
    let bestMatchScore = -Infinity;
    for (let i = 0; i < dateTitles.length; i++) {
      const dateScore = similarity(dateTitle, date_titles[i]);
      const eventScore = similarity(eventTitle, event_titles[i]);

      // calculate the overall similarity score for this date/event pair
      const score = dateScore + eventScore;

      if (score > bestMatchScore) {
        bestMatchIndex = i;
        bestMatchScore = score;
      }
    }
  }
  else
  {
    bestMatchIndex = date_titles.indexOf(dateTitle);
  }
    // create the ID string for the matching card
    const cardId = years_all_info[bestMatchIndex][3]+"_"+years_all_info[bestMatchIndex][4];
    // console.log(cardId);
    // scroll the element into view smoothly
    const element = document.getElementById(cardId);
    element.scrollIntoView({ behavior: 'smooth', block: 'center',
            inline: 'center' });

    // create a new mouse event with the type "mousedown"
    const mouseDownEvent = new MouseEvent('mousedown');

    // dispatch the mouse down event to the SVG element
    element.dispatchEvent(mouseDownEvent);
  }

}


function similarity(string1, string2) {
  const string1Words = string1.toLowerCase().split(' ');
  const string2Words = string2.toLowerCase().split(' ');
  const intersection = string1Words.filter(word => string2Words.includes(word));
  const union = [...new Set([...string1Words, ...string2Words])];
  return intersection.length / union.length;
}

// Sceoll to Div or overlay
    function scrollToDiv(divId) {
        var element = document.getElementById(divId);
        // console.log(element);
        if (element) 
        {
            element.scrollIntoView({ behavior: 'smooth' });
        }
    }
</script>
</body>

<style>
  /* Filter icon */
.filterIcon {
  cursor: pointer;
  color: #333;
  align: right;
}

/* Modal */
.modal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 9999;
}

.modal-content {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 300px;
  margin: 0 auto;
  padding: 20px;
  background-color: #fff;
}

.modal-title{
    color: black;
}

.modal h2 {
  margin-top: 0;
}

.modal form {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.modal label {
  font-weight: bold;
}

.modal input {
  padding: 5px;
}

.modal button {
  padding: 10px 20px;
  background-color: #333;
  color: #fff;
  border: none;
  cursor: pointer;
}

/* Dark Mode Icon */
#darkModeIcon {
  cursor: pointer;
  color: #333; /* Change color to desired color for dark mode icon */
  /* Add additional styling for icon as needed */
}

body.dark-mode {
  color: #FFF;
  background-color: #383c3d !important; /* Change background color to desired color for dark mode */
}

.circle-label.dark-mode{
  font-size: 30px;
  /*fill: #343434;*/
  text-anchor: middle;
  fill: white;
}

.modal {
  position: absolute;
  top: 90px; /* Adjust as needed */
  left: 0;
  right: 90px;
  margin: auto;
}

.modal-backdrop {
  z-index: 100;
}


  </style>

  <script>
    // Event listener for filter icon click
$('#filterIcon').on('click', function() {
  $('#filterModal').modal('show'); // Show the modal
});

// Event listener for Apply Filter button click
$('#filter-button').on('click', function() {
  let minValue = $('#minValue').val();
  let maxValue = $('#maxValue').val();
  // Perform operations with min and max values
  // console.log('Min Value:', minValue);
  // console.log('Max Value:', maxValue);

  $('#filterModal').modal('hide'); // Hide the modal
});

$('#darkModeIcon').on('click', function() {
  // Toggle dark mode class on body element
  $('body').toggleClass('dark-mode');

  // Toggle dark mode class on other elements that need to change
  // For example, you can add additional elements by chaining .toggleClass() method
  $('#filterIcon').toggleClass('dark-mode');
  $('text').toggleClass('dark-mode');
  // Add more elements to toggle class for dark mode as needed
});



// Event listener for category icon click
document.getElementById("categoryIcon").addEventListener("click", function() {
  var categories = ["Indigenous_History", "European_Settlers", "War", "Transportation", "Fishing", "Historical_Figures"];

  // Generate the category options and append them to the drop-down menu
  for (let i = 0; i < categories.length; i++) {
    let text = categories[i];
    var op_view = text.replace("_", " ");
    var option = " <option value=" + categories[i] + ">" + op_view  + "</option>";
    document
      .getElementById("categoryDropdown")
      .insertAdjacentHTML("beforeend", option);
  }
});

  // Event listener for category icon click
  $('#categoryIcon').on('click', function() {
    $('#categoryModal').modal('show'); // Show the modal
  });

  // Event listener for Apply button click
  $('#applyCategory').on('click', function() {
    let selectedCategory = $('#categorySelect').val();
    // Perform operations with selected category
    console.log('Selected Category:', selectedCategory);

    $('#categoryModal').modal('hide'); // Hide the modal
  });

  </script>
<?php 
include '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/includes/footer.php'; 
?>
