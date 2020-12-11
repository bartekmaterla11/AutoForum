$(document).ready(function() {
    var NavY = $('#navik').offset().top;

    var stickyNav = function(){
        var ScrollY = $(window).scrollTop();

        if (ScrollY > NavY) {
            $('#navik').addClass('sticky');
        } else {
            $('#navik').removeClass('sticky');
        }
    };

    stickyNav();

    $(window).scroll(function() {
        stickyNav();
    });
});