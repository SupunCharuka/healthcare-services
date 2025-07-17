$(document).ready(function () {
    $(".banner-slider").owlCarousel({
        items: 1,
        loop: true,
        margin: 0,
        nav: true,
        dots: false,
        autoplay: true, // Enable autoplay
        autoplayTimeout: 5000, // Set autoplay interval to 5 seconds
        autoplaySpeed: 1500, // Set the transition speed to 1.5 seconds
        responsive: {
            0: {
                items: 1,
            },
            768: {
                items: 1,
            },
            992: {
                items: 1,
            },
        },
    });

    function setColumnStyles() {
        var maxHeight = 0;
        $(".p-font").each(function () {
            var columnHeight = $(this).height();
            if (columnHeight > maxHeight) {
                maxHeight = columnHeight;
            }
        });

        $(".p-font").height("auto");

        maxHeight = maxHeight + 10;

        var maxHeightValue = Math.max(maxHeight, 100);
        $(".p-font").height(maxHeightValue);
    }

    setColumnStyles();

   
    $(window).resize(function () {
        setColumnStyles();
    });
});

var banners = document.querySelectorAll(".mobile-banner-image");

function updateBannerClass() {
    banners.forEach(function (banner) {
        if (window.innerWidth <= 768) {
            banner.classList.add("banner-section", "style-two");
        } else {
            banner.classList.remove("banner-section", "style-two");
        }
    });
}

updateBannerClass();

window.addEventListener("resize", updateBannerClass);
