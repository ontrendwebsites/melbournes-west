jQuery(window).load (function() {
  

  //jQuery('.light-grey .span3').equalHeights();

  jQuery('.grid').masonry({
    columnWidth: 0,
    itemSelector: '.grid-item'
  });

  
});

// run homepage slider
jQuery(document).ready(function(){

  // home page slider
  jQuery('.home-slides').slick({
  dots: true,
  autoplay: true,
  autoplaySpeed: 5000,
  prevArrow: '<a href="javascript:void(0);" class="fa fa-chevron-left"></a>',
  nextArrow: '<a href="javascript:void(0);" class="fa fa-chevron-right"></a>',
  });

  // Our Region page slider
  jQuery('.region-slides').slick({
  dots: true,
  autoplay: true,
  autoplaySpeed: 5000,
  arrows: false
  });

  // equal heights homepage pods
  jQuery('.home-pods-container .span3').equalHeights();

  // equal heights homepage logos
  //jQuery('.light-grey .span3').equalHeights();


  //var x = document.getElementsByClassName("label-tribe-bar-date");
    //x[0].innerHTML = "Click here to pick a date";

});


(function($) {
  function ajaxRequest() {
    var $response = $('.response');
    
    var settings = {
      "async": true,
      "crossDomain": true,
      "url": "https://wmt.everi.com.au/feed?page=1&access_token=f0e38e70b8cd4efab644a5046b546edb",
      "method": "GET"
    };

    $.ajax(settings).done(function (serverData) {
      
      var responseString = JSON.stringify(serverData);
      console.log(responseString);

      // show all titles
      var objects = serverData.data;

      var buildHtml = "";

      buildHtml += "<div class='events-container'>";

      // object loop to build the card HTML
      for (var i= 0; i < objects.length; i++) {

        // build the card HTML
        buildHtml += '<div class="event-card">';

          // URL
          var $url = objects[i].Url;
          // title
          var $title = objects[i].Title;
          // image
          var $image = JSON.stringify(objects[i].Images[0].Url);
          var $imageClean = $image.slice(1, -1); // remove the quotes around image data
          // dates
          var $dates = objects[i].Dates;
          // times
          var $times = objects[i].Hours;
          // location
          var $location = objects[i].Location;

          // build the HTML
          buildHtml += '<div class="image-container" style="background-image: url(' + $imageClean + ');"></div>';
          
          // event card wrapper
          buildHtml += '<div class="event-card-inner">';
            buildHtml += '<h3>' + $title + '</h3>';
            // Event link
            if(objects[i].BookingUrl) {
              buildHtml += '<p><a href="' + objects[i].BookingUrl + '" target="_blank">Event link</a></p>';
            }

            buildHtml += '<p class="event-label">dates</p>';

            for (var d= 0; d < $dates.length; d++) {
              var $dateString = $dates[d]; // get full date string
              var $year = $dateString.slice(0,4); // get string of year - digits 1 to 4
              var $month = $dateString.slice(4,6); // get string of month - digits 5 and 6
              var $day = $dateString.slice(6,8); // get string of day - figits 7 and 8

              var $buildDate = $year + '-' + $month + '-' + $day; // build the date with hyphens for correct format to use moment.js

              var $momentDate = moment($buildDate).format('ddd Do MMM');

              buildHtml += '<p class="event-dates">' + $momentDate + '</p>';
            }

            if(objects[i].Hours) {
              buildHtml += '<p class="event-label">time</p>';
              buildHtml += '<p>' + $times + '</p>';
            }

            if(objects[i].Location) {
              buildHtml += '<p class="event-label">location</p>';
              buildHtml += '<p>Location: ' + $location + '</p>';
            }

            // end card inner
            buildHtml += '</div>';

          // end card HTML
          buildHtml += '</div>';
      }

      buildHtml += "</div>";
      $response.html(buildHtml);
    });
  }

  $(window).load(function() {
    ajaxRequest();
  });

  
})( jQuery );