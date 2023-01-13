<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

if (!$is_member)
    alert('로그인 후 이용하여 주십시오.', G5_URL);


$g5['title'] = '마이페이지';

$view = sql_fetch("select * from g5_video where vi_id = '".$vi_id."' and mb_id = '".$member["mb_id"]."'");

if($view["vi_id"] == "")
{
    alert('존재하지 않는 영상 입니다.', "/bbs/video.php");
}

if ($member['mb_id'] != $view['mb_id']) {
    alert('글을 읽을 권한이 없습니다.', "/bbs/video.php");
}


$view['content'] = conv_content($view['vi_content'], 0);

// 수정, 삭제 링크
$update_href = $delete_href = '';
// 로그인중이고 자신의 글이라면 또는 관리자라면 비밀번호를 묻지 않고 바로 수정, 삭제 가능
if (($member['mb_id'] && ($member['mb_id'] === $write['mb_id'])) || $is_admin) {
    $update_href = short_url_clean(G5_BBS_URL.'/biz_news_write.php?w=u&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id);
    set_session('ss_delete_token', $token = uniqid(time()));
    $delete_href = G5_BBS_URL.'/delete.php?rtn_url=biz_news&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;token='.$token;
}

include_once(G5_PATH.'/head2.php');
add_stylesheet('<link rel="stylesheet" href="/css/member.css">', 0);

$_is_video = true;

?>
<style>
.member--container{
    margin-top:0;
}

.sound_only, .btn_cke_sc{
    display:none;
}

.list--videoPopup-figure-video{
    margin-bottom:30px;
}


</style>

<div class="member--container public--wrap member03">
    <?php
    include_once('./mypage_aside.php');
    ?>
    <div class="member--body">
        <div class="member--body-wrap">
            <div class="member--title member--title-member03detail">
                <div class="member--title-text">
                    <div class="member--title-text00">&nbsp;</div>
                    <div class="member--title-text01"><?=cut_str(get_text($view['vi_title']), 70);?></div>
                    <div class="member--title-text03">작성일:<?=get_board_view_date($view['vi_reg_date'])?><span></span>담당자 : <?=$member['mb_name']?></div>
                </div>
                <div class="member03--title-detail">
                    <a href="" class="member03--title-detail-link">게시글 보러가기</a>
                    <div class="member03--title-view">
                        <span class="material-symbols-outlined">visibility</span>
                        <!--p요소에는 해당 게시글 조회수가 숫자로 출력됩니다. -->
                        <p><?php echo number_format($view['vi_hit']) ?></p>
                    </div>
                </div>
            </div>
            <div class="member03--preview">
                <!-- 게시글 내용이 member03--preview에 나타납니다. 요소는 예시이며 자유롭게 출력되어도 무방합니다. -->
                <div class="list--videoPopup-figure list--videoPopup-figure-video"><iframe src="<?=$view['vi_url']?>" frameborder="0"></iframe></div>
                <p><?php echo get_view_thumbnail($view['content']); ?></p>
            </div>
            <div class="member03--preview-menu">
                <!-- 게시글을 수정하거나 삭제할 수 있는 버튼들 입니다. member03--preview-menuBtn요소를 div(다른요소)로 바꿔도 무관합니다.-->
                <a href="/bbs/video.php" class="member03--preview-menuBtn member03--preview-toList">목록</a>
                <div class="member03--preview-control">
                    <a class="member03--preview-menuBtn member03--preview-dlt" id="video_view_del_btn" data-vi_id="<?=$view["vi_id"]?>">삭제</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/member03.js"></script>

<script>

$("#video_view_del_btn").click(function(){

    
    var result = confirm('정말 영상을 삭제하시겠습니까?');

    if(!result)
    {
        return false;
    }

    var vi_lst_txt = $(this).data("vi_id");

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

                location.href = "/bbs/video.php";
            }
        });
    }

});

</script>
<?
include_once(G5_PATH.'/tail2.php');