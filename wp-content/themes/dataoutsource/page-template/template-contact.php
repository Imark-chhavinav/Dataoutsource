<?php
/**
 * Template Name: Contact us
 *
 * @package DHJoined
 * @subpackage Imark 
 */
get_header();?>
<?php	while ( have_posts() ) : the_post(); ?>

	<div class="uprdiv inr-bnnr" style="background-image:url('<?php echo get_the_post_thumbnail_url(null,'full'); ?>');">  
		<p><?php the_title(); ?></p>
	</div> 
	
	<div class="support-formdiv contactdiv">
		<div class="container">
			<div class="row">
				<div class="head-part">
				<?php the_content(); ?>	
				</div>
			</div>
			<div class="row">
				<div class=" col-md-10 col-md-offset-1 ">
					<div class="btm-adrs">
						<div class="col-md-7 adr-div">
							<ul>
								<li>
									<span><i class="fa fa-phone" aria-hidden="true"></i></span>
									<?php echo the_field('website_contact_information','option'); ?>
									<br>
									<a href="tel:<?php echo str_replace(" ","",the_field('website_contact_number','option')); ?>">T: <?php echo the_field('website_contact_number','option'); ?>
									</a>
								</li>
									<li><span><i class="fa fa-map-marker" aria-hidden="true"></i></span><?php echo the_field('website_address','option'); ?>
								</li> 
							</ul>
						</div>
					  <div class="col-md-5 mapdiv">
					  <?php	  $map = get_field('website_map_address','option');	?>
					  <?php if(!empty($map)): ?>
						<div class="acf-map">
							<div class="marker" data-lat="<?php echo $map['lat']; ?>" data-lng="<?php echo $map['lng']; ?>"></div>
						</div>	
					<?php endif; ?>
					  </div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endwhile; ?> 


<?php get_footer(); ?>
<style type="text/css">

.acf-map {
	width: 100%;
	height: 400px;
	border: #ccc solid 1px;
	margin: 20px 0;
}

/* fixes potential theme css conflict */
.acf-map img {
   max-width: inherit !important;
}

</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCgyr5jOtzzsZS0V9IrZjsQZmIecpfj6CU"></script>
<script type="text/javascript">
(function($) {

/*
*  new_map
*
*  This function will render a Google Map onto the selected jQuery element
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$el (jQuery element)
*  @return	n/a
*/

function new_map( $el ) {
	
	// var
	var $markers = $el.find('.marker');
	
	
	// vars
	var args = {
		zoom		: 16,
		center		: new google.maps.LatLng(<?php echo $map['lat']; ?>, <?php echo $map['lng']; ?>),
		mapTypeId	: google.maps.MapTypeId.ROADMAP
	};
	
	
	// create map	        	
	var map = new google.maps.Map( $el[0], args);
	
	
	// add a markers reference
	map.markers = [];
	
	
	// add markers
	$markers.each(function(){
		
    	add_marker( $(this), map );
		
	});
	
	
	// center map
	center_map( map );
	
	
	// return
	return map;
	
}

/*
*  add_marker
*
*  This function will add a marker to the selected Google Map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	$marker (jQuery element)
*  @param	map (Google Map object)
*  @return	n/a
*/

function add_marker( $marker, map ) {

	// var
	var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

	// create marker
	var marker = new google.maps.Marker({
		position	: latlng,
		map			: map
	});

	// add to array
	map.markers.push( marker );

	// if marker contains HTML, add it to an infoWindow
	if( $marker.html() )
	{
		// create info window
		var infowindow = new google.maps.InfoWindow({
			content		: $marker.html()
		});

		// show info window when marker is clicked
		google.maps.event.addListener(marker, 'click', function() {

			infowindow.open( map, marker );

		});
	}

}

/*
*  center_map
*
*  This function will center the map, showing all markers attached to this map
*
*  @type	function
*  @date	8/11/2013
*  @since	4.3.0
*
*  @param	map (Google Map object)
*  @return	n/a
*/

function center_map( map ) {

	// vars
	var bounds = new google.maps.LatLngBounds();

	// loop through all markers and create bounds
	$.each( map.markers, function( i, marker ){

		var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

		bounds.extend( latlng );

	});

	// only 1 marker?
	if( map.markers.length == 1 )
	{
		// set center of map
	    map.setCenter( bounds.getCenter() );
	    map.setZoom( 16 );
	}
	else
	{
		// fit to bounds
		map.fitBounds( bounds );
	}

}

/*
*  document ready
*
*  This function will render each map when the document is ready (page has loaded)
*
*  @type	function
*  @date	8/11/2013
*  @since	5.0.0
*
*  @param	n/a
*  @return	n/a
*/
// global var
var map = null;

$(document).ready(function(){

	$('.acf-map').each(function(){

		// create map
		map = new_map( $(this) );

	});

});

})(jQuery);
</script>