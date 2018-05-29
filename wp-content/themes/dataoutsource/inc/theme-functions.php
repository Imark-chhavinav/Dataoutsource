<?php

/**
 * User Role
 * Changing user role name
 *
 */
function wps_change_role_name()
{
     add_role( 'reseller', 'Reseller', array( 'read' => true, 'level_0' => true ) );
   add_role( 'customer', 'Customer', array( 'read' => true, 'level_0' => true ) );
   add_role( 'reseller_customer', 'Reseller Customer', array( 'read' => true, 'level_0' => true ) );
  

}
add_action( 'init', 'wps_change_role_name');
/**
 * New User registration
 *
 */
function vb_reg_new_user() {
 
  // Verify nonce

  if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'cs_new_user' ) )
    die( 'Ooops, something went wrong, please try again later.' );



	$filePath = get_parent_theme_file_path( '/Dashboard/js/server-validator.php');	
	if(file_exists($filePath))
		{
			require_once($filePath);
		}
 	else
	 	{
	 		die( 'Server Validation, something went wrong, please try again later.' );
	 	}

	$Validate = new Validator;

	$_POST = $Validate->sanitize($_POST); // You don't have to sanitize, but it's safest to do so.

	$Validate->validation_rules(array(
		'username' => 'required|alpha|max_len,100',
		'email'    => 'required|valid_email',
		'company'  => 'required|max_len,100',
		//'number'   => 'required|max_len,15|min_len,10',
		'account'  => 'required'
	));

	$validated_data = $Validate->run($_POST);

	if($validated_data === false) 
		{
			echo json_encode(array('status'=>'error','message'=>$Validate->get_readable_errors(true)));	
			exit;		
		} 
	else 
		{
			if ( email_exists( $validated_data['email'] ) ) 
			{
	   			echo json_encode(array('status'=>'error','message'=>'Email ID Already Exists !'));
	   			exit();
			}
			else
			{
				$userGenerate = explode('@',$validated_data['email']);
				$username = $userGenerate[0].generateRandNumber(4);
				if( username_exists( $username ) )
				{
					$username = $username.generateRandNumber(3);
				}				
			}
		}


    /**
     * IMPORTANT: You should make server side validation here!
     *
     */

    $password = wp_generate_password();
    if( $validated_data['account'] == 'cs_customer' )
   	{
   		$role = 'customer';
   		$status = 1;
   		$success = ' Registration done successfully ! Please check your Email for Login Credentials ';
		$currentuser_ID = '0';
   	}

   elseif( $validated_data['account'] == 'cs_reseller' )
   	{
		$role = 'reseller';
		$status = 0;
		$success = 'Your registration is under observation and we will notify you as soon as your account is been approved by Admin.';
		$currentuser_ID = '0';
   	}
	elseif( $validated_data['account'] == 'cs_reseller_customer' )
	{
		$role = 'reseller_customer';
   		$status = 1;
   		$success = ' Registration done successfully ! Please check your Email for Login Credentials ';
		$currentuser_ID = $_POST['_user_parent_admin'];
	}

   $userdata = array(
        'user_login' => $username,
        'user_pass'  => $password,
        'user_email' => $validated_data['email'],
        'first_name' => $validated_data['username'],        
        'role' => $role,        
    );
	
	$user_id = wp_insert_user( $userdata ) ;
    add_user_meta( $user_id, '_user_company_name', $validated_data['company']); 
    add_user_meta( $user_id, '_user_profile_approve', $status);  
    add_user_meta( $user_id, '_user_phone_number', $_POST['number']);  
    add_user_meta( $user_id, '_user_parent_admin', $currentuser_ID);  

    $to = $validated_data['email'];
	$subject = 'New User Registration';
	$body = '<p>Username: '.$username.'</p><p>Password : '.$password.'</p><p> Login Url : '.site_url().'</p>';
	$headers = array('Content-Type: text/html; charset=UTF-8');
	 
	wp_mail( $to, $subject, $body, $headers );


    // Return
    if( !is_wp_error($user_id) ) 
	    {
	      echo json_encode(array('status'=>'success','message'=>$success));
	    } 
    else 
	    {
	    	echo json_encode(array('status'=>'error','message'=>$user_id->get_error_message())); 
	    }
  die();
 
}
 
