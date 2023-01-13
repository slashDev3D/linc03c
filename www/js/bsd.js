const bsdNewsSwiper = new Swiper(".bsdNewsSwiper",{
    slidesPerView: 1.1,
    spaceBetween: 10,
    navigation: {
        nextEl: ".bsd--newsSwiper-next",
        prevEl: ".bsd--newsSwiper-prev",
    },
    breakpoints: {
        480: {
          slidesPerView: 2,
          spaceBetween: 10
        },
        // when window width is >= 640px
        767: {
          slidesPerView: 3,
          spaceBetween: 20
        }
    }
})
const bsdEventSwiper = new Swiper(".bsdEventSwiper",{
    slidesPerView: 1.1,
    spaceBetween: 10,
    navigation: {
        nextEl: ".bsd--eventSwiper-next",
        prevEl: ".bsd--eventSwiper-prev",
    },
    breakpoints: {
        480: {
          slidesPerView: 2,
          spaceBetween: 10
        },
        // when window width is >= 640px
        767:{
          slidesPerView: 3,
          spaceBetween: 10
        },
        1024: {
          slidesPerView: 4,
          spaceBetween: 20
        }
    }
})