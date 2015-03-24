function showSummaries(yesNo) {
    if (yesNo == "yes") {
      $("span.details").hide();
      $("span.nodetails").show();
    }
    else {
      $("span.details").show();
      $("span.nodetails").hide();
    }
    try {
        localStorage.setItem("showSummaries", yesNo);
    } catch (e) {}
}

$(document).ready(function(){
  $("#buttonShow").click(function(){
    showSummaries("no");
  });
  $("#buttonHide").click(function(){
    showSummaries("yes");
  });
 try {
    if (localStorage.getItem("showSummaries") ==  "yes") {
       $("span.details").hide();
       $("span.nodetails").show();
    }
 } catch (e) {};
});

$(function(){
$(window).hashchange(function() {
  // Alerts every time the hash changes!
  $(location.hash).addClass('navhighlight');
  })

// Trigger the event (useful on page load).
$(window).hashchange();
});

function hst(section) {
  $("#"+section).toggle(500);
  $("#x"+section).toggle();
}

$('#bluecss').click(function (){
   $('link[title="colorful"]').attr('rel','alternate stylesheet');
   $('link[title="blue"]').attr('rel','stylesheet');
});
$('#colorfulcss').click(function (){
   $('link[title="colorful"]').attr('rel','stylesheet');
   $('link[title="blue"]').attr('rel','alternate stylesheet');
});

