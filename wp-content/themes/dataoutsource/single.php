<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<div class="uprdiv inr-bnnr" style="background-image:url('<?php echo get_the_post_thumbnail_url(null,'full'); ?>');">  
		<p>BLOG</p>
</div>
	
<?php while ( have_posts() ) : the_post();?>
	 	
	<section class="aboutpage ourblog ">
		<div class="container">
			<div class="row">
				<div class="col-md-12 blogtext blog-detail blog-cls">					
					<div class="outer-block">
					<img class="pull-right" src="<?php echo get_the_post_thumbnail_url(null,'full'); ?>" alt="<?php the_title(); ?>"/>
						<h2><?php the_title(); ?></h2>
						<?php the_content(); ?>
					</div>
					<div class="socialicons">
						<ul>
							<li><a href="#" target="_blank" ><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="#" target="_blank" ><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<li><a href="#" target="_blank" ><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
						</ul>
					</div>
					<a href="<?php echo site_url("blog"); ?>" class="btn-border" >Back to Blog</a>		
				</div>
			</div>
		</div>
	</section>
<?php endwhile; // End of the loop.?>
<?php get_footer(); ?>