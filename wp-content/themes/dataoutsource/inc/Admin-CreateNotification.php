<!DOCTYPE html>
<html>
<head>
<title>Create Notification</title>
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
			 <div class="panel-heading"><h2>Create Notification</h2></div>
			  <div class="panel-body">	
			  	<form  id="notification" class="form-horizontal">	
			  	<?php echo wp_nonce_field( 'create_noti', 'create_noti_nonce' ); ?>				
					<div class="col-sm-12">						
						<div class="form-group">
							<label class="col-sm-2 control-label">Select Notification Type</label>
							<div class="col-sm-10">
								<?php $list =  get_field('notification_type','option');  ?>
								<select name="NotificationType" class="form-control">
									<option value="">Select Notification Type</option>
									<?php foreach( $list  as $keys => $val ): ?>
										<option value="<?php echo $keys; ?>"><?php echo $val['notification_name']; ?></option>					
									<?php endforeach; ?>							
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Notification Heading</label>
							<div class="col-sm-10">
							   <input type="text" class="form-control" name="NotiHeading" placeholder="Notification Heading">
							</div>
						</div>
					  <div class="form-group">
						<label for="PromoContent" class="col-sm-2 control-label">Notification Content</label>
						<div class="col-sm-10">
						  <?php wp_editor( '', 'NotiContent', array( 'textarea_name'=>'NotiContent' ) ); ?>
						</div>
					  </div> 
					  <div class="form-group">
						<label for="PromoEndDate" class="col-sm-2 control-label">End Date</label>
						<div class="col-sm-10">
						   <input type="text" class="form-control" id="EndDate" name="EndDate" placeholder="End Date">
						</div>
					  </div>						
						<button type="submit" name="submit" class="btn btn-primary col-md-offset-10">Submit</button>
						</form>
					</div>	
			  </div>			 
			</div>
		</div>
	</div>
</div>