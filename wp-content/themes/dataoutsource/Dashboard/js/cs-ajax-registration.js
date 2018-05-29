jQuery(document).ready(function($) {
 
  $("#form1").validate({
       rules: {
        cs_name: {  required:true,lettersonly:true },
        cs_email: {  email: true,required:true },
        cs_company: "required",
        cs_number: 
        {
            number:true,
            required:true
        },     
        cs_account: "required"
       },
       messages: {
        cs_name: { required:"Please Specify Name",lettersonly:"Please User Alphabetice Only" },
        cs_email: "Please Specify Email",
        cs_company: "Please Specify Company Name",
        cs_number: "Please Specify Number",
        cs_account: "Please Select Account Type"
       }
    });
	
	/* Reseller Create Customer Validation */
	$("#reseller_customer").validate({
       rules: {
        cs_name: {  required:true,lettersonly:true },
        cs_email: {  email: true,required:true },
        cs_company: "required"
		},
       messages: {
        cs_name: { required:"Please Specify Name",lettersonly:"Please User Alphabetice Only" },
        cs_email: "Please Specify Email",
        cs_company: "Please Specify Company Name",
       }
    });
	
	/* Login Form Validation */
  $('#loginForm').validate({

      rules: {
        loginPar :  { required:true },
        loginPass : { required:true }
      },
      messages: {
        loginPar :  {  required:"Please Specify Username or Email ID"},
        loginPass : { required:" Password Field Can't be Empty" }
      }
  });  
  
  /* TCO Calculator */
  $('#tco_cal').validate({

      rules: {
        product :  { required:true },
        quantity : { required:true }
      },
      messages: {
        product :  {  required:"Please Select Product!"},
        quantity : { required:"Please specify product Quantity!" }
      }
  });  
  
  /* Create Ticket Validation */
  
  $('#create_ticket').validate({

      rules: {
        ticket_subject :  { required:true },
        ticket_department : { required:true },
        ticket_severity : { required:true },
        ticket_product : { required:true },
        ticket_company : { required:true },
        issue : { required:true },
      },
      messages: {
		ticket_subject :  { required:"Please Select Subject !" },
        ticket_department : { required:"Please Select Department !" },
        ticket_severity : { required:"Please Select Severity !" },
        ticket_product : { required:"Please Select Product !" },
        ticket_company : { required:"Company Field can'\t be empty !" },
        issue : { required:"Issue Description can\'t be Empty!" }  
        
      }
  });  
  

  jQuery.validator.addMethod("lettersonly", function(value, element) 
  {
  return this.optional(element) || /^[a-z," "]+$/i.test(value);
  }, "Letters and spaces only please"); 

  /**
   * When user clicks on button...
   *
   */
  $('#btn-new-user').click( function(event) {
 
    /**
     * Prevent default action, so when user clicks button he doesn't navigate away from page
     *
     */
    if (event.preventDefault) {
        event.preventDefault();
    } else {
        event.returnValue = false;
    }


    
if ($("#form1").valid()) 
  {
         
    // Show 'Please wait' loader to user, so she/he knows something is going on
   // $('.indicator').show();
 
    // If for some reason result field is visible hide it
   // $('.result-message').hide();
 
    // Collect data from inputs
    var reg_nonce = $('#cs_new_user_nonce').val();
    var reg_name  = $('input[name="cs_name"]').val();
    var reg_email  = $('input[name="cs_email"]').val();
    var reg_company  = $('input[name="cs_company"]').val();
    var reg_number  = $('input[name="cs_number"]').val();
    var reg_account  = $('select[name="cs_account"]').val();

    /**
     * AJAX URL where to send data
     * (from localize_script)
     */
    var ajax_url = cs_reg_vars.cs_ajax_url;
 
    // Data to send
    data = {
      action: 'register_user',
      nonce: reg_nonce,
      username: reg_name,
      email: reg_email ,
      company: reg_company ,
      number: reg_number,
      account: reg_account,
    };
 
    // Do AJAX request
    $.post( ajax_url, data, function(response) {
       // If we have response
      if( response ) {
		  var obj = jQuery.parseJSON(response);
		  $('#res').show();
		  if( obj.status == 'success' )
		  {
			$('#res').addClass('alert-success');
			$('#res').text(obj.message);	
		  }
		  else
		  {
			$('#res').addClass('alert-danger');
			$('#res').text(obj.message);
		  }     
      }
    }); 
  }
  });

  /* User login Javascript*/

  $('#cs_login_btn').click(function(event)
  {

    /* Prevent the form to submit Date and Reload Page*/
    if (event.preventDefault) 
    {
        event.preventDefault();
    } 
    else 
    {
        event.returnValue = false;
    }

    // Only Process further if Validation is Pass
    if($('#loginForm').valid())
    {
		
        var Cs_parameter = $('input[name="loginPar"]').val();
        var Cs_password = $('input[name="loginPass"]').val();
        var Cs_nonce = $('input[name="cs_user_login_nonce"]').val();

       var ajax_url = cs_reg_vars.cs_ajax_url;
 
        // Data to send
        data = {
          action: 'UserLogin',
          nonce: Cs_nonce,
          Parameters: Cs_parameter,
          Password: Cs_password          
        };

     $.post( ajax_url, data, function(response) 
     {
         // If we have response
        if( response ) 
        {
			console.log(response);
          var obj = jQuery.parseJSON(response);
		  
		  if(obj.loggedin)
		  {
			window.location = cs_admin_vars.cs_admin_url;
			$('#resp').show();
			$('#resp .alert').addClass('alert-success');
			$('#resp .alert').removeClass('alert-danger');
			$('#resp .alert').text(obj.message);
		  }
		  else
		  {
			  $('#resp').show();
			  $('#resp .alert').addClass('alert-danger');
			  $('#resp .alert').text(obj.message);
		  }
		  
		  
		  setTimeout(function(){ $('#resp').hide(); },3000);
        } 
     });
   }

  });
  
  /* Reseller Create User*/

  $('#cs_resellercreate_btn').click(function(event)
  {

    /* Prevent the form to submit Date and Reload Page*/
    if (event.preventDefault) 
    {
        event.preventDefault();
    } 
    else 
    {
        event.returnValue = false;
    }

    // Only Process further if Validation is Pass
   if ($("#reseller_customer").valid()) 
  {
         
    // Show 'Please wait' loader to user, so she/he knows something is going on
   // $('.indicator').show();
 
    // If for some reason result field is visible hide it
   // $('.result-message').hide();
 
    // Collect data from inputs
    var reg_nonce = $('#cs_new_user_nonce').val();
    var reg_name  = $('input[name="cs_name"]').val();
    var reg_email  = $('input[name="cs_email"]').val();
    var reg_company  = $('input[name="cs_company"]').val();
    var reg_account  = $('input[name="cs_account"]').val();
    var parent_admin_account  = $('input[name="_user_parent_admin"]').val();
	

    /**
     * AJAX URL where to send data
     * (from localize_script)
     */
    var ajax_url = cs_reg_vars.cs_ajax_url;
 
    // Data to send
    data = {
      action: 'register_user',
      nonce: reg_nonce,
      username: reg_name,
      email: reg_email ,
      company: reg_company ,
      account: reg_account,
      _user_parent_admin: parent_admin_account
    };
 
    // Do AJAX request
    $.post( ajax_url, data, function(response) {
 
      // If we have response
      if( response ) {
		  console.log(response);
 
        // Hide 'Please wait' indicator
        //$('.indicator').hide();
 
        /* if( response === '1' ) {
          // If user is created
          $('.result-message').html('Your submission is complete.'); // Add success message to results div
          $('.result-message').addClass('alert-success'); // Add class success to results div
          $('.result-message').show(); // Show results div
        } else {
          $('.result-message').html( response ); // If there was an error, display it in results div
          $('.result-message').addClass('alert-danger'); // Add class failed to results div
          $('.result-message').show(); // Show results div
        } */
      }
    }); 
  }

  });
  
  /* TCO Calculator */
  
  $('.Add').on('click',function(event){
	  
	if (event.preventDefault) 
		{
			event.preventDefault();
		} 
    else 
		{
			event.returnValue = false;
		}

	  
	if ($("#tco_cal").valid()) 
		{  
	  
			var userid = $('input[name="user_id"]').val();
			var product_name  = $('#selectMenu option:selected').attr('data-name');
			var product_sku  = $('#selectMenu option:selected').attr('data-sku');
			var product_qty  = $('input[name="quantity"]').val();
			var product_price  = $('select[name="product"]').val();
			var reg_nonce = $('#cs_tco_cal_nonce').val();	

			/**
			 * AJAX URL where to send data
			 * (from localize_script)
			 */
			var ajax_url = cs_reg_vars.cs_ajax_url;
		 
			// Data to send
			data = {
			  action: 'insertco',
			  nonce: reg_nonce,
			  userid: userid,
			  product_name: product_name ,
			  product_sku: product_sku ,
			  product_qty: product_qty,
			  product_price: product_price
			};
	  
			$.post( ajax_url, data, function(response) 
			{
			
			  // If we have response
			   if( response ) {
				 	jQuery('.ajax_table').html(response);
					jQuery('#example').DataTable( {
						dom: 'Bfrtip',
						"aaSorting": [],
						buttons: [
							{
								extend: 'pdfHtml5',
								orientation: 'landscape',
								pageSize: 'LEGAL'
							}
						]
					} );
			  } 
			});
		}
	  
  })
  
  
  /* TCO Calculator Clear */
  $('.Clear').on('click',function(event){
	  if (event.preventDefault) 
		{
			event.preventDefault();
		} 
    else 
		{
			event.returnValue = false;
		}
		var userid = $(this).attr('id');
		var reg_nonce = $('#cs_tco_clear_nonce').val();
		
		var ajax_url = cs_reg_vars.cs_ajax_url;
		 
			// Data to send
			data = {
			  action: 'clearTable',
			  nonce: reg_nonce,
			  userid: userid			  
			};
	  
			$.post( ajax_url, data, function(response) 
			{
				var obj = jQuery.parseJSON(response);
			  // If we have response
		if( obj.status == 'success' ) 
			{
				   jQuery('.ajax_table').html('<table id="example"><thead><tr><th>SKU</th><th>Product</th><th>Quantity</th><th>Price</th><th>Total </th></tr></thead></table>');			
			} 
			});
		
  });
  
	/* Tco Calculator Email */
  $('.sendEmail').on( 'click',function(event){
	 
	if (event.preventDefault) 
		{
			event.preventDefault();
		} 
    else 
		{
			event.returnValue = false;
		}
		var userid = $('input[name="userid"]').val();
		var reg_nonce = $('#cs_tco_email_nonce').val();
		var email = $('input[name="email_address"]').val();
		
		var ajax_url = cs_reg_vars.cs_ajax_url;
		 
			// Data to send
			data = {
			  action: 'emailTable',
			  nonce: reg_nonce,
			  userid: userid,			  
			  email: email			  
			};
	  
			$.post( ajax_url, data, function(response) 
			{
				var obj = jQuery.parseJSON(response);
			  // If we have response
		if( obj.status == 'success' ) 
			{
				$('input[name="email_address"]').val("");
				$('#myModal').modal('hide');
			} 
			});
  });	
  
  /* Ticket Generating */
  
  $('.btn_screate').on('click',function( event )
  {
	if(event.preventDefault())
	  {
		  event.preventDefault();
	  }
	else
	  {
		  event.returnvalue = false;
	  }
	  
	if($('#create_ticket').valid())
	{
		
		var ticket_department 	= $('select[name="ticket_department"]').val();	
		var ticket_severity 	= $('select[name="ticket_severity"]').val();	
		var ticket_product 		= $('select[name="ticket_product"]').val();	
		var ticket_company		= $('input[name="ticket_company"]').val();	
		var issue 				= $('textarea[name="issue"]').val();	
		var user_id 			= $('input[name="user_id"]').val();			
		var reg_nonce 			= $('#cs_new_ticket_nonce').val();
		
		 var ajax_url = cs_reg_vars.cs_ajax_url;
 
		// Data to send
		data = {
		  action			: 'create_ticket',
		  nonce				: reg_nonce,
		 // ticket_subject	: ticket_subject,
		  ticket_severity	: ticket_severity ,
		  ticket_product	: ticket_product ,
		  ticket_company	: ticket_company ,
		  ticket_department	: ticket_department ,
		  issue				: issue,
		  user_id			: user_id
		};
 
    // Do AJAX request
    $.post( ajax_url, data, function(response) 
	{
 		if( response ) 
		  {
			console.log( response );
		  }
    }); 
		
		
	}		
	  
	  
	  
  })
  
  
  /* Chating For Ticket */
  $('.cht-btn').on('click',function(event)
  {
	  if(event.preventDefault())
	  {
		  event.preventDefault();
	  }
	else
	  {
		  event.returnvalue = false;
	  }
	  
		var fromUser 			= $('input[name="fromUser"]').val();	
		var ToUser 				= $('input[name="ToUser"]').val();	
		var chat_text 			= $('textarea[name="chat_text"]').val();	
		var TicketNo 			= $('input[name="TicketNo"]').val();	
		var reg_nonce 			= $('#cs_new_chat_nonce').val();	
	
	if( ToUser != 'UnAssigned' && fromUser != "" && chat_text != "" && TicketNo != "" )
	  {
		var ajax_url = cs_reg_vars.cs_ajax_url;
		  data = {
		  action			: 'chat',
		  nonce				: reg_nonce,
		  fromUser			: fromUser,
		  ToUser			: ToUser ,
		  chat_text			: chat_text ,
		  TicketNo			: TicketNo 
		  
		};
		  $.post( ajax_url, data, function(response) 
			{
				var dta = jQuery.parseJSON(response);
				if( dta.status == 'success' ) 
				  {
					$('textarea[name="chat_text"]').val("");
				  }
			});
	  }
	else
		{
			
		}
	 
  });
  
});