( function( $ ) {

    $('document').ready(function(){
        // Burger nav
        $('.menu-toggle').on('click', function(){
            $('header').toggleClass('header--menu-is-open');
            // Toggle aria-expanded attribute on click
            $('.main-navigation').toggleClass('menu-is-open');
        });
        // Do things...
    });

    $(window).scroll(function(){
        // Header scroll behavior
        var scrollPosition = $(window).scrollTop();
        var scrollThreshold = window.innerHeight * 0.5; // 50vh

        if (scrollPosition > scrollThreshold) {
            $('.header').addClass('header--scrolled');
        } else {
            $('.header').removeClass('header--scrolled');
        }
    });

}( jQuery ) );