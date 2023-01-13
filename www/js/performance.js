$(".perf--sort-optionValue").click(function(){
    $(".perf--sort-optionValue").removeClass("checked")
    $(this).addClass("checked")
})
$(".perf--sort-selectBox-view").click(function(){
    if($(this).closest(".perf--sort-selectBox").hasClass("on")){
        $(this).closest(".perf--sort-selectBox").removeClass("on")
        $(this).find("span").text("expand_more")
    } else {
        $(this).closest(".perf--sort-selectBox").addClass("on")
        $(this).find("span").text("expand_less")
        console.log($(this).find("span").text())
    }
})
$(".perf--sort-selectBox-optionItem").click(function(){
    let thisText = $(this).text()
    $(this).closest(".perf--sort-selectBox").find(".perf--sort-selectBox-view p").text(thisText)
    $(this).closest(".perf--sort-selectBox").removeClass("on")
    $(this).closest(".perf--sort-selectBox").find(".perf--sort-selectBox-view span").text("expand_more")
})