add_action('wp_ajax_register_user', 'vb_reg_new_user');
add_action('wp_ajax_nopriv_register_user', 'vb_reg_new_user');





function Cs_Login()
{

	if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'cs_user_login' ) )
    die( 'Ooops, something went wrong, please try again later.' );

	$filePath = get_parent_theme_file_path( '/Dashboard/js/server-validator.php');	
	if(file_exists($filePath))
		{
			require_once($filePath);
		}
 	else
	 	{
	 		die( 'Server Validation, something went wrong, please try again later.' );
	 	}

	$Validate = new Validator;

	$_POST = $Validate->sanitize($_POST); // You don't have to sanitize, but it's safest to do so.


	$Validate->validation_rules(array(
		'Parameters' => 'required',
		'Password'    => 'required',		
	));

	$validated_data = $Validate->run($_POST);

	$info = array();

	if(is_email($_POST['Parameters']))
	{
		$info['user_email'] = $_POST['Parameters'];
	}
	else
	{
		$info['user_login'] = $_POST['Parameters'];
	}

	$info['user_password'] = $_POST['Password'];

	if($validated_data === false) 
		{
			echo json_encode(array('status'=>'error','message'=>$Validate->get_readable_errors(true)));	
			exit();	
		} 
	else 
		{
			 $user = wp_authenticate($info['user_login'], $info['user_password']);

			 if( !empty( $user ) )
			 {
			 	
			 	if(!empty($user) && $user->roles['0'] == 'reseller')
					{
						$verify = get_user_meta($user->ID, '_user_profile_approve');		
						if($verify[0] == 0 || $verify[0] == 2)
						{	
							echo json_encode(array('loggedin'=>false,'message'=>'User is not Approved Please try Again later !'));
							exit();	
						}
					}
				$user_signon = wp_signon( $info, false );
			    if ( is_wp_error($user_signon) )
			    	{
				        echo json_encode(array('loggedin'=>false, 'message'=>__('Invalid Credentials')));
				    } 
			    else 
				    {
				        echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...')));
				    }
			 }
			 else
			 {
			 	
			 }





		}

	die();
}
add_action('wp_ajax_UserLogin', 'Cs_Login');
add_action('wp_ajax_nopriv_UserLogin', 'Cs_Login');



/* Ticket Generating */

