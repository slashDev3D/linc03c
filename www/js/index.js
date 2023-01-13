
var mainBannerSwiper = new Swiper('.mainBannerSwiper', {
    speed: 1,
    allowTouchMove: false,
    autoplay: {
        delay: 4500,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: '.mainBannerSwiper-button-next',
        prevEl: '.mainBannerSwiper-button-prev',
    },
});
var mainSlideLength = (mainBannerSwiper.slides.length)
const $mainSlideLength = document.getElementById("mainSlideLength")
const $mainSlideIndex = document.getElementById("mainSlideIndex")
$mainSlideLength.innerHTML = "0" + String(mainSlideLength)
$mainSlideIndex.innerHTML = "01"
mainBannerSwiper.on("slideChange",function(){
    var idx = mainBannerSwiper.realIndex + 1;
    $mainSlideIndex.innerHTML = "0" + String(idx)
})

$(".mainBannerSwiper-button-mid").click(function(){
    if($(this).hasClass("playing")){
        $(this).removeClass("playing")
        mainBannerSwiper.autoplay.start();
    } else {
        $(this).addClass("playing")
        mainBannerSwiper.autoplay.stop();
    }
})

const mainContentSwiper01 = new Swiper(".mainContentSwiper01",{
    slidesPerView: 1.1,
    spaceBetween: 10,
    navigation: {
        nextEl: ".mainContentSwiper01--next",
        prevEl: ".mainContentSwiper01--prev",
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
const mainContentSwiper02 = new Swiper(".mainContentSwiper02",{
    slidesPerView: 1.1,
    spaceBetween: 10,
    navigation: {
        nextEl: ".mainContentSwiper02--next",
        prevEl: ".mainContentSwiper02--prev",
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
const mainContentSwiper03 = new Swiper(".mainContentSwiper03",{
    slidesPerView: 1.1,
    spaceBetween: 10,
    navigation: {
        nextEl: ".mainContentSwiper03--next",
        prevEl: ".mainContentSwiper03--prev",
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

var mainEventSwiperBg = new Swiper('.mainEventSwiperBg', {
    speed: 500,
    allowTouchMove: false,
    fadeEffect: {
        crossFade: true
    },
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: '.mainEventSwiper-button-next',
        prevEl: '.mainEventSwiper-button-prev',
    },
});
var mainEventSwiper = new Swiper('.mainEventSwiper', {

    speed: 500,
    allowTouchMove: false,
    effect: 'fade',
    fadeEffect: {
      crossFade: true
    },
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: '.mainEventSwiper-button-next',
        prevEl: '.mainEventSwiper-button-prev',
    },
});
var eventSlideLength = (mainEventSwiper.slides.length)
const $mainEventSlideLength = document.getElementById("mainEventSlideLength")
const $mainEventSlideIndex = document.getElementById("mainEventSlideIndex")
$mainEventSlideLength.innerHTML = "0" + String(eventSlideLength)
$mainEventSlideIndex.innerHTML = "01"
mainEventSwiper.on("slideChange",function(){
    var idx = mainEventSwiper.realIndex + 1;
    $mainEventSlideIndex.innerHTML = "0" + String(idx)
})

$(".mainEventSwiper-button-mid").click(function(){
    if($(this).hasClass("playing")){
        $(this).removeClass("playing")
        mainEventSwiperBg.autoplay.start();
        mainEventSwiper.autoplay.start();
    } else {
        $(this).addClass("playing")
        mainEventSwiperBg.autoplay.stop();
        mainEventSwiper.autoplay.stop();
    }
})
$(".mainContentSwiper--item-thumb").click(function(){
    var thisId = $(this).attr("data-vi_id")
    console.log(thisId)
    $("#listVideoPopup_video").attr("src","https://www.youtube.com/embed/" + thisId + "?enablejsapi=1&version=3&playerapiid=ytplayer")
    $("#listVideoPopup").addClass('show')
})
$(".list--videoPopup-bg").click(function(){
    $("#listVideoPopup").removeClass('show')
    $("#listVideoPopup_video")[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
})