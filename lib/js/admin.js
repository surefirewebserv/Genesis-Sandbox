jQuery(document).ready(function($) {
$('#one_footer').click(function () {
    if($(this).is(":checked")){
        $('#footer-right-box').fadeOut();
    }else{
        $('#footer-right-box').fadeIn();   
    }
})

if($('#one_footer').is(":checked")){
        $('#footer-right-box').hide();
    }
	
});