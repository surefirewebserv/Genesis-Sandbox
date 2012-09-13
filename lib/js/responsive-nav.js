jQuery(document).ready(function(){

jQuery('.menu').wrap('<div id="nav-response" class="nav-responsive">');

jQuery('#nav-response').append('<a href="#" id="pull" class="closed"><strong>MENU</strong></a>');	

sf_duplicate_menu( jQuery('.nav-responsive ul'), jQuery('#pull'), 'mobile_menu', 'sf_mobile_menu' );

		
		function sf_duplicate_menu( menu, append_to, menu_id, menu_class ){
			var jQuerycloned_nav;
			
			menu.clone().attr('id',menu_id).removeClass().attr('class',menu_class).appendTo( append_to );
			jQuerycloned_nav = append_to.find('> ul');
			jQuerycloned_nav.find('.menu_slide').remove();
			jQuerycloned_nav.find('li:first').addClass('sf_first_mobile_item');
			
			append_to.click( function(){
				if ( jQuery(this).hasClass('closed') ){
					jQuery(this).removeClass( 'closed' ).addClass( 'opened' );
					jQuerycloned_nav.slideDown( 500 );
				} else {
					jQuery(this).removeClass( 'opened' ).addClass( 'closed' );
					jQuerycloned_nav.slideUp( 500 );
				}
				return false;
			} );
			
			append_to.find('a').click( function(event){
				event.stopPropagation();
			} );
		}


});