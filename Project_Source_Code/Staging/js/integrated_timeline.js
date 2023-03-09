var years = ["1810","1810","1810","1810","1810","1810","1810","1810","1810","1810"];
var info =  ["At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium","At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium","At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium","At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium","At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium","At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium","At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium","At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium","At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium","At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium"]; 
for(let i = 0 ; i < years.length; i++)
{
    pathOnDiv(years[i], (i/(years.length-1)));
}



function pathOnDiv(text, pos)
{
   var  path = document.getElementById("mypath");
   var  pathLength = path.getTotalLength();
   var  loc = path.getPointAtLength(pos * (pathLength-10));
   var point = '<circle id='+text+' cx="'+(loc.x +8)+'" cy="'+loc.y+'" r="5" fill="white" class="event" data-year="'+text+'" />"';
   document.getElementById('timeline').insertAdjacentHTML('beforeend',point);
}







const timeline = document.getElementById('timeline_box');
const events = timeline.querySelectorAll('.event');

events.forEach(event => {
  event.addEventListener('click', () => {
    const year = event.getAttribute('data-year');
    const year_tooltip = info[years.indexOf(year)];
    const label = document.createElement('div');
    label.textContent = year;
    label.classList.add('event-label');
    /* timeline.appendChild(label); */
    
    const rect = event.getBoundingClientRect();
    
    
 		var year_info= ' <div id="label" class="event-label" style="top: '+(rect.top - 140)+'px; left: '+(rect.left + rect.width / 2)+'px; display: block;height: 130px; max-width:200px; white-space: normal; overflow:hidden; "><time>'+year+'</time>'+year_tooltip+'</div>';
    
    timeline.insertAdjacentHTML('beforeend',year_info);
    
    const label2 = document.getElementById('label');
    /* label.style.top = (rect.top - 40) + 'px';
    label.style.left = (rect.left + rect.width / 2) + 'px'; */
   /*  label.style.display = 'block'; */
    setTimeout(() => {
      label2.parentNode.removeChild(label2);
    }, 30000);
  });
});
