var scale = 1;
var zoomContainer = document.querySelector('.zoom-container');

zoomContainer.addEventListener('wheel', function(e) {
  e.preventDefault();
  var delta = e.deltaY || e.detail || e.wheelDelta;
  if (delta > 0) {
    scale -= 0.1;
  } else {
    scale += 0.1;
  }
  zoomContainer.querySelector('.zoom-content').style.transform = 'scale(' + scale + ')';
});