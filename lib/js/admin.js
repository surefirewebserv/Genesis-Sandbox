jQuery(document).ready(function($) {
    // $() will work as an alias for jQuery() inside of this function
	
	$("#primary-menu-toggle .show").click(function () {
		if ($(".menu-primary").is(":hidden")) {
			$(".menu-primary").slideDown(500);
			$(this).attr('class', 'toggle-switch hide').attr('title', 'Hide Menu');
			$('#primary-menu-toggle span').replaceWith('<span>Hide Menu</span>');
		} else {
			$(".menu-primary").hide(500);
			$(this).attr('class', 'toggle-switch show').attr('title', 'Show Menu');
			$('#primary-menu-toggle span').replaceWith('<span>Show Menu</span>');
		}
	});
	
	$("#secondary-menu-toggle .show").click(function () {
		if ($(".menu-secondary").is(":hidden")) {
			$(".menu-secondary").slideDown(500);
			$(this).attr('class', 'toggle-switch hide').attr('title', 'Hide Menu');
			$('#secondary-menu-toggle span').replaceWith('<span>Hide Menu</span>');
		} else {
			$(".menu-secondary").hide(500);
			$(this).attr('class', 'toggle-switch show').attr('title', 'Show 2nd Menu');
			$('#secondary-menu-toggle span').replaceWith('<span>Show 2nd Menu</span>');
		}
	});
	
	/*SMOOTH SCROLLING*/
	jQuery(".scroll, .gototop a").click(function(event){		
		event.preventDefault();
		jQuery('html,body').animate({scrollTop:jQuery(this.hash).offset().top}, 500);
	});
	
	
});


/*
 *  This script hides or shows the menu on resize if required.
 */

/*
 * finds the height of the #sidebar and #sidebar-alt the sets the #content to have a min-height of whichever value is greater
 */
function fluidMenuToggle(){

	var body = jQuery( 'body' ).width();
	
	if( body > 768 ){
    
		jQuery(".menu-primary").slideDown(500);
		jQuery(".menu-secondary").slideDown(500);

	}
	else if( body < 768 ) {
	
		jQuery(".menu-primary").hide(500);
		jQuery(".menu-secondary").hide(500);
		
	}
	
	
}


var menuTimer;
jQuery(window).resize(function() {
	clearTimeout(menuTimer);
	menuTimer = setTimeout(fluidMenuToggle, 100);
}); 
		
		