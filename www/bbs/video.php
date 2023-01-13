<?php

include_once('./_common.php');
include_once(G5_PATH.'/vendor/autoload.php');


$g5['title'] = '마이페이지';






// 분류 사용 여부
$is_category = false;
$category_option = '';

//검색인지 아닌지 구분하는 변수 초기화
$is_search_bbs = false;
$sql_search = "";

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

// 년도 2자리
$today2 = G5_TIME_YMD;

$list = array();
$i = 0;

$sql_order = " order by vi_reg_date desc ";

$sql_where = "";

if($vi_open != "")
{
    $sql_where = " and vi_open = '".$vi_open."' ";
}

$sql = " select * from g5_video where mb_id = '".$member["mb_id"]."' {$sql_where} ";
$sql .= " {$sql_order} ";

// 페이지의 공지개수가 목록수 보다 작을 때만 실행
$result = sql_query($sql);
$total_count = sql_num_rows($result);

$open_cnt = 0;
$not_open_cnt = 0;

while ($row = sql_fetch_array($result))
{

    $list[$i] = $row;
    $i++;

    if($row["vi_open"] == "1")
    {
        $open_cnt++;
    }
    else{
        $not_open_cnt++;
    }
}

for ($i=0; $i<count($list); $i++) {

    $list[$i]['href'] = "/bbs/video_view.php?vi_id=".$list[$i]["vi_id"];

    if($list[$i]["vi_thumb"] == "")
    {
        $res = $client->request($list[$i]["vi_vi_id"], 'GET');
        $data = $res['body'];

        if($data["transcode"]["status"] == "complete")
        {
            $vi_thumb = $data["pictures"]["base_link"];

            if($vi_thumb != "")
            {
                $list[$i]["vi_thumb"] = $vi_thumb;
            }

            $vi_url = $data["player_embed_url"];

            if($vi_url != "")
            {
                $list[$i]["vi_url"] = $vi_url;
            }

            sql_query("update g5_video set vi_thumb = '".$vi_thumb."', vi_url = '".$vi_url."' where mb_id = '".$member["mb_id"]."' and vi_id = '".$list[$i]["vi_id"]."'");

        }else{

            $list[$i]['href'] = "javascript:alert('영상이 업로드 중입니다.');";
        }


    }
}


include_once(G5_PATH.'/head2.php');
add_stylesheet('<link rel="stylesheet" href="/css/member.css">', 0);

$_is_video = true;


$open_text = "전체";

if($vi_open == "1")
{
    $open_text = "노출";
}else if($vi_open == "0")
{
    $open_text = "비노출";
}

?>
<style>
.member--container{
    margin-top:0;
}

.member03--sort-selectBox-item{
    display:block;
}
</style>

