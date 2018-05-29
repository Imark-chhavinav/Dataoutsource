<?php
/**
 * Template Name: FAQ's
 *
 * @package DataOutSource
 * @subpackage Imark 
 */
get_header();?>
<?php	while ( have_posts() ) : the_post(); ?>
	<div class="uprdiv inr-bnnr" style="background-image:url('<?php echo get_the_post_thumbnail_url(null,'full'); ?>');">
		<p><?php the_title(); ?></p>
	</div> 
	
<div class="support-formdiv ">
<div class="container">
<div class="row">
<div class="col-md-9 col-sm-8 Faq">


<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
<?php 
					$faq = get_field('question_with_answer'); 
					 
					$x = 1;
					foreach($faq as $keys):
						echo'<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading'.$x.'">
								 <h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse'.$x.'" aria-expanded="true"  aria-controls="collapseOne">
							'.$keys["faq_question"].'	
							</a>
						  </h4>

							</div>';
							if($x==1)
							{
								echo'<div id="collapse'.$x.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading'.$x.'">';
							}
							else
							{
								echo'<div id="collapse'.$x.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$x.'">';
							}							
								echo'<div class="panel-body">'.wpautop($keys["faq_answers"]).'</div>
							</div>
						</div>';
					$x++;
					endforeach;
?>    
</div>


  
  </div>
  
  <!--<div class="col-md-3 col-sm-4">
  <div class="recent-questions">
  <h2>Recent questions</h2>
  <div class="question-div">
  
  <ul>
  <li><a href="#">Lorem ipsum dolor sit amet, consectetur.</a></li>
    <li><a href="#">Lorem ipsum dolor sit amet, consectetur.</a></li>
      <li><a href="#">Lorem ipsum dolor sit amet, consectetur.</a></li>
        <li><a href="#">Lorem ipsum dolor sit amet, consectetur.</a></li>
  
  </ul>
  
  
  </div>
   
   
   
    
     
      </div>
  
  
  
  </div>-->

</div>


</div>


</div>


<?php endwhile; ?> 
<?php get_footer(); ?>