function CreatingTicket()
{
	global $wpdb;
	if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'cs_new_ticket' ) )
    die( 'Ooops, something went wrong, please try again later.' );
	
	$filePath = get_parent_theme_file_path( '/Dashboard/js/server-validator.php');	
	if(file_exists($filePath))
		{
			require_once($filePath);
		}
 	else
	 	{
	 		die( 'Server Validation, something went wrong, please try again later.' );
	 	}

	$Validate = new Validator;

	$_POST = $Validate->sanitize($_POST); // You don't have to sanitize, but it's safest to do so.

	$Validate->validation_rules(array(
		//'ticket_subject' 		=> 'required',
		'ticket_severity'   	=> 'required',
		'ticket_product'  		=> 'required',		
		'ticket_department'  	=> 'required',		
		'ticket_company'  		=> 'required',		
		'issue'  				=> 'required',
		'user_id'  				=> 'required',
	));
	
	$validated_data = $Validate->run($_POST);

	if($validated_data === false) 
		{
			echo json_encode(array('status'=>'error','message'=>$Validate->get_readable_errors(true)));	
			exit;		
		} 
	else 
	{
		$user_info = get_userdata($_POST['user_id']);
		$Date = new DateTime();
		$userdata = array(
        'ticket_subject' 		=> $_POST['ticket_subject'], 
        'ticket_department'  	=> $_POST['ticket_department'],
        'ticket_severnity'		=> $_POST['ticket_severity'],
        'ticket_product' 		=> $_POST['ticket_product'],        
        'ticket_company' 		=> $_POST['ticket_company'],        
        'ticket_issue' 			=> $_POST['issue'],        
        'ticket_status'			=> 0,        
        'userid_handleby'		=> 0,        
        'createdOn' 			=> date('Y-m-d H:i:s'),
		);
		  
		
		if($user_info->roles[0] == 'reseller')
		{
			$user_last = get_user_meta( $_POST['user_id'], '_user_parent_admin');
			$userdata['Ruserid_createdby'] = $_POST['user_id'] ;
			$userdata['userid_createdby'] = 0;
			$userdata['parent_admin'] = $user_last[0];
			
			
		}
		elseif($user_info->roles[0] == 'customer' || $user_info->roles[0] == 'reseller_customer')
		{
			$userdata['Ruserid_createdby'] = 0;
			$userdata['userid_createdby'] = $_POST['user_id'];
		}

		$Result = $wpdb->insert($wpdb->prefix.'create_ticket' , $userdata);		
		echo $Result;
	}
}
add_action('wp_ajax_create_ticket', 'CreatingTicket');
add_action('wp_ajax_nopriv_create_ticket', 'CreatingTicket');


/* TCO Calculator   */
function InsertTco()
{
	 if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'cs_tco_cal' ) )
    die( 'Ooops, something went wrong, please try again later.' );
	global $wpdb;
	
	$table = '';
	$result = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."tco_calculator WHERE userid = ".$_POST['userid']." AND product_sku = '".$_POST['product_sku']."'");
	
	 if(empty($result))
	{
		$Insert = $wpdb->insert($wpdb->prefix."tco_calculator", array(
			'userid' => $_POST['userid'],
			'product_name' => $_POST['product_name'],
			'product_sku' => $_POST['product_sku'], 
			'product_qty' => $_POST['product_qty'], 
			'product_price' => $_POST['product_price'] 
		));
		if($Insert)
		{	
			echo $table = getTcoRecord($_POST['userid']); 
			exit();
		}		
	}
	else
	{
		
		$UNID = $result[0]->id;		
		$update = $wpdb->update($wpdb->prefix."tco_calculator", 
				array( 
					'product_qty' => $_POST['product_qty']					
				), 
				array( 'id' => $UNID )); 
		if($update)
		{
			echo $table = getTcoRecord($_POST['userid']);			
			exit();
		}
		else
		{
			echo $table = getTcoRecord($_POST['userid']);
			exit();
		}
		
		
	} 
	
}
add_action('wp_ajax_insertco', 'InsertTco');
add_action('wp_ajax_nopriv_insertco', 'InsertTco');

/* TCO Calculator Clear */
function ClearTco()
{
	if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'cs_tco_clear' ) )
	die( 'Ooops, something went wrong, please try again later.' );
	global $wpdb;
	$results = $wpdb->delete( $wpdb->prefix."tco_calculator", array( 'userid' => $_POST['userid'] ) );	
	if($results)
	{
		echo json_encode(array('status'=>'success'));
	}
	else
	{
		echo json_encode(array('status'=>'error'));
	}
	exit;
	
}
add_action('wp_ajax_clearTable', 'ClearTco');
add_action('wp_ajax_nopriv_clearTable', 'ClearTco');

/* TCO Calculator Mail */

