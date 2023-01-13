$(".login--form-keepLogin").click(function(){
    
    if($(this).hasClass("checked")){
        $(this).removeClass("checked")
        document.getElementById("keepLoginInput").checked = false
    } else {
        $(this).addClass("checked")
        document.getElementById("keepLoginInput").checked = true
    }

})

$(".login--form-pwView").click(function(){
    if($(this).hasClass("on")){
        $(this).removeClass("on")
        document.getElementById("pw").type = "password"
    } else {
        document.getElementById("pw").type = "text"
        $(this).addClass("on")
    }
})

$("input").focus(function(){
    $(".login--container").removeClass("err")
})