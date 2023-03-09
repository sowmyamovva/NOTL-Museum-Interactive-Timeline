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
   var point = '<circle cx="'+loc.x+'" cy="'+loc.y+'" r="5" fill="white" class="event" data-year="'+text+'" />"';
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
