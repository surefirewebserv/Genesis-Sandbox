jQuery(document).ready(function ($) {
    $("ul.menu-mobile").before('<div id="primary-menu-toggle" class="menu-toggle primary"><a class="toggle-switch show" href="#"><span>Show Menu</span></a></div>');
    $("#primary-menu-toggle .show").click(function () {
        if ($(".menu-mobile").is(":hidden")) {
            $(".menu-mobile").slideDown(500);
            $(this).attr("class", "toggle-switch hide").attr("title", "Hide Menu");
            $("#primary-menu-toggle span").replaceWith("<span>Hide Menu</span>")
        } else {
            $(".menu-mobile").hide(500);
            $(this).attr("class", "toggle-switch show").attr("title", "Show Menu");
            $("#primary-menu-toggle span").replaceWith("<span>Show Menu</span>")
        }
    });
    
    jQuery(".scroll, .gototop a").click(function (e) {
        e.preventDefault();
        jQuery("html,body").animate({
            scrollTop: jQuery(this.hash).offset().top
        }, 500)
    })
})