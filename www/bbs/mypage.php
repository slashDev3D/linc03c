<?php
include_once('./_common.php');

$g5['title'] = '마이페이지';

include_once(G5_PATH.'/head2.php');
add_stylesheet('<link rel="stylesheet" href="/css/member.css">', 0);

$_is_mypage = true;

$register_action_url = G5_HTTPS_BBS_URL.'/mypage_update.php';

?>
<style>
.member--container{
    margin-top:0;
}
</style>
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<div class="member--container public--wrap">
    <?php
    include_once('./mypage_aside.php');
    ?>
    <div class="member--body">
        <div class="member--body-wrap">
            <div class="member--title">
                <div class="member--title-text01">😊&nbsp;가입정보</div>
                <div class="member--title-text02">상세한 가입 계정 정보를 관리할 수 있어요.</div>
            </div>
            <form id="fregisterform" name="fregisterform" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="hidden" name="mb_id" value="<?=$member["mb_id"]?>">
                <div class="member--figure">
                    <div class="member--figureItem">
                    <div class="member--figureItem-title">
                        <p>기본정보</p>
                    </div>
                    <div class="member--figureItem-contents">
                        <div class="member--figureItem-row">
                            <div class="member--figureItem-row-title">아이디</div>
                            <div class="member--figureItem-static"><?=$member["mb_id"]?></div>
                        </div>
                        <div class="member--figureItem-row">
                            <div class="member--figureItem-row-title">비밀번호</div>
                            <div class="member--figureItem-inputBox">
                                <input type="password" placeholder="비밀번호" name="mb_password" id="reg_mb_password">
                            </div>
                        </div>
                        <div class="member--figureItem-row">
                            <div class="member--figureItem-row-title"></div>
                            <div class="member--figureItem-inputBox">
                                <input type="password" placeholder="비밀번호 확인" name="mb_password_re" id="reg_mb_password_re">
                                <p class="member--figureItem-inputBox-exp">8~20자 이내 영문자, 숫자의 조합으로 입력해주세요.</p>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="member--figureItem">
                    <div class="member--figureItem-title">
                        <p>담당자 정보</p>
                    </div>
                    <div class="member--figureItem-contents">
                        <div class="member--figureItem-row">
                            <div class="member--figureItem-row-title">이름<span class="essential"></span></div>
                            <div class="member--figureItem-inputBox">
                                <input type="text" placeholder="이름" value="<?=$member["mb_name"]?>" name="mb_name" required>
                            </div>
                        </div>
                        <div class="member--figureItem-row">
                            <div class="member--figureItem-row-title">전화번호<span class="essential"></span></div>
                            <div class="member--figureItem-inputBox">
                                <input type="text" placeholder="'-'없이 숫자만" value="<?=$member["mb_hp"]?>" name="mb_hp" required>
                            </div>
                        </div>
                        <div class="member--figureItem-row">
                            <div class="member--figureItem-row-title">이메일<span class="essential"></span></div>
                            <div class="member--figureItem-inputBox">
                                <input type="text" placeholder="dev@slash.builders" value="<?=$member["mb_email"]?>" name="mb_email" required>
                            </div>
                        </div>
                        <!--<div class="member--figureItem-final">
                            <div id="memberOut"><p>회원탈퇴</p><span class="material-symbols-outlined">navigate_next</span></div>
                        </div>-->
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
$("#formReset").click(function(){
    location.reload();
});


function fregisterform_submit(f)
{

    if (f.mb_password.value != f.mb_password_re.value) {
        alert("비밀번호가 같지 않습니다.");
        f.mb_password.focus();
        return false;
    }

    if (f.mb_password.value.length > 0) {
        if (f.mb_password_re.value.length < 8) {
            alert("비밀번호를 8글자 이상 입력하십시오.");
            f.mb_password.focus();
            return false;
        }
    }

    // 이름 검사
    if (f.mb_name.value.length < 1) {
        alert("이름을 입력하십시오.");
        f.mb_name.focus();
        return false;
    }

    if (f.mb_hp.value.length < 1) {
        alert("전화번호를 입력하십시오.");
        f.mb_hp.focus();
        return false;
    }

    if (chk_tel(f.mb_hp.value) == false) {
        alert("올바른 전화번호를 입력하십시오.");
        f.mb_hp.focus();
        return false;
    }

    if (f.mb_email.value.length < 1) {
        alert("이메일을 입력하십시오.");
        f.mb_email.focus();
        return false;
    }



    return true;
}
</script>
<?
include_once(G5_PATH.'/tail2.php');