const svg = document.getElementById('subtimeline');
const line = svg.querySelector('line');
const circles = svg.querySelectorAll('circle');

svg.addEventListener('mousedown', function(e) {
  const mouseX = e.clientX;
  const mouseY = e.clientY;
  
  const lineX1 = parseFloat(line.getAttribute('x1'));
  const lineX2 = parseFloat(line.getAttribute('x2'));
  const lineY1 = parseFloat(line.getAttribute('y1'));
  const lineY2 = parseFloat(line.getAttribute('y2'));
  
  const newLineX1 = lineX1 + mouseX - svg.getBoundingClientRect().left;
  const newLineX2 = lineX2 + mouseX - svg.getBoundingClientRect().left;
  const newLineY1 = lineY1 + mouseY - svg.getBoundingClientRect().top;
  const newLineY2 = lineY2 + mouseY - svg.getBoundingClientRect().top;
  
  line.setAttribute('x1', newLineX1);
  line.setAttribute('x2', newLineX2);
  line.setAttribute('y1', newLineY1);
  line.setAttribute('y2', newLineY2);
  
  circles.forEach(function(circle) {
    const cx = parseFloat(circle.getAttribute('cx'));
    const cy = parseFloat(circle.getAttribute('cy'));
    
    const newCx = cx + mouseX - svg.getBoundingClientRect().left;
    const newCy = cy + mouseY - svg.getBoundingClientRect().top;
    
    circle.setAttribute('cx', newCx);
    circle.setAttribute('cy', newCy);
  });
});
