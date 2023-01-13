<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
//add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);
add_stylesheet('<link rel="stylesheet" href="/css/login .css">', 0);

?>
<style>
#header, #footer, .login--title{
    display:none;
}

.public--container{
    padding-top:0;
}
</style>

<div class="login--container">
    <div class="login--form">
        <div class="login--form-wrap">
            <a class="login--form-home" href="/"><img src="/img/logo01.png" alt=""></a>
            <p class="login--title">로그인</p>
            <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
            <input type="hidden" name="url" value="<?php echo $login_url ?>">
                <div class="login--form-inputText">
                    <div class="login--form-inputText-title">아이디</div>
                    <input type="text" name="mb_id" id="login_id">
                </div>
                <div class="login--form-inputText">
                    <div class="login--form-inputText-title">비밀번호</div>
                    <input type="password" name="mb_password" id="pw">
                    <div class="login--form-pwView">
                        <div class="visible"><span class="material-symbols-outlined">visibility</span></div>
                        <div class="invisible"><span class="material-symbols-outlined">visibility_off</span></div>
                    </div>
                </div>
                <div class="login--form-err">
                    <span class="material-symbols-outlined">error</span>
                    <p>가입되어 있지 않은 계정이거나, 이메일 또는 비밀번호가 일치하지 않습니다.</p>
                </div>
                <div class="login--form-submit">
                    <button type="submit"><p>로그인</p></button>
                </div>
                <div class="login--form-check">
                    <input type="checkbox" id="keepLoginInput">
                    <div class="login--form-keepLogin">
                        <span></span>
                        <p>로그인 유지</p>
                    </div>
                    <div class="login--form-findPw">
                        <p>비밀번호 찾기</p><span class="material-symbols-outlined">chevron_right</span>
                    </div>
                </div>
            </form>
            <div class="login--pwReset">
                <p>비밀번호가 어려우신가요?</p>
                <a href="">비밀번호 재설정</a>
            </div>
        </div>
    </div>
</div>



<script>
jQuery(function($){
    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });
});

function flogin_submit(f)
{
    if( $( document.body ).triggerHandler( 'login_sumit', [f, 'flogin'] ) !== false ){
        return true;
    }
    return false;
}

$(".login--form-keepLogin").click(function(){
    
    if($(this).hasClass("checked")){
        $(this).removeClass("checked")
        document.getElementById("keepLoginInput").checked = false
    } else {
        $(this).addClass("checked")
        document.getElementById("keepLoginInput").checked = true
    }

})

$(".login--form-pwView").click(function(){
    if($(this).hasClass("on")){
        $(this).removeClass("on")
        document.getElementById("pw").type = "password"
    } else {
        document.getElementById("pw").type = "text"
        $(this).addClass("on")
    }
})

$("input").focus(function(){
    $(".login--container").removeClass("err")
})
</script>
<!-- } 로그인 끝 -->

