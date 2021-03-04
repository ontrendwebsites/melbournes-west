<?php 
   $cat = get_query_var('category');
   if( empty( $cat )) {
      $cat = 'default';
   } else {
      $cat = esc_html($cat);
   }
?>
<form method="post" action="#" name="adminForm" id="adminForm">
   <div class="businessdirectory__search">
      <div class="container">
         <div id="gadget__search" class="search-gadget BE row accomTab">
            <div class="rs_categories col-xs-12 col-sm-3 col-md-3 gadget__search-column gadget__search-column-select">
               <div class="row">
                  <label class="col-xs-12" style="max-width:100%">&nbsp;</label>
                  <div class="col-xs-12">
                     <span style="display: block;" class="input">
                        <select id="filter_from" name="filter_from[]" size="1">
                           <option value="default">All Events</option>
                           <?php
                              $categories = get_categories( array(
                                  'orderby' => 'term_order',    
                                  'taxonomy' => 'tribe_events_cat',
                                  'hide_empty' => false
                              ) );
                              foreach( $categories as $category ) {
                                 if($category->slug == $cat) {
                                    echo '<option value="'.$category->slug.'" selected >'.$category->name.'</option>';                 
                                 } else {
                                    echo '<option value="'.$category->slug.'" >'.$category->name.'</option>';              
                                 }
                                 
                              } 
                           ?> 
                        </select>     

                     </span>
                  </div>
               </div>
            </div>
            <div class="rs_categories col-xs-12 col-sm-3 col-md-3 gadget__search-column gadget__search-column-select">
               <div class="row">
                  <label class="col-xs-12">&nbsp;</label>
                  <div class="col-xs-12">
                     <span style="display: block;" class="input">
                        <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%">
                           <i class="fa fa-calendar"></i>&nbsp;
                           <span class="date-range">All Dates</span>
                           <input type="hidden" id="dateRange" name="dateEnd" value="">
                           <input type="hidden" id="dateStart" name="dateStart" value="">
                           <input type="hidden" id="dateEnd" name="dateEnd" value="">
                        </div>
                     </span>
                  </div>
               </div>
            </div>
            <div class="bd_keywords col-xs-12 col-sm-3 col-md-3 gadget__search-column gadget__search-column-select gadget__search-column-border">
               <div class="row">
                  <label class="col-xs-12">&nbsp;</label>
                  <div class="col-xs-12">
                     <span style="display: block;" class="input">
                           <?php
                           $field = get_field_object('search_location');
                           if( $field['choices'] ): ?>
                           <select id="filter_from_location" name="filter_from_location[]" size="1">
                                 <option value="default">All Locations</option>   
                                   <?php foreach( $field['choices'] as $value => $label ):
                                       $arr = explode(",", $value);
                                       echo '<option value="'.strtolower(clean($arr[0])).'">'.$arr[0].'</option>';
                                    endforeach; ?>
                           </select>
                           <?php endif; ?>
                              
                     </span>
                  </div>
               </div>
            </div>
            <div class="bd_keywords col-xs-12 col-sm-3 col-md-3 gadget__search-column gadget__search-column-select gadget__search-column-border">
               <div class="row">
                  <label class="col-xs-12">&nbsp;</label>
                  <div class="col-xs-12">
                     <input type="text" name="search[]" id="operator_keyword" placeholder="Filter by Title" value="" size="30">
                  </div>
               </div>
            </div>
            <input type="hidden" name="rs_clear" id="rs_clear" value="0">
            <input type="hidden" name="rs_remove" id="rs_remove" value="">
         </div>
      </div>
   </div>
</form>


