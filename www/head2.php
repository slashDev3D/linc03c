<?php

// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$g5_debug['php']['begin_time'] = $begin_time = get_microtime();

if (!isset($g5['title'])) {
    $g5['title'] = $config['cf_title'];
    $g5_head_title = $g5['title'];
}
else {
    // 상태바에 표시될 제목
    $g5_head_title = implode(' | ', array_filter(array($g5['title'], $config['cf_title'])));
}

$g5['title'] = strip_tags($g5['title']);
$g5_head_title = strip_tags($g5_head_title);

// 현재 접속자
// 게시판 제목에 ' 포함되면 오류 발생
$g5['lo_location'] = addslashes($g5['title']);
if (!$g5['lo_location'])
    $g5['lo_location'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
$g5['lo_url'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
if (strstr($g5['lo_url'], '/'.G5_ADMIN_DIR.'/') || $is_admin == 'super') $g5['lo_url'] = '';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta property="og:type" content="website"> 
    <?if($data["mb_9"] != ""){?>
        <meta name="description" content="<?=$data["mb_9"]?>">     
        <meta property="og:description" content="<?=$data["mb_9"]?>"> 
    <?}?>
    <?if($data["mb_8"] != ""){?>
        <meta name="subject" content="링크3.0 <?=$data["mb_8"]?>">     
        <meta property="og:title" content="링크3.0 <?=$data["mb_8"]?>"> 
        <meta property="og:subject" content="링크3.0 <?=$data["mb_8"]?>"> 
    <?}?>
    <?if($data["mb_10"] != ""){?>
        <meta name="keywords" content="<?=$data["mb_10"]?>">     
    <?}?>
    <title><?php echo $g5_head_title; ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <?echo '<link rel="stylesheet" href="'.run_replace('head_css_url', G5_CSS_URL.'/'.(G5_IS_MOBILE?'mobile':'default').$shop_css.'.css?ver='.G5_CSS_VER, G5_URL).'">'.PHP_EOL;?>
    <link rel="stylesheet" href="/css/public.css">

    <?if(defined('_INDEX_')) { ?>
        <link rel="stylesheet" href="/css/index.css">
    <?}?>

    <?if($_list_page){?>
        <link rel="stylesheet" href="/css/list.css">
    <?}?>

    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <?if($_list_page){?>
        <script src="https://www.youtube.com/iframe_api"></script>
    <?}?>

    <script>
    // 자바스크립트에서 사용하는 전역변수 선언
    var g5_url       = "<?php echo G5_URL ?>";
    var g5_bbs_url   = "<?php echo G5_BBS_URL ?>";
    var g5_is_member = "<?php echo isset($is_member)?$is_member:''; ?>";
    var g5_is_admin  = "<?php echo isset($is_admin)?$is_admin:''; ?>";
    var g5_is_mobile = "<?php echo G5_IS_MOBILE ?>";
    var g5_bo_table  = "<?php echo isset($bo_table)?$bo_table:''; ?>";
    var g5_sca       = "<?php echo isset($sca)?$sca:''; ?>";
    var g5_editor    = "<?php echo ($config['cf_editor'] && $board['bo_use_dhtml_editor'])?$config['cf_editor']:''; ?>";
    var g5_cookie_domain = "<?php echo G5_COOKIE_DOMAIN ?>";
    var g5_shop_url = "<?php echo G5_SHOP_URL; ?>";
    <?php if(defined('G5_IS_ADMIN')) { ?>
    var g5_admin_url = "<?php echo G5_ADMIN_URL; ?>";
    <?php } ?>
    </script>
    <?
    add_stylesheet('<link rel="stylesheet" href="'.G5_JS_URL.'/font-awesome/css/font-awesome.min.css">', 0);

    add_javascript('<script src="'.G5_JS_URL.'/common.js?ver='.G5_JS_VER.'"></script>', 0);
    ?>


</head>
<body>
<div class="public--container" data-sub="<?=$data_sub?>">
<?php
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');

preg_match("/오늘:(.*),어제:(.*),최대:(.*),전체:(.*)/", $config['cf_visit'], $visit);
settype($visit[1], "integer");
settype($visit[2], "integer");
settype($visit[3], "integer");
settype($visit[4], "integer");


?>
<script>
    var g5_visit = "<?php echo number_format($visit[4])?>";
</script>
