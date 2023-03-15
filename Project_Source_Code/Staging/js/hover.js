const circles = document.querySelectorAll('circle');
circles.forEach(circle => {
  const div = document.createElement('div');
  div.textContent = 'Event name';
  div.classList.add('event_name');
  circle.addEventListener('mouseenter', () => {
    div.style.top = `${circle.getBoundingClientRect().top - 20}px`;
    div.style.left = `${circle.getBoundingClientRect().left}px`;
    document.body.appendChild(div);
  });
  circle.addEventListener('mouseleave', () => {
   // document.body.removeChild(div);
  });
  document.getElementById('timeline_box').addEventListener('scroll', () => {
  console.log("scroll");
    div.style.top = `${circle.getBoundingClientRect().top - 20}px`;
    div.style.left = `${circle.getBoundingClientRect().left}px`;
  });
});
