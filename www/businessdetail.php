<?
include_once('./_common.php');

$data_sub = "show";
$data_visit = "3";
$data = sql_fetch("select * from g5_member where mb_id = '".$bi."' and mb_level = '3' ");
$video = sql_fetch("select * from g5_video where mb_id = '".$bi."' and vi_open = '1' order by vi_id desc limit 1 ");



include_once(G5_PATH.'/head2.php');


add_stylesheet('<link rel="stylesheet" href="/css/businessdetail .css">', 0);
?>
<div class="bsd--container">
    <div class="public--wrap">
        <div class="public--where">
            <div class="public--where-before">
                <a href="/">Home<span class="material-symbols-outlined">navigate_next</span></a>
            </div>
            <div class="public--where-before">
                <a href="/business.php">LINC3.0 사업단<span class="material-symbols-outlined">navigate_next</span></a>
            </div>
            <div class="public--where-now">
                <a href=""><?=$data["mb_nick"]?></a>
            </div>
        </div>
    </div>        
    <div class="bsd--contents public--wrap">
        <div class="bsd--info">
            <div class="bsd--info-logo"><img src="<?=G5_DATA_URL.'/member_image/'.$data["mb_img"]?>" alt="사업단로고"></div>
            <div class="bsd--info-name"><?=$data["mb_nick"]?></div>
            <div class="bsd--info-tag">
                <p><?=$data["mb_2"]?></p>
                <p><?=$data["mb_1"]?></p>
            </div>
            <!--<div class="bsd--info-detail">
                <div class="bsd--info-date">
                    <span class="material-symbols-outlined">calendar_month</span><span>{YYYY.MM.DD}</span>
                </div>
                <span class="bsd--info-line"></span>
                <div class="bsd--info-area">
                    <span class="material-symbols-outlined">location_on</span><span>{소속지역}</span>
                </div>
            </div>-->
            <div class="bsd--info-button">
                <a class="bsd--info-home" href="<?=$data["mb_homepage"]?>" target="_blank">사업단 홈페이지 바로가기</a>
                <?if($video["vi_id"] != ""){?>
                    <a class="bsd--info-video" href="/performancedetail.php?vi_id=<?=$video["vi_id"]?>">성과영상 보러가기</a>
                <?}else{?>
                    <a class="bsd--info-video" href="javascript:none_video()">성과영상 보러가기</a>
                <?}?>
            </div>
            <div class="bsd--info-sns">
                <?if($data["mb_4"] != ""){?>
                <a href="<?=$data["mb_4"]?>" class="bsd--info-snsItem" target="blank"><img src="./img/facebook-app-symbol.png" alt=""></a>
                <?}?>
                <?if($data["mb_5"] != ""){?>
                <a href="<?=$data["mb_5"]?>" class="bsd--info-snsItem" target="blank"><img src="./img/instagram.png" alt=""></a>
                <?}?>
                <?if($data["mb_3"] != ""){?>
                <a href="<?=$data["mb_3"]?>" class="bsd--info-snsItem" target="blank"><img src="./img/youtube.png" alt=""></a>
                <?}?>
            </div>
        </div>
        <div class="bsd--textBox">
            <div class="bsd--text01">😉&nbsp;학교소개</div>
            <div class="bsd--text02"><?=nl2br($data["mb_signature"])?></div>
        </div>
        <div class="bsd--textBox">
            <div class="bsd--text01">💡&nbsp;사업단 소개</div>
            <div class="bsd--text02"><?=nl2br($data["mb_profile"])?></div>
        </div>
        <?php
        $sql = " select * from g5_write_biz_news where wr_is_comment = 0 and mb_id = '".$data["mb_id"]."' and wr_1 = '1' order by wr_id desc ";
        $result_news = sql_query($sql);
        

        ?>
        <div class="bsd--textBox bsd--news">
            <div class="bsd--text01">💬&nbsp;사업단 소식</div>
            <div class="bsd--swiperContainer">
                <div class="bsd--newsSwiper swiper bsdNewsSwiper">
                    <div class="swiper-wrapper">
                        <?while ($row = sql_fetch_array($result_news)){?>
                        <?php
                        $content = strip_tags($row['wr_content']);
                        $content = get_text($content, 1);
                        $content = strip_tags($content);
                        $content = str_replace('&nbsp;', '', $content);
                        $content = cut_str($content, 100, "…");
                        
                        ?>
                        <div class="swiper-slide">
                            <a href="/newsdetail.php?wr_id=<?=$row['wr_id']?>" target="_blank">
                                <div class="bsd--news-contents">
                                    <!--<p class="bsd--news-tag"><span>{소식글 태그값}</span></p>-->
                                    <p class="bsd--news-title"><?=$row["wr_subject"]?></p>
                                    <p class="bsd--news-exp"><?=$content?></p>
                                </div>
                                <p class="bsd--news-date"><span class="material-symbols-outlined">schedule</span><?=get_board_date($row['wr_datetime'])?></p>
                            </a>
                        </div>
                        <?}?>
                    </div>
                </div>
                <div class="bsd--newsSwiper-button">
                    <div class="bsd--newsSwiper-prev"><img src="./img/bsdetail_swiper_prev.png" alt=""></div>
                    <div class="bsd--newsSwiper-next"><img src="./img/bsdetail_swiper_next.png" alt=""></div>
                </div>
            </div>
        </div>

        <?php
        $sql = " select * from g5_write_event_info where wr_is_comment = 0 and mb_id = '".$data["mb_id"]."' and wr_1 = '1' order by wr_id desc ";
        $result_event = sql_query($sql);
        

        ?>
        <div class="bsd--textBox bsd--event">
            <div class="bsd--text01">🎉&nbsp;사업단 행사</div>
            <div class="bsd--swiperContainer">
                <div class="bsd--eventSwiper swiper bsdEventSwiper">
                    <div class="swiper-wrapper">
                        <?while ($row = sql_fetch_array($result_event)){?>
                        <?php
                            $thumb = get_list_thumbnail("event_info", $row['wr_id'], 305, 250, false, true);
                        ?>
                        <div class="swiper-slide">
                            <a href="/news02detail.php?wr_id=<?=$row['wr_id']?>" target="_blank" class="bsd--event-thumb">
                                <div class="bsd--event-thumbImg" style="background-image:url(<?=$thumb["src"]?>)"></div>
                            </a>
                            <div class="bsd--event-text">
                                <p class="bsd--event-title"><?=$row["wr_subject"]?></p>
                                <div class="bsd--event-info">
                                    <p class="bsd--event-date"><span class="material-symbols-outlined">schedule</span><?=get_board_date($row['wr_datetime'])?></p>
                                    <p class="bsd--event-place"><span class="material-symbols-outlined">location_on</span><?=$row["wr_2"]?></p>
                                </div>
                            </div>
                        </div>
                        <?}?>
                    </div>
                </div>
                <div class="bsd--eventSwiper-button">
                    <div class="bsd--eventSwiper-prev"><img src="./img/bsdetail_swiper_prev.png" alt=""></div>
                    <div class="bsd--eventSwiper-next"><img src="./img/bsdetail_swiper_next.png" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/bsd.js"></script>

<script>

function none_video(){
    var setTimeTimer = 2000;
    var setTime = setTimeout(toastPopupClose,setTimeTimer)
    function toastPopupClose(){
        $(".header--ToastPopup").removeClass("active")
    }

    $(".header--ToastPopup").addClass("active")
    clearTimeout(setTime)
    setTime = setTimeout(toastPopupClose,setTimeTimer)
}

</script>

<?php
include_once(G5_PATH.'/tail2.php');
?>