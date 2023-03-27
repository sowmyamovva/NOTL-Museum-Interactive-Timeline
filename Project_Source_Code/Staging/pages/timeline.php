<!DOCTYPE html>
<html>
<head>

  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="C:/RS/COSC 4P02/all_features.css"> 
</head>
<body>
  <div class = "outer-container">
<div id="filter">
  <select id="filter_title">
    <option value="all">All Titles</option>
  </select>

  <label for="from-year">From:</label>
  <input type="number" id="from-year" name="from-year" min="1700" max="2010" value="1812" step="10">
  <label for="to-year">To:</label>
  <input type="number" id="to-year" name="to-year" min="1990" max="2010" value="2010">
  <button id="filter-button">Filter</button>
</div>
<div class="left hidden" id = "left_arrow">
  <i class="material-icons" style='font-size:30px;color:white'>chevron_left</i>
</div>
<div id="timeline_container" class="scroll-container">

  <div id="timeline_box" class="scroll-content">

    <svg id="timeline" cache-id="16de89faabdb48d1a0a46f23dde4f4b1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 400 400" shape-rendering="geometricPrecision" text-rendering="geometricPrecision">
      <defs>
        <linearGradient id="e0YvEuspUTQ2-stroke" x1="0" y1="150" x2="300" y2="150" spreadMethod="pad" gradientUnits="userSpaceOnUse" gradientTransform="translate(0 0)">
          <stop id="e0YvEuspUTQ2-stroke-0" offset="0%" stop-color="#fc259b" />
          <stop id="e0YvEuspUTQ2-stroke-1" offset="100%" stop-color="#f85e08" />
        </linearGradient>
      </defs>

      <line id="mypath" x1="-1600" y1="180" x2="2000" y2="180" fill="#1c278a" stroke="url(#e0YvEuspUTQ2-stroke)" stroke-width="13" />
      
       <line id = "mypath2" class="second-line hidden"  y1="300" y2="300"  fill="#1c278a" pathLength="90" stroke="url(#e0YvEuspUTQ2-stroke)" stroke-width="11" />
       <!--  <circle class="second-circle hidden" cx="100" cy="250" r="10" />
        <circle class="second-circle hidden" cx="200" cy="250" r="10" />
        <circle class="second-circle hidden" cx="300" cy="250" r="10" />
        <circle class="second-circle hidden" cx="400" cy="250" r="10" /> -->
      
    </svg>

  </div>
</div>
<div class = "right hidden" id = "right_arrow"  >
  <i class="material-icons" style='font-size:30px;color:white'>chevron_left</i>
</div>
</div> 
<script src='all_features.js'></script>
</body>
</html>
