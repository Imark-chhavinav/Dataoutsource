<?php
/**
 * Template Name: About Us
 *
 * @package DataOutSource
 * @subpackage Imark 
 */
get_header();?>
<?php	while ( have_posts() ) : the_post(); ?>
<?php	//Vimeo Video
		$link = get_field('about_vimeo_link');
		if(!empty($link))
		{
			$video = vimeo_video($link);
		}		
?>
	<div class="uprdiv inr-bnnr" style="background-image:url('<?php echo get_the_post_thumbnail_url(null,'full'); ?>');">  
		<p><?php the_title(); ?></p>
	</div> 
   
<section class="aboutpage">
	<div class="container">
		<div class="row">
			<div class="col-md-6 abouttext">
				<?php the_content(); ?>
			</div>
			<div class="col-md-6 " >
<?php  
			if(isset($video) && empty($video))
			{
				echo'<div class="aboutvideo" style="background:url();">
					<div class="out-part">
					<span><a href="#"><i class="fa fa-play" aria-hidden="true"></i></a></span>
					</div>
				</div>';						
			}
		else
			{
				echo'<div class="aboutvideo" style="background:url('.$video->thumbnail_url.');">
					<div class="out-part">
					<span><a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-play" aria-hidden="true"></i></a></span>
					</div>
				</div>';
			}			
?>
				
			</div>
		</div>
	</div>
</section>

<?php endwhile; ?> 
<?php get_footer(); ?>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">    
	<?php echo html_entity_decode($video->html) ?>	           
    </div>
  </div>
</div>