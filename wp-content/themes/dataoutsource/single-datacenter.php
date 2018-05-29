<?php
/**
 * The Data Center Custom Post template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<?php	while ( have_posts() ) : the_post(); ?>
<div class="uprdiv inr-bnnr" style="background-image:url('<?php echo get_the_post_thumbnail_url(null,'full'); ?>');">  
		<p><?php the_title(); ?></p>
</div> 
<section class="aboutpage">
	<div class="container">
		<div class="row">
			<div class="col-md-12 abouttext">
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</div>			
		</div>
	</div>
</section>
<?php endwhile; ?> 
<?php get_footer(); ?>