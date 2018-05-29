<?php //require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' ); ?>
<!DOCTYPE html>
<html>
<head>
<title>Ticket Manager</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

</head>
<body>
<br>
<br>
<div class="container-fluid">
	<div class="row content">
		<div class="col-sm-12">
			<div class="panel panel-default">
			 <div class="panel-heading"><h2>Tickets Manager</h2></div>
			  <div class="panel-body">
			  
			  <?php 
			  wp_nonce_field('cs_get_AssignTicket','cs_get_AssignTicket_nonce', true, true );
			  global $wpdb;
			  $results = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'create_ticket WHERE `parent_admin` IS NULL  OR `AssignAdmin` = "1"', OBJECT );
			  
			 
			  ?>
			  <table id="ticketManager" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Ticket ID</th>
							<th>Subject</th>
							<th>Date</th>
							<th>Status</th>                
							<th>Assign To</th>                
							<th>View</th>                
							<th>Chat</th>                
						</tr>
					</thead> 
				<tbody>
				<?php foreach($results as $keys):
				
						/* Ticket Status */
						if($keys->ticket_status == 0)
							{
								$status = 'UnAttended';								
							}	
						elseif($keys->ticket_status == 1)
							{
								$status = 'Inprogress';
							}	
						elseif($keys->ticket_status == 2)
							{
								$status = 'Resolved';
							}
							
							/* Assign To */
						if( $keys->userid_handleby == 0 )
							{
								$Assign = 'Not Assigned';
							}
						else
							{
								$user = get_user_by( 'ID',$keys->userid_handleby );
								$Assign = $user->display_name;
							}
						$dt = new DateTime($keys->updatedOn);
						$date = $dt->format('d/m/Y');			
				
				
				?>
					<tr>
						<td><?php echo $keys->id; ?></td>             
						<td><?php echo $keys->ticket_subject; ?></td>             
						<td><?php echo $date; ?></td>             
						<td><?php echo $status; ?></td>             
						<td><?php echo $Assign; ?></td>             
						<td><button class="btn btn-primary getPop" data-id="<?php echo $keys->id; ?>" >View</button></td>             
						<td>
						<?php 
						if($keys->userid_handleby == 0)
						{
							echo '<button class="btn btn-primary alertMe" >Chat</button>';
						}
						else
						{ 
							$url = admin_url('admin.php?page=ticketManager&TickeID=').$keys->id;
							echo '<a href="'.$url.'" class="btn btn-primary " >Chat</button>';
						}
					
							?>
						
						</td>             
					</tr>
				<?php endforeach; ?>
				</tbody>
				</table>
			  </div>			 
			</div>
		</div>
	</div>
	
	
<?php 
	if(isset($_GET['TickeID']))
	{
		global $wpdb;
		$results = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'create_ticket WHERE id = "'.$_GET['TickeID'].'"', OBJECT );
		if($results[0]->userid_createdby != 0):			
		$form = '';
		$form .='<div class="ticket-chat">
				<div class="chat_ajax">
				</div>';
		$form .= '<form method="POST">';
		$form .= '<input type="hidden" name="ToUser" value="'.$results[0]->userid_createdby.'">
		<input type="hidden" name="TicketNo" value="'.$_GET['TickeID'].'">
		<input type="hidden" name="fromUser" value="'.get_current_user_ID().'">';	
		wp_nonce_field('cs_new_chat','cs_new_chat_nonce', true, true );
		wp_nonce_field('cs_get_chat','cs_get_chat_nonce', true, true );
		$form .='<textarea name="chat_text" class="input"></textarea>
		<input type="submit" class="form-submit-btn cht-btn" value="Send">'; 
		$form .= '</form>';
		$form .= '</div>';
		
		echo $form;
		endif;
	}


		?>
</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
	<?php  wp_nonce_field('cs_save_AssignTicket','cs_save_AssignTicket_nonce', true, true ); ?>
	 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      <div class="modal-header">
        <div class="modal-title">Modal title</div>       
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
        <button type="button" id="" class="btn btn-primary save_chn">Save changes</button>        
      </div>
    </div>
  </div>

</div>
