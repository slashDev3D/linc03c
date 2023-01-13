<?php
include_once('./_common.php');
include_once(G5_PATH.'/vendor/autoload.php');

$client_id = "a571693bc6916fcafadc42ad951d58a1b9a4abc7";
$client_secret = "1WV7+1sHLXi2zjnOUu2x6tCN1t+CY84e8GzxP4uPZy8DivFtG6ome08xiCf5x8tsPNk8elHHe2S+vgAugzB1SRybQR+jMTFG4Rq5B7AHRiBL7NCpLJJ/Q7OtWW3EKmxa";
$access_token = "c87362fee22bdd1d4657ff8723e7e893";

use Vimeo\Vimeo;
$client = new Vimeo($client_id, $client_secret, $access_token);

$g5['title'] = '성과영상 업로드';

$msg = array();
$uid = isset($_POST['uid']) ? preg_replace('/[^0-9]/', '', $_POST['uid']) : 0;

$upload_max_filesize = ini_get('upload_max_filesize');

if (empty($_POST)) {
    alert("파일 또는 글내용의 크기가 서버에서 설정한 값을 넘어 오류가 발생하였습니다.\\npost_max_size=".ini_get('post_max_size')." , upload_max_filesize=".$upload_max_filesize."\\n게시판관리자 또는 서버관리자에게 문의 바랍니다.");
}

$vi_title = '';
if (isset($_POST['vi_title'])) {
    $vi_title = substr(trim($_POST['vi_title']),0,255);
    $vi_title = preg_replace("#[\\\]+$#", "", $vi_title);
}
if ($vi_title == '') {
    $msg[] = '<strong>제목</strong>을 입력하세요.';
}

$vi_content = '';
if (isset($_POST['vi_content'])) {
    $vi_content = substr(trim($_POST['vi_content']),0,65536);
    $vi_content = preg_replace("#[\\\]+$#", "", $vi_content);
}
if ($vi_content == '') {
    $msg[] = '<strong>내용</strong>을 입력하세요.';
}



$msg = implode('<br>', $msg);
if ($msg) {
    alert($msg);
}

// 090710
if (substr_count($vi_content, '&#') > 50) {
    alert('내용에 올바르지 않은 코드가 다수 포함되어 있습니다.');
    exit;
}



$vi_file = $_FILES['vi_file']['name'];
$video_file = realpath($_FILES['vi_file']['tmp_name']);
$folder_number = $member['mb_7'];

if($folder_number == "")
{
    alert("업로드 실패! 관리자에게 문의 바랍니다.", "/bbs/video.php");
    exit;
}

$uri = $client->upload($video_file, array(
    "folder_uri" => "https://vimeo.com/manage/folders/".$folder_number,
    "name" => $vi_title,
    "description" => $vi_content));


$vi_vi_id = $uri;

$sql = " insert into g5_video
            set vi_title = '$vi_title',
            mb_id = '{$member['mb_id']}',
            vi_reg_date = '".G5_TIME_YMDHIS."',
            vi_content = '$vi_content',
            vi_file = '$vi_file',
            vi_open = '0',
            vi_vi_id = '$vi_vi_id' ";

sql_query($sql);

alert("업로드 완료! 업로드 영상이 올라가는데 약간의 시간이 발생 합니다.", "/bbs/video.php");
exit;

?>