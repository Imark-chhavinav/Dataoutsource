<?php
/**
 * Template Name: Blog Page
 *
 * @package DataOutSource
 * @subpackage Imark 
 */
get_header();?>
	<div class="uprdiv inr-bnnr" style="background-image:url('<?php echo get_the_post_thumbnail_url(null,'full'); ?>');">  
			<p><?php the_title(); ?></p>
	</div> 
	<section class="aboutpage ourblog">
		<div class="container">	
			<ul class="nav nav-tabs">
			  <li class="active"><a data-toggle="tab" href="#home">Blog</a></li>
			  <li><a data-toggle="tab" href="#menu1">KB Articles</a></li>			
			</ul>

			<div class="tab-content">
			  <div id="home" class="tab-pane fade in active">
			    <?php
		global $post , $wpdb;		
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
							
		$args = array( 'order' => 'ASC', 'post_type' => 'post','paged' => $paged,'category__not_in' => '4' ); 
		$my_query = new WP_Query( $args ); 		?>
<?php	while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
		<div class="row ">
			<div class="col-md-6 blog-img">
				<img src="<?php echo get_the_post_thumbnail_url(null,'full'); ?>" alt="<?php the_title(); ?>"/>
			</div>
			<div class="col-md-6 blogtext">
				<h2><?php the_title(); ?></h2>
				<?php the_excerpt(); ?>
				<div class="socialicons">
					<ul>
					<li><a href="#" target="_blank" ><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
					<li><a href="#" target="_blank" ><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					<li><a href="#" target="_blank" ><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
					</ul>
				</div>
				<a href="<?php the_permalink(); ?>" class="btn-border" >View detail</a>
			</div>
		</div>
		<?php if ( $wp_query->max_num_pages > 1 ) : ?>
						
						<div class="paginate">
                          <?php $my_pages=my_pagination();
						  ?>					 						  
						        <ul>									
									<?php foreach($my_pages as $my_page)
									{?>
										<li class=""><?php echo $my_page;?></li>
									<?php
									}?>
							   </ul>
						</div>
							<?php endif; ?>			
<?php	endwhile; ?>

			
			
				<?php wp_reset_query(); ?>
			  </div>
			  <div id="menu1" class="tab-pane fade">
			    <?php
		global $post , $wpdb;		
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
							
		$args = array( 'order' => 'ASC', 'post_type' => 'post','paged' => $paged,'cat' => '4' ); 
		$my_query = new WP_Query( $args ); 		?>
<?php	while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
		<div class="row ">
			<div class="col-md-6 blog-img">
				<img src="<?php echo get_the_post_thumbnail_url(null,'full'); ?>" alt="<?php the_title(); ?>"/>
			</div>
			<div class="col-md-6 blogtext">
				<h2><?php the_title(); ?></h2>
				<?php the_excerpt(); ?>
				<div class="socialicons">
					<ul>
					<li><a href="#" target="_blank" ><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
					<li><a href="#" target="_blank" ><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					<li><a href="#" target="_blank" ><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
					</ul>
				</div>
				<a href="<?php the_permalink(); ?>" class="btn-border" >View detail</a>
			</div>
		</div>
		<?php if ( $wp_query->max_num_pages > 1 ) : ?>
						
						<div class="paginate">
                          <?php $my_pages=my_pagination();
						  ?>					 						  
						        <ul>									
									<?php foreach($my_pages as $my_page)
									{?>
										<li class=""><?php echo $my_page;?></li>
									<?php
									}?>
							   </ul>
						</div>
							<?php endif; ?>			
<?php	endwhile; ?>

			
			
				<?php wp_reset_query(); ?>
			  </div>			 
			</div>






		
		</div>
	</section>
<?php get_footer(); ?>