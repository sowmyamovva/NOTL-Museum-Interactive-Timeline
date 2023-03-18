
// Clicky Zoom in and Zoom out
const divs = document.querySelectorAll(".zoomable"); // Select all the divs with class "zoomable"
const zoomIncrement = 0.2; // Zoom increment/decrement amount
const maxZoomLevel = 1.2; // Maximum zoom level
const minZoomLevel = 1; // Minimum zoom level

divs.forEach((div) => {
  let zoomLevel = 1; // Initial zoom level for each div
  let divOffsetX = 0; // Initial x offset of the div
  let divOffsetY = 0; // Initial y offset of the div

  // Add event listener to zoom in on mouse click
  div.addEventListener("click", (event) => {
    if (event.button === 0) { // Check for left click
      const prevZoomLevel = zoomLevel;
      zoomLevel = Math.min(maxZoomLevel, zoomLevel + zoomIncrement);
      const zoomRatio = zoomLevel / prevZoomLevel;
      const mouseX = event.clientX - div.offsetLeft;
      const mouseY = event.clientY - div.offsetTop;
      divOffsetX = (divOffsetX + mouseX) * zoomRatio - mouseX;
      divOffsetY = (divOffsetY + mouseY) * zoomRatio - mouseY;
      div.style.transform = `scale(${zoomLevel}) translate(${divOffsetX}px, ${divOffsetY}px)`;
      div.style.transformOrigin = `${event.clientX}px ${event.clientY}px`;
    }
  });

  // Add event listener to zoom out on right mouse click
  div.addEventListener("contextmenu", (event) => {
    event.preventDefault(); // Prevent context menu from appearing
    const prevZoomLevel = zoomLevel;
    zoomLevel = Math.max(minZoomLevel, zoomLevel - zoomIncrement);
    const zoomRatio = zoomLevel / prevZoomLevel;
    const mouseX = event.clientX - div.offsetLeft;
    const mouseY = event.clientY - div.offsetTop;
    divOffsetX = (divOffsetX + mouseX) * zoomRatio - mouseX;
    divOffsetY = (divOffsetY + mouseY) * zoomRatio - mouseY;
    div.style.transform = `scale(${zoomLevel}) translate(${divOffsetX}px, ${divOffsetY}px)`;
    div.style.transformOrigin = `${event.clientX}px ${event.clientY}px`;
  });
});

// ZOOM IN ON SVG

// Select the SVG element
const svg = document.querySelector('svg');

// Add a wheel event listener to the SVG
svg.addEventListener('wheel', (event) => {
  // Prevent the default scroll behavior
  event.preventDefault();

  // Calculate the zoom level based on the scroll delta
  const zoom = event.deltaY > 0 ? 0.9 : 1.5; // change to adjust zoom

  // Get the current mouse position relative to the SVG
  const rect = svg.getBoundingClientRect();
  const x = event.clientX - rect.left;
  const y = event.clientY - rect.top;

  // Adjust the transform origin to the mouse position
  svg.style.transformOrigin = `${x}px ${y}px`;

  // Apply the zoom level to the SVG transform
  svg.style.transform = `scale(${zoom})`;
});


// OVERLAY
const overlayContainer = document.querySelector('.overlay-container');
const overlay = document.querySelector('.overlay');

overlayContainer.addEventListener('click', () => {
  overlay.classList.toggle('show');
});


// Original JS
var years = [1810,1810,1810,1810,1810,1810,1810,1810,1810,1810];
for(let i = 0 ; i < years.length; i++)
{
    pathOnDiv(years[i], (i/(years.length-1)));
}



function pathOnDiv(text, pos)
{
   var  path = document.getElementById("mypath");
   var  pathLength = path.getTotalLength();
   var  loc = path.getPointAtLength(pos * pathLength);
   var point = '<circle cx="'+loc.x+'" cy="'+loc.y+'" r="3.5" fill="white" class="event" data-year="'+text+'" />"';
   document.getElementById('timeline').insertAdjacentHTML('beforeend',point);
}







const timeline = document.getElementById('timeline_box');
const events = timeline.querySelectorAll('.event');

events.forEach(event => {
  event.addEventListener('click', () => {
    const year = event.getAttribute('data-year');
    const label = document.createElement('div');
    label.textContent = year;
    label.classList.add('event-label');
    timeline.appendChild(label);
    const rect = event.getBoundingClientRect();
    label.style.top = rect.top - 40 + 'px';
    label.style.left = rect.left + rect.width / 2 + 'px';
    label.style.display = 'block';
    setTimeout(() => {
      label.parentNode.removeChild(label);
    }, 3000);
  });
});
