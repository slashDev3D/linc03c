<?


$_REQUEST["bo_table"] = "biz_news";
$bo_table = "biz_news";

include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$data_sub = "show";
$data_visit = "4";

$ss_name = 'ss_biz_news_'.$wr_id;
if (!get_session($ss_name))
{
    sql_query(" update g5_write_biz_news set wr_hit = wr_hit + 1 where wr_id = '{$wr_id}' ");

    set_session($ss_name, TRUE);
}


include_once(G5_PATH.'/head2.php');


$view = get_view($write, $board, $board_skin_path);
$view['content'] = conv_content($view['wr_content'], 1);


// 윗글을 얻음
$sql = " select wr_id, wr_subject, wr_datetime from g5_write_biz_news where wr_is_comment = 0 and wr_num < '{$write['wr_num']}' and wr_1 = '1' order by wr_num desc, wr_reply desc limit 1 ";
$prev = sql_fetch($sql);

// 아래글을 얻음
$sql = " select wr_id, wr_subject, wr_datetime from g5_write_biz_news where wr_is_comment = 0 and wr_num > '{$write['wr_num']}' and wr_1 = '1'  order by wr_num, wr_reply limit 1 ";
$next = sql_fetch($sql);

// 이전글 링크
$prev_href = '';
if (isset($prev['wr_id']) && $prev['wr_id']) {
    $prev_wr_subject = get_text(cut_str($prev['wr_subject'], 255));
    $prev_href = "/newsdetail.php?wr_id=".$prev['wr_id'];
    $prev_wr_date = get_board_date($prev['wr_datetime']);
}

// 다음글 링크
$next_href = '';
if (isset($next['wr_id']) && $next['wr_id']) {
    $next_wr_subject = get_text(cut_str($next['wr_subject'], 255));
    $next_href = "/newsdetail.php?wr_id=".$next['wr_id'];
    $next_wr_date = get_board_date($next['wr_datetime']);
}


add_stylesheet('<link rel="stylesheet" href="/css/news.css">', 0);

?>

<div class="list-contents">
    <div class="public--wrap">
        <div class="public--where">
            <div class="public--where-before">
                <a href="/">Home<span class="material-symbols-outlined">navigate_next</span></a>
            </div>
            <div class="public--where-before">
                <a href="/news.php">소식 모아보기<span class="material-symbols-outlined">navigate_next</span></a>
            </div>
            <div class="public--where-now">
                <a href="">게시글</a>
            </div>
        </div>
        <div class="boardDetail--title">
            <div class="boardDetail--title-text">
                <div class="boardDetail--title-text01"><?=cut_str(get_text($view['wr_subject']), 70);?></div>
                <div class="boardDetail--title-text02">작성일:<?=get_board_view_date($view['wr_datetime'])?><span></span>담당자 : <?=$view['wr_name']?></div>
            </div>
            <div class="boardDetail--title-view">
                <span class="material-symbols-outlined">visibility</span>
                <!--p요소에는 해당 게시글 조회수가 숫자로 출력됩니다. -->
                <p><?php echo number_format($view['wr_hit']) ?></p>
            </div>
        </div>

        <div class="boardDetail--body-wrap">
            <div class="boardDetail--preview">
                <!-- 게시글 내용이 boardDetail--preview에 나타납니다. 요소는 예시이며 자유롭게 출력되어도 무방합니다. -->
                <img src="" alt="">
                <p><?php echo get_view_thumbnail($view['content']); ?></p>
            </div>
            <?if($view['wr_link1'] != ""){?>
            <div class="boardDetail--preview-link">
                <p><a href="<?=$view['wr_link1']?>" target="_blank"><?=$view['wr_link1']?></a></p>
            </div>
            <?}?>
            <div class="boardDetail--preview-menu">
                <!-- 게시글을 수정하거나 삭제할 수 있는 버튼들 입니다. boardDetail--preview-menuBtn요소를 div(다른요소)로 바꿔도 무관합니다.-->
                <a href="/news.php" class="boardDetail--preview-menuBtn boardDetail--preview-toList">목록</a>
                <!--<div class="boardDetail--preview-control">
                    <a class="boardDetail--preview-menuBtn boardDetail--preview-dlt" href="">삭제</a>
                    <a class="boardDetail--preview-menuBtn boardDetail--preview-fix" href="">수정</a>
                </div>-->
            </div>
            <?php if ($prev_href || $next_href) { ?>
            <div class="boardDetail--preview-other">
                
                <!--이전 글이 없으면 해당 요소는 제거 부탁드립니다.-->
                <?if ($prev_href) {?>
                <div class="boardDetail--preview-otherItem">
                    <div class="boardDetail--preview-otherItem-text">
                        <p>이전 글</p>
                        <p><a href="<?php echo $prev_href ?>"><?php echo $prev_wr_subject;?></a></p>
                    </div>
                    <div class="boardDetail--preview-otherItem-date">
                        <p><?=$prev_wr_date?></p>
                    </div>
                </div>
                <?}?>
                <!--다음 글이 없으면 해당 요소는 제거 부탁드립니다.-->
                <?if ($next_href) {?>
                <div class="boardDetail--preview-otherItem">
                    <div class="boardDetail--preview-otherItem-text">
                        <p>다음 글</p>
                        <p><a href="<?php echo $next_href ?>"><?php echo $next_wr_subject;?></a></p>
                    </div>
                    <div class="boardDetail--preview-otherItem-date">
                        <p><?=$next_wr_date?></p>
                    </div>
                </div>
                <?}?>
            </div>
            <?}?>
        </div>
    </div>
</div>

<script src="./js/event.js"></script>

<?php
include_once(G5_PATH.'/tail2.php');
?>