jQuery(function() {  
    var pull        = jQuery('#pull');  
        menu        = jQuery('.nav-responsive ul');  
  
    jQuery(pull).on('click', function(e) {  
        e.preventDefault();  
        menu.slideToggle();  
    });  
});

jQuery(window).resize(function(){  
    var w = jQuery(window).width();  
    if(w > 320 && menu.is(':hidden')) {  
        menu.removeAttr('style');  
    }  
});