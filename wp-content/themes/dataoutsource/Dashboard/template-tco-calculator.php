<?php	/* Template Name: TCO Calculator Dashboard */  ?>

<?php get_header('Dashboard'); 	?>
<link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="datatable">
<link href="//cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" rel="datatable">
<link href="https://cdn.datatables.net/buttons/1.4.2/css/buttons.dataTables.min.css" rel="stylesheet">
<?php while ( have_posts() ) : the_post(); 	$fields = get_fields(); //print_R($fields); ?> 
		<div class="main">
        <div class="container-fluid">
            <div class="heading">
                <h2>TCO Calculator</h2> </div>    
		<?php 
			
			$args = array('post_type'=> 'products','posts_per_page'=> -1);            
			$the_query = new WP_Query( $args );
			$options = '';
			if($the_query->have_posts() ) : 
				while ( $the_query->have_posts() ) : $the_query->the_post();			
				$products_fields = get_fields();
				$productName = get_the_title();
				
				$options .="<option data-name='".$productName."' data-sku='".$products_fields['product_sku']."' value='".$products_fields['product_price']."'>".$productName." - $".$products_fields['product_price']."</option>";				
				endwhile;
			endif;
			?>
		<form id="tco_cal" class="custom-form">		
		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12">
                <div class="form-group">
				<select  id="selectMenu" class="form-control" name="product">
				<option value="">Select Product</option>
				<?php echo $options; ?>
				</select>
                    </div>
			</div>	
			<div class="col-md-4 col-sm-4 col-xs-12">	
                 <div class="form-group">
				<input type="number" class="form-control" placeholder="Quantity" name="quantity">
                </div>
			</div>	
			<div class="col-md-4 col-sm-4 col-xs-12">
				<button class="add-pro-btn Add" name="Add"><i class="fa fa-plus" aria-hidden="true"></i> Add to the table</button>				
			</div>			
		</div>
		</form>
		<input type="hidden" name="user_id" value="<?php echo get_current_user_id(); ?>">
		<?php wp_nonce_field('cs_tco_cal','cs_tco_cal_nonce', true, true ); ?>
        <div class="custom-table tco-table">
            <div class="ajax_table">
			<table id="example">
				<thead>
					<tr>
						<th>SKU</th>
						<th>Product</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Total </th>                   
					</tr>
				</thead>                
            </table>
			</div>
            
           <div class="pd-btn-group">
            <a data-toggle="modal" href="#myModal" class="green-btn">SEND EMAIL</a>
            <?php wp_nonce_field('cs_tco_clear','cs_tco_clear_nonce', true, true ); ?>
             <a id="<?php echo get_current_user_id(); ?>" href="javascript:void(0)" class="green-btn Clear">Clear Table</a>
            </div>
            
<!--
            <a href="#" class="add-pro-btn"><i class="fa fa-plus" aria-hidden="true"></i> ADD PRODUCT</a>
                
-->
        </div>
    </div>
</div>
<?php endwhile; ?>
<?php get_footer('Dashboard'); ?>
<script type='text/javascript' src='//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js'></script>
<script type='text/javascript' src='//cdn.datatables.net/buttons/1.4.2/js/dataTables.buttons.min.js'></script>
<script type='text/javascript' src='//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js'></script>
<script type='text/javascript' src='//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js'></script>
<script type='text/javascript' src='//cdn.datatables.net/buttons/1.4.2/js/buttons.html5.min.js'></script>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Send Email</h4>
      </div>
      <div class="modal-body">		
		  <div class="form-group">
			<label for="email">Email address:</label>
			<input type="email" name="email_address" class="form-control" id="email">
		  </div>
		<?php wp_nonce_field('cs_tco_email','cs_tco_email_nonce', true, true ); ?>
		<input type="hidden" name="userid" value="<?php echo get_current_user_id(); ?>">
		<button class="btn btn-default sendEmail">Send</button>		   
      </div>      
    </div>

  </div>
</div>


