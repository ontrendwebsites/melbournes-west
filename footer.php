<?php  global $brad_data;?>

<?php if($brad_data['check_footerwidgets']){	?>
<footer id="footer">
  <div class="container">
    <div class="row-fluid">
      <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Widgets')) : ?>
      <?php endif; ?>
    </div>
  </div>
</footer>
<?php } ?>


  <?php if( $brad_data['layout'] == 'boxed') { ?>
  </div>
  <!-- End Boxed Layout -->
  <?php  } ?>
   
<?php wp_footer(); ?>
<!-- End footer -->
</body>
</html>