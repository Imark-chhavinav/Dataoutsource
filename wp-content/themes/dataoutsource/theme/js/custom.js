jQuery(document).ready(function() {
    jQuery("#menu").click(function() {

        jQuery(".main-menu").addClass("open");
    });
    jQuery('.closeicon').click(function() {

        jQuery(".main-menu").removeClass("open");
    });

    /* Validations  */
    jQuery("input[name='FirstName'],input[name='LastName']").keypress(function(event) {
        var inputValue = event.which;
        // allow letters and whitespaces only.
        if ((inputValue > 32 && inputValue < 64) || (inputValue > 90 && inputValue < 97) || (inputValue > 123 && inputValue < 127) &&
            (inputValue != 32)) {
            event.preventDefault();
        }
    });

    jQuery("input[name='Phone']").keypress(function(event) {
        var inputValue = event.which;
        // allow letters and whitespaces only.
        if ((inputValue > 32 && inputValue < 48) || (inputValue > 57 && inputValue < 90) || (inputValue > 90 && inputValue < 122) || (inputValue > 122 && inputValue < 127) &&
            (inputValue != 32)) {
            event.preventDefault();
        }
    });

    jQuery('#testimonials').owlCarousel({
    	autoplay:			true,
    	autoplayTimeout:	3000,
		items:				1,
    	loop:				true,
    	margin:				0,
    	nav:				false,
    });
});