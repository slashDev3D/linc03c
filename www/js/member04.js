$(".member04--item-thumbCheck").click(function(event){

    event.preventDefault(); 

    if($(this).hasClass("checked")){
        $(this).removeClass("checked")
    } else {
        $(this).addClass("checked")
    }
})
function sortSelectBoxClose(){
    $(".member04--sort-selectBox-val").removeClass("open")
    $(".member04--sort-selectBox-val").find(".material-symbols-outlined").text("expand_more")
    $(".member04--sort-selectBox-itemList").removeClass("on")
}
function sortSelectBoxOpen(){
    $(".member04--sort-selectBox-val").addClass("open")
    $(".member04--sort-selectBox-val").find(".material-symbols-outlined").text("expand_less")
    $(".member04--sort-selectBox-itemList").addClass("on")
}
$(".member04--sort-selectBox-val").click(function(){
    if($(this).hasClass("open")){
        sortSelectBoxClose()
    } else {
        sortSelectBoxOpen()
    }
})
$(".member04--sort-selectBox-item").click(function(){
    var thisText = $(this).text()
    sortSelectBoxClose()
    $(".member04--sort-selectBox-val p").text(thisText)
})


$(".event_list_open_btn").click(function(){

    var wr_1 = $(this).data("wr_1");
    
    var vi_lst = Array();


    $('.member04--item-thumbCheck').each(function(index,item){
        
        if($(this).hasClass("checked"))
        {
            vi_lst.push($(this).data("wr_id"));
        }
    });

    if(vi_lst.length == 0)
    {
        alert("게시물을 선택하세요.");
        return false;
    }

    var vi_lst_txt = vi_lst.join(","); 

    if(vi_lst_txt != "")
    {
        $.ajax({
            url: g5_bbs_url+"/ajax.action.php",
            type: "POST",
            dataType: "json",
            data: {
                "vi_lst" : vi_lst_txt,
                "wr_1" : wr_1,
                "action" : "event_open_list"
            },
            async: true,
            cache: false,
            success: function(data, textStatus) {
                if(data.error != "")
                {
                    alert(data.error);
                    return false;
                }

                location.reload();
            }
        });
    }
    
});


$("#event_list_del_btn").click(function(){

    
    var vi_lst = Array();


    $('.member04--item-thumbCheck').each(function(index,item){
        
        if($(this).hasClass("checked"))
        {
            vi_lst.push($(this).data("wr_id"));
        }
    });

    if(vi_lst.length == 0)
    {
        alert("삭제할 게시물을 선택하세요.");
        return false;
    }

    var result = confirm('정말 게시물을 삭제하시겠습니까?');

    if(!result)
    {
        return false;
    }

    var vi_lst_txt = vi_lst.join(","); 


    if(vi_lst_txt != "")
    {
        $.ajax({
            url: g5_bbs_url+"/ajax.action.php",
            type: "POST",
            dataType: "json",
            data: {
                "vi_lst" : vi_lst_txt,
                "action" : "event_del_list"
            },
            async: true,
            cache: false,
            success: function(data, textStatus) {
                if(data.error != "")
                {
                    alert(data.error);
                    return false;
                }

                location.reload();
            }
        });
    }
    
});


$(".del_file_btn").click(function(){
    $(this).hide();
    $("#file_name").text("첨부파일을 추가해주세요.");
    $("#bf_file_del0").val("1");
});