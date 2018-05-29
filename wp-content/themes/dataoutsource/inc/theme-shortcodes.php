<?php


/* User Registration Form */
if ( !function_exists( 'User_Registration_Form' ) ) {
function User_Registration_Form()
{
	$form = '';
	$form .='
	<form id="form1">
		<div class="form-group">  
			<input type="text" class="form-control" name="cs_name" placeholder="Name">
		</div>
		<div class="form-group">   
			<input type="text" class="form-control" name="cs_email" placeholder="Email">
		</div>
  
		<div class="form-group">  
			<input type="text" class="form-control" name="cs_company" placeholder="Company">
		</div>
		<div class="form-group">   
			<input type="text" class="form-control" name="cs_number" placeholder="Phone Number">
		</div>		
		<div class="form-group"> 
			<select name="cs_account">
				<option value="">Select User Type</option>
				<option value="cs_reseller">Re-Seller</option>
				<option value="cs_customer">Customer</option>
			</select>
		</div>';
		$form.= wp_nonce_field('cs_new_user','cs_new_user_nonce', true, true );
		$form.= '<div class="cntr-aligned">
			<button type="submit" class="btn btn-default" id="btn-new-user">Register Now</button>
		</div>
			<div style="display:none" id="res" class="alert">	  			
			</div>		
		<p>Already have an account?<a href="#" data-dismiss="modal" data-toggle="modal" data-target="#Login" class="loginclass"> Login</a></p>
	</form>';
	
	echo $form;
	
}

add_shortcode('CS_TicketRegister','User_Registration_Form');
}

if( !function_exists( 'User_login_form' ) ) {
function User_login_form()
{
	$Loginform = '';

	$Loginform .='
	<form id="loginForm" >
	  	<div class="form-group">  
		    <input type="text" class="form-control" name="loginPar" placeholder="Username Or Email">
		</div>
	 	<div class="form-group">   
		    <input type="password" class="form-control" name="loginPass" placeholder="Password">
	  	</div>
	 	<div class="cntr-aligned">
	  		<button type="submit" id="cs_login_btn" class="btn btn-default">Login</button>
	  	</div>
	  	<div styel="display:none" id="resp" class="form-group">   
	  		<div class="alert">			  
			</div>	    
	  	</div>'; 

	$Loginform .= wp_nonce_field('cs_user_login','cs_user_login_nonce', true, true ); 
  	$Loginform .='<p>Don\'t have an account?<a href="#" data-dismiss="modal" data-toggle="modal" data-target="#Register" class="registerclass"> Register</a>
  		</p>
	</form>';

	echo $Loginform;

}
add_shortcode('CS_LOGINFORM','User_login_form');
}


function CreateTicket_Form()
{
	$form = '';
		
	
	$option = get_fields('options');	
	/*echo "<pre>";
	print_R($option['ticket_department']);
	echo "</pre>";*/

	$Department = '';
	foreach( $option['ticket_department'] as $keys ):
		$Department .= '<option value="'.$keys["ticket_add_department"].'">'.$keys["ticket_add_department"].'</option>';		
	endforeach;

	$form .='<form id="create_ticket" method="POST">
	<div class="col-md-6">
	<input type="hidden" name="user_id" value="'.get_current_user_id().'">
		<div class="custom-form">
		<!-- <div class="form-group">
			<label>Subject</label>
			<select name="ticket_subject" class="form-control">
				<option value="" >Select Subject</option>
				<option value="Chhavi" >Chhavi</option>
			</select>
		</div>   -->                    
		<div class="form-group">
			<label>Department</label>
			<select name="ticket_department" class="form-control">
				<option value="">Select Department</option>';
				$form .=$Department;
			$form .='</select>
		</div>'.wp_nonce_field("cs_new_ticket","cs_new_ticket_nonce", true, true ).'		
		<div class="form-group">
			<label>Severity</label>
			<select name="ticket_severity" class="form-control">
				<option value="">Select Severity</option>
				<option value="0">Low</option>
				<option value="1">Medium</option>
				<option value="2">High</option>
			</select>
		</div>		
		 <div class="form-group">
			<label>Product</label>
			<select name="ticket_product" class="form-control">
				<option value="">Select Product</option>
				<option value="Product">Product</option>
			</select>
		</div>                        
		<div class="form-group">
			<label>Company</label>
			<input type="text" name="ticket_company" class="form-control" placeholder="infotech">
		</div>                        
		<div class="form-group">
			<label>Specific Issue</label>
			<textarea type="text" name="issue" class="form-control" placeholder="Description"></textarea>
		</div>
		<div class="text-left">
			<input type="submit" class="form-submit-btn btn_screate" value="create ticket">
		</div>
	</div>
</div>
</form>';
echo  $form;
}
add_shortcode('CS_Create_Ticket','CreateTicket_Form');

