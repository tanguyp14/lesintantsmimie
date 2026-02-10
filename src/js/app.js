( function( $ ) {

    $('document').ready(function(){
        // Burger nav
        $('.menu-toggle').on('click', function(){
            $('header').toggleClass('header--menu-is-open');
            // Toggle aria-expanded attribute on click
            $('.main-navigation').toggleClass('menu-is-open');
        });

        // Sous-menus - empêcher le clic sur le parent et toggle le sous-menu
        $('.menu-item-has-children > a').on('click', function(e){
            e.preventDefault();
            var $parent = $(this).parent();
            $parent.toggleClass('sub-menu-open');

            // Fermer les autres sous-menus ouverts (seulement en desktop)
            if ($(window).width() > 768) {
                $('.menu-item-has-children').not($parent).removeClass('sub-menu-open');
            }
        });

        // Fermer le sous-menu quand on clique ailleurs (seulement en desktop)
        $(document).on('click', function(e){
            if ($(window).width() > 768 && !$(e.target).closest('.menu-item-has-children').length) {
                $('.menu-item-has-children').removeClass('sub-menu-open');
            }
        });

        // Mobile - ouvrir les sous-menus par défaut
        if ($(window).width() <= 768) {
            $('.menu-item-has-children').addClass('sub-menu-open');
        }
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