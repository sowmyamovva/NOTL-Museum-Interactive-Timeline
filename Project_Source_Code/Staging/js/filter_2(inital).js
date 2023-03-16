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
    '" r="8" fill="white" class="event" data-year="' +
    text +
    '"data-title="' +
    title +
    '" />"';
  document.getElementById("timeline").insertAdjacentHTML("beforeend", point);
}
window.addEventListener("load", function () {
  const container = document.querySelector("#timeline_box");
  let prevX = 0;

  container.addEventListener("mousemove", function (e) {
    const x = e.clientX - container.offsetLeft;
    if (x < prevX) {
      container.scrollLeft -= 10;
    } else if (x > prevX) {
      container.scrollLeft += 10;
    }
    prevX = x;
  });
});

const timeline = document.getElementById("timeline_box");
const events = timeline.querySelectorAll(".event");
// this messes up the div position for now
events.forEach((event) => {
  //maybe hover and click feature
  /*   event.addEventListener('click', () => {
    const label2 = document.getElementById('label');
    if (label2) {
      label2.parentNode.removeChild(label2);
    }
    const year = event.getAttribute('data-year');
    const year_tooltip = info[years.indexOf(year)];
    const label = document.createElement('div');
    label.textContent = year;
    label.classList.add('event-label');
  
    const rect = event.getBoundingClientRect();
  
  
    var year_info = ' <div id="label" class="event-label" style="top: ' + (rect.top - 140) + 'px; left: ' + (rect.left + rect.width / 2) + 'px; display: block;height: 130px; max-width:200px; white-space: normal; overflow:hidden; "><time>' + year + '</time>' + year_tooltip + '</div>';
  
    timeline.insertAdjacentHTML('beforeend', year_info);
  
  }); */
});

const container = document.querySelector(".scroll-container");
const content = document.querySelector("#timeline_box");

container.addEventListener("mousemove", (e) => {
  const containerWidth = container.offsetWidth;
  const contentWidth = content.offsetWidth;
  const scrollPos = container.scrollLeft;

  const hoverPos = e.pageX - container.offsetLeft;

  const hoverPercent = hoverPos / containerWidth;

  const scrollAmount = hoverPercent * (contentWidth - containerWidth);

  container.scrollLeft = scrollAmount;
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
filterSelect.addEventListener("change", function () {
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
// const circles = timeline.querySelectorAll('circle');
circles.forEach((circle) => {
  const div = document.createElement("div");
  div.textContent = circle.getAttribute("data-title");
  div.classList.add("event_name");
  circle.addEventListener("mouseenter", () => {
    div.style.top = `${circle.getBoundingClientRect().top - 20}px`;
    div.style.left = `${circle.getBoundingClientRect().left}px`;
    document.body.appendChild(div);
  });
  circle.addEventListener("mouseleave", () => {
    // div.parentNode.removeChild(div);
   // document.body.removeChild(div);
  });
  document.getElementById("timeline_container").addEventListener("scroll", () => {
   
      console.log("scroll");
      div.style.top = `${circle.getBoundingClientRect().top - 20}px`;
      div.style.left = `${circle.getBoundingClientRect().left}px`;
    });
});
