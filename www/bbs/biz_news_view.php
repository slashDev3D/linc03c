<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

$_REQUEST["bo_table"] = "biz_news";
$bo_table = "biz_news";

include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

if (!$is_member)
    alert('로그인 후 이용하여 주십시오.', G5_URL);


$g5['title'] = '마이페이지';


if ((isset($wr_id) && $wr_id) || (isset($wr_seo_title) && $wr_seo_title)) {
    // 글이 없을 경우 해당 게시판 목록으로 이동
    if (!$write['wr_id']) {
        $msg = '글이 존재하지 않습니다.\\n\\n글이 삭제되었거나 이동된 경우입니다.';
        alert($msg, "/bbs/biz_news.php");
    }

    if ($member['mb_id'] != $write['mb_id']) {
        if ($is_member)
            alert('글을 읽을 권한이 없습니다.', "/bbs/biz_news.php");
    }
}

$view = get_view($write, $board, $board_skin_path);
$view['content'] = conv_content($view['wr_content'], 1);

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

$_is_biz_news = true;


// 윗글을 얻음
$sql = " select wr_id, wr_subject, wr_datetime from g5_write_biz_news where wr_is_comment = 0 and wr_num < '{$write['wr_num']}' and mb_id = '".$member["mb_id"]."' order by wr_num desc, wr_reply desc limit 1 ";
$prev = sql_fetch($sql);

// 아래글을 얻음
$sql = " select wr_id, wr_subject, wr_datetime from g5_write_biz_news where wr_is_comment = 0 and wr_num > '{$write['wr_num']}' and mb_id = '".$member["mb_id"]."'  order by wr_num, wr_reply limit 1 ";
$next = sql_fetch($sql);

// 이전글 링크
$prev_href = '';
if (isset($prev['wr_id']) && $prev['wr_id']) {
    $prev_wr_subject = get_text(cut_str($prev['wr_subject'], 255));
    $prev_href = "/bbs/biz_news_view.php?wr_id=".$prev['wr_id'];
    $prev_wr_date = get_board_date($prev['wr_datetime']);
}

// 다음글 링크
$next_href = '';
if (isset($next['wr_id']) && $next['wr_id']) {
    $next_wr_subject = get_text(cut_str($next['wr_subject'], 255));
    $next_href = "/bbs/biz_news_view.php?wr_id=".$next['wr_id'];
    $next_wr_date = get_board_date($next['wr_datetime']);
}

?>
<style>
.member--container{
    margin-top:0;
}

.sound_only, .btn_cke_sc{
    display:none;
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
                    <div class="member--title-text01"><?=cut_str(get_text($view['wr_subject']), 70);?></div>
                    <div class="member--title-text03">작성일:<?=get_board_view_date($view['wr_datetime'])?><span></span>담당자 : <?=$view['wr_name']?></div>
                </div>
                <div class="member03--title-detail">
                    <a href="/newsdetail.php?wr_id=<?=$view['wr_id']?>" class="member03--title-detail-link">게시글 보러가기</a>
                    <div class="member03--title-view">
                        <span class="material-symbols-outlined">visibility</span>
                        <!--p요소에는 해당 게시글 조회수가 숫자로 출력됩니다. -->
                        <p><?php echo number_format($view['wr_hit']) ?></p>
                    </div>
                </div>
            </div>
            <div class="member03--preview">
                <!-- 게시글 내용이 member03--preview에 나타납니다. 요소는 예시이며 자유롭게 출력되어도 무방합니다. -->
                <img src="" alt="">
                <p><?php echo get_view_thumbnail($view['content']); ?></p>
            </div>
            <?if($view['wr_link1'] != ""){?>
            <div class="member03--preview-link">
                <p><a href="<?=$view['wr_link1']?>" target="_blank"><?=$view['wr_link1']?></a></p>
            </div>
            <?}?>
            <div class="member03--preview-menu">
                <!-- 게시글을 수정하거나 삭제할 수 있는 버튼들 입니다. member03--preview-menuBtn요소를 div(다른요소)로 바꿔도 무관합니다.-->
                <a href="/bbs/biz_news.php" class="member03--preview-menuBtn member03--preview-toList">목록</a>
                <div class="member03--preview-control">
                    <a class="member03--preview-menuBtn member03--preview-dlt" onclick="delform('<?=$delete_href?>');">삭제</a>
                    <a class="member03--preview-menuBtn member03--preview-fix" href="<?=$update_href?>">수정</a>
                </div>
            </div>
            <?php if ($prev_href || $next_href) { ?>
            <div class="member03--preview-other">
                
                <!--이전 글이 없으면 해당 요소는 제거 부탁드립니다.-->
                <?if ($prev_href) {?>
                <div class="member03--preview-otherItem">
                    <div class="member03--preview-otherItem-text">
                        <p>이전 글</p>
                        <p><a href="<?php echo $prev_href ?>"><?php echo $prev_wr_subject;?></a></p>
                    </div>
                    <div class="member03--preview-otherItem-date">
                        <p><?=$prev_wr_date?></p>
                    </div>
                </div>
                <?}?>
                <?if ($next_href) {?>
                <!--다음 글이 없으면 해당 요소는 제거 부탁드립니다.-->
                <div class="member03--preview-otherItem">
                    <div class="member03--preview-otherItem-text">
                        <p>다음 글</p>
                        <p><a href="<?php echo $next_href ?>"><?php echo $next_wr_subject;?></a></p>
                    </div>
                    <div class="member03--preview-otherItem-date">
                        <p><?=$next_wr_date?></p>
                    </div>
                </div>
                <?}?>
            </div>
            <?}?>
        </div>
    </div>
</div>
<script src="/js/member03.js"></script>

<script>

function delform(url)
{


    var result = confirm('정말 게시물을 삭제하시겠습니까?');

    if(!result)
    {
        return false;
    }

    location.href = url;

}

</script>
<?
include_once(G5_PATH.'/tail2.php');