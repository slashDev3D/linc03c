function compInit(){
    //$.get("../Header.html?g5_visit="+g5_visit, (data) => {$("#header").prepend(data)})
    $.get("../Footer.html", (data) => {$("#footer").prepend(data)})
}
compInit();

/*$(document).ready(function(){
    $("#g5_visit").text(number_format(g5_visit));
});*/

$(window).on('mousewheel',function(e){
var wheel = e.originalEvent.wheelDelta;

//스크롤값을 가져온다.
if(wheel>0){
//스크롤 올릴때
$(".headerComponent").removeClass("downScroll")
} else {
    //스크롤 내릴때
    $(".headerComponent").addClass("downScroll")
}
});