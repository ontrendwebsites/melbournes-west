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
  $(document).ready(function() {

    // the test api click function
    $('.test-api').click(function() {
      ajaxRequestv2();
    });

      // AJAX function 1
    function ajaxRequestv1() {
      console.log('ajax clicked');

      var $response = document.getElementsByClassName('response'); // the div where AJAX content will be displayed
      var xhr = new XMLHttpRequest(); // new request named: xhr

      xhr.onreadystatechange = function() {
        
        if (xhr.readystate === 4) { // ready state of 4 = got response back from server
          console.log('ajaxing...');
          $response.innerHTML = xhr.responseText;
        }

        xhr.open('GET', 'https://wmt.everi.com.au/feed?page=1&access_token=f0e38e70b8cd4efab644a5046b546edb');// open the request
        xhr.send();
      }; // close onreadystatechange
    } // close the function
  

    function ajaxRequestv2() {
      var $response = $('.response');
    
      var settings = {
        "async": true,
        "crossDomain": true,
        "url": "https://wmt.everi.com.au/feed?page=1&access_token=f0e38e70b8cd4efab644a5046b546edb",
        "method": "GET"
      }
    
      $.ajax(settings).done(function (serverData) {
          //console.log(serverData);
          
          var responseString = JSON.stringify(serverData);
          var responseParse = JSON.parse(responseString);

          //console.log(responseString);
          //console.log(responseParse);

          // store json into a variable
          var storedJson = serverData;

          // shows first title
          /*
          var titles = serverData.data[0].Title;
          console.log(titles);
          $response.html(titles);
          */

          // show all titles
          var objects = serverData.data;
          var buildHtml = "";
          for (var i= 0; i < objects.length; i++) {
            buildHtml += '<h4>' + objects[i].Title + '</h4>';
          }

          $response.html(buildHtml);





          //$response.html(responseString);
      });
    }
  
  
  

    
  
  });
  
  
  
})( jQuery );