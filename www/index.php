<?
include_once('./_common.php');
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_PATH.'/head2.php');
?>


<div class="mainBannerSwiper--container">
    <div class="mainBannerSwiper--wrap">
        <!--이벤트 컨텐츠 작성시 이 곳에 출력됩니다 -->
        <div class="mainBannerSwiper">
            <div class="swiper-wrapper">
                <!-- 해당 콘텐츠 개수 만큼 이 슬라이드를 복제해주세요 -->
                    <!--이벤트 컨텐츠의 컬러입력값이 .swiper-slide의 background-color값으로 들어가게 해주세요.-->
                    <div class="swiper-slide" style="background-color:#13181e">
                        <div class="swiper-slide-img-bg" >
                            <!--이벤트 컨텐츠 중 이미지01 = background-image:url(이곳으로 들어가게 해주세요)-->
                            <div class="swiper-slide-img-bgBox" style="background-image: url(img/main_bnr01_bg.png);"></div>
                        </div>
                        <div class="swiper-slide-wrap public--wrap">
                            <div class="swiper-slide-text">
                                <div class="mainBannerSwiper--typeWrap">
                                    <!-- 이벤트 게시글의 셀렉트 타입에 맞는 type을 출력해주세요  -->
                                    <p class="mainBannerSwiper--type mainBannerSwiper--type01">😃 채널 링크3.0</p>
                                    <!-- <p class="mainBannerSwiper--type mainBannerSwiper--type02">똑똑 위클리</p> -->
                                    <!-- <p class="mainBannerSwiper--type mainBannerSwiper--type03">링크 어워드</p> -->
                                    <!-- <p class="mainBannerSwiper--type mainBannerSwiper--type04">링크 컴퍼니</p> -->
                                </div>
                                <!-- 이벤트 컨텐츠의 텍스트(타이틀)이 출력됩니다. -->
                                <div class="mainBannerSwiper--title"><p>똑똑 위클리</p></div>
                                <div class="mainBannerSwiper--exp">
                                    <p>
                                        <!-- 이벤트 컨텐츠의 텍스트(내용)이 출력됩니다. -->
                                        #LINC3.0 사업 핵심 이슈 <br>#링크 사업의 이야기를 모아모아 <br>#서경석이 알려주는 알짜 사업 정보
                                        <!-- #일타 강사가 쏙쏙! 알려주는 알짜 사업 정보<br> -->
                                    </p>
                                </div>
                            </div>
                            <!--이벤트 컨텐츠 중 이미지01 = background-image:url(이곳으로 들어가게 해주세요) div.swiper-slide-img-bgBox의 이미지01과 같은 이미지가 출력됩니다.-->
                            <div class="swiper-slide-img" style="background-image: url(img/main_bnr01.png);"></div>
                        </div>
                    </div>
                    <div class="swiper-slide" style="background-color:#3a0b7b">
                        <div class="swiper-slide-img-bg" >
                            <!--이벤트 컨텐츠 중 이미지01 = background-image:url(이곳으로 들어가게 해주세요)-->
                            <div class="swiper-slide-img-bgBox" style="background-image: url(img/main_bnr02_bg.png);"></div>
                        </div>
                        <div class="swiper-slide-wrap public--wrap">
                            <div class="swiper-slide-text">
                                <div class="mainBannerSwiper--typeWrap">
                                    <!-- 이벤트 게시글의 셀렉트 타입에 맞는 type을 출력해주세요  -->
                                    <p class="mainBannerSwiper--type mainBannerSwiper--type02">🌟 채널 링크3.0</p>
                                    <!-- <p class="mainBannerSwiper--type mainBannerSwiper--type02">똑똑 위클리</p> -->
                                    <!-- <p class="mainBannerSwiper--type mainBannerSwiper--type03">링크 어워드</p> -->
                                    <!-- <p class="mainBannerSwiper--type mainBannerSwiper--type04">링크 컴퍼니</p> -->
                                </div>
                                <!-- 이벤트 컨텐츠의 텍스트(타이틀)이 출력됩니다. -->
                                <div class="mainBannerSwiper--title"><p>링크 어워드</p></div>
                                <div class="mainBannerSwiper--exp">
                                    <p>
                                        <!-- 이벤트 컨텐츠의 텍스트(내용)이 출력됩니다. -->
                                        #LINC3.0 사업 우수 성과자 시상<br>
                                        #개인의 경험을 인사이트로<br>
                                        #그들이 전해주는 진솔한 이야기<br>
                                    </p>
                                </div>
                            </div>
                            <!--이벤트 컨텐츠 중 이미지01 = background-image:url(이곳으로 들어가게 해주세요) div.swiper-slide-img-bgBox의 이미지01과 같은 이미지가 출력됩니다.-->
                            <div class="swiper-slide-img" style="background-image: url(img/main_bnr02.png);"></div>
                        </div>
                    </div>
                    <div class="swiper-slide" style="background-color:#6b3ed5">
                        <div class="swiper-slide-img-bg" >
                            <!--이벤트 컨텐츠 중 이미지01 = background-image:url(이곳으로 들어가게 해주세요)-->
                            <div class="swiper-slide-img-bgBox" style="background-image: url(img/main_bnr03_bg.png);"></div>
                        </div>
                        <div class="swiper-slide-wrap public--wrap">
                            <div class="swiper-slide-text">
                                <div class="mainBannerSwiper--typeWrap">
                                    <!-- 이벤트 게시글의 셀렉트 타입에 맞는 type을 출력해주세요  -->
                                    <p class="mainBannerSwiper--type mainBannerSwiper--type03">😬 MC 이상준, 해지대지</p>
                                    <!-- <p class="mainBannerSwiper--type mainBannerSwiper--type02">똑똑 위클리</p> -->
                                    <!-- <p class="mainBannerSwiper--type mainBannerSwiper--type03">링크 어워드</p> -->
                                    <!-- <p class="mainBannerSwiper--type mainBannerSwiper--type04">링크 컴퍼니</p> -->
                                </div>
                                <!-- 이벤트 컨텐츠의 텍스트(타이틀)이 출력됩니다. -->
                                <div class="mainBannerSwiper--title"><p>링크 컴퍼니</p></div>
                                <div class="mainBannerSwiper--exp">
                                    <p>
                                        <!-- 이벤트 컨텐츠의 텍스트(내용)이 출력됩니다. -->
                                        #낱낱이 파헤치는 기업의 이야기<br>
                                        #학생들이 직접 만드는 광고 이야기!<br>
                                        #기업 광고? 어서 오시고<br>
                                    </p>
                                </div>
                            </div>
                            <!--이벤트 컨텐츠 중 이미지01 = background-image:url(이곳으로 들어가게 해주세요) div.swiper-slide-img-bgBox의 이미지01과 같은 이미지가 출력됩니다.-->
                            <div class="swiper-slide-img" style="background-image: url(img/main_bnr03.png);"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mainBannerSwiper--nav public--wrap">
                <div class="mainBannerSwiper--index">
                    <span id="mainSlideIndex"></span>&nbsp;/&nbsp;<span id="mainSlideLength"></span>
                </div>
                <div class="mainBannerSwiper--navButton">
                    <div class="mainBannerSwiper-button-prev">
                    <div class="mainBannerSwiper-button-bg"></div>
                    <span class="material-symbols-outlined">navigate_before</span>
                    <!-- <img src="./img/main_swiper_prev.png" alt=""> -->
                    </div>
                    <div class="mainBannerSwiper-button-mid">
                    <div class="mainBannerSwiper-button-stopIcon stop">
                        <div class="mainBannerSwiper-button-bg"></div>
                        <img src="./img/main_swiper_stop.png" alt="">
                    </div>
                    <div class="mainBannerSwiper-button-stopIcon play">
                        <div class="mainBannerSwiper-button-bg"></div>
                        <!-- <img src="./img/main_swiper_play.png" alt=""> -->
                        <span class="material-symbols-outlined">play_arrow</span>
                    </div>
                    </div>
                    <div class="mainBannerSwiper-button-next">
                        <div class="mainBannerSwiper-button-bg"></div>
                        <span class="material-symbols-outlined">navigate_next</span>
                        <!-- <img src="./img/main_swiper_next.png" alt=""> -->
                    </div>
                </div>
            </div>
    </div>
