<?php

add_stylesheet('<link rel="stylesheet" href="/css/event.css">', 0);


?>
<div class="list-contents">
    <div class="public--wrap">
        <div class="public--where">
            <div class="public--where-before">
                <a href="/">Home<span class="material-symbols-outlined">navigate_next</span></a>
            </div>
            <div class="public--where-now">
                <a href="">이벤트</a>
            </div>
        </div>
        <div class="board--title">
            <div class="board--title-text01">이벤트</div>
            <div class="board--title-text02">채널 링크3.0 이벤트들을 만나보세요.</div>
        </div>
        <div class="board--sort">
            <div class="board--sort-option <?if($ing == "") echo "on";?>"><a href="/bbs/board.php?bo_table=event">전체</a></div>
            <div class="board--sort-option <?if($ing == "n") echo "on";?>"><a href="/bbs/board.php?bo_table=event&ing=n">진행예정 이벤트</a></div>
            <div class="board--sort-option <?if($ing == "t") echo "on";?>"><a href="/bbs/board.php?bo_table=event&ing=t">진행중인 이벤트</a></div>
            <div class="board--sort-option <?if($ing == "f") echo "on";?>"><a href="/bbs/board.php?bo_table=event&ing=f">종료된 이벤트</a></div>
        </div>
        <div class="board--list">
            <?php for ($i=0; $i<count($list); $i++) {?>
            <?php
            $origDate = substr($list[$i]["wr_1"],0,10);
            $startDate = date("Y.m.d", strtotime($origDate));

            $origDate = substr($list[$i]["wr_2"],0,10);
            $endDate = date("Y.m.d", strtotime($origDate));

            $thumb = get_list_thumbnail("event", $list[$i]['wr_id'], 414, 416, false, true);
            $img_url = "";
            if($thumb['src']) {
                $img_url = $thumb['src'];
            }

            ?>
            <div class="board--listItem">
                <!-- board--listItem-thumb 클릭 시 해당 이벤트 글로 이동 부탁드립니다.-->
                <a href="<?php echo $list[$i]['href'] ?>">
                <div class="board--listItem-thumb">
                    <div class="board--listItem-thumbImg" style="background-image:url(<?=$img_url?>)"></div>
                    <?if($list[$i]['ing'] == "n"){?>
                        <div class="board--listItem-ing ing">진행예정</div>
                    <?}else if($list[$i]['ing'] == "t"){?>
                        <div class="board--listItem-ing ing">진행중</div>
                    <?}else if($list[$i]['ing'] == "f"){?>
                        <div class="board--listItem-ing over">종료</div>
                    <?}?>
                </div>
                </a>
                <div class="board--listItem-text">
                    <div class="board--listItem-text01"><?php echo $list[$i]['subject'] ?></div>
                    <div class="board--listItem-text02">
                        <span class="material-symbols-outlined">schedule</span><p><?=$startDate?> ~ <?=$endDate?></p>
                    </div>
                </div>
            </div>
            <?}?>
        </div>

        <!-- 페이지 -->
        <?php echo $write_pages; ?>
        <!-- 페이지 -->
    </div>
</div>
<script>
    // 221101 성재민
    // 헤더의 편성표 메뉴에 불이 들어오기 위해 이 펑션을 추가합니다.
    setTimeout(() => { $(".headerComponent").attr("data-visit","5") }, (50));
</script>