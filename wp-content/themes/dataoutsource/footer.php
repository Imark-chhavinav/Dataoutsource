<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>
  <footer>
  <div class="container">
  <div class="row">
  <div class="col-md-6 btm-list">
  <ul>
  <?php 
		
			$menu = wp_get_nav_menu_object("footer-menu" );
			$menu_items = wp_get_nav_menu_items($menu->term_id);
			
			$dropdown = [];
			$li = [];
			foreach($menu_items as $keys):
			 
				if($keys->menu_item_parent != 0)
				{
					$li[] = array($keys->url,$keys->title);
					$dropdown[$keys->menu_item_parent] = $li;				
				}
			endforeach; 
		
			 foreach($menu_items as $keys):
				$ID = $keys->ID;
				if($keys->menu_item_parent == 0 && !array_key_exists($ID,$dropdown))
				{	
					echo '<li> <a href="'.$keys->url.'"> '.$keys->title.' </a> </li>';			
				}
				elseif($keys->menu_item_parent == 0 && array_key_exists($ID,$dropdown)	)
				{
					echo'<li class="dropdown"> 
						<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">'.$keys->title.'</a>
						 <ul class="dropdown-menu">';
						foreach($dropdown["$ID"] as $valu)
						{
							echo '<li><a href="'.$valu[0].'">'.$valu[1].'</a></li>';						
						}
					echo'</ul>
					</li>';
				}
			endforeach;  
		?>	
  </ul>
  
  
  
  </div>
  
  <div class="col-md-3 social-icons">
  
  <ul>
  
  <li><a href="<?php echo the_field('facebook_link','option'); ?>"><i class="fa fa-facebook" aria-hidden="true"></i><span>Facebook</span></a></li>
  <li><a href="<?php echo the_field('twitter_link','option'); ?>"><i class="fa fa-twitter" aria-hidden="true"></i><span>Twitter</span></a></li>
    <li><a href="<?php echo the_field('linkedin_link','option'); ?>"><i class="fa fa-linkedin" aria-hidden="true"></i><span>Linkedin</span></a></li>
  </ul>
  
  
  </div>
  </div>
  
 
  </div>
 
   <div class="small-fotr">
    <div class="container">
   <div class="row">
  <ul>
  <li>Copyright© <?php echo date('Y'); ?> dataoutsource All rights reserved.<span class="small-line">|</span></li>
  <li>Powered By -<a href="https://www.imarkinfotech.com" target="_blank"> iMark Infotech</a></li>
  </ul>
  </div>
  </div>
  </div>

  </footer>
   
   
   
      
    
   <!-- register Modal -->
<div class="modal fade" id="Register" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 47.971 47.971" >
<g>
	<path d="M28.228,23.986L47.092,5.122c1.172-1.171,1.172-3.071,0-4.242c-1.172-1.172-3.07-1.172-4.242,0L23.986,19.744L5.121,0.88   c-1.172-1.172-3.07-1.172-4.242,0c-1.172,1.171-1.172,3.071,0,4.242l18.865,18.864L0.879,42.85c-1.172,1.171-1.172,3.071,0,4.242   C1.465,47.677,2.233,47.97,3,47.97s1.535-0.293,2.121-0.879l18.865-18.864L42.85,47.091c0.586,0.586,1.354,0.879,2.121,0.879   s1.535-0.293,2.121-0.879c1.172-1.171,1.172-3.071,0-4.242L28.228,23.986z" fill="#FFFFFF"/>
</g>

</svg></span></button>
        <h4 class="modal-title" >Register</h4>
      </div>
      <div class="modal-body loginpopup">
		<?php echo do_shortcode('[CS_TicketRegister]'); ?>
      </div>     
    </div>
  </div>
</div>
   
   
   
   
   
   <!--Register Modal End-->
   
   
   
   
   
   
   
   
   
   <!-- Login Modal -->
<div class="modal fade" id="Login" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">

<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 47.971 47.971" >
<g>
	<path d="M28.228,23.986L47.092,5.122c1.172-1.171,1.172-3.071,0-4.242c-1.172-1.172-3.07-1.172-4.242,0L23.986,19.744L5.121,0.88   c-1.172-1.172-3.07-1.172-4.242,0c-1.172,1.171-1.172,3.071,0,4.242l18.865,18.864L0.879,42.85c-1.172,1.171-1.172,3.071,0,4.242   C1.465,47.677,2.233,47.97,3,47.97s1.535-0.293,2.121-0.879l18.865-18.864L42.85,47.091c0.586,0.586,1.354,0.879,2.121,0.879   s1.535-0.293,2.121-0.879c1.172-1.171,1.172-3.071,0-4.242L28.228,23.986z" fill="#FFFFFF"/>
</g>

</svg>


</span></button>
        <h4 class="modal-title" >Login</h4>
      </div>
      <div class="modal-body loginpopup">
 <?php echo do_shortcode('[CS_LOGINFORM]'); ?>

      </div>
     
    </div>
  </div>
</div> 
<?php wp_footer(); ?>.
  </body>
</html>