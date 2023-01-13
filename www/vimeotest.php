<?
include_once('./_common.php');
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_PATH.'/head2.php');

// 컴포저의 비메오기능을 가져오기 위한 파일 로드입니다.
include_once(G5_PATH.'/vendor/autoload.php');
include_once(G5_PATH.'/vimeoinfo.php');
?>
<?php for ($i=0; $i<$res_folder_count; $i++) { ?>
    <div><? echo $res_folder_data[$i]['video']['link'] ?></div>
    <div><? echo $res_folder_data[$i]['video']['name'] ?></div>
    <!-- <div><? echo $res_folder_data[$i]['video']['files'][0]['link'] ?></div> -->
    <video style="width:560px;" playsinline controls src="<? echo $res_folder_data[$i]['video']['files'][0]['link'] ?>"></video>
    <p>비디오</p>
    <div style="width:560px;"><img style="width:100%;display:block;" src="<?php echo $res_folder_data[$i]['video']['pictures']['base_link'] ?>" alt=""></div>
    <p>썸네일</p>
<? } ?>
<form method="POST" id ="vimeo-form" action="./vimeopost.php" enctype="multipart/form-data">
    <!-- <label for="file">File:</label> -->
    <div>
        <label for="videoFile"></label>
        <input type="file" name="video_file" value="" class="form-control" id="videoFile">
    </div>
    <input type="text" name="video_name" value="" class="form-control" id="videoName">
    <input type="text" name="video_desc" value="" class="form-control" id="videoDesc">
    <input type="submit" value="save" name="saveUniv" class="btn btn-primary">
</form>
<?php
include_once(G5_PATH.'/tail2.php');
?>
