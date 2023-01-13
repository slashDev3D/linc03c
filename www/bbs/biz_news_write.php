<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

$_REQUEST["bo_table"] = "biz_news";
$bo_table = "biz_news";

include_once('./_common.php');
include_once(G5_EDITOR_LIB);

if (!$is_member)
    alert('로그인 후 이용하여 주십시오.', G5_URL);


$g5['title'] = '마이페이지';


if (!($w == '' || $w == 'u')) {
    alert('w 값이 제대로 넘어오지 않았습니다.');
}

if ($w == 'u') {
    if ($write['wr_id']) {
        // 가변 변수로 $wr_1 .. $wr_10 까지 만든다.
        for ($i=1; $i<=10; $i++) {
            $vvar = "wr_".$i;
            $$vvar = $write['wr_'.$i];
        }
    } else {
        alert("글이 존재하지 않습니다.\\n삭제되었거나 이동된 경우입니다.", G5_URL);
    }
}

if ($w == '') {
    if ($wr_id) {
        alert('글쓰기에는 \$wr_id 값을 사용하지 않습니다.', G5_BBS_URL.'/biz_news.php');
    }

    $wr_1 = "1";

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

    $wr_1 = $write['wr_1'];
}

set_session('ss_bo_table', $bo_table);
set_session('ss_wr_id', $wr_id);

$subject = "";
if (isset($write['wr_subject'])) {
    $subject = str_replace("\"", "&#034;", get_text(cut_str($write['wr_subject'], 255), 0));
}

$content = '';
if ($w == '') {
    $content = html_purifier($board['bo_insert_content']);
} else {
    $content = get_text($write['wr_content'], 0);
}

$is_dhtml_editor = false;
$is_dhtml_editor_use = false;
$editor_content_js = '';
if(!is_mobile() || defined('G5_IS_MOBILE_DHTML_USE') && G5_IS_MOBILE_DHTML_USE)
    $is_dhtml_editor_use = true;

// 모바일에서는 G5_IS_MOBILE_DHTML_USE 설정에 따라 DHTML 에디터 적용
if ($config['cf_editor'] && $is_dhtml_editor_use && $board['bo_use_dhtml_editor']) {
    $is_dhtml_editor = true;

    if ( $w == 'u' && (! $is_member || ! $is_admin || $write['mb_id'] !== $member['mb_id']) ){
        // kisa 취약점 제보 xss 필터 적용
        $content = get_text(html_purifier($write['wr_content']), 0);
    }

    if(is_file(G5_EDITOR_PATH.'/'.$config['cf_editor'].'/autosave.editor.js'))
        $editor_content_js = '<script src="'.G5_EDITOR_URL.'/'.$config['cf_editor'].'/autosave.editor.js"></script>'.PHP_EOL;
}
$editor_html = editor_html('wr_content', $content, $is_dhtml_editor);
$editor_js = '';
$editor_js .= get_editor_js('wr_content', $is_dhtml_editor);
$editor_js .= chk_editor_js('wr_content', $is_dhtml_editor);

$action_url = https_url(G5_BBS_DIR)."/biz_news_write_update.php";

include_once(G5_PATH.'/head2.php');
add_stylesheet('<link rel="stylesheet" href="/css/member.css">', 0);

$_is_biz_news = true;

$ca_name = "";
$ca_name_sel = "사업분야를 선택하세요.";
if (isset($write['ca_name']) && $write['ca_name'] != "")
{
    $ca_name = $write['ca_name'];
    $ca_name_sel = $write['ca_name'];
}
    

$categories = explode("|", $board['bo_category_list']); // 구분자가 | 로 되어 있음

?>
<style>
.member--container{
    margin-top:0;
}

.sound_only, .btn_cke_sc{
    display:none;
}

