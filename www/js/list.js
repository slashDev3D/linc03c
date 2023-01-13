
// var winT = $(document).scrollTop(),
// lastScrollTop = 0,
// delta = 1;

// $(window).scroll(function(){
// winT = $(window).scrollTop()

// if (Math.abs(lastScrollTop - winT) <= delta) return;
// if (winT < 0){
//     $(".subscribeLincBar").removeClass("show")
// } else {
//     $(".subscribeLincBar").addClass("show")
//     if ((winT > lastScrollTop) && (lastScrollTop > 0)) {
//         console.log("down")
//         $(".subscribeLincBar").addClass("show")
//     } else {
//         console.log("up")
//         $(".subscribeLincBar").removeClass("show")
//     }
// }
// lastScrollTop = winT;
// })
$(".subscribeLincBar").addClass("show")


$(".list--sort-optionValue").click(function(){
$(".list--sort-optionValue").removeClass("checked")
$(this).addClass("checked")
})
$(".list--itemThumb-img").click(function(){
$("#listVideoPopup").addClass('show')
})
$(".list--videoPopup-bg").click(function(){
$("#listVideoPopup").removeClass('show')
$("iframe")[0].contentWindow.postMessage('{"event":"command","func":"' + 'stopVideo' + '","args":""}', '*');
})