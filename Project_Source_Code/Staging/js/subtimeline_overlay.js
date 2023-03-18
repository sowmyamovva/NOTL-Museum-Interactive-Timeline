//jqery 3.4.1

$(document).ready(function() {
  // Show overlay and dynamic timeline on click of line element
  $('.line').on('click', function() {
    // Hide previous dynamic timeline (if any)
    $('.dynamic-timeline').hide();
    
    // Show overlay and dynamic timeline
    $('.overlay').show();
    $('.dynamic-timeline').show().html('Dynamic timeline content');
    
    // Position dynamic timeline right under clicked line element
    var linePosition = $(this).offset().left;
    var timelinePosition = linePosition - $('.timeline-container').scrollLeft();
    $('.dynamic-timeline').css('left', timelinePosition + 'px');
  });
  
  // Hide overlay and dynamic timeline on click of overlay element
  $('.overlay').on('click', function() {
    $('.overlay').hide();
    $('.dynamic-timeline').hide();
  });
});
