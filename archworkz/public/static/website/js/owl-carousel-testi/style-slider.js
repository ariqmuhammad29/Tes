$('.owl-carousel').owlCarousel({
    loop: true,
    nav: false,
    responsiveClass: true,
    autoplay: true,
    autoplayTimeout: 4000,
    autoplaySpeed: 1500,
    responsive: {
        0: {
            items: 1
        },
        700: {
            items: 1
        },
        900: {
            items: 1
        },

        1024: {
            items: 1
        }

    }
});

$('.owl-preve').click(function () {
    $('.owl-carousel').trigger('prev.owl.carousel');
});

$('.owl-nextee').click(function () {
    $('.owl-carousel').trigger('next.owl.carousel');
});