<div class="member--container public--wrap member03">
    <?php
    include_once('./mypage_aside.php');
    ?>
    <div class="member--body">
        <div class="member--body-wrap">
            <div class="member--title">
                <div class="member--title-text">
                    <div class="member--title-text01">💬&nbsp;성과영상 업로드</div>
                    <div class="member--title-text02">사업단 성과영상을 업로드하세요.</div>
                </div>
            </div>
            <div class="member-vimeo-figure">
              <form action="">
                  <div class="member--figure">
                      <div class="member--figureItem">
                          <div class="member--figureItem-title">
                              <p>성과영상 업로드 계정</p>
                          </div>
                          <div class="member05--figureItem-body">
                              <div class="member05--figure-row">
                                  <div class="member05--figure-row-text01">아이디</div>
                                  <div class="member05--figure-row-box">
                                    <div class="member05--figure-row-text02 "><?=$member["mb_11"]?></div><input type="hidden" id="vimeo_id" value="<?=$member["mb_11"]?>">
                                    <div class="member05--figure-row-copy vimeo_id"><span class="material-symbols-outlined">content_copy</span></div>
                                  </div>
                              </div>
                              <div class="member05--figure-row">
                                  <div class="member05--figure-row-text01">비밀번호</div>
                                  <div class="member05--figure-row-box">
                                    <div class="member05--figure-row-text02 "><?=$member["mb_12"]?></div><input type="hidden" id="vimeo_pw" value="<?=$member["mb_12"]?>">
                                    <div class="member05--figure-row-copy vimeo_pw"><span class="material-symbols-outlined">content_copy</span></div>
                                  </div>
                              </div>
                          </div>
                          <div class="member--figureItem-goLink">
                              <a href="https://vimeo.com/upload/videos" target="_blank" class="member--figureItem-goLinkItem member--figureItem-goLinkItem01"><p>성과영상 업로드하기</p><span class="material-symbols-outlined">open_in_new</span></a>
                              <a href="https://vimeo.com/manage/folders/<?=$member["mb_7"]?>" target="_blank" class="member--figureItem-goLinkItem member--figureItem-goLinkItem02"><p>성과영상 아카이브 공간</p></a>
                          </div>
                      </div>
                  </div>
              </form>
            </div>

            <div class="member03--figure--btn-box">
              <div class="member03--figureItem-btn vimeo-update-btn">
                  <p>성과영상 가져오기</p>
                  <span style="font-size:15px" class="material-symbols-outlined">refresh</span>
              </div>
            </div>

            <div class="member--figure">
                    <div class="member--figureItem">
                        <div class="member--figureItem-title member03--figureItem-title">
                        <div class="member03--figureItem-titleBox"><p>성과영상 모아보기</p>
                            </div>
                            <div class="member03--figureItem-props">
                                <!--
                                    하단의 {Num}에는 각각 아이템의 갯수를 조건에 맞게 출력 부탁드립니다.
                                    총 게시물 : 아이템 총 total count
                                    노출 : 노출상태의 아이템 total count
                                    비노출 : 비노출상태의 아이템 total count
                                -->
                                <div class="member03--figureItem-totalItems">📄 총 게시물 :<span><?php echo number_format($total_count) ?></span></div>
                                <div class="member03--figureItem-showItems">&nbsp;/ 노출 : <span><?php echo number_format($open_cnt) ?></span></div>
                                <div class="member03--figureItem-hideItems">&nbsp;/ 비노출 : <span><?php echo number_format($not_open_cnt) ?></span></div>
                            </div>
                        </div>
                        <div class="member--figureItem-contents member03--figureItem-contents">
                            <div class="member03--sort">
                                <div class="member03--sort-selectBox">
                                    <div class="member03--sort-selectBox-val"><p><?=$open_text?></p><span class="material-symbols-outlined">expand_more</span></div>
                                    <div class="member03--sort-selectBox-itemList">
                                        <!-- 아래의 아이템 중 하나를 선택 시, .member03--itemList를 조건에 맞게 재정렬되도록 부탁드립니다. -->
                                        <a href="/bbs/video.php" class="member03--sort-selectBox-item">전체</a>
                                        <a href="/bbs/video.php?vi_open=1" class="member03--sort-selectBox-item">노출</a>
                                        <a href="/bbs/video.php?vi_open=0" class="member03--sort-selectBox-item">비노출</a>
                                    </div>
                                </div>
                                <div class="member03--sort-menu">
                                    <!--
                                        member03--item마다 member03--item-thumbCheck 요소가 있습니다.
                                        해당 요소에는 checked클래스가 토글됩니다.
                                        member03--sort-menuItem 클릭 시 confirm창이 뜨고 확인버튼을 누를 경우
                                        checked된 아이템들을 일괄 처리 부탁드립니다.
                                        member03--item-thumbCheck 몇 개 체크 후 member03--sort-menuItem 클릭하면
                                        confirm "해당 아이템들을 (삭제/숨기기 처리/노출 처리) 하시겠습니까?", 확인 버튼 클릭 시 처리(confirm 멘트는 예시입니다. 별도로 지정해주셔도 좋습니다.).
                                        -->
                                    <!-- <div class="member03--sort-menuItem" id="video_list_del_btn">삭제</div> --> <!-- 여기서는 삭제되지 않아도 됩니다! -->
                                    <div class="member03--sort-menuItem video_list_open_btn" data-vi_open="0">숨기기</div>
                                    <div class="member03--sort-menuItem video_list_open_btn" data-vi_open="1">노출</div>
                                </div>
                            </div>
                            <div class="member03--itemList">
                                <?php for ($i=0; $i<count($list); $i++) {?>
                                <?php

                                ?>
                                <div class="member03--item">
                                    <a href="<?php echo $list[$i]['href'] ?>">
                                    <div class="member03--item-thumb">
                                        <!-- member03--item-thumbImg 클릭 시 마이페이지전용 해당아이템 상세(member03detail.html)로 이동합니다. -->
                                        <div class="member03--item-thumbImg" style="background-image: url(<?=$list[$i]["vi_thumb"]?>);"></div>
                                        <div class="member03--item-thumb-isShow">
                                            <!-- 노출상태인 경우 isShow--true를 출력, 숨기기(비노출)상태의 경우 isShow--false를 출력 부탁드립니다. -->
                                            <?if($list[$i]["vi_open"] == "1"){?>
                                            <p class="isShow--true">노출</p>
                                            <?}else{?>
                                            <p class="isShow--false">비노출</p>
                                            <?}?>
                                        </div>
                                        <?if($list[$i]["vi_thumb"] != ""){?>
                                        <div class="member03--item-thumbCheck" data-vi_id="<?=$list[$i]["vi_id"]?>"></div>
                                        <?}?>
                                    </div>
                                    </a>
                                    <div class="member03--item-text">
                                        <!--<div class="member03--item-text01">{태그값}</div>-->
                                        <div class="member03--item-text02"><?=$list[$i]['vi_title']?></div>
                                        <div class="member03--item-text03">
                                            <span class="material-symbols-outlined">schedule</span>
                                            <p><?=get_board_date($list[$i]['vi_reg_date'])?></p>
                                        </div>
                                    </div>
                                </div>
                                <?}?>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- 여기서는 작성되지 않아도 됩니다 -->
            <!--
            <div class="member--submit member03--submit">
                <a href="/bbs/video_write.php" class="member--goToWrite"><p>작성하기</p></a>
            </div>
            -->
        </div>
    </div>
