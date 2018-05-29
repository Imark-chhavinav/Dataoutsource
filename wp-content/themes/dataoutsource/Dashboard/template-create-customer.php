<?php
/* Template Name: Create Customer  */  ?>

<?php get_header('Dashboard'); 	?>
<link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

<?php while ( have_posts() ) : the_post(); 	$fields = get_fields(); //print_R($fields); ?> 
  <div class="main">
        <div class="container-fluid">
            <div class="heading">
                <h2>create customer</h2> </div>
            <div class="row">
                <div class="col-md-6">
				<form id="reseller_customer">
                    <div class="custom-form">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="cs_name" class="form-control" placeholder="Name"> </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="cs_email" class="form-control" placeholder="Email"> </div>
							<?php wp_nonce_field('cs_new_user','cs_new_user_nonce', true, true );  ?>
                        <div class="form-group">
                            <label>Company</label>
                            <input type="text" name="cs_company" class="form-control" placeholder="Company Name"> 
                            <input type="hidden" name="cs_account" class="form-control" value="cs_reseller_customer" placeholder="Company Name"> 
                            <input type="hidden" name="_user_parent_admin" class="form-control" value="<?php echo get_current_user_id(); ?>" placeholder="Company Name"> 
							</div>
                        <div class="text-left">
                            <input type="submit" id="cs_resellercreate_btn" class="form-submit-btn" value="create customer"> </div>
                    </div>
				</form>
                </div>
            </div>
        </div>
        <div class="custom-table">
			<table id="" class="display" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Customer ID</th>
						<th>Name</th>
						<th>Email ID</th>								
						<th>Action</th>								
					</tr>
				</thead>						
				<tbody>
				<?php 
				global $wpdb;
				$users = get_users();				
				foreach($users as $user_id)
				{
					$user_meta = get_user_meta ( $user_id->ID);
					$current_id =  get_current_user_id();
					
					if($user_meta['_user_parent_admin'][0] == $current_id)
					{
				?>
					<tr>
						<td><?php echo $user_id->ID; ?></td>
						<td><?php echo $user_id->display_name; ?></td>
						<td><?php echo $user_id->user_email; ?></td>
						<td><a href="<?php echo $user_id->ID; ?>">Delete</a></td>							
					</tr>					
				<?php 		
					}
					
				} 
				
				?>					
				</tbody>
			</table>          
        </div>
    </div>

<?php endwhile; ?>
<?php get_footer('Dashboard'); ?>
<script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script>
jQuery(document).ready(function() 
{
    jQuery('table.display').DataTable();
});
</script>