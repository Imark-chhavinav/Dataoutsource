window.To = 0;
$(document).ready(function(){
	
	$('#ticketManager').DataTable();
	
	
	/* Popup On Click on View Button in Admin Ticket Manager */
	$('.getPop').on('click',function()
	{
		var id =  $(this).attr('data-id');
		var nonce =  $('#cs_get_AssignTicket_nonce').val();
		var ajax_url = cs_admin_vars.cs_admin_url;
		// Data to send
		data = {
			action: 'AssignTicket',
			nonce: nonce,
			TickeID: id      
		};
 
		// Do AJAX request
		$.post( ajax_url, data, function(response) 
		{
		  if( response ) 
			{
				var res = jQuery.parseJSON(response);
				$('#myModal').modal('show');
				$('.save_chn').attr('id',id);
				$('.modal-body').html(res.content);
				$('.modal-title').html(res.heading);
			}
		}); 
		
		
	});
	
	/* Save Changes send by Popup */
	$('.save_chn').on('click',function(){
		var id =  $(this).attr('id');
		var userid_handleby =  $('select[name="userid_handleby"]').val();
		var ticket_status =  $('select[name="ticket_status"]').val();
		var nonce =  $('#cs_save_AssignTicket_nonce').val();
		var ajax_url = cs_admin_vars.cs_admin_url;
		
		data = {
			action: 'saveAssignTicket',
			userid_handleby: userid_handleby,
			ticket_status: ticket_status,
			nonce: nonce,
			TickeID: id      
		};
 
		// Do AJAX request
		$.post( ajax_url, data, function(response) 
		{
			var obj = jQuery.parseJSON(response);
		if( obj.status == 'success' ) 
			{				
				$('.save_chn').attr('id',"");
				$('.modal-body').html("");
				$('.modal-title').html(obj.message);
				location.reload();
			}
		else if(obj.status == 'error')
			{
				$('.save_chn').attr('id',"");
				$('.modal-body').html("");
				$('.modal-title').html(obj.message);
				location.reload();
			}
		}); 
		
	});

	/* Alert To Assign User */
	$('.alertMe').on('click',function()
	{
		alert('Please Assign User First !');
	});

	/* Chating BTn  */
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
		var ajax_url = cs_admin_vars.cs_admin_url;
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
	
	if($('input[name="fromUser"]').length > 0)
	{
		AjaxChat(); setInterval("AjaxChat()",3000)	
	}	
	
});
function AjaxChat()
	{
		
		var CfromUser 			= jQuery('input[name="fromUser"]').val();	
		var CToUser 			= jQuery('input[name="ToUser"]').val();	
		
		var CTicketNo 			= jQuery('input[name="TicketNo"]').val();	
		var Creg_nonce 			= jQuery('#cs_get_chat_nonce').val();

		var ajax_url = cs_admin_vars.cs_admin_url;
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
				});	
	}