</div>
<script src="/js/member03.js"></script>

<script>

$(function() {


    $(".vimeo_id").on("click", function() {
        if($('#vimeo_id').val() != "")
        {

            $('#vimeo_id').attr('type', 'text');

            $('#vimeo_id').select();
            var copy = document.execCommand('copy');

            $('#vimeo_id').attr('type', 'hidden');

            if(copy) {
                alert("아이디가 복사되었습니다.");
            }


        }

    });

    $(".vimeo_pw").on("click", function() {
        if($('#vimeo_pw').val() != "")
        {

            $('#vimeo_pw').attr('type', 'text');

            $('#vimeo_pw').select();
            var copy = document.execCommand('copy');

            $('#vimeo_pw').attr('type', 'hidden');

            if(copy) {
                alert("비밀번호가 복사되었습니다.");
            }


        }

    });

    $(".vimeo-update-btn").on("click", function() {
        $.ajax({
            url: "/bbs/ajax.video.php",
            type: "POST",
            data: "",
            dataType: "json",
            async: true,
            cache: false,
            success: function(data, textStatus) {

            
                if(data.error != "") {
                    alert(data.error);
                    return false;
                }
                
                location.reload();

                
            },
            error : function(request, status, error){
                alert('false ajax :'+request.responseText);
            }
        });

    });

});

</script>

<?
include_once(G5_PATH.'/tail2.php');
