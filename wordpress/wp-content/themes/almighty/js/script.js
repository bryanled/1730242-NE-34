(function ($, window, undefined) {
    "use strict";
    $(function () {
        $('#mainslider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 8000,
            infinite: true,
            dots: true,
            nextArrow: '<i class="nav-arrow nav-main icon-right"></i>',
            prevArrow: '<i class="nav-arrow nav-main icon-left"></i>',
            responsive: [
                {
                    breakpoint: 767,
                    settings: {
                        arrows: false
                    }
                }
            ]
        });
        $(".gallery-columns-1, ul.wp-block-gallery.columns-1, .wp-block-gallery.columns-1 .blocks-gallery-grid").each(function () {
            $(this).slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                fade: true,
                autoplay: true,
                autoplaySpeed: 8000,
                infinite: true,
                dots: false,
                nextArrow: '<i class="nav-arrow icon-right"></i>',
                prevArrow: '<i class="nav-arrow icon-left"></i>',
            });
        });
    });
    $(function () {
        $('.widget-area').theiaStickySidebar({
            additionalMarginTop: 30
        });
    });
    $(function () {
        var pageSection = $(".header-image");
        pageSection.each(function (indx) {
            if ($(this).attr("data-background")) {
                $(this).css("background-image", "url(" + $(this).data("background") + ")");
            }
        });
    });
    $(function () {

        $('.icon-search').on('click', function (event) {
            $('body').toggleClass('united-model');
            setTimeout(function () { 
                $('.icon-search').focus();
            }, 300);
            
        });
        $('.cross-exit').on('click', function (event) {
            $('body').removeClass('united-model');
            $('.icon-search').focus();
        });

        $(document).keyup(function(j) {
            if (j.key === "Escape") { // escape key maps to keycode `27`
                $('body').removeClass('united-model');
            }
        });

        $('button, input, a' ).on('focus', function() {
            if ( $( 'body' ).hasClass( 'united-model' ) ) {
                if ( ! $( this ).parents( '.model-search' ).length ) {
                   $('.model-search-wrapper .search-field').focus();
                }
            }
        } );

        $('.model-search .cross-exit').blur(function(){
            if ($('body').hasClass('united-model')) {
                $('.model-search .search-field').focus();
            }
        });

    });
    $('.gallery, .wp-block-gallery').each(function () {
        $(this).magnificPopup({
            delegate: 'a',
            type: 'image',
            closeOnContentClick: false,
            closeBtnInside: false,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            image: {
                verticalFit: true,
                titleSrc: function (item) {
                    return item.el.attr('title');
                }
            },
            gallery: {
                enabled: true
            },
            zoom: {
                enabled: true,
                duration: 300,
                opener: function (element) {
                    return element.find('img');
                }
            }
        });
    });
    $('.zoom-gallery').each(function () {
        $(this).magnificPopup({
            delegate: 'span',
            type: 'image',
            closeOnContentClick: false,
            closeBtnInside: false,
            mainClass: 'mfp-with-zoom mfp-img-mobile',
            image: {
                verticalFit: true,
                titleSrc: function (item) {
                    return item.el.attr('title');
                }
            },
            zoom: {
                enabled: true,
                duration: 300,
                opener: function (element) {
                    return element.find('img');
                }
            }
        });
    });
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.scroll-up').fadeIn();
        } else {
            $('.scroll-up').fadeOut();
        }
    });
    $('.scroll-up').on("click", function (e) {
        $("html, body").animate({scrollTop: 0}, 600);
        return false;
    });
})(jQuery, this);