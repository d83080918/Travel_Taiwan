$(function () {

    /* ===========================
       Bootstrap Carousel
    =========================== */

    const carouselElement = document.querySelector("#heroCarousel");

    if (carouselElement) {

        const carousel = new bootstrap.Carousel(carouselElement, {

            interval: 4000,

            ride: "carousel",

            pause: false,

            wrap: true,

            touch: true

        });

        // 滑鼠移入停止輪播
        carouselElement.addEventListener("mouseenter", function () {

            carousel.pause();

        });

        // 滑鼠移出繼續輪播
        carouselElement.addEventListener("mouseleave", function () {

            carousel.cycle();

        });

    }

    /* ===========================
       Navbar Scroll Effect
    =========================== */

    $(window).on("scroll", function () {

        if ($(this).scrollTop() > 60) {

            $(".navbar")
                .addClass("shadow-lg")
                .css({
                    "background": "#146c43",
                    "transition": ".3s"
                });

        } else {

            $(".navbar")
                .removeClass("shadow-lg")
                .css({
                    "background": "#198754"
                });

        }

    });


});