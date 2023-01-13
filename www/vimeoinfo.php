<!-- 
    2022.11.23 성재민
    vimeo API 사용을 위한 테스트 페이지 입니다.
    easyweb2021@gmail.com 비메오 계정을 사용했습니다.
    사용한 것들 : composer, vimeoAPI 2.0
-->
<? 
/* 
멤버별로 여분필드1에 vimeo 폴더넘버를 저장했습니다.
폴더 넘버는 vimeo의 영상이 담긴 폴더 접속 시 주소창의 넘버입니다.
앱링크 : https://developer.vimeo.com/apps/258490
위의 링크에서 client_id, client_secret, access_token을 확인할 수 있습니다.
이 변수들은 지우지 말아주세요.
*/
$folder_number = $member['mb_1'];
// $folder_number = 13879292;
$client_id = "a571693bc6916fcafadc42ad951d58a1b9a4abc7";
$client_secret = "1WV7+1sHLXi2zjnOUu2x6tCN1t+CY84e8GzxP4uPZy8DivFtG6ome08xiCf5x8tsPNk8elHHe2S+vgAugzB1SRybQR+jMTFG4Rq5B7AHRiBL7NCpLJJ/Q7OtWW3EKmxa";
$access_token = "c87362fee22bdd1d4657ff8723e7e893"; //이 토큰은 private 토큰입니다.
// $access_token = "784ee9a5685f885f07c86e6777fe7f62"; //이 토큰은 public 입니다.

use Vimeo\Vimeo;

$client = new Vimeo($client_id, $client_secret, $access_token);

$res_folder = $client->request('/me/projects/'.$folder_number.'/items', 'GET');
$res_folder_data = $res_folder['body']['data'];
$res_folder_count = count($res_folder_data);
?>

<script>
    </script>
<!-- vimeo body를 json으로 parsing하기 위한 스크립트 입니다. -->
<script>
    console.log(<?php echo $folder_number; ?>)
    var words = <?php echo json_encode($res_folder_data); ?>;
    console.log(words)
    console.log("hello vimeoinfo")
</script>