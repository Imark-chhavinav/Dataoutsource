<?php	/* Template Name: Create Ticket Dashboard */  ?>

<?php get_header('Dashboard'); 	?>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

<?php while ( have_posts() ) : the_post(); 	$fields = get_fields(); //print_R($fields); ?> 
		 <div class="main">
        <div class="container-fluid">
            <div class="heading">
                <h2>Create Ticket</h2> 
			</div>
		<?php	echo do_shortcode('[CS_Create_Ticket]'); ?>            
        </div>
        <div class="custom-table">
			<?php	echo do_shortcode('[TICKETS_RECORDS]'); ?>            
        </div>
    </div>
<?php endwhile; ?>
<?php get_footer('Dashboard'); ?>
<script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script>
jQuery(document).ready(function() {
    jQuery('table').DataTable();
} );
</script>