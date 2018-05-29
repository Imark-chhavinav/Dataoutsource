<?php	/* Template Name: Ticket View Dashboard */  ?>

<?php get_header('Dashboard'); 	?>
<?php while ( have_posts() ) : the_post(); 	$fields = get_fields(); //print_R($fields); ?> 
	<div class="main">
        <div class="container-fluid">
            <div class="heading">
                <h2>ticket detail</h2> </div>
				<?php echo do_shortcode('[CS_Tickets_Details]'); ?>
            <div class="heading">
                <h2>ticket thread</h2> </div>
            <div class="ticket-chat">
                <div class="chat_ajax_cover">
				<div class="chat_ajax">
				</div>
                    </div>
               <div class="inbox-message-box-cover">
                    <form method="POST">
						<input type="hidden" name="fromUser" value="<?php echo get_current_user_ID(); ?>">
						<?php 
						$user_info = get_userdata(get_current_user_id());
						global $wpdb;
						$results = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'create_ticket WHERE id = "'.$_GET['TickeID'].'"', OBJECT );
						
						if($user_info->roles[0] == 'reseller_customer')
						{
							//Reseller - Customer							
							$ToUser = $results[0]->parent_admin;
						}
						elseif( $user_info->roles[0] == 'reseller' )
						{
							if(isset($_GET['chatOn']) && $_GET['chatOn'] == 'reseller')
							{
								$ToUser = $results[0]->Ruserid_createdby;
							}
							elseif($results[0]->AssignAdmin == 1)
							{
								if($results[0]->userid_handleby != 0)
								{
									$ToUser = $results[0]->userid_handleby;
								}
								else
								{
									$ToUser = 'UnAssigned';
								}
							}
							else
							{
								if($results[0]->userid_handleby != 0)
								{
									$ToUser = $results[0]->userid_handleby;
								}
								else
								{
									$ToUser = 'UnAssigned';
								}
							}
							
						}
						elseif( $user_info->roles[0] == 'customer' )
						{
							if($results[0]->userid_handleby != 0)
								{
									$ToUser = $results[0]->userid_handleby;
								}
								else
								{
									$ToUser = 'UnAssigned';
								}							
						}
						
						?>
						
						<input type="hidden" name="ToUser" value="<?php echo $ToUser; ?>">
						<input type="hidden" name="TicketNo" value="<?php if(isset($_GET['TickeID'])){	echo $_GET['TickeID'];	} ?>">	
						<?php wp_nonce_field('cs_new_chat','cs_new_chat_nonce', true, true ); ?>
						<?php wp_nonce_field('cs_get_chat','cs_get_chat_nonce', true, true ); ?>
                        <textarea name="chat_text" <?php if($ToUser == 'UnAssigned' ){	echo "disabled";	} ?> class="input"><?php if($ToUser == 'UnAssigned' ){	echo "Ticket is not Assigned to Any Support Executive";	} ?></textarea>
                        <input type="submit" class="form-submit-btn cht-btn" value="Send"> 
					</form>
                </div>
            </div>
        </div>
    </div>	
<?php endwhile; ?>
<?php get_footer('Dashboard'); ?>
<script>
window.To = 0;
jQuery(document).ready(function(){
	AjaxChat();
	setInterval("AjaxChat()",3000);	
});
function AjaxChat()
{
	
	var CfromUser 			= jQuery('input[name="fromUser"]').val();	
	var CToUser 			= jQuery('input[name="ToUser"]').val();	
	
	var CTicketNo 			= jQuery('input[name="TicketNo"]').val();	
	var Creg_nonce 			= jQuery('#cs_get_chat_nonce').val();

	var ajax_url = cs_reg_vars.cs_ajax_url;
		  data = {
		  action			: 'getchat',
		  nonce				: Creg_nonce,
		  fromUser			: CfromUser,
		  ToUser			: CToUser ,		  
		  TicketNo			: CTicketNo 
		  
		};
		  jQuery.post( ajax_url, data, function(response) 
			{
				console.log(To);
				var dta = jQuery.parseJSON(response);
				
				if( dta.count != 0 ) 
				  {
					  if(dta.count != To)
					  {
						  To = dta.count;
						  jQuery('.chat_ajax').html(dta.message);
					  }
					
				  }
				else
				{
					jQuery('.chat_ajax').html('No message as yet!');
				}
			});	
}

</script>

