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
  function ajaxRequestv2() {
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
      
      // store json into a variable
      var storedJson = serverData;

      // show all titles
      var objects = serverData.data;

      var buildHtml = "";
      for (var i= 0; i < objects.length; i++) {
        // vars
        var $title = objects[i].Title;    // title
        var $image = JSON.stringify(objects[i].Images[0].Url);   // title
        var $location = objects[i].Location;

        if(objects[i].Dates[0]) {
          var $date1 = objects[i].Dates[0];
          var $date1text = Date($date1.slice(0,4), $date1.slice(4,6), $date1.slice(6,8));
        }

        if(objects[i].Dates[1]) {
          var $date2 = objects[i].Dates[0];
          var $date2text = Date($date2.slice(0,4), $date2.slice(4,6), $date2.slice(6,8));
        }


        
        
        // build the HTML
        buildHtml += '<h4>' + $title + '</h4>';
        buildHtml += '<p>Date 1: ' + $date1text + '</p>';
        if($date2text) {
          buildHtml += '<p>Date 2: ' + $date2text + '</p>';
        }
        buildHtml += '<p>Location: ' + $location + '</p>';
        buildHtml += '<img src=' + ($image) + ' />';

        // image
        if(objects[i].BookingUrl) {
          buildHtml += '<p><a href="' + objects[i].BookingUrl + '" target="_blank">Event link</a></p>';
        }
      }

      $response.html(buildHtml);

    });
  }

  $(window).load(function() {
    ajaxRequestv2();
  });

  
})( jQuery );