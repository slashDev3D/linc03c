<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

$_REQUEST["bo_table"] = "event_info";
$bo_table = "event_info";

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
    
    $wr_1 = $write['wr_1'];

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

$action_url = https_url(G5_BBS_DIR)."/event_info_write_update.php";

include_once(G5_PATH.'/head2.php');
include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');
add_stylesheet('<link rel="stylesheet" href="/css/member.css">', 0);

$_is_event = true;



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

.member--figureItem-inputBox-calendar input{
    outline: none;
    border: none;
    border-radius: 0;
    padding: 0;
    width: 100%;
    max-width: none;
    font-size: 14px;
    color: #000;
}
</style>

<div class="member--container public--wrap member03">
    <?php
    include_once('./mypage_aside.php');
    ?>
    <div class="member--body">
        <div class="member--body-wrap">
            <div class="member--title member--title-member04">
                <div class="member--title-text">
                    <div class="member--title-text01">🥳&nbsp;행사안내</div>
                    <div class="member--title-text02">본사업단의 행사정보를 작성하세요.</div>
                </div>
            </div>
            
            <form name="fwrite" id="member03write" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
            <input type="hidden" name="w" value="<?php echo $w ?>">
            <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
            <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
            <input type="hidden" value="<?php echo $wr_1 ?>" name="wr_1">
            <input type="hidden" id="bf_file_del0" name="bf_file_del[0]" value="">
            <input type="hidden" value="html1" name="html">
            <div class="member--figure">
                <div class="member--figureItem">
                    <div class="member--figureItem-title member03--figureItem-title">
                        <?if($w == "u"){?>
                            <p>행사글 수정하기</p>
                        <?}else{?>
                            <p>행사글 작성하기</p>
                        <?}?>  
                    </div>
                    <div class="member03--figureItem-form">
                        <div class="member--figureItem-row">
                            <div class="member--figureItem-row-title">제목<span class="essential"></span></div>
                            <div class="member--figureItem-inputBox">
                                <input type="text" placeholder="제목을 입력하세요" name="wr_subject" value="<?=$subject?>" required>
                            </div>
                        </div>
                        <div class="member--figureItem-row member--figureItem-row-flexStart">
                            <!-- <div class="member--figureItem-row-title">대학 로고<span class="essential"></span></div> -->
                            <div class="member--figureItem-row-title">이미지<span class="essential"></span></div>
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
                        <div class="member--figureItem-row member--figureItem-row-flexStart">
                            <div class="member--figureItem-row-title">게시글<span class="essential"></span></div>
                            <div class="member--figureItem-inputBox member--figureItem-textareaBox wr_content <?php echo $is_dhtml_editor ? $config['cf_editor'] : ''; ?>">
                                <!-- 게시글 입력(textarea)은 그누보드 기본 폼으로 부탁드립니다(html 모드로도 작성이 가능해야 합니다) -->
                                <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
                            </div>
                        </div>
                        <div class="member--figureItem-row-margin"></div>
                        <div class="member--figureItem-row">
                            <div class="member--figureItem-row-title">기간<span class=""></span></div>
                            <div class="member--figureItem-inputBox member--figureItem-inputBox-double">
                                <div class="member--figureItem-inputBox-calendar">
                                    <!--<p>YYYY.MM.DD(월)</p>-->
                                    <input type="text" name="wr_6" id="wr_6" placeholder="YYYY.MM.DD(월)" value="<?=$write["wr_6"]?>">
                                    <!-- #eventDayStart 클릭 시 달력팝업(그누보드 기본 입력풋으로 작업 부탁드립니다), 날짜 선택 시 형제요소 p의 텍스트날짜가 해당날짜로 변경되도록 부탁드립니다. -->
                                    <label id="eventDayStart" for="wr_6">
                                        <span class="material-symbols-outlined">calendar_month</span>
                                    </label>
                                </div>
                                <div class="member--figureItem-inputBox-calendar">
                                    <!--<p>2022.12.31(월)</p>-->
                                    <input type="text" name="wr_7" id="wr_7" placeholder="2022.12.31(월)"  value="<?=$write["wr_7"]?>">
                                    <!-- #eventDayEnd 클릭 시 달력팝업(그누보드 기본 입력풋으로 작업 부탁드립니다), 날짜 선택 시 형제요소 p의 텍스트날짜가 해당날짜로 변경되도록 부탁드립니다. -->
                                    <label id="eventDayEnd" for="wr_7">
                                        <span class="material-symbols-outlined">calendar_month</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="member--figureItem-row">
                            <div class="member--figureItem-row-title">장소<span class=""></span></div>
                            <div class="member--figureItem-inputBox">
                                <input type="text" placeholder="장소를 입력하세요" name="wr_2"  value="<?=$write["wr_2"]?>">
                            </div>
                        </div>
                        <div class="member--figureItem-row">
                            <div class="member--figureItem-row-title">대상<span class=""></span></div>
                            <div class="member--figureItem-inputBox">
                                <input type="text" placeholder="대상을 입력하세요" name="wr_3"  value="<?=$write["wr_3"]?>">
                            </div>
                        </div>
                        <div class="member--figureItem-row">
                            <div class="member--figureItem-row-title">참여방법<span class=""></span></div>
                            <div class="member--figureItem-inputBox">
                                <input type="text" placeholder="참여방법을 입력하세요" name="wr_4"  value="<?=$write["wr_4"]?>">
                            </div>
                        </div>
                        <div class="member--figureItem-row">
                            <div class="member--figureItem-row-title">문의처<span class=""></span></div>
                            <div class="member--figureItem-inputBox">
                                <input type="text" placeholder="문의처를 입력하세요" name="wr_5"  value="<?=$write["wr_5"]?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="member--submit member03--submit">
                <!-- 해당 버튼 클릭 시 사업단 소식 게시글 작성 페이지로 넘어갑니다. -->
                <a href="/bbs/event_info.php" class="form--reset-button">취소</a>
                <button type="submit" form="member03write" class="form--save-button">저장하기</button>
            </div>
        </form>
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


$(function(){
    
    
    $("#wr_6, #wr_7").datepicker({
        dateFormat:"yy.mm.dd",
        closeText: "닫기",
        prevText: "이전달",
        nextText: "다음달",
        currentText: "오늘",
        monthNames: ["1월(JAN)","2월(FEB)","3월(MAR)","4월(APR)","5월(MAY)","6월(JUN)", "7월(JUL)","8월(AUG)","9월(SEP)","10월(OCT)","11월(NOV)","12월(DEC)"],
        monthNamesShort: ["1월","2월","3월","4월","5월","6월", "7월","8월","9월","10월","11월","12월"],
        dayNames: ["일","월","화","수","목","금","토"],
        dayNamesShort: ["일","월","화","수","목","금","토"],
        dayNamesMin: ["일","월","화","수","목","금","토"],
        weekHeader: "Wk",
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: true,
        changeMonth: true,
        changeYear: true,
        yearSuffix: "",
        showButtonPanel: true,
        yearRange: "c-99:c+99",
        onSelect:function(d){
            
            var date=new Date($(this).datepicker({dateFormat:"yy/mm/dd"}).val());
            var week = new Array("일","월","화","수","목","금","토");
            var yoil = week[date.getDay()];
            var v_date = d+"("+yoil+")";
            $(this).val(v_date);
        }
    });

    
    
});


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