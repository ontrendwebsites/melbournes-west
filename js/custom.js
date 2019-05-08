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
    
    // content containers
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
          // description
          var $description = objects[i].Description;

          // build the HTML
          buildHtml += '<div class="image-container" style="background-image: url(' + $imageClean + ');"></div>';
          
          // event card wrapper
          buildHtml += '<div class="event-card-inner">';

            if(objects[i].Description) {
              buildHtml += '<div class="hidden-description">';
              buildHtml += '<h3>' + $title + '</h3>';
              buildHtml += $description;
              buildHtml += '</div>';
            }

            // title and details popup link
            buildHtml += '<h3 class="inner-item">' + $title + '</h3>';
            buildHtml += '<a class="modal-link inner-item" href="#modal">View details <i class="fas fa-info-circle" aria-hidden="true"></i></a>';

            
            // Event link
            if(objects[i].BookingUrl) {
              buildHtml += '<a class="inner-item booking-link" href="' + objects[i].BookingUrl + '" target="_blank">Bookings <i class="fas fa-ticket" aria-hidden="true"></i></a></p>';
            }

            buildHtml += '<p class="event-label inner-item">dates</p>';

            for (var d= 0; d < $dates.length; d++) {
              var $dateString = $dates[d]; // get full date string
              var $year = $dateString.slice(0,4); // get string of year - digits 1 to 4
              var $month = $dateString.slice(4,6); // get string of month - digits 5 and 6
              var $day = $dateString.slice(6,8); // get string of day - figits 7 and 8
              var $buildDate = $year + '-' + $month + '-' + $day; // build the date with hyphens for correct format to use moment.js
              var $momentDate = moment($buildDate).format('ddd Do MMM'); // format the date

              buildHtml += '<p class="event-dates inner-item">' + $momentDate + '</p>';
            }

            if(objects[i].Hours) {
              buildHtml += '<p class="event-label inner-item">time</p>';
              buildHtml += '<p class="event-times inner-item">' + $times + '</p>';
            }

            if(objects[i].Location) {
              buildHtml += '<p class="event-label inner-item">location</p>';
              buildHtml += '<p class="event-location inner-item">' + $location + '</p>';
            }

            // end card inner
            buildHtml += '</div>';

          // end card HTML
          buildHtml += '</div>';

      } // end for loop

      buildHtml += "</div>";
      $response.html(buildHtml);

      // add description on modal click
      var $modalLink = $('.modal-link');
      var $modalContent = $('.remodal-content');
      var $eventDescription = $('.hidden-description');

      $modalLink.click(function() {
        console.log('clicked');

        // the description
        var $content = $(this).parents('.event-card-inner').children('.hidden-description').clone();
        $modalContent.html($content);
        if( $content.is(":visible") ) {
          $content.hide();
        } else {
          $content.show();
        }
      });
    });
  }

  $(window).load(function() {
    ajaxRequest();
  });
})( jQuery );