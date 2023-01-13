<?php
include_once('./_common.php');
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_PATH.'/head2.php');

// 컴포저의 비메오기능을 가져오기 위한 파일 로드입니다.
include_once(G5_PATH.'/vendor/autoload.php');
include_once(G5_PATH.'/vimeoinfo.php');

$video_file = realpath($_FILES['video_file']['tmp_name']);
$video_name = $_POST['video_name'];
$video_desc = $_POST['video_desc'];

$uri = $client->upload($video_file, array(
    "folder_uri" => "https://vimeo.com/manage/folders/".$folder_number,
    "name" => $video_name,
    "description" => $video_desc,
));
echo "Your video URI is: " . $uri;
?>


<?php
include_once(G5_PATH.'/tail2.php');
?>
