<?php	/* Template Name: Web Site Access */  ?>

<?php get_header('Dashboard'); 	?>
<?php while ( have_posts() ) : the_post(); 	$fields = get_fields(); //print_R($fields); ?> 
  <div class="main">
        <div class="container-fluid">
            <div class="heading">
                <h2><?php the_title(); ?></h2> 
			</div>            
        </div>
        <div class="custom-table">
            <table>
                <tr>                    
                    <th>Portal</th>
                    <th>Website url's  </th>
                    <th>Info</th>                  
                </tr>
   
				<?php foreach($fields['website_access_details'] as $keys): ?>	
					 <tr>
						<td><?php echo $keys['portal']; ?></td>
						<td><a href="<?php echo $keys['website_urls']; ?>" target="_blank"><?php echo preg_replace('#^https?://#', '',$keys['website_urls']); ?></a> </td>
						<td class="infoData"><a href="#"><i class="fa fa-question-circle" aria-hidden="true"></i></a></td>     
					</tr>				
				<?php endforeach;  ?>				          
            </table>			
        </div>
    </div>
<?php endwhile; ?>
<?php get_footer('Dashboard'); ?> 
<script>
jQuery(document).ready(function(){
	//jQuery("[data-toggle=tooltip]").tooltip();
//jQuery('.btn').popover('show')	
})
</script>