function MailTco()
{
	if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'cs_tco_email' ) )
	die( 'Ooops, something went wrong, please try again later.' );
	global $wpdb;
	
	$table = getTcoRecord($_POST['userid']);
	$to = $_POST['email'];
	$subject = 'Tco Calculator';
	$body = $table;
	$headers = array('Content-Type: text/html; charset=UTF-8');
	 
	if(wp_mail( $to, $subject, $body, $headers ))
	{
		echo json_encode(array('status'=>'success'));
	}
	else
	{
		echo json_encode(array('status'=>'error'));
	}
	exit;
}
add_action('wp_ajax_emailTable', 'MailTco');
add_action('wp_ajax_nopriv_emailTable', 'MailTco');

/* Insert Chating Function */
function CreateChating()
{
	global $wpdb;
	if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'cs_new_chat' ) )
    die( 'Ooops, something went wrong, please try again later.' );
	$results = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'ticket_conversation WHERE TicketNo = "'.$_POST["TicketNo"].'" AND (fromUser = "'.$_POST["fromUser"].'" AND ToUser = "'.$_POST["ToUser"].'" ) OR (fromUser = "'.$_POST["ToUser"].'" AND ToUser = "'.$_POST["fromUser"].'" )', OBJECT );
	
		if(empty($results))
		{
			$Insert = $wpdb->insert($wpdb->prefix."ticket_conversation", array(			
			'fromUser' => $_POST['fromUser'],
			'ToUser' => $_POST['ToUser'], 
			'TicketNo' => $_POST['TicketNo'],			
			'createdOn' => date('Y-m-d H:i:s'),			
			'updatedOn' => date('Y-m-d H:i:s')			
			));
			
			$conversionID = $wpdb->insert_id;
		}
		else
		{
			$conversionID = $results[0]->id;
		}
		
		if(!empty($conversionID))
		{
			$CInsert = $wpdb->insert($wpdb->prefix."conversation_message", array(			
			'conversionID' => $conversionID,
			'fromUser' => $_POST['fromUser'],
			'ToUser' => $_POST['ToUser'], 
			'chat_text' => $_POST['chat_text'],			
			'createdOn' => date('Y-m-d H:i:s'),			
			));
			if($CInsert)
			{
				echo json_encode(array('status'=>'success'));
			}
			else
			{
				echo json_encode(array('status'=>'error'));
			}
		}
		else		
		{
			echo json_encode(array('status'=>'error'));
		}
	exit;	
}
add_action('wp_ajax_chat', 'CreateChating');
add_action('wp_ajax_nopriv_chat', 'CreateChating');

/* Get Chating Record */
function GetChat()
{
	global $wpdb;
	if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'cs_get_chat' ) )
    die( 'Ooops, something went wrong, please try again later.' );
	
	$results = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'ticket_conversation WHERE TicketNo = "'.$_POST["TicketNo"].'" AND (fromUser = "'.$_POST["fromUser"].'" AND ToUser = "'.$_POST["ToUser"].'" ) OR (fromUser = "'.$_POST["ToUser"].'" AND ToUser = "'.$_POST["fromUser"].'" ) ', OBJECT );
	
	if(!empty($results))
	{
		
		$Cresults = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'conversation_message WHERE conversionID = "'.$results[0]->id.'" ORDER BY id DESC ', OBJECT );
		if(!empty($Cresults))
		{
			$toTal = count($Cresults);
		$Chat = '';	
		
		/* updatedOn */
		foreach($Cresults as $cht):
		
		$dt = new DateTime($cht->updatedOn);
		$date = $dt->format('d/m/Y');
		$time = $dt->format('H:i:s');
		$author_obj = get_user_by('id', $cht->fromUser);
		$image = esc_url( get_avatar_url( $user->ID ) );
		
		$Chat .='<article>
			<figure style="background-image:url('.$image.');"> </figure>
			<div class="inbox-time">
				<time><i class="fa fa-clock-o" aria-hidden="true"></i> '.$time.'</time>
				<p>'.$date.'</p>
			</div>
			<div class="inbox-message">
				<h4>'.$author_obj->display_name.'</h4>
				'.wpautop($cht->chat_text).'
			</div>
		</article>';
		endforeach;
		
			echo json_encode(array('count'=>$toTal,'message'=>$Chat,'status'=>'success'));
			exit;
		}
		else
		{
			echo json_encode(array('count'=>0,'message'=>"No Conversation as Yet",'status'=>'success'));
			exit;
		}
		
	}
	
}
add_action('wp_ajax_getchat', 'GetChat');
add_action('wp_ajax_nopriv_getchat', 'GetChat');

