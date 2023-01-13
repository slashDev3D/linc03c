
<?
include_once('./_common.php');


$data_sub = "show";
$data_visit = "2";

$data = sql_fetch("select a.*, b.* from g5_video a left outer join g5_member b on a.mb_id = b.mb_id where a.vi_id = '".$vi_id."'");

if($data["vi_id"] == "")
{
    alert("등록된 성과영상이 없습니다.");
    exit;
}

$ss_name = 'ss_view_video_'.$vi_id;
if (!get_session($ss_name))
{
    sql_query(" update g5_video set vi_hit = vi_hit + 1 where vi_id = '{$vi_id}' ");

    set_session($ss_name, TRUE);
}

include_once(G5_PATH.'/head2.php');


$result = sql_query("select * from g5_video where mb_id = '".$data["mb_id"]."' and vi_open = '1' and vi_id != '".$vi_id."' order by vi_reg_date desc");
$total_count = sql_num_rows($result);

add_stylesheet('<link rel="stylesheet" href="/css/performance.css">', 0);
?>
<style>

.perd--head-thumbImg{
    position: relative;
}

.perd--head-thumbImg iframe {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
    width: 100%;
    height: 100%;
    display: block;
}

.perd--others01-listItem-thumb > a{
    display: block;
    width: 100%;
    height: 100%;
}
</style>
<div class="perd--contents public--wrap">
    <div class="perd--head">
        <div class="perd--head-thumb">
            <div class="perd--head-thumbImg"><iframe src="<?=$data['vi_url']?>" frameborder="0"></iframe></div>
        </div>
        <div class="perd--head-info">
            <div class="perd--head-infoText">
                <div class="perd--head-info01">
                    <span><?=$data["mb_nick"]?></span>
                    <span><?=$data["mb_2"]?></span>
                    <span><?=$data["mb_1"]?></span>
                </div>
                <div class="perd--head-info02">
                    <div class="perd--head-info02thumb">
                        <div class="perd--head-info02thumbImg" style="background-image:url(<?=G5_DATA_URL.'/member_image/'.$data["mb_img"]?>)"></div>
                    </div>
                </div>
                <div class="perd--head-info03">
                <?=$data["vi_title"]?>
                </div>
                <div class="perd--head-info04">
                    <div class="perd--head-info04-detail"><span class="material-symbols-outlined">calendar_month</span><span><?=get_board_date($data["vi_reg_date"])?></span></div>
                    <!--
                    <div class="perd--head-info04-dot"></div>
                    <div class="perd--head-info04-detail"><span class="material-symbols-outlined">location_on</span><span>{행사장소}</span></div>
                    -->
                </div>
            </div>
            <div class="perd--head-goLink">
                <a href="/businessdetail.php?bi=<?=$data["mb_id"]?>"> 링크3.0 <?=$data["mb_nick"]?> 바로가기</a>
            </div>
        </div>
    </div>
    <div class="perd--others01">
        <div class="perd--others01-head">
            <div class="perd--others01-title">'<?=$data["mb_8"]?>' 다른 영상&nbsp;<span><?=number_format($total_count)?></span></div>
            <div class="perd--others01-sort">
                <div class="perf--sort-option">
                    <!--
                        div.perf--sort-optionValue요소기 sorting 옵션값입니다.
                        옵션값은 중복되지 않습니다.
                        최초옵션값은 최신등록 순(첫번째 옵션값)입니다.
                        버튼 클릭 시 페이지 이동 없이 해당 페이지 내에서 아이템 정렬을 부탁드립니다.
                    -->
                    <div class="perf--sort-optionValue checked" data-sort="new">
                        <div class="perf--sort-optionState">
                            <span class="perf--sort-optionValue-off"></span>
                            <span class="perf--sort-optionValue-on material-symbols-outlined">done</span>
                        </div>
                        <div class="perf--sort-optionName">최신등록 순</div>
                    </div>
                    <div class="perf--sort-optionValue" data-sort="old">
                        <div class="perf--sort-optionState">
                            <span class="perf--sort-optionValue-off"></span>
                            <span class="perf--sort-optionValue-on material-symbols-outlined">done</span>
                        </div>
                        <div class="perf--sort-optionName">오래된 순</div>
                    </div>
                    <div class="perf--sort-optionValue" data-sort="hit">
                        <div class="perf--sort-optionState">
                            <span class="perf--sort-optionValue-off"></span>
                            <span class="perf--sort-optionValue-on material-symbols-outlined">done</span>
                        </div>
                        <div class="perf--sort-optionName">조회 순</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="perd--others01-list">
            <?while ($row = sql_fetch_array($result)){?>
            <div class="perd--others01-listItem">
                
                <div class="perd--others01-listItem-thumb">
                    <a href="/performancedetail.php?vi_id=<?=$row["vi_id"]?>">
                    <div class="perd--others01-listItem-thumbImg" style="background-image:url(<?=$row["vi_thumb"]?>)"></div>
                    </a>
                </div>
                
                <div class="perd--others01-listItem-info">
                    <div class="perd--others01-listItem-info01"><span><?=$data["mb_nick"]?></span>&nbsp;<span><?=$data["mb_2"]?></span>&nbsp;<span><?=$data["mb_1"]?></span></div>
                    <div class="perd--others01-listItem-info02"><?=$row["vi_title"]?></div>
                    <div class="perd--others01-listItem-info03">
                        <span class="material-symbols-outlined">schedule</span>
                        <p><?=get_board_date($row["vi_reg_date"])?></p>
                    </div>
                </div>
            </div>
            <?}?>
        </div>
    </div>
    <div class="perd--others02" style="display:none">
        <div class="perd--others02-title">다른 수도권 성과영상</div>
        <div class="perd--others02-contents">
            <div class="perd--others02-list swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="perd--others02-list-thumb">
                            <div class="perd--others02-list-thumbImg"></div>
                        </div>
                        <div class="perd--others02-list-info">
                            <div class="perd--others02-list-info01">
                                <span>{대학교이름}</span>
                                <span>{지역이름}</span>
                                <span>{분야이름}</span>
                            </div>
                            <div class="perd--others02-list-info02">
                                {영상제목}
                            </div>
                            <div class="perd--others02-list-info03">
                                <span class="material-symbols-outlined">schedule</span>
                                <p>YYYY.MM.DD</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="perd--others02-list-thumb">
                            <div class="perd--others02-list-thumbImg"></div>
                        </div>
                        <div class="perd--others02-list-info">
                            <div class="perd--others02-list-info01">
                                <span>{대학교이름}</span>
                                <span>{지역이름}</span>
                                <span>{분야이름}</span>
                            </div>
                            <div class="perd--others02-list-info02">
                                {영상제목}
                            </div>
                            <div class="perd--others02-list-info03">
                                <span class="material-symbols-outlined">schedule</span>
                                <p>YYYY.MM.DD</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="perd--others02-list-thumb">
                            <div class="perd--others02-list-thumbImg"></div>
                        </div>
                        <div class="perd--others02-list-info">
                            <div class="perd--others02-list-info01">
                                <span>{대학교이름}</span>
                                <span>{지역이름}</span>
                                <span>{분야이름}</span>
                            </div>
                            <div class="perd--others02-list-info02">
                                {영상제목}
                            </div>
                            <div class="perd--others02-list-info03">
                                <span class="material-symbols-outlined">schedule</span>
                                <p>YYYY.MM.DD</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="perd--others02-list-thumb">
                            <div class="perd--others02-list-thumbImg"></div>
                        </div>
                        <div class="perd--others02-list-info">
                            <div class="perd--others02-list-info01">
                                <span>{대학교이름}</span>
                                <span>{지역이름}</span>
                                <span>{분야이름}</span>
                            </div>
                            <div class="perd--others02-list-info02">
                                {영상제목}
                            </div>
                            <div class="perd--others02-list-info03">
                                <span class="material-symbols-outlined">schedule</span>
                                <p>YYYY.MM.DD</p>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="perd--others02-list-thumb">
                            <div class="perd--others02-list-thumbImg"></div>
                        </div>
                        <div class="perd--others02-list-info">
                            <div class="perd--others02-list-info01">
                                <span>{대학교이름}</span>
                                <span>{지역이름}</span>
                                <span>{분야이름}</span>
                            </div>
                            <div class="perd--others02-list-info02">
                                {영상제목}
                            </div>
                            <div class="perd--others02-list-info03">
                                <span class="material-symbols-outlined">schedule</span>
                                <p>YYYY.MM.DD</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="perd--others02-swiper-button">
                <div class="perd--others02Swiper-prev"><span class="material-symbols-outlined">chevron_left</span></div>
                <div class="perd--others02Swiper-next"><span class="material-symbols-outlined">chevron_right</span></div>
            </div>
        </div>
    </div>
</div>
<script src="./js/performance_detail.js"></script>

<script>

$(".perf--sort-optionValue").click(function() {
    
    var _vi_id = '<?=$vi_id?>';
    var _sort = $(this).data("sort");

	jQuery.ajax({
	type:"POST",
	url:"/bbs/ajax.perfomance.php",
	data:{vi_id : _vi_id, sort : _sort},
	dataType: "html",
	success : function(data)
	{
		
        $(".perd--others01-list").html(data);
        
	},
	complete : function(data) {
		
	},
	error : function(xhr, status, error) {
       
    }
	});

});
</script>
<?php
include_once(G5_PATH.'/tail2.php');
?>