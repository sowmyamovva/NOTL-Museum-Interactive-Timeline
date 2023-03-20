var years = [
  "1810",
  "1811",
  "1812",
  "1813",
  "1814",
  "1815",
  "1816",
  "1817",
  "1818",
  "1819"
];
var info = [
  "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium",
  "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium",
  "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium",
  "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium",
  "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium",
  "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium",
  "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium",
  "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium",
  "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium",
  "At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium"
];
var titles = [
  "title1",
  "title2",
  "title3",
  "title4",
  "title5",
  "title6",
  "title7",
  "title8",
  "title9",
  "title10"
];

for (let i = 0; i < titles.length; i++) {
  console.log("here");
  var option = " <option value=" + titles[i] + ">" + titles[i] + "</option>";
  document
    .getElementById("filter_title")
    .insertAdjacentHTML("beforeend", option);
}

for (let i = 0; i < years.length; i++) {
  pathOnDiv(years[i], i / (years.length - 1), titles[i]);
}

var cnt = 0;

function pathOnDiv(text, pos, title) {
  var path = document.getElementById("mypath");
  var pathLength = path.getTotalLength();
  var loc = path.getPointAtLength(pos * (pathLength - 10));
  var point =
    "<circle id=" +
    text +
    ' cx="' +
    (loc.x + 8) +
    '" cy="' +
    loc.y +
    '"  class=" unselected_circle event first-circle" data-year="' +
    text +
    '"data-title="' +
    title +
    '" />"';
  //r="20" fill="white" stroke="#474e5d" stroke-width="3" stroke-r = "2"
  document.getElementById("timeline").insertAdjacentHTML("beforeend", point);
}
window.addEventListener("load", function() {
  const container = document.querySelector("#timeline_box");
  let prevX = 0;

  container.addEventListener("mousemove", function(e) {
    const x = e.clientX - container.offsetLeft;
    if (x < prevX) {
      container.scrollLeft -= 10;
    } else if (x > prevX) {
      container.scrollLeft += 10;
    }
    prevX = x;
  });
/*   var oldScrollX = container.scrollY;
  var directionText = document.getElementById('direction');
  container.onscroll = function(e) {
    if (oldScrollX < container.scrollX) {
      document.querySelector(".fa-angle-double-left").classList.add="hidden";
      document.querySelector(".fa-angle-double-right").classList.remove="hidden";
    } else {
       document.querySelector(".fa-angle-double-left").classList.remove="hidden";
      document.querySelector(".fa-angle-double-right").classList.add="hidden";
    }
    oldScrollX = container.scrollX;
  }
  
   */
});

const timeline = document.getElementById("timeline_box");
const events = timeline.querySelectorAll(".event");
// this messes up the div position for now

const container = document.querySelector(".scroll-container");
const content = document.querySelector("#timeline_box");
 var oldScrollX = 0;
 const left_arrow = document.querySelector(".left");
 const right_arrow =  document.querySelector(".right");
container.addEventListener("mousemove", (e) => {
  const containerWidth = container.offsetWidth;
  const contentWidth = content.offsetWidth;
  const scrollPos = container.scrollLeft;
  

  const hoverPos = e.pageX - container.offsetLeft;

  const hoverPercent = hoverPos / containerWidth;

  const scrollAmount = hoverPercent * (contentWidth - containerWidth);

  container.scrollLeft = scrollAmount;
  console.log(scrollAmount + " " + oldScrollX);
   if (scrollAmount >oldScrollX) {
      left_arrow.classList.add="hidden";
      right_arrow.classList.remove="hidden";
    } else {
       left_arrow.classList.remove="hidden";
     right_arrow.classList.add="hidden";
    }
     oldScrollX = scrollAmount;
});

const filterButton = document.querySelector("#filter-button");
const circles = document.querySelectorAll("circle");