/* Admin Tickets Functions */
function AssignTicket()
{
	if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'cs_get_AssignTicket' ) )
    die( 'Ooops, something went wrong, please try again later.' );
	
	global $wpdb;
	
	$results = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'create_ticket WHERE id = "'.$_POST['TickeID'].'"', OBJECT );
			
			
			if(!empty($results))
			{
				foreach( $results as $keys):
				$statusDrop = '';
				$statusDrop .= '<select class="form-control" name="ticket_status">';
				if($keys->ticket_status == 0)
					{
						$status = 'UnAttended';
						$statusDrop .='<option selected value="0">UnAttended</option>';
					}
				else
					{
						$statusDrop .='<option value="0">UnAttended</option>';
					}	
					
				if($keys->ticket_status == 1)
					{
						$status = 'Inprogress';
						$statusDrop .='<option  selected value="1">Inprogress</option>';
					}
				else
					{
						$statusDrop .='<option  value="1">Inprogress</option>';
					}
					
				if($keys->ticket_status == 2)
					{
						$status = 'Resolved';
						$statusDrop .='<option selected value="2">Resolved</option>';
					}
				else
					{
						$statusDrop .='<option value="2">Resolved</option>';
					}
					
			$statusDrop .= '</select>';
			if($keys->userid_handleby != 0)
			{
				$AssignTo = getUsers($keys->userid_handleby);		
			}
			else
			{
				$AssignTo = getUsers();
			}
			$Heading = $keys->ticket_subject;
			$form = '';
			$form .= '			
			<div class="form-group">
				<label for="example-text-input" class="col-2 col-form-label">Assign To</label>
				<div class="col-10">
					'.$AssignTo.'
				</div>
			</div>
			<div class="form-group">
				<label for="example-text-input" class="col-2 col-form-label">Status</label>
				<div class="col-10">
					'.$statusDrop.'
				</div>
			</div>';
			
			endforeach;
			echo json_encode(array('status'=>'success','content'=>$form,'heading'=>'<h1>'.$Heading.'</h1>'));
			exit;
			}	
}
add_action('wp_ajax_AssignTicket', 'AssignTicket');
add_action('wp_ajax_nopriv_AssignTicket', 'AssignTicket');

/* Admin Save Ticket Action */
function saveAssignTicket()
{
	if( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'cs_save_AssignTicket' ) )
    die( 'Ooops, something went wrong, please try again later.' );
	global $wpdb;
	
	$Result = $wpdb->update($wpdb->prefix.'create_ticket',array
	( 
		'ticket_status' => $_POST['ticket_status'],	
		'userid_handleby' => $_POST['userid_handleby']	
	), 
	array( 'id' => $_POST['TickeID'] ));
	
	if($Result)
	{
		echo json_encode(array('status'=>'success','message'=>'Ticket Update Success Fully'));
	}
	else
	{
		echo json_encode(array('status'=>'error','message'=>'No Entry is Updated in Ticket !'));
	}	
	exit;
}
add_action('wp_ajax_saveAssignTicket', 'saveAssignTicket');
add_action('wp_ajax_nopriv_saveAssignTicket', 'saveAssignTicket');


