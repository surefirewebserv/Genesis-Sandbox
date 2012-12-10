jQuery(document).ready(function(){

/*RESPONSIVE NAVIGATION, COMBINES MENUS EXCEPT FOR FOOTER MENU*/

	jQuery('.menu').not('#footer .menu, #footer-widgets .menu').wrap('<div id="nav-response" class="nav">');
	
	jQuery('#nav-response').append('<a href="#" id="pull">Menu</a>');
	
	var pull        = jQuery('#pull');  
	    menu        = jQuery('.nav ul');  
	    menuHeight  = menu.height();  
	  
	    jQuery(pull).on('click', function(e) {  
	        e.preventDefault();  
	        menu.slideToggle();  
	    }); 
		
	/*SMOOTH SCROLLING*/
	jQuery(".scroll, .gototop a").click(function(event){		
		event.preventDefault();
		jQuery('html,body').animate({scrollTop:jQuery(this.hash).offset().top}, 500);
	});
	
	jQuery(window).resize(function(){  
	    var w = jQuery(window).width();  
	    if(w > 768 && menu.is(':hidden')) {  
	        menu.removeAttr('style');  
	    }  
	}); 


});