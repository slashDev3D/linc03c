
function sortSelectBoxClose(){
    $(".member03--figureItem-selectBox").removeClass("open")
    $(".member03--figureItem-selectBox").find(".material-symbols-outlined").text("expand_more")
    $(".member03--figureItem-selectBox-list").removeClass("on")
}
function sortSelectBoxOpen(){
    $(".member03--figureItem-selectBox").addClass("open")
    $(".member03--figureItem-selectBox").find(".material-symbols-outlined").text("expand_less")
    $(".member03--figureItem-selectBox-list").addClass("on")
}
$(".member03--figureItem-selectBox").click(function(){
    if($(this).hasClass("open")){
        sortSelectBoxClose()
    } else {
        sortSelectBoxOpen()
    }
})
$(".member03--figureItem-selectBox-listItem").click(function(){
    var thisText = $(this).text()
    sortSelectBoxClose()
    $(".member03--figureItem-selectBox p").text(thisText)
})


$(".clear_link_btn").click(function(){
    $(this).siblings("input").val("");
});

$(".del_file_btn").click(function(){
    $(this).hide();
    $("#file_name").text("첨부파일을 추가해주세요.");
    $("#bf_file_del0").val("1");
});

$(".ca_name_item").click(function(){
    var ca_name = $(this).data("ca_name");
    $("#ca_name").val(ca_name);
});