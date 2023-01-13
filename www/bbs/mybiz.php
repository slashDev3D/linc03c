<?php
include_once('./_common.php');

if (!$is_member)
    alert('로그인 후 이용하여 주십시오.', G5_URL);


$g5['title'] = '마이페이지';

include_once(G5_PATH.'/head2.php');
add_stylesheet('<link rel="stylesheet" href="/css/member.css">', 0);

$_is_mybiz = true;


$register_action_url = G5_HTTPS_BBS_URL.'/mybiz_update.php';

?>
<style>
.member--container{
    margin-top:0;
}

#mb_img{
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
<div class="member--container public--wrap">
    <?php
    include_once('./mypage_aside.php');
    ?>
    <div class="member--body">
        <div class="member--body-wrap">
            <div class="member--title">
                <div class="member--title-text01">📚&nbsp;사업단 정보</div>
                <div class="member--title-text02">사업단 상세 정보를 확인하고, 관리하세요.</div>
            </div>
            <form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="mb_id" value="<?=$member["mb_id"]?>">
                <div class="member--figure">
                    <div class="member--figureItem">
                        <div class="member--figureItem-title"><p>기본정보</p></div>
                        <div class="member--figureItem-contents">
                            <div class="member--figureItem-row">
                                <div class="member--figureItem-row-title">사업유형</div>
                                <div class="member--figureItem-row-static"><p><?=$member["mb_1"]?></p></div>
                            </div>
                            <div class="member--figureItem-row">
                                <div class="member--figureItem-row-title">권역명</div>
                                <div class="member--figureItem-row-static"><p><?=$member["mb_2"]?></p></div>
                            </div>
                            <div class="member--figureItem-row">
                                <div class="member--figureItem-row-title">대학교명</div>
                                <div class="member--figureItem-row-static"><p><?=$member["mb_nick"]?></p></div>
                            </div>
                            <!-- <div class="member--figureItem-row">
                                <div class="member--figureItem-row-title">사업유형<span class="essential"></span></div>
                                <div class="member--figureItem-inputBox-blocked">
                                    <?=$member["mb_1"]?>
                                </div>
                            </div>
                            <div class="member--figureItem-row">
                                <div class="member--figureItem-row-title">권역유형<span class="essential"></span></div>
                                <div class="member--figureItem-inputBox-blocked">
                                    <?=$member["mb_2"]?>
                                </div>
                            </div> -->
                            <?php
                            $file_name = $member['mb_img'];
                            if($file_name == "")
                            {
                                $file_name = "첨부파일을 추가해주세요.";
                            }
                            ?>
                            <div class="member--figureItem-row member--figureItem-row-flexStart">
                                <div class="member--figureItem-row-title">대학 로고<span class="essential"></span></div>
                                <div class="member--figureItem-inputBox">
                                    <div class="member--figureItem-inputBox-blocked member--figureItem-inputBox-blocked2">
                                        <p id="file_name"><?=$file_name?></p>
                                        <input id="mb_img" type="file" name="mb_img" accept=".jpeg, .jpg, .png, .gif" onchange="readFile(event);">
                                        <label for="mb_img" class="member--figureItem-fileUpload"><span class="material-symbols-outlined">folder_open</span></label>
                                    </div>
                                    <p class="member--figureItem-inputBox-exp">5MB를 초과할 수 없으며<br>JPEG, JPG, PNG, GIF 형식의 파일만 가능합니다.</p>
                                </div>
                            </div>
                            <div class="member--figureItem-row">
                                <div class="member--figureItem-row-title">홈페이지<span class="essential"></span></div>
                                <div class="member--figureItem-inputBox">
                                    <input type="text" placeholder="사업단 URL을 입력해주세요." value="<?=$member["mb_homepage"]?>" name="mb_homepage" required>
                                    <div class="member--figureItem-inputClear clear_link_btn">
                                        <span class="material-symbols-outlined">delete</span>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="member--figureItem-row">
                                <div class="member--figureItem-row-title">설립일<span class="essential"></span></div>
                                <div class="member--figureItem-inputBox">
                                    <input type="text" placeholder="YYYY.MM.DD">
                                </div>
                            </div> 
                            <div class="member--figureItem-row">
                                <div class="member--figureItem-row-title">대학교 지역<span class="essential"></span></div>
                                <div class="member--figureItem-inputBox">
                                    <input type="text" placeholder="YYYY.MM.DD">
                                </div>
                            </div>-->
                        </div>
                    </div>
                    <div class="member--figureItem">
                        <div class="member--figureItem-title"><p>SNS</p></div>
                        <div class="member--figureItem-contents">
                            <div class="member--figureItem-row">
                                <div class="member--figureItem-row-title">페이스북</div>
                                <div class="member--figureItem-inputBox">
                                    <input type="text" placeholder="URL을 입력해주세요" value="<?=$member["mb_4"]?>" name="mb_4">
                                    <div class="member--figureItem-inputClear clear_link_btn">
                                        <span class="material-symbols-outlined">delete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="member--figureItem-row">
                                <div class="member--figureItem-row-title">인스타그램</div>
                                <div class="member--figureItem-inputBox">
                                    <input type="text" placeholder="URL을 입력해주세요" value="<?=$member["mb_5"]?>" name="mb_5">
                                    <div class="member--figureItem-inputClear clear_link_btn">
                                        <span class="material-symbols-outlined">delete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="member--figureItem-row">
                                <div class="member--figureItem-row-title">유튜브</div>
                                <div class="member--figureItem-inputBox">
                                    <input type="text" placeholder="URL을 입력해주세요" value="<?=$member["mb_3"]?>" name="mb_3">
                                    <div class="member--figureItem-inputClear clear_link_btn">
                                        <span class="material-symbols-outlined">delete</span>
                                    </div>
                                </div>
                            </div>
                            <div class="member--figureItem-row">
                                <div class="member--figureItem-row-title">기타링크</div>
                                <div class="member--figureItem-inputBox">
                                    <input type="text" placeholder="URL을 입력해주세요" value="<?=$member["mb_6"]?>" name="mb_6">
                                    <div class="member--figureItem-inputClear clear_link_btn">
                                        <span class="material-symbols-outlined">delete</span>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="member--figureItem-final">
                                <div id="memberOut"><p>회원탈퇴</p><span class="material-symbols-outlined">navigate_next</span></div>
                            </div>-->
                        </div>
                    </div>
                    <div class="member--figureItem">
                        <div class="member--figureItem-title"><p>기타 정보</p></div>
                        <div class="member--figureItem-contents">
                            <div class="member--figureItem-row member--figureItem-row-flexStart">
                                <div class="member--figureItem-row-title">학교소개<span class="essential"></span></div>
                                <div class="member--figureItem-inputBox member--figureItem-textareaBox">
                                    <textarea type="text" placeholder="학교소개 글을 입력하세요." name="mb_signature" required><?=$member["mb_signature"]?></textarea>
                                </div>
                            </div>
                            <div class="member--figureItem-row member--figureItem-row-flexStart">
                                <div class="member--figureItem-row-title">사업단소개<span class="essential"></span></div>
                                <div class="member--figureItem-inputBox member--figureItem-textareaBox">
                                    <textarea type="text" placeholder="사업단소개 글을 입력하세요." name="mb_profile" required><?=$member["mb_profile"]?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="member--figureItem">
                        <div class="member--figureItem-title"><p>검색엔진 최적화</p></div>
                        <div class="member--figureItem-contents">
                            <div class="member--figureItem-metaTag-exp">
                                <p class="member--figureItem-metaTag-exp01"><span>⁉️</span> 검색엔진 최적화 (meta tag)란?</p>
                                <p class="member--figureItem-metaTag-exp02">검색엔진은 주기적으로 우리의 웹사이트를 방문하여 각 웹페이지가 어떤 컨텐츠를 제공하는 기능입니다.</p>
                            </div>
                            <div class="member--figureItem-row">
                                <div class="member--figureItem-row-title">검색 타이틀<span class="essential"></span></div>
                                <div class="member--figureItem-inputBox member--figureItem-inputBox2">
                                    <div class="member--figureItem-fixedBox">링크3.0</div>
                                    <input type="text" placeholder="학교명" value="<?=$member["mb_8"]?>" name="mb_8" required>
                                </div>
                            </div>
                            <div class="member--figureItem-row member--figureItem-row-flexStart">
                                <div class="member--figureItem-row-title">노출 설명<span class="essential"></span></div>
                                <div class="member--figureItem-inputBox member--figureItem-textareaBox">
                                    <textarea type="text" placeholder="검색 노출 설명글을 입력하세요." name="mb_9" required><?=$member["mb_9"]?></textarea>
                                </div>
                            </div>
                            <div class="member--figureItem-row member--figureItem-row-flexStart">
                                <div class="member--figureItem-row-title">키워드<span class="essential"></span></div>
                                <div class="member--figureItem-inputBox member--figureItem-inputBox-long">
                                    <input type="text" placeholder="ex) 링크3.0, 학교명, 링크3.0학교명" value="<?=$member["mb_10"]?>" name="mb_10" required>
                                    <div class="member--figureItem-inputBox-exp2"><span class="material-symbols-outlined">error</span><p>0개 단어 제한 / 단어별 ,(콤마)로 구분</p></div>
                                </div>
                            </div>
                            <!-- <div class="member--figureItem-final">
                                <div id="memberOut"><p>회원탈퇴</p><span class="material-symbols-outlined">navigate_next</span></div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="member--submit">
                    <div id="formReset" class="form--reset-button"><span class="material-symbols-outlined">refresh</span><p>초기화</p></div>
                    <button type="submit" id="formSave" class="form--save-button"><p>저장하기</p></button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function readFile(event) {
    let file = event.target.files[0];
	$("#file_name").text(file.name);
}

$(".clear_link_btn").click(function(){
    $(this).siblings("input").val("");
});

$("#formReset").click(function(){
    location.reload();
});
</script>
<?
include_once(G5_PATH.'/tail2.php');