function getTcoRecord($userID)
{
	global $wpdb;
	$result = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix."tco_calculator WHERE userid = ".$userID);
	$table="";
	$table .="<table id='example'>
	<thead>
				<tr>
					<th>SKU</th>
					<th>Product</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Total</th>                    
				</tr>
				</thead>";
	$Total = 0;	
	$x = 0;	
	foreach($result as $keys)
	{
		if($x == 0){	$table .='<tbody>';	}
		$ProTotal = $keys->product_price*$keys->product_qty;
		$table .="<tr><td>".$keys->product_sku."</td><td>".$keys->product_name."</td><td>".$keys->product_qty."</td><td>$".$keys->product_price."</td><td>$".$ProTotal."</td></tr>";
		$Total = $Total+$ProTotal;
		$x++;
	}
	$table .='<tr><td class="total-data ">Grand Total</td><td style=""></td><td style=""></td><td style=""></td><td class="total-data">$'.$Total.'</td></tr>';
	
	
	$table .="</tbody></table>";
	
	return $table;
}


function getUsers($ID = NULL)
{
	 $AssignTo = '';
	  $AssignTo .= '<select class="form-control" name="userid_handleby">';
	  if($ID == NULL)
	  {
		$AssignTo .= '<option selected value="0">UnAssigned</option>';		  
	  }
	  else
	  {
		  $AssignTo .= '<option value="0">UnAssigned</option>';		 
	  }
		$args = array(
			'role' => array('administrator'),
			'order' => 'ASC'
		);
		 $users = get_users($args);
		foreach($users as $Ukeys):
		if(get_current_user_ID() == $Ukeys->ID)
		{
			if($ID == $Ukeys->ID)
			{
				$AssignTo .='<option selected value="'.$Ukeys->ID.'">'.$Ukeys->display_name.'( My Self )</option>';
			}
			else
			{
				$AssignTo .='<option value="'.$Ukeys->ID.'">'.$Ukeys->display_name.'( My Self )</option>';
			}
			
		}
		else
		{
			if($ID == $Ukeys->ID)
			{
				$AssignTo .='<option selected value="'.$Ukeys->ID.'">'.$Ukeys->display_name.'</option>';
			}
			else
			{
				$AssignTo .='<option value="'.$Ukeys->ID.'">'.$Ukeys->display_name.'</option>';
			}
			
		}
		endforeach;
		
		$args1 = array(
			'role' => array('editor'),
			'order' => 'ASC'
		);
		$users1 = get_users($args1);
		foreach($users1 as $U2keys):
		if(get_current_user_ID() == $U2keys->ID)
		{
			if($ID == $U2keys->ID)
			{
				$AssignTo .='<option selected value="'.$U2keys->ID.'">'.$U2keys->display_name.'( My Self )</option>';
			}
			else
			{
				$AssignTo .='<option value="'.$U2keys->ID.'">'.$U2keys->display_name.'( My Self )</option>';	
			}
			
		}
		else
		{
			if($ID == $U2keys->ID)
			{
				$AssignTo .='<option selected value="'.$U2keys->ID.'">'.$U2keys->display_name.'</option>';
			}
			else
			{
				$AssignTo .='<option value="'.$U2keys->ID.'">'.$U2keys->display_name.'</option>';
			}
			
		}
			
		endforeach;		
	$AssignTo .= '</select>';
	
	return $AssignTo;
}


function generateRandNumber($no)
{
	$number = mt_rand(10,500);
	$digit = substr($number, 0,$no);
	return $digit;
}


