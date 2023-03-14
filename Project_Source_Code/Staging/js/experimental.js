var years = ["1810", "1811", "1812", "1813", "1814", "1815", "1816", "1817", "1818", "1819"];
var info = ["At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium", "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium", "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium", "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium", "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium", "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium", "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium", "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium", "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium", "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium"];
for (let i = 0; i < years.length; i++) {
  pathOnDiv(years[i], (i / (years.length - 1)));
}



function pathOnDiv(text, pos) {
  var path = document.getElementById("mypath");
  var pathLength = path.getTotalLength();
  var loc = path.getPointAtLength(pos * (pathLength - 10));
  var point = '<circle id=' + text  + ' cx="' + (loc.x + 8) + '" cy="' + loc.y + '" r="5" fill="white" class="event" data-year="' + text + '" />"';
  document.getElementById('timeline').insertAdjacentHTML('beforeend', point);
}


const timeline = document.getElementById('timeline_box');
const events = timeline.querySelectorAll('.event');

let isTextDisplayed = false;
let displayedYear = '';

events.forEach(event => {
  event.addEventListener('click', () => {
    const label2 = document.getElementById('label');
    if (label2 && displayedYear === event.getAttribute('data-year')) {
      label2.parentNode.removeChild(label2);
      isTextDisplayed = false;
      displayedYear = '';
      return;
    }
    displayedYear = event.getAttribute('data-year');
    const year = displayedYear;
    const year_tooltip = info[years.indexOf(year)];
    const label = document.createElement('div');
    label.textContent = year;
    label.classList.add('event-label');
    if (isTextDisplayed) {
      const label2 = document.getElementById('label');
      label2.parentNode.removeChild(label2);
    }
    isTextDisplayed = true;

    const rect = event.getBoundingClientRect();


    var year_info = ' <div id="label" class="event-label" style="top: ' + (rect.top - 140) + 'px; left: ' + (rect.left + rect.width / 2) + 'px; display: block;height: 130px; max-width:200px; white-space: normal; overflow:hidden; "><time>' + year + '</time>' + year_tooltip + '</div>';

    timeline.insertAdjacentHTML('beforeend', year_info);
  });
});


// Overlay