#bf_file_1{
    position: absolute;
    width: 0;
    height: 0;
    opacity: 0;
    left: 0;
    top: 0;
    padding: 0;
    border: none;
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
                    <div class="member--title-text01">💬&nbsp;사업단 소식지</div>
                    <div class="member--title-text02">본사업단의 소식을 알려주세요.</div>
                </div>
            </div>
            <form name="fwrite" id="member03write" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
            <input type="hidden" name="w" value="<?php echo $w ?>">
            <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
            <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
            <input type="hidden" value="html1" name="html">
            <input type="hidden" value="<?php echo $wr_1 ?>" name="wr_1">
            <input type="hidden" id="bf_file_del0" name="bf_file_del[0]" value="">
            <input type="hidden" id="ca_name" name="ca_name" value="<?=$ca_name?>">
            <div class="member--figure">
                    <div class="member--figureItem">
                        <div class="member--figureItem-title member03--figureItem-title">
                            <?if($w == "u"){?>
                                <p>소식지 수정하기</p>
                            <?}else{?>
                                <p>소식지 작성하기</p>
                            <?}?>                            
                        </div>
                        
                        <div class="member03--figureItem-form">
                            <div class="member--figureItem-row">
                                    <div class="member--figureItem-row-title">대학</div>
                                    <div class="member--figureItem-static"><?=$member["mb_8"]?></div>
                            </div>
                            <div class="member--figureItem-row">
                                    <div class="member--figureItem-row-title">사업분야<span class="essential"></span></div>
                                    <div class="member--figureItem-inputBox relative">
                                        <div class="member03--figureItem-selectBox"><p><?=$ca_name_sel?></p><span class="material-symbols-outlined">expand_more</span></div>
                                        <div class="member03--figureItem-selectBox-list">
                                            <?for ($i=0; $i<count($categories); $i++) {?>
                                                <?php
                                                $category = trim($categories[$i]);
                                                ?>
                                            <div class="member03--figureItem-selectBox-listItem ca_name_item" data-ca_name="<?=$category?>"><?=$category?></div>
                                            <?}?>
                                        </div>
                                    </div>
                            </div>
                            <div class="member--figureItem-row">
                                    <div class="member--figureItem-row-title">제목<span class="essential"></span></div>
                                    <div class="member--figureItem-inputBox">
                                        <input type="text" placeholder="제목을 입력하세요" name="wr_subject" required value="<?=$subject?>">
                                    </div>
                            </div>
                            <div class="member--figureItem-row-margin"></div>
                            <div class="member--figureItem-row-margin"></div>
                            <div class="member--figureItem-row member--figureItem-row-flexStart">
                                <div class="member--figureItem-row-title">게시글 내용<span class="essential"></span></div>
                                <div class="member--figureItem-inputBox member--figureItem-textareaBox wr_content <?php echo $is_dhtml_editor ? $config['cf_editor'] : ''; ?>">
                                    <!-- 게시글 입력(textarea)은 그누보드 기본 폼으로 부탁드립니다(html 모드로도 작성이 가능해야 합니다) -->
                                    <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
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
                                            $file_name = "첨부파일을 추가해주세요.";
                                        }
                                        ?>
                                        <p id="file_name"><?=$file_name?></p>
                                        <input id="bf_file_1" type="file" name="bf_file[]" accept=".jpeg, .jpg, .png, .gif" onchange="readFile(event);">
                                        <label class="member--figureItem-fileUpload" for="bf_file_1"><span class="material-symbols-outlined">folder_open</span></label>
                                    </div>
                                    <p class="member--figureItem-inputBox-exp">5MB를 초과할 수 없으며<br>JPEG, JPG, PNG, GIF 형식의 파일만 가능합니다.</p>
                                    <!-- .member--figureItem-inputBox-fileDlt 요소 클릭 시 파일첨부 값을 초기화로 부탁드립니다. -->
                                    <?php if($w == 'u' && $file[0]['file']) { ?>
                                    <p class="member--figureItem-inputBox-fileDlt del_file_btn">파일삭제<span class="material-symbols-outlined">cancel</span></p>
                                    <?}?>
                                </div>
                            </div>
                            <div class="member--figureItem-row-margin"></div>
                            <div class="member--figureItem-row">
                                <div class="member--figureItem-row-title">참고출처<span class="essential"></span></div>
                                <div class="member--figureItem-inputBox">
                                    <input type="text" placeholder="URL을 입력해주세요" name="wr_link1" value="<?=$write["wr_link1"]?>">
                                    <div class="member--figureItem-inputClear clear_link_btn">
                                        <span class="material-symbols-outlined">delete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
            <div class="member--submit member03--submit">
                <!-- 해당 버튼 클릭 시 사업단 소식 게시글 작성 페이지로 넘어갑니다. -->
                <a href="/bbs/biz_news.php" class="form--reset-button">취소</a>
                <button type="submit" form="member03write" class="form--save-button">저장하기</button>
            </div>
        </div>
    </div>
</div>
<script src="/js/member03write.js"></script>

<script>
<?php if($write_min || $write_max) { ?>
// 글자수 제한
var char_min = parseInt(<?php echo $write_min; ?>); // 최소
var char_max = parseInt(<?php echo $write_max; ?>); // 최대
check_byte("wr_content", "char_count");

$(function() {
    $("#wr_content").on("keyup", function() {
        check_byte("wr_content", "char_count");
    });
});

<?php } ?>


function readFile(event) {
    let file = event.target.files[0];
	$("#file_name").text(file.name);
}

function html_auto_br(obj)
{
    if (obj.checked) {
        result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
        if (result)
            obj.value = "html2";
        else
            obj.value = "html1";
    }
    else
        obj.value = "";
}

function fwrite_submit(f)
{
    <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

    if($("#ca_name").val() == "")
    {
        alert("사업분야를 선택하세요.");
        return false;
    }

    var subject = "";
    var content = "";
    $.ajax({
        url: g5_bbs_url+"/ajax.filter.php",
        type: "POST",
        data: {
            "subject": f.wr_subject.value,
            "content": f.wr_content.value
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function(data, textStatus) {
            subject = data.subject;
            content = data.content;
        }
    });

    if (subject) {
        alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
        f.wr_subject.focus();
        return false;
    }

    if (content) {
        alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
        if (typeof(ed_wr_content) != "undefined")
            ed_wr_content.returnFalse();
        else
            f.wr_content.focus();
        return false;
    }

    if (document.getElementById("char_count")) {
        if (char_min > 0 || char_max > 0) {
            var cnt = parseInt(check_byte("wr_content", "char_count"));
            if (char_min > 0 && char_min > cnt) {
                alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                return false;
            }
            else if (char_max > 0 && char_max < cnt) {
                alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                return false;
            }
        }
    }

    

    

    return true;
}
</script>
<?
include_once(G5_PATH.'/tail2.php');