</div>
<!--
    컨텐츠들은 mainContentSwiper라는 스와이퍼에 각각 담깁니다.
    각 스와이퍼는 mainContentSwiper 클래스가 있고 mainContentSwiper01~... 넘버링으로 각각의 개별 클래스가 지정되며
    해당 스와이퍼들을 담당하는 prev,next버튼 또한 mainContentSwiper--prev 클래스가 있고 mainContentSwiper01--prev,mainContentSwiper02--prev...의 개별 클래스로 지정되어있습니다(next도 같음).
    -->
<!-- 콕콕위클리 -->
<div class="public--wrap">
    <div class="mainContentSwiper01 mainContentSwiper swiper">
        <div class="mainContentSwiper--head">
            <div class="mainContentSwiper--title">
                <!--p요소에는 컨텐츠 종류가 들어갑니다 (똑똑위클리, 링크어워드, 링크컴퍼니 )-->
                <p>똑똑 위클리</p>
            </div>
            <div class="mainContentSwiper--nav">
                <div class="mainContentSwiper--prev mainContentSwiper01--prev">
                    <!-- <span class="material-symbols-outlined">navigate_before</span> -->
                    <span class="material-symbols-outlined">navigate_before</span>
                </div>
                <div class="mainContentSwiper--next mainContentSwiper01--next">
                    <!-- <span class="material-symbols-outlined">navigate_next</span> -->
                    <span class="material-symbols-outlined">navigate_next</span>
                </div>
                <a href="./list01.html">전체보기</a>
            </div>
        </div>
        <div class="swiper-wrapper">
            <!-- 해당 콘텐츠 개수 만큼 이 슬라이드를 복제해주세요 -->
            <?echo latest_linc('/linc_list', 'calender', 6, 40, 1, '', '똑똑 위클리');	?>
            <!-- <div class="noContent">
                <img src="/img/main_noContent01.png" alt="">
                <p>2022년 11월 15일, 첫 방영</p>
            </div> -->
        </div>
    </div>
