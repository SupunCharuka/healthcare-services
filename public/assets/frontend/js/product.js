(function ($) {
    "use strict";

    /*---single product activation---*/
    $("#gallery_01").owlCarousel({
        autoplay: true,
        loop: true,
        nav: true,
        autoplayTimeout: 8000,
        items: 4,
        margin: 15,
        dots: false,
        navText: [
            '<i class="fa fa-angle-left"></i>',
            '<i class="fa fa-angle-right"></i>',
        ],
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
            },
            320: {
                items: 2,
            },
            992: {
                items: 3,
            },
            1200: {
                items: 4,
            },
        },
    });

    /*---elevateZoom---*/
    $("#zoom1").elevateZoom({
        gallery: "gallery_01",
        responsive: true,
        cursor: "crosshair",
        zoomType: "inner",
    });

    $(".btn-color-fam").click(function () {
        // Change stock
        $(".btn-color-fam").removeClass("selected");
        $(this).addClass("selected");

        //   Change image
        $(".elevatezoom-gallery").removeClass("zoomGalleryActive");
        var color_fam = $(this).attr("data-color-fam");
        $("#" + color_fam).addClass("zoomGalleryActive");
        var img = $("#" + color_fam).attr("data-image");
        $("#zoom1").attr("src", img);
        $("#zoom1").attr("data-zoom-image", img);
        $(".zoomWindow").css({"background-image": "url('" + img + "'"});

        //        owl.trigger('next.owl.carousel');
    });

    $(".biz-product-carousel").owlCarousel({
        items: 1,
        navigation: true,
        pagination: false,
        autoWidth: true,
        navigationText: ["", ""],
    });

    $(".more-by-star").owlCarousel({
        items: 1,
        navigation: true,
        pagination: false,
        autoWidth: true,
        navigationText: ["", ""],
        itemsDesktop: [1000, 1], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 1], // betweem 900px and 601px
        itemsTablet: [768, 1], //2 items between 600 and 0;
        itemsTablet: [556, 1], //2 items between 600 and 0;
        itemsMobile: [430, 1] // itemsMobile disabled - inherit from itemsTablet option
    });




    // Livewire.on("changePhoto", (stock_id) => {
    //     //   Change image
    //     $(".elevatezoom-gallery").removeClass("zoomGalleryActive");
    //     var color_fam = "stock-" + stock_id;
    //     $("#" + color_fam).addClass("zoomGalleryActive");
    //     var img = $("#" + color_fam).attr("data-image");
    //     $("#zoom1").attr("src", img);
    //     $("#zoom1").attr("data-zoom-image", img);
    //     $(".zoomWindow").css({"background-image": "url('" + img + "'"});
    // });
})(jQuery);
