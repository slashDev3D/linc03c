$(".member03--item-thumbCheck").click(function(event){

    event.preventDefault(); 

    if($(this).hasClass("checked")){
        $(this).removeClass("checked")
    } else {
        $(this).addClass("checked")
    }
});


$(".biz_list_open_btn").click(function(){

    var wr_1 = $(this).data("wr_1");
    
    var vi_lst = Array();


    $('.member03--item-thumbCheck').each(function(index,item){
        
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
                "action" : "biz_open_list"
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


$(".video_list_open_btn").click(function(){

    var vi_open = $(this).data("vi_open");
    
    var vi_lst = Array();


    $('.member03--item-thumbCheck').each(function(index,item){
        
        if($(this).hasClass("checked"))
        {
            vi_lst.push($(this).data("vi_id"));
        }
    });

    if(vi_lst.length == 0)
    {
        alert("영상을 선택하세요.");
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
                "vi_open" : vi_open,
                "action" : "video_open_list"
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


$("#video_list_del_btn").click(function(){

    
    var vi_lst = Array();


    $('.member03--item-thumbCheck').each(function(index,item){
        
        if($(this).hasClass("checked"))
        {
            vi_lst.push($(this).data("vi_id"));
        }
    });

    if(vi_lst.length == 0)
    {
        alert("삭제할 영상을 선택하세요.");
        return false;
    }

    var result = confirm('정말 영상을 삭제하시겠습니까?');

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
                "action" : "video_del_list"
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




$("#biz_list_del_btn").click(function(){

    
    var vi_lst = Array();


    $('.member03--item-thumbCheck').each(function(index,item){
        
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
                "action" : "biz_del_list"
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

function sortSelectBoxClose(){
    $(".member03--sort-selectBox-val").removeClass("open")
    $(".member03--sort-selectBox-val").find(".material-symbols-outlined").text("expand_more")
    $(".member03--sort-selectBox-itemList").removeClass("on")
}
function sortSelectBoxOpen(){
    $(".member03--sort-selectBox-val").addClass("open")
    $(".member03--sort-selectBox-val").find(".material-symbols-outlined").text("expand_less")
    $(".member03--sort-selectBox-itemList").addClass("on")
}
$(".member03--sort-selectBox-val").click(function(){
    if($(this).hasClass("open")){
        sortSelectBoxClose()
    } else {
        sortSelectBoxOpen()
    }
})
$(".member03--sort-selectBox-item").click(function(){
    var thisText = $(this).text()
    sortSelectBoxClose()
    $(".member03--sort-selectBox-val p").text(thisText)
})