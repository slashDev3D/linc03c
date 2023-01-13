<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

include_once('./_common.php');
include_once(G5_PATH.'/vendor/autoload.php');



$upload_max_filesize = ini_get('upload_max_filesize');

if (!$is_member)
    alert('로그인 후 이용하여 주십시오.', G5_URL);


$g5['title'] = '마이페이지';



$client_id = "a571693bc6916fcafadc42ad951d58a1b9a4abc7";
$client_secret = "1WV7+1sHLXi2zjnOUu2x6tCN1t+CY84e8GzxP4uPZy8DivFtG6ome08xiCf5x8tsPNk8elHHe2S+vgAugzB1SRybQR+jMTFG4Rq5B7AHRiBL7NCpLJJ/Q7OtWW3EKmxa";
$access_token = "c87362fee22bdd1d4657ff8723e7e893";

use Vimeo\Vimeo;
$client = new Vimeo($client_id, $client_secret, $access_token);

$sql = " select * from g5_video where mb_id = '".$member["mb_id"]."' and vi_id = '".$vi_id."'";
$write = sql_fetch($sql);

if (!($w == '' || $w == 'u')) {
    alert('w 값이 제대로 넘어오지 않았습니다.');
}

if ($w == 'u') {
    if ($write['vi_id']) {
        alert("글이 존재하지 않습니다.\\n삭제되었거나 이동된 경우입니다.", G5_BBS_URL.'/video.php');
    }
}

if ($w == '') {
    if ($vi_id) {
        alert('글쓰기에는 \$vi_id 값을 사용하지 않습니다.', G5_BBS_URL.'/video.php');
    }

} else if ($w == 'u') {
    // 김선용 1.00 : 글쓰기 권한과 수정은 별도로 처리되어야 함
    //if ($member['mb_level'] < $board['bo_write_level']) {

    if($member['mb_id'] != $write['mb_id'])
    {
        alert('글을 수정할 권한이 없습니다.');
    }
    
}

if ($w == 'u') {
    $name = get_text(cut_str(stripslashes($write['wr_name']),20));
    $email = get_email_address($write['wr_email']);
    $homepage = get_text(stripslashes($write['wr_homepage']));

    for ($i=1; $i<=1; $i++) {
        $write['wr_link'.$i] = get_text($write['wr_link'.$i]);
        $link[$i] = $write['wr_link'.$i];
    }

    $file = get_file($bo_table, $wr_id);
    if($file_count < $file['count']) {
        $file_count = $file['count'];
    }

    for($i=0;$i<$file_count;$i++){
        if(! isset($file[$i])) {
            $file[$i] = array('file'=>null, 'source'=>null, 'size'=>null);
        }
    }
}


$subject = "";
if (isset($write['vi_title'])) {
    $subject = str_replace("\"", "&#034;", get_text(cut_str($write['vi_title'], 255), 0));
}

$content = '';
if ($w == '') {
    //$content = html_purifier($board['bo_insert_content']);
} else {
    //$content = get_text($write['wr_content'], 0);
}

$action_url = https_url(G5_BBS_DIR)."/video_write_update.php";

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

#vi_file{
    position: absolute;
    width: 0;
    height: 0;
    opacity: 0;
    left: 0;
    top: 0;
    padding: 0;
    border: none;
}

.popup--videoloading{
    display:none;
}

.popup--videoloading.show{
    display:flex;
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
            <form name="fwrite" id="member03write" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
            <input type="hidden" name="w" value="<?php echo $w ?>">
            <div class="member--figure">
                    <div class="member--figureItem">
                        <div class="member--figureItem-title member03--figureItem-title">
                            <?if($w == "u"){?>
                                <p>성과영상 수정하기</p>
                            <?}else{?>
                                <p>성과영상 등록하기</p>
                            <?}?>                            
                        </div>
                        
                        <div class="member03--figureItem-form">
                            <div class="member--figureItem-row">
                                    <div class="member--figureItem-row-title">담당자<span class="essential"></span></div>
                                    <div class="member--figureItem-static"><?=$member['mb_name']?></div>
                            </div>
                            <div class="member--figureItem-row">
                                    <div class="member--figureItem-row-title">제목<span class="essential"></span></div>
                                    <div class="member--figureItem-inputBox">
                                        <input type="text" placeholder="제목을 입력하세요" name="vi_title" required value="<?=$subject?>">
                                    </div>
                            </div>
                            <div class="member--figureItem-row-margin"></div>
                            <div class="member--figureItem-row-margin"></div>
                            <div class="member--figureItem-row member--figureItem-row-flexStart">
                                <div class="member--figureItem-row-title">영상 내용<span class="essential"></span></div>
                                <div class="member--figureItem-inputBox member--figureItem-textareaBox">
                                    <!-- 게시글 입력(textarea)은 그누보드 기본 폼으로 부탁드립니다(html 모드로도 작성이 가능해야 합니다) -->
                                    <textarea type="text" placeholder="" name="vi_content" required></textarea>
                                </div>
                            </div>
                            <div class="member--figureItem-row member--figureItem-row-flexStart">
                                <!-- <div class="member--figureItem-row-title">대학 로고<span class="essential"></span></div> -->
                                <div class="member--figureItem-row-title"></div>
                                <div class="member--figureItem-inputBox">
                                    <div class="member--figureItem-inputBox-blocked">
                                        <?php
                                        $file_name = $file[0]['source'];
                                        if($file_name == "")
                                        {
                                            $file_name = "영상 파일을 추가해주세요.";
                                        }
                                        ?>
                                        <p id="file_name"><?=$file_name?></p>
                                        <input id="vi_file" type="file" name="vi_file" onchange="readFile(event);">
                                        <label class="member--figureItem-fileUpload" for="vi_file"><span class="material-symbols-outlined">folder_open</span></label>
                                    </div>
                                    <p class="member--figureItem-inputBox-exp"><?=$upload_max_filesize?>이하의 파일만 업로드 가능합니다.</p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
            <div class="member--submit member03--submit">
                <!-- 해당 버튼 클릭 시 사업단 소식 게시글 작성 페이지로 넘어갑니다. -->
                <a href="/bbs/video.php" class="form--reset-button">취소</a>
                <button type="submit" form="member03write" class="form--save-button">저장하기</button>
            </div>
        </div>
    </div>
</div>
<script src="/js/member03write.js"></script>

<div class="popup--videoloading">
<p>비디오를 업로드 중입니다.</p>
<p>잠시만 기다려주세요.</p>
</div>



<script>






function readFile(event) {
    let file = event.target.files[0];
	$("#file_name").text(file.name);
}

function fwrite_submit(f)
{
    $(".popup--videoloading").addClass("show");

    /*var file = $(f).prop("files")[0];
    var formData = new FormData();
    formData.append("file_data", file);

    $.ajax("https://api.vimeo.com/me/videos/", {
        type: "POST",
        headers: {
            "Authorization": "Bearer -----", 
        },
        data: formData,
        contentType: "multipart/form-data",     // changed this
        dataType: "json",

        crossDomain: true            // for CORS policy error
    }).done((response) => {
        
        // Do something

    }).fail((error) => {
        
        // Do something

    }).complete(() => {

        // Do something

    });*/
    
    return true;
}
</script>
<?
include_once(G5_PATH.'/tail2.php');