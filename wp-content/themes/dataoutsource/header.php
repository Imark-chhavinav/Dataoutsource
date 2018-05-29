<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header>  
    <div class="main-menu">
		<span><a href="#" class="closeicon"><i class="fa fa-close" aria-hidden="true"></i></a></span>
		<ul>	
		<?php 
		
			$menu = wp_get_nav_menu_object("header-menu" );
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
 
    <div class="top-header">
		<div class="left-div">
		<?php
		/* Get Website Logo		*/
		$logo = get_field('website_logo','option');		
		$email = get_field('website_email_address','option');		
		$contactnumber = get_field('website_contact_number','option');		
		
		?>
			<a href="<?php echo site_url(); ?>"><img alt="<?php echo $logo['alt']; ?>" src="<?php echo $logo['url']; ?>" alt=""/></a>
		</div>
		<div class="ryt-div" >
			<ul>
				<li>
					 <a href="mailto:<?php echo trim($email); ?>">
					 <i class="fa fa-envelope" aria-hidden="true"></i><?php echo $email; ?>
					 </a><span>|</span>
				</li>
				<li>
				  <a href="tel:<?php echo str_replace(" ","",$contactnumber); ?>">
				  <i class="fa fa-phone" aria-hidden="true"></i><?php echo $contactnumber; ?>
				  </a><span>|</span>
				</li>
				<!--<li class="slash">
				   <a href="#" class="spc-ryt" data-toggle="modal" data-target="#Login">Log In </a>/
				   <a href="#" class="spc-left" data-toggle="modal" data-target="#Register"> Register</a>
				</li>-->
				<li class="request">
					<a href="#" id="menu"><i class="fa fa-bars" aria-hidden="true"></i></a>
				</li>
			</ul>		 
		</div>
	</div>
</header>
   