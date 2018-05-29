   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
    <!-- Include all compiled plugins (below), or include individual files as needed -->   
<script src="https://cdn.jsdelivr.net/jquery.mcustomscrollbar/3.0.6/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php echo get_template_directory_uri() ?>/theme/js/custom.js"></script>
<script>
    (function($){
        $(window).on("load",function(){
            $(".chat_ajax_cover").mCustomScrollbar({
    axis:"y"
});
        });
    })(jQuery);
	
	 jQuery(function($) {
     var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
     $('.menu-area ul > li a').each(function() {
      if (this.href === path) {
       $(this).parent('li').addClass('active');
      }
     });
    });
	
</script>
	<script type="text/javascript">
   // var jQuery_1_7_0 = $.noConflict(true);  // <- this
</script>
	<?php wp_footer(); ?>
</body>

</html>