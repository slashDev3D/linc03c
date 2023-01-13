<?php

add_stylesheet('<link rel="stylesheet" href="/css/event.css">', 0);

$origDate = substr($list[$i]["wr_1"],0,10);
$newDate = date("Y.m.d", strtotime($view['wr_datetime']));
?>
<div class="list-contents">
    <div class="public--wrap">
        <div class="public--where">
            <div class="public--where-before">
                <a href="/">Home<span class="material-symbols-outlined">navigate_next</span></a>
            </div>
            <div class="public--where-before">
                <a href="/event.html">이벤트<span class="material-symbols-outlined">navigate_next</span></a>
            </div>
            <div class="public--where-now">
                <a href="">게시글</a>
            </div>
        </div>
        <div class="boardDetail--title">
            <div class="boardDetail--title-text">
                <div class="boardDetail--title-text01"><?php echo cut_str(get_text($view['wr_subject']), 70);?></div>
                <div class="boardDetail--title-text02">이벤트 기간 : <?php echo $view['wr_1'] ?> <?php if($view['wr_2']) { echo "~ ".$view['wr_2']; }?> <?//=$newDate?><!-- <span></span>담당자 : <?php echo $view['name'] ?>--></div>
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
                <p><?php echo get_view_thumbnail($view['content']); ?></p>
            </div>
            <div class="boardDetail--preview-menu">
                <!-- 게시글을 수정하거나 삭제할 수 있는 버튼들 입니다. boardDetail--preview-menuBtn요소를 div(다른요소)로 바꿔도 무관합니다.-->
                <a href="<?php echo $list_href ?>" class="boardDetail--preview-menuBtn boardDetail--preview-toList">목록</a>
                <div class="boardDetail--preview-control" style="display:none">
                    <a class="boardDetail--preview-menuBtn boardDetail--preview-dlt" href="">삭제</a>
                    <a class="boardDetail--preview-menuBtn boardDetail--preview-fix" href="">수정</a>
                </div>
            </div>
            <div class="boardDetail--preview-other">

                <!--이전 글이 없으면 해당 요소는 제거 부탁드립니다.-->
                <?php if ($prev_href) { ?>
                <div class="boardDetail--preview-otherItem">
                    <a href="<?php echo $prev_href ?>">
                    <div class="boardDetail--preview-otherItem-text">
                        <p>이전 글</p>
                        <p><?php echo $prev_wr_subject;?></p>
                    </div>
                    </a>
                    <div class="boardDetail--preview-otherItem-date">
                        <p><?=get_board_date($prev_wr_date)?></p>
                    </div>
                </div>
                <?}?>

                <!--다음 글이 없으면 해당 요소는 제거 부탁드립니다.-->
                <?php if ($next_href) { ?>
                <div class="boardDetail--preview-otherItem">
                    <a href="<?php echo $next_href ?>">
                    <div class="boardDetail--preview-otherItem-text">
                        <p>다음 글</p>
                        <p><?php echo $next_wr_subject;?></p>
                    </div>
                    </a>
                    <div class="boardDetail--preview-otherItem-date">
                        <p><?=get_board_date($next_wr_date)?></p>
                    </div>
                </div>
                <?}?>
            </div>
        </div>
    </div>
</div>
<script>
    // 221101 성재민
    // 헤더의 편성표 메뉴에 불이 들어오기 위해 이 펑션을 추가합니다.
    setTimeout(() => { $(".headerComponent").attr("data-visit","5") }, (50));
</script>
