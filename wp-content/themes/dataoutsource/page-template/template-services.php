<?php
/**
 * Template Name: Services
 *
 * @package DataOutSource
 * @subpackage Imark 
 */
get_header();?>
<div class="uprdiv inr-bnnr" style="background-image:url('<?php echo get_the_post_thumbnail_url(null,'full'); ?>');">  
	<p><?php the_title(); ?></p>
</div>  

	
<div class="support-formdiv ">
  <div class="container">
    <div class="row">
      <div class="col-md-12 services-tab">
        <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
          <ul class="nav nav-tabs" id="myTabs" role="tablist">
		  <?php 
			
			$args = array( 'posts_per_page' => -1, 'order' => 'ASC', 'post_type' => 'services' ); 
			$my_query = new WP_Query( $args );
			$y = 1;
			if ( $my_query->have_posts() ) : 
			   while ( $my_query->have_posts() ) : $my_query->the_post(); 
			   $title = get_the_title();
			   if($_GET["active"])
			   {
				    if($_GET["active"] == $y)
				   {
					   echo'<li role="presentation" class="active"><a  href="#'.$y.'" id="'.$y.'-tab" role="tab" data-toggle="tab" aria-controls="'.$y.'" aria-expanded="true">'.$title.'</a></li>';
				   }
				   else
				   {
					   echo'<li role="presentation" class=""><a href="#'.$y.'" role="tab" id="'.$y.'-tab" data-toggle="tab" aria-controls="'.$y.'" aria-expanded="false">'.$title.'</a></li>';
				   } 
			   }else
			   {
				   if($y == 1)
				   {
					   echo'<li role="presentation" class="active"><a  href="#'.$y.'" id="'.$y.'-tab" role="tab" data-toggle="tab" aria-controls="'.$y.'" aria-expanded="true">'.$title.'</a></li>';
				   }
				   else
				   {
					   echo'<li role="presentation" class=""><a href="#'.$y.'" role="tab" id="'.$y.'-tab" data-toggle="tab" aria-controls="'.$y.'" aria-expanded="false">'.$title.'</a></li>';
				   } 
			   }
			  
				$y++;
			   endwhile; 
			endif;
			wp_reset_query();
			?>
           
          </ul>
          <div class="tab-content " id="myTabContent">
			<?php			
			$my_query2 = new WP_Query( $args );	

			$x = 1;   ?>
			<?php	while ( $my_query->have_posts() ) : $my_query->the_post();  ?>
            <div class="tab-pane fade <?php  if(isset($_GET["active"])){ if($_GET["active"] == $x){	echo "active in";	} }else{ if($x == 1){	echo "active in";	} } ?> " role="tabpanel" id="<?php echo $x; ?>" aria-labelledby="<?php echo $x; ?>-tab">
              <div class="col-md-7 ">
                <div class="plaintext-left">
                  <h1>  <?php the_title(); ?> </h1>
                  <?php the_content(); ?>
                </div>
              </div>
              <div class="col-md-5 right-spc1">
                <div class="get-quote-div">
                  <h2>Get a quote</h2>
                  <div class="quote-form">
                   <?php echo do_shortcode('[contact-form-7 id="73" title="Get a quote"]'); ?>
                  </div>
                </div>
              </div>
            </div>
			<?php $x++;  endwhile; 	wp_reset_query(); ?>
		   </div>
        </div>
      </div>
    </div>
  </div>
</div>

 
<?php get_footer(); ?>