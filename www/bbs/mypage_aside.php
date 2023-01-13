<?php

if (!$is_member)
    goto_url(G5_BBS_URL."/login.php?url=".urlencode(G5_BBS_URL."/mypage.php"));



$mem_img = "/img/member_thumb_basic.png";

if($member["mb_img"] != "")
{
    $mem_img = G5_DATA_URL.'/member_image/'.$member["mb_img"];
}
?>
<div class="member--aside">
    <div class="member--aside-info">
        <div class="member--aside-thumb">
            <div class="member--aside-thumbImg" style="background-image:url(<?=$mem_img?>)"></div>
            <div class="member--aside-thumbFix"><a href="/bbs/mybiz.php"><span class="material-symbols-outlined">edit</span></a></div>
        </div>
        <div class="member--aside-type">
            <!-- <p>사업단</p> -->
            <!-- <p>사업단</p> -->
            <!-- <p>사업단</p> -->
        </div>
        <div class="member--aside-name"><p><?=$member["mb_nick"]?>님</p></div><!--회원의 이름이 출력됩니다.-->
        <!--회원의 이메일이 출력됩니다.-->
        <!-- <div class="member--aside-email"><p><?=$member["mb_email"]?></p></div> -->
        <!-- 회원의 대학교명이 출력됩니다. -->
        <div class="member--aside-party"><?=$member['mb_1']?> | <?=$member['mb_2']?></div>
        <!-- <div><?=$member['mb_2']?></div> -->
        <a href="/businessdetail.php?bi=<?=$member["mb_id"]?>" class="member--aside-goControl">나의 사업단 바로가기</a>
    </div>
    <div class="member--aside-menu">
        <a href="/bbs/mypage.php" class="member--aside-menuItem <?if($_is_mypage) echo "on";?>"><span>😊</span><p>가입정보</p></a>
        <a href="/bbs/mybiz.php" class="member--aside-menuItem <?if($_is_mybiz) echo "on";?>"><span>📚</span><p>사업단 정보</p></a>
        <a href="/bbs/biz_news.php" class="member--aside-menuItem <?if($_is_biz_news) echo "on";?>"><span>💬</span><p>사업단 소식지</p></a>
        <a href="/bbs/event_info.php" class="member--aside-menuItem <?if($_is_event) echo "on";?>"><span>🥳</span><p>행사안내</p></a>
        <a href="/bbs/video.php" class="member--aside-menuItem <?if($_is_video) echo "on";?>"><span>📹</span><p>성과영상 업로드</p></a>
        <a href="/bbs/notice.php" class="member--aside-menuItem <?if($_is_notice) echo "on";?>"><span>📢</span><p>관리 안내 공지</p></a>
    </div>
    <div class="member--aside-logout">
        <a href="/bbs/logout.php">로그아웃</a>
    </div>
</div>