function ApproveUser()
{
	if(is_admin() && is_user_logged_in())
	{
		$result = update_user_meta($_POST['user_id'], '_user_approved_status', $_POST['permission']);
		$user_info = get_userdata($_POST['user_id']);
		$to = $user_info->user_email;
		$username = $user_info->user_login;
		$Fields = get_fields('option');
		if($result)
		{
			
		$URl = site_url();		
	$subject = 'Account Status';
	$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Dataout Source</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body style="margin: 0; padding: 0; background-color:#f6f6f6;" >
<table border="0" cellpadding="0" cellspacing="0" width="600" align="center" style="margin:0 auto; width:600px; padding:10px 0;">
  <tr>
    <td><table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" bgcolor="#fff" style="width:100%; background:#fff;border: 1px solid #eaeaea;" >
        <tr>
          <td  style="text-align:center;padding:40px 0;"><img src="'.$Fields["website_logo"]["url"].'" alt="Properenglsihacademy" width="431" height="26" style="display: inline-block;" /></td>
        </tr>
        <tr>
          <td bgcolor="#ffffff" style="padding:0px 30px 40px 30px; font-family:\'Open Sans\', Arial, sans-serif; font-size: 14px; color:#000; "><table border="0" cellpadding="0" cellspacing="0" width="100%" style="border-top: 1px solid #a3cf7e;color: #5f5f5f;">
              <tr>
                <td style="color: #5f5f5f;font-family:\'Open Sans\', Arial, sans-serif; font-size: 22px; color:#5983ad; padding:30px 10px 10px; padding-bottom: 20px; font-weight:700;"> Welcome to <span style="color:#4EB748;">Datacloud 365</span></td>
              </tr>
              <tr>
                <td style="color: #5f5f5f;font-family:\'Open Sans\', Arial, sans-serif;padding: 10px; line-height:1.4; font-size:14px;">Hi '.$username.'</td>
              </tr>';

             if($_POST['permission'] == 1)
			{

            $body .='  
              <tr>
                <td style="color: #5f5f5f;font-family:\'Open Sans\', Arial, sans-serif;padding: 10px; line-height: 26px; font-size:14px;">Your Account has been approved by Admin. <br> You can login into the Dashboard using the Credentials which were sent at the time of sign-up through Email </td>
              </tr>';
          }
  if($_POST['permission'] == 2)
			{

            $body .='  
              <tr>
                <td style="color: #5f5f5f;font-family:\'Open Sans\', Arial, sans-serif;padding: 10px; line-height: 26px; font-size:14px;">Your Account has been un-approved by Admin. Please contact Admin</td>
              </tr>';
          }


              $body .='<tr>
                <td style="color: #5f5f5f;font-family:\'Open Sans\', Arial, sans-serif;padding: 10px; padding-top: 50px;line-height: 22px; font-size:14px;">
                <strong>DATA OUTSOURCE PTY LTD</strong><br />
                  SUITE 26, LEVEL 8, 320 ADELAIDE STREET <br />
BRISBANE, QUEENSLAND, 4000<br />
AUSTRALIA<br />
                  <strong>Tel :</strong> 1300-6000774<br />
                  <strong>ABN :</strong> 1300-6000774<br />
                  <strong>Mail :</strong> <a style="color:#333;text-decoration:none;" href="mailto:cloud@dataoutsource.com.au">cloud@dataoutsource.com.au</a><br />
                  <strong>Url :</strong> <a style="color:#333;text-decoration:none;" href="'.site_url().'" target="_blank">'.site_url().'</a></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td style="text-align:center;padding:0 30px 30px;"><p style="border-top: 1px solid #a3cf7e;font-size: 13px;font-family:\'Open Sans\', Arial, sans-serif;line-height: 20px;color: #868686; margin:0; padding:30px 0 0;">Copyright &copy; '.date("Y").'  Datacloud 365. All rights reserved. <br />
            Powered By - <a href="https://www.imarkinfotech.com/" target="_blank" style="color:#2998D4;text-decoration:none;">iMark Infotech</a></p></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>';
	$headers = array('Content-Type: text/html; charset=UTF-8');
	 
	wp_mail( $to, $subject, $body, $headers );
	echo json_encode(array('status'=>'success','message'=>'User Data Updated successfully'));
	die();
			
		}
	}	
}
add_action('wp_ajax_user_approval', 'ApproveUser');
add_action('wp_ajax_nopriv_user_approval', 'ApproveUser');