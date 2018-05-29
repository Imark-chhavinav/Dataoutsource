<?php
/* Template Name: Market Material */  ?>

<?php get_header('Dashboard'); 	?>
<?php while ( have_posts() ) : the_post(); 	$fields = get_fields(); //print_R($fields); ?> 
 <div class="main">
        <div class="container-fluid">
            <div class="heading">
                <h2><?php the_title(); ?></h2> </div>
           
            <div class="row market-material-outer">
			<?php 
			
			$args = array('post_type'=> 'marketingmaterial');            
			$the_query = new WP_Query( $args );
			if($the_query->have_posts() ) : 
			while ( $the_query->have_posts() ) : $the_query->the_post(); 
			$fields = get_fields();				
			
			?>
				 <div class="col-md-4">
                    <div class="market-material-cover">
                        <figure style="background-image:url('<?php echo get_template_directory_uri() ?>/Dashboard/images/mm-img.jpg');">
                            
                        </figure>
                        <h4><?php the_title(); ?></h4>
                        <a href="<?php echo $fields['marketing_add_new_marketing_file']['url']; ?>" target="_blank" class="green-btn">download</a>
                    </div>
                </div>
			
		<?php 	endwhile;	endif;	?>
			
                
            </div>
        
        </div>
        
    </div>

<?php endwhile; ?>
<?php get_footer('Dashboard'); ?>