$(".perf--sort-optionValue").click(function(){
    $(".perf--sort-optionValue").removeClass("checked")
    $(this).addClass("checked")
})
const bsdNewsSwiper = new Swiper(".perd--others02-list",{
    slidesPerView: 1.1,
    spaceBetween: 10,
    navigation: {
        nextEl: ".perd--others02Swiper-next",
        prevEl: ".perd--others02Swiper-prev",
    },
    breakpoints: {
        560: {
          slidesPerView: 2,
          spaceBetween: 10
        },
        // when window width is >= 640px
        880: {
          slidesPerView: 3,
          spaceBetween: 20
        },
        1024: {
          slidesPerView: 4,
          spaceBetween: 20
        }
    }
})