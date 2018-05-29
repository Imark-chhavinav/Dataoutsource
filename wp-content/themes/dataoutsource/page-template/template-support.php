<?php
/**
 * Template Name: Support
 *
 * @package DataOutSource
 * @subpackage Imark 
 */
get_header();?>
<?php	while ( have_posts() ) : the_post(); ?>
<div class="uprdiv inr-bnnr" style="background-image:url('<?php echo get_the_post_thumbnail_url(null,'full'); ?>');">  
	<p><?php the_title(); ?></p>
</div> 

<section class="aboutpage  supportpage">
	<div class="container">
		<div class="row ">
			<div class="head-part">
				<?php  the_content();  ?>
			</div>
		<?php	$issues = get_field("support_issues"); 
				foreach($issues as $keys):
				$svg = get_svgIcons($keys["support_issues_title"]);
				
					echo '<div class="col-md-4">
						<div class="outer-suuport">
							<div class="inner-support">
							'.$svg.'
								<h3>'.$keys["support_issues_title"].'</h3>
								'.wpautop($keys["support_issues_content"]).'
							</div>
						</div>
					</div>';
				endforeach;
		
		?>		
		</div>
	</div>
</section>


 

<div class="support-formdiv">
<div class="container">
<div class="row">
<form>
<div class="col-md-10 col-md-offset-1 support-form ">
<h3>submit your Request</h3>

  <div class="form-group">
    <label >Name</label>
    <input type="text" class="form-control"  placeholder="Name">
  </div>
  <div class="form-group">
    <label >Email</label>
    <input type="text" class="form-control"  placeholder="Email">
  </div>
   <div class="form-group lastgroup">
    <label >Phone</label>
    <input type="text" class="form-control"  placeholder="Phone">
  </div>
 <div class="form-group">
    <label >Description of Request</label>
   <textarea class="form-control"></textarea>
  </div>

 


</div>
  <div class="cntr-aligned col-md-10 col-md-offset-1 ">
   <button type="submit" class="btn btn-default">Submit</button>
  </div>
  </form>
</div>


</div></div>
<?php endwhile; ?>


   
<?php get_footer(); ?>