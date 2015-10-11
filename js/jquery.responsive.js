jQuery(document).ready(function(){
//    alert("page loaded OK...in my script");
    $("#mobile-menu-toggle").click(function(evt) {
        $("#mobile-menu-toggle .fa").toggleClass("the-active-mob-menu-icon");
//        alert("clicked");
        if ( $("#mob-button-icon-anex .the-active-mob-menu-icon").length > 0) {
            $("#mobile-topnav").addClass("mobile-topnav-display-on");
        } else {
            $("#mobile-topnav").removeClass("mobile-topnav-display-on");
        }
    });
});