</div>
<!-- 링크 어워드 -->
<div class="public--wrap">
    <div class="mainContentSwiper02 mainContentSwiper swiper">
        <div class="mainContentSwiper--head">
            <div class="mainContentSwiper--title">
                <!--p요소에는 컨텐츠 종류가 들어갑니다 (똑똑위클리, 링크어워드, 링크컴퍼니 )-->
                <p>링크 어워드</p>
            </div>
            <div class="mainContentSwiper--nav">
                <div class="mainContentSwiper--prev mainContentSwiper02--prev"><span class="material-symbols-outlined">navigate_before</span></div>
                <div class="mainContentSwiper--next mainContentSwiper02--next"><span class="material-symbols-outlined">navigate_next</span></div>
                <a href="./list03.html">전체보기</a>
            </div>
        </div>
        <div class="swiper-wrapper">
            <!-- 해당 콘텐츠 개수 만큼 이 슬라이드를 복제해주세요 -->
            <? echo latest_linc('/linc_list', 'calender', 6, 40, 1, '', '링크 어워드');	?>
            <!-- <div class="noContent">
                <img src="/img/main_noContent02.png" alt="">
                <p>2022년 11월 16일, 첫 방영</p>
            </div> -->
        </div>
    </div>
</div>
<!-- 링크 컴퍼니 -->
<div class="public--wrap">
    <div class="mainContentSwiper03 mainContentSwiper swiper">
        <div class="mainContentSwiper--head">
            <div class="mainContentSwiper--title">
                <!--p요소에는 컨텐츠 종류가 들어갑니다 (똑똑위클리, 링크어워드, 링크컴퍼니 )-->
                <p>링크 컴퍼니</p>
            </div>
            <div class="mainContentSwiper--nav">
                <div class="mainContentSwiper--prev mainContentSwiper03--prev"><span class="material-symbols-outlined">navigate_before</span></div>
                <div class="mainContentSwiper--next mainContentSwiper03--next"><span class="material-symbols-outlined">navigate_next</span></div>
                <a href="./list02.html">전체보기</a>
            </div>
        </div>
        <div class="swiper-wrapper">
            <!-- 해당 콘텐츠 개수 만큼 이 슬라이드를 복제해주세요 -->
            <? echo latest_linc('/linc_list', 'calender', 6, 40, 1, '', '링크 컴퍼니');	?>
            <!-- <div class="noContent">
                <img src="/img/main_noContent03.png" alt="">
                <p>2023년 01월 05일, 첫 방영</p>
            </div> -->
        </div>
    </div>
</div>
<!-- 이 콘텐츠는 개발과 무관합니다. -->
<div class="main--videoContainer">
    <div class="public--wrap">
        <div class="main--videoWrap">
            <div class="main--videoContents">
                <iframe src="https://www.youtube.com/embed/KDAtL7HDEec?autoplay=1&mute=1&playlist=KDAtL7HDEec&loop=1" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <img src="/img/beta_video.png" alt="" style="width:100%;display:none;">
            <div class="main--videoCover" style="display:none;">
                <!-- <span class="material-symbols-outlined">play_arrow</span> -->
                <p style="color: #fff;font-size:32px;">준비중 입니다.</p>
            </div>
        </div>
    </div>
</div>

<!-- 이벤트02 -->
<div class="main--eventContainer">
    <div class="public--wrap">
        <div class="swiper mainEventSwiperBg">
            <div class="swiper-wrapper">
                <!--이벤트02콘텐츠의 입력값중 색상이 background-color로 반영됩니다.-->
                <?echo latest_linc('/linc_eventbg', 'event', 6, 40, 1, '');	?>
                <!-- <div class="swiper-slide mainEventSwiper--bg" style="background-color: #ffcc00;"></div> -->
                <!-- <div class="swiper-slide mainEventSwiper--bg" style="background-color: #00bbff;"></div> -->
                <!-- <div class="swiper-slide mainEventSwiper--bg" style="background-color: #ff9d00;"></div> -->
            </div>
        </div>
        <div class="swiper mainEventSwiper">
            <div class="swiper-wrapper">
                <?echo latest_linc('/linc_event', 'event', 6, 40, 1, '');	?>
                <!--
                <div class="swiper-slide">
                    <div class="mainEventSwiper--text">
                        <p>이벤트 준비중입니다.</p>
                    </div>
                    <div class="mainEventSwiper--img">
                        <img src="./img/main_event01.png" alt="">
                    </div>
                </div>
                -->
            </div>
            <div class="mainEventSwiper--nav">
                <div class="mainEventSwiper--nav-remote">
                    <div class="mainEventSwiper-button-prev"><span class="material-symbols-outlined">navigate_before</span></div>
                    <div class="mainEventSwiper--index">
                        <span id="mainEventSlideIndex"></span>
                        &nbsp;/&nbsp;
                        <span id="mainEventSlideLength"></span>
                    </div>
                    <div class="mainEventSwiper-button-next"><span class="material-symbols-outlined">navigate_next</span></div>
                </div>
                <div class="mainEventSwiper-button-mid">
                    <div class="mainEventSwiper-button-stopIcon stop">
                        <div class="mainEventSwiper-button-bg"></div>
                        <img src="./img/main_swiper_stop.png" alt="">
                    </div>
                    <div class="mainEventSwiper-button-stopIcon play">
                        <div class="mainEventSwiper-button-bg"></div>
                        <!-- <img src="./img/main_swiper_play.png" alt=""> -->
                        <span class="material-symbols-outlined">play_arrow</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- LINC3.0 사업단 최신영상 -->
<?php
$where = array();

$where[] = " a.vi_open = '1' ";

if(!$is_admin)
{
    $where[] = " b.mb_id != 'test' ";
    $where[] = " b.mb_id != 'test2' ";
    $where[] = " b.mb_id != 'monq' ";
}

if ($where) {
    $sql_search = ' where '.implode(' and ', $where);
}

$sql_order = " order by a.vi_reg_date desc ";

$sql_common = " from g5_video a left outer join g5_member b on a.mb_id = b.mb_id $sql_search ";

$sql = " select a.*, b.* $sql_common ";
$sql .= " {$sql_order} limit 0, 8";

$result = sql_query($sql);

?>
<div class="public--wrap">
    <div class="mainContentsGrid">
        <div class="mainContentsGrid--head">
            <div class="mainContentsGrid--title">
                <!--p요소에는 컨텐츠 이름이 들어갑니다.-->
                <p>LINC3.0 사업단 최신영상</p>
            </div>
            <!-- <div class="mainContentsGrid--nav">
                <a href="">전체보기</a>
            </div> -->
        </div>
        <div class="mainContentsGrid--body">
            <!-- 최대 8개 까지 출력 -->
            <!-- 콘텐츠가 없을 시 noContent 요소 출력 부탁드립니다. 이 요소는 /skin/latest/linc_list/latest.skin.php의 76행의 요소와 동일합니다.-->
            <!-- <div class="noContent">
                <img src="/img/beta_item_thumb.png" alt="">
            </div> -->
            <?while ($row = sql_fetch_array($result)){?>
            <div class="mainContentsGrid--item">
                <!-- 이 콘텐츠 아이템에 등록한 이미지를 아래의 mainContentsGrid--item-thumb요소의 background-image에 출력 부탁드립니다. -->
                <a href="/performancedetail.php?vi_id=<?=$row["vi_id"]?>"><div class="mainContentsGrid--item-thumb" style="background-image: url(<?=$row["vi_thumb"]?>);"></div></a>
                <div class="mainContentsGrid--item-title"><?=$row['vi_title']?></div>
                <div class="mainContentsGrid--item-props">
                    <!-- 이 콘텐츠 아이템에 입력했던 값들을 아래의 p요소에 출력 부탁드립니다. -->
                    <p><?=$row['mb_nick']?></p>
                    <p><?=$row['mb_2']?></p>
                    <p><?=$row['mb_1']?></p>
                </div>
            </div>
            <?}?>
        </div>
    </div>
</div>


<?php
include_once(G5_PATH.'/tail2.php');
?>
