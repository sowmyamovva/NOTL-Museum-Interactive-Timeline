<?php
//echo getcwd() . "\n";
include 'db.php';
$conn = OpenCon();
//echo "Connected Successfully";

$sql = "SELECT id, image_front, image_back, date,date_title,date_marker,sub_events FROM events";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  $cnt1 = 0;
  $cnt2 = 0;
  $year_info = array(array());
  while($row = $result->fetch_assoc()) {
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
} 

$sql2 = "SELECT id, image_front, image_back, event_id FROM sub_events";
$results = $conn->query($sql2);

if ($results->num_rows > 0) {
  // output data of each row
  $cnt1 = 0;
  $cnt2 = 0;
  $sub_info = array(array());
  $event_ids= array();
  while($row = $results->fetch_assoc()) {
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
} 
CloseCon($conn);
?>


<!DOCTYPE html>
<html>

<head>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="../CSS/all_features.css">
  <link rel="stylesheet" href="/CSS/calendar.css">
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

<button onclick="toggleCalendar()">Toggle Calendar</button><!-- FEATURE -->
<div id="calendar"></div>

<div id="timeline_container" class="scroll-container">
  <div id="timeline_box" class="scroll-content">                                                                                                <!--Right, Top, Width, Height -->                                                                                   
    <svg id="timeline" cache-id="16de89faabdb48d1a0a46f23dde4f4b1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 300 8500 1" shape-rendering="geometricPrecision" text-rendering="geometricPrecision"  x="0px" y="0px" style="overflow: scroll;">
      <defs>
        <linearGradient id="e0YvEuspUTQ2-stroke" x1="0" y1="150" x2="300" y2="150" spreadMethod="pad" gradientUnits="userSpaceOnUse" gradientTransform="translate(0 0)">
          <!-- <stop id="e0YvEuspUTQ2-stroke-0" offset="0%" stop-color="#fc259b" />
          <stop id="e0YvEuspUTQ2-stroke-1" offset="100%" stop-color="#f85e08" /> -->
          <stop id="e0YvEuspUTQ2-stroke-0" offset="0%" stop-color="#94b8b4" />
          <stop id="e0YvEuspUTQ2-stroke-1" offset="100%" stop-color="#ac80b0" />
        </linearGradient>
      </defs>= <!--  -6600 -->
     <line id="mypath" x1="300" y1="180" x2="7900" y2="180" fill="#1c278a" stroke="url(#e0YvEuspUTQ2-stroke)" stroke-width="13" />
    
        <g id ="sub_timeline" class="arrow_sub">
            <style type="text/css">
                .st0{fill:none;stroke:whitesmoke;stroke-miterlimit:10;stroke-width: 5;z-index: 11;}
                .st1{ r: 15 !important;
                    fill:url(#e0YvEuspUTQ2-stroke);
                    stroke: white;
                    stroke-width: 3;}
            </style>
          <!--The following html code is the code for the line that shows up to indicate sub timeline -->
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
  <!-- The signifiers -->
<div class="left_arrow hidden" id = "left_arrow">
    <i class="material-icons" style='font-size:30px;color:white'>chevron_left</i>
  </div>
<div class = "right_arrow hidden" id = "right_arrow"  >
  <i class="material-icons" style='font-size:30px;color:white'>chevron_right</i>
</div>
<!-- <script src='all_features.js'></script> -->

<!-- The element that holds the sub-timeline -->
<div class="main-div">
    <?xml version="1.0" encoding="utf-8"?>

    <div class="expandend-div hidden">
        <h1 id = "sub_heading">heading</h1>
        <div class="grid" id="sub_events_container">
          
        </div>
        
    <button class="close" onclick="off()">x</button>
    </div>
    
</div>
<!-- The overlay for when the subtimeline appears. -->
<div class = "overlay hidden" id ="overlay" onclick="off()">
    <div>

    </div>
</div>
<!--This section is currently used by the stacked container and video container-->
<div class="addSpace">
  <div class = stacked-container>
</div>
<div id = "video-container"></div>

<!-- <button id="show-div-button">Show Div Block</button>
  <button id="close-button">X</button>
</div> -->

<script>
  var years_all_info = <?php echo json_encode($year_info); ?>;
  var sub_events = <?php echo json_encode($sub_info); ?>;
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  -->
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
<script src="/js/calendar.js"></script> 
<script src="/js/timeline_scripts.js"></script> 

</body>
</html>



