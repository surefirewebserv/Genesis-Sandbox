jQuery(document).ready(function(){


et_duplicate_menu( jQuery('.nav-responsive ul'), jQuery('#pull'), 'mobile_menu', 'et_mobile_menu' );
et_duplicate_menu( jQuery('.subnav-responsive ul'), jQuery('#subpull'), 'sub_mobile_menu', 'et_mobile_menu' );

		
		function et_duplicate_menu( menu, append_to, menu_id, menu_class ){
			var jQuerycloned_nav;
			
			menu.clone().attr('id',menu_id).removeClass().attr('class',menu_class).appendTo( append_to );
			jQuerycloned_nav = append_to.find('> ul');
			jQuerycloned_nav.find('.menu_slide').remove();
			jQuerycloned_nav.find('li:first').addClass('et_first_mobile_item');
			
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