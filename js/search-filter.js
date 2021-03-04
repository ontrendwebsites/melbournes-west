jQuery(document).ready(function($) {
    var title, location, datetime = [];
    var category="Banana",
        container = $('.category-events-page .items__container .list-events'),
        event_item = $('.category-events-page .items__container .list-events .item-event'),
        categorydefault = $(".category-name"),
        operator_category = $("#filter_from"), 
        date_start = $("#dateStart"), 
        date_end = $("#dateEnd"), 
        operator_keyword = $("#operator_keyword"), 
        filter_from_location = $("#filter_from_location"),
        nextPage = 1;

    
    jQuery(document).on('change', '#filter_from', function () { 
        category = $( this ).val();
        datetime[0] = date_start.val();
        datetime[1] = date_end.val();
        title = operator_keyword.val();
        location = filter_from_location.val();
        changeurl(category);
        return ajaxCallBack(category, datetime, title, location);
        
    });

    jQuery(document).on('change', '#filter_from_location', function () { 
        category = operator_category.val();
        datetime[0] = date_start.val();
        datetime[1] = date_end.val();
        title = operator_keyword.val();
        location = $( this ).val();
        //nextPage = $('#loadMore').attr('data-pagenum');
        return ajaxCallBack(category, datetime, title, location);
    });


    jQuery(document).on('change', '#operator_keyword', function (e) {
        category = operator_category.val();
        datetime[0] = date_start.val();
        datetime[1] = date_end.val();
        title = $( this ).val();
        location = filter_from_location.val();
        return ajaxCallBack(category, datetime, title, location);                
    });

    jQuery(document).on('keypress', '#operator_keyword', function (e) {
        if(e.keyCode == 13) {
          e.preventDefault();
          operator_category.focus();
          return false;
        }
    });

    jQuery(document).on('change', '#dateRange', function () {
        var dateRange = $( this ).val();
        var arr =  dateRange.split(" ");
        
         category = operator_category.val();
         datetime[0] = arr[0];
         datetime[1] = arr[1];
         title = operator_keyword.val();
         location = filter_from_location.val();
         //nextPage = $('#loadMore').attr('data-pagenum');
         return ajaxCallBack(category, datetime, title, location); 
        
    });


    jQuery(document).on('click', '#loadMore', function (e) {
        e.preventDefault(); 
        category = operator_category.val();        
        datetime[0] = date_start.val();
        datetime[1] = date_end.val();
        title = operator_keyword.val();
        location = filter_from_location.val();
        nextPage = $(this).attr('data-pagenum');
        loadmore_ajaxCallBack(category, datetime, title, location, parseInt(nextPage));
        $(this).parent().remove();
    });

    jQuery(document).on('click', '#clearSearch', function (e) {
        e.preventDefault();         
        filter_from_location.prop('selectedIndex',0);
        $('#dateRange').val("");
        $('.date-range').text('All Dates');
        datetime[0] = date_start.val("");
        datetime[1] = date_end.val("");
        title = operator_keyword.val("");

        setTimeout(function(){ 
          category = operator_category.val();        
          datetime[0] = date_start.val();
          datetime[1] = date_end.val();
          title = operator_keyword.val();
          location = filter_from_location.val();

         
          changeurl(category);
          ajaxCallBack(category, datetime, title, location); 

        }, 100);
    });

    function ajaxCallBack(category, datetime, title, location) {
        
        $.ajax({
            url: ajax_obj.ajaxurl, // or example_ajax_obj.ajaxurl if using on frontend
            data: {
                'action': 'search_ajax_request',
                'category' : category,
                'datetime' : datetime,
                'title' : title,
                'location' : location
            },
            dataType: "json",
            beforeSend : function() { // traitements JS à faire AVANT l'envoi
                $(container).html('<div class="col-xs-12 ajaxLoader-inner text-center fa-3x"><img src="http://melbourneswest.com.au/wp-content/uploads/2020/02/ajax-loader.gif" alt="Loading..."/></div>');
                $("#loadMore, .numberEvents").css({"opacity": 0, "cursor": "default"});   // add a gif loader  
                //die();
            },
            success:function(data) {
                container.html(data.html);
                $('.numberEvents').text('(' + data.total + ')');
                $('.ajaxLoader-inner').fadeOut('slow').delay(2000); 
                $("#loadMore, .numberEvents").css('opacity', 1);  
                $('.category-name').html(data.category);
                
            },
            error: function(errorThrown){
                console.log(errorThrown);
                $('.ajaxLoader-inner').fadeOut(); 
            }
        });  
    }


    function loadmore_ajaxCallBack(category, datetime, title, location, nextPage) {
        var button = $('#loadMore');
        
        //console.log(nextPage);
        $.ajax({
            url: ajax_obj.ajaxurl, // or example_ajax_obj.ajaxurl if using on frontend
            data: {
                'action': 'search_ajax_request',
                'category' : category,
                'datetime' : datetime,
                'title' : title,
                'location' : location,
                'current': nextPage
            },
            dataType: "json",
            beforeSend : function() { 
                   $('.loadmore_content').html('<div class="col-xs-12 ajaxLoader-inner text-center fa-3x"><img src="http://melbourneswest.com.au/wp-content/uploads/2020/02/ajax-loader.gif" alt="Loading..."/></div>');
            },
            success:function(data) {
                $('.ajaxLoader-inner').fadeOut('slow').delay(2000); 
                $('.loadmore_content').remove();
                if(data) {
                    $('.item-event:last').after(data.html);
                    $("#loadMore").attr("data-pagenum", nextPage + 1);
                    if(data.html =='') {
                      $("#loadMore").remove();  
                    }
                } else{   
                    $("#loadMore").remove();
                }
            },
            error: function(errorThrown){
                console.log(errorThrown);
                $('.ajaxLoader-inner').fadeOut(); 
            }
        });  
    }


    function changeurl(url) {
      var new_url="http://melbourneswest.com.au/category-events/?category="+ url;
      window.history.pushState("data","Title",new_url);
      //document.title=url;
    }

});