if( !function_exists( 'Ticket_records' ) )
	{
		function Ticket_records()
		{
			if ( is_user_logged_in() ) 
			{
				global $wpdb;
				$user_info = get_userdata(get_current_user_id());
				
				if( $user_info->roles[0] == 'reseller_customer' )
				{
					$results = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'create_ticket WHERE Ruserid_createdby = "'.get_current_user_id().'"', OBJECT );

				}
				elseif( $user_info->roles[0] == 'reseller' )
				{
					$results = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'create_ticket WHERE userid_createdby = "'.get_current_user_id().'" OR parent_admin = "'.get_current_user_id().'" ', OBJECT );
				}
				elseif( $user_info->roles[0] == 'customer' )
				{
					$results = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'create_ticket WHERE userid_createdby = "'.get_current_user_id().'"', OBJECT );
				}
				
				$own = '';
				$own .='
				<table id="own" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Ticket ID</th>
							<th>Subject</th>
							<th>Date</th>
							<th>Status</th>                
							<th>View</th>                
						</tr>
					</thead> 
				<tbody>';
		if($user_info->roles[0] == 'reseller')
		{
				$request = '';
				$request .= '
	<table id="request" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Ticket ID</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Status</th>                
                <th>View</th>                
            </tr>
        </thead> 
	<tbody>';
		}
				
				foreach( $results as $keys):
					if($keys->parent_admin == $user_info->ID && $user_info->roles[0] == 'reseller')
					{
						$request .= '<tr>';
						$request .= '<td>'.$keys->id.'</td>';						
						$request .= '<td>'.$keys->ticket_subject.'</td>';						
						$request .= '<td>'.$keys->createdOn.'</td>';
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
							
						$request .= '<td>'.$status.'</td>';						
						$request .= '<td><a href="'.site_url("/ticket-view/").'?TickeID='.$keys->id.'&chatOn=reseller">View</td>';						
						$request .= '</tr>';
					}
					else
					{
						$own .= '<tr>';
						$own .= '<td>'.$keys->id.'</td>';						
						$own .= '<td>'.$keys->ticket_subject.'</td>';						
						$own .= '<td>'.$keys->createdOn.'</td>';
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
							
						$own .= '<td>'.$status.'</td>';	
						$own .= '<td><a href="'.site_url("/ticket-view/").'?TickeID='.$keys->id.'">View</td>';							
						$own .= '</tr>';
					}
			endforeach;
			
				$own .='</tbody></table>';
				if($user_info->roles[0] == 'reseller')
				{
					$request .='</tbody></table>';
				}
			
			echo $own;			
			if($user_info->roles[0] == 'reseller')
			{
				echo "<div class='heading'><h2>Customer Requests :- </h2></div>";
				echo $request;				
			}
				
				
				
			} 			
		}
	add_shortcode('TICKETS_RECORDS','Ticket_records');
	}

	
	/* Get Ticket Details */
if( !function_exists( 'Tickets_Details' ) )	
{
	function Tickets_Details()
	{
		global $wpdb;
		if(isset($_GET['TickeID']))
		{
			$results = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'create_ticket WHERE id = "'.$_GET['TickeID'].'"', OBJECT );
			$hello = $results[0];
			
			if(!empty($results))
			{
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
				echo '<ul class="ticket-detail">
                <li><strong>Subject:</strong> '.$results[0]->ticket_subject.' </li>
                <li><strong>Department:</strong> '.$results[0]->ticket_department.'</li>
                <li><strong>Severity:</strong> '.$results[0]->ticket_severnity.'</li>
                <li><strong>Specific Issue:</strong> '.$results[0]->ticket_issue.'t</li>
                <li><strong>Created:</strong> '.$results[0]->createdOn.'</li>
                <li><strong>Status:</strong> '.$status.'</li>
            </ul>';
			}
			else
			{
				wp_redirect('/dashboard/');
				exit();
			}			
		}
		else
		{
			wp_redirect('/dashboard/');
			exit();
		}	
	}
	add_shortcode('CS_Tickets_Details','Tickets_Details');
}