filterButton.addEventListener("click", () => {
  const fromYear = parseInt(document.querySelector("#from-year").value);
  const toYear = parseInt(document.querySelector("#to-year").value);

  circles.forEach((circle) => {
    const year = parseInt(circle.dataset.year);

    if (year >= fromYear && year <= toYear) {
      circle.style.display = "inline";
    } else {
      circle.style.display = "none";
    }
  });
});

var filterSelect = document.querySelector("#filter_title");
const circles_title = document.querySelectorAll("circle");
filterSelect.addEventListener("change", function() {
  var selectedValue = this.value;
  circles_title.forEach((circle) => {
    console.log(selectedValue + " and " + circle.getAttribute("data-title"));
    if (
      selectedValue === "all" ||
      circle.getAttribute("data-title") == selectedValue
    ) {
      circle.classList.remove("hidden");
    } else {
      circle.classList.add("hidden");
    }
  });
});
const firstLine = document.querySelector('#mypath');
const secondLine = document.querySelector('.second-line');
const secondCircle = document.querySelector('.second-circle');

circles.forEach((circle) => {

  const div = document.createElement("div");
  div.textContent = circle.getAttribute("data-title");
  div.id = circle.getAttribute("data-title");
  div.classList.add("event_name");
  circle.addEventListener("mousedown", () => {

    secondLine.classList.add('hidden');
    //secondCircle.classList.add('hidden');
    circle.classList.remove('unselected_circle');
    circle.classList.add('selected_circle');
    div.style.top = `${circle.getBoundingClientRect().top - 40}px`;
    div.style.left = `${circle.getBoundingClientRect().left - 10}px`;
    document.body.appendChild(div);
  });

  document.getElementById("timeline_container").addEventListener("scroll", () => {

    div.style.top = `${circle.getBoundingClientRect().top - 40}px`;
    div.style.left = `${circle.getBoundingClientRect().left -10}px`;
  });
});


firstLine.addEventListener('click', (event) => {
  const clickedX = event.clientX - event.target.getBoundingClientRect().left;
  const circleBefore = findCircleBeforeX(clickedX);
  const circleAfter = findCircleAfterX(clickedX);

  console.log(" here");
  /* console.log(circleBefore.cx.baseVal.value + " here " + circleAfter.cx.baseVal.value) */
  if (circleBefore != 0 && circleAfter != 0) {
    const centerX = (circleBefore + circleAfter) / 2;
    console.log(circleBefore + " here " + circleAfter);
    const secondLineX1 = centerX - 200;
    const secondLineX2 = centerX + 200;
    secondLine.setAttribute('x1', secondLineX1);
    secondLine.setAttribute('x2', secondLineX2);
   // secondCircle.setAttribute('x', secondLineX1);
    secondLine.classList.remove('hidden');
    // secondCircle.classList.remove('hidden');
  } else {
    // secondTimeline.classList.add('hidden');
  }
});


function findCircleBeforeX(x) {
  console.log("findCircleBeforeX");
  const circles = document.querySelectorAll('.first-circle');
  let circleBefore = null;

  circles.forEach(function(circle) {
    console.log(circle.cx);
    const circleX = circle.getBoundingClientRect().left - event.target.getBoundingClientRect().left + circle.r.baseVal.value;

    console.log(circleX);
    console.log(x);
    if (circleX <= x) {
      circleBefore = circle;
      console.log(circle.cx.baseVal.value);
    }
  });

  return circleBefore.cx.baseVal.value;
}

function findCircleAfterX(x) {
  console.log("findCircleAfterX");
  const circles = document.querySelectorAll('.first-circle');
  /* console.log(circles) */
  let circleAfter = null;

  var check = true;
  // Iterate over all the circles and find the one with the closest X coordinate that is greater than the clicked X
  circles.forEach(function(circle) {

    const circleX = circle.getBoundingClientRect().left - event.target.getBoundingClientRect().left + circle.r.baseVal.value;
    console.log(circleX);
    console.log(x);
    if (circleX > x && check) {
      check = false;
      console.log(circle.cx.baseVal.value);
      circleAfter = circle;

    }
  });
  return circleAfter.cx.baseVal.value;
}
