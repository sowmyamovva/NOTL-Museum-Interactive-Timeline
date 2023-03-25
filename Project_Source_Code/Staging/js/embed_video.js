// HTML string
// User will be able to supply an embedded video by simply right clicking the video and copying the embedded video 
const videoHtml = '<iframe width="554" height="309" src="https://www.youtube.com/embed/bkUTrn_qeyA" title="The Battle of Lundy&#39;s Lane (July 1814)" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';

// create an iframe element
const iframe = document.createElement('iframe');

// extract attribute values from HTML string
const parser = new DOMParser();
const parsedHtml = parser.parseFromString(videoHtml, 'text/html');
const videoSrc = parsedHtml.querySelector('iframe').getAttribute('src');
const videoWidth = parsedHtml.querySelector('iframe').getAttribute('width');
const videoHeight = parsedHtml.querySelector('iframe').getAttribute('height');
const videoTitle = parsedHtml.querySelector('iframe').getAttribute('title');
const videoAllow = parsedHtml.querySelector('iframe').getAttribute('allow');
const videoAllowFullscreen = parsedHtml.querySelector('iframe').getAttribute('allowfullscreen');

// set the iframe source and attributes
iframe.src = videoSrc;
iframe.width = videoWidth;
iframe.height = videoHeight;
iframe.title = videoTitle;
iframe.allow = videoAllow;
iframe.allowFullscreen = videoAllowFullscreen;

// add the iframe element to the DOM
const container = document.getElementById('video-container');
container.appendChild(iframe);
