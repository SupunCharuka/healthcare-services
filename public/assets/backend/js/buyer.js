$( document ).ready(function() {
    $('#more-to-love').owlCarousel({
        items: 8,
        loop: true,
        margin: 10,
        autoHeight: false,
        nav: false,
        responsive: {
            0: {
                items: 2
            },
            450: {
                items: 3
            },
            600: {
                items: 4
            },
            768: {
                items: 5
            },
            1000: {
                items: 5
            },
            1206: {
                items: 7
            },
            1434: {
                items: 8
            }
        }
    });
});