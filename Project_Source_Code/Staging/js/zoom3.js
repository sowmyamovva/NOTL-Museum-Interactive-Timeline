// const zoomable = document.getElementById("zoomable");

// let zoomLevel = 1;
// let zoomPoint = { x: 0, y: 0 };

// zoomable.addEventListener("click", (event) => {
//   if (event.shiftKey) {
//     // Shift-click to zoom out
//     zoomLevel -= 0.5;
//   } else {
//     // Click to zoom in
//     zoomLevel += 0.5;
//   }

//   // Get the position of the click relative to the zoomable element
//   const rect = zoomable.getBoundingClientRect();
//   zoomPoint.x = (event.clientX - rect.left) / rect.width;
//   zoomPoint.y = (event.clientY - rect.top) / rect.height;

//   // Apply the zoom transform to the zoomable element
//   zoomable.style.transformOrigin = `${zoomPoint.x * 100}% ${zoomPoint.y * 100}%`;
//   zoomable.style.transform = `scale(${zoomLevel})`;
// });
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

