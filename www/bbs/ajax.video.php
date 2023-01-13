<?php

include_once('./_common.php');
include_once(G5_PATH.'/vendor/autoload.php');

$client_id = "a571693bc6916fcafadc42ad951d58a1b9a4abc7";
$client_secret = "1WV7+1sHLXi2zjnOUu2x6tCN1t+CY84e8GzxP4uPZy8DivFtG6ome08xiCf5x8tsPNk8elHHe2S+vgAugzB1SRybQR+jMTFG4Rq5B7AHRiBL7NCpLJJ/Q7OtWW3EKmxa";
$access_token = "c87362fee22bdd1d4657ff8723e7e893";

use Vimeo\Vimeo;
$client = new Vimeo($client_id, $client_secret, $access_token);


$update_chk = false;

if($member["mb_7"] != "" && $member["mb_id"] != "")
{
    $test = $client->request('/me/projects/'.$member["mb_7"].'/items', 'GET');
    $test = $test['body']['data'];


    for($i=0; $i < count($test); $i++){
        $data = $test[$i]["video"];


        if($data["transcode"]["status"] == "complete"){

            $vi_title = addslashes($data["name"]);
            $vi_content = addslashes($data["description"]);
            $vi_vi_id = $data["uri"];
            $vi_thumb = $data["pictures"]["base_link"];
            $vi_url = $data["player_embed_url"];
            $vi_reg_date = $data['created_time'];
            $vi_reg_date = str_replace("T", " ", $vi_reg_date);
            $vi_reg_date = str_replace("+00:00", "", $vi_reg_date);

            $old = sql_fetch("select * from g5_video where mb_id = '".$member["mb_id"]."' and vi_vi_id = '".$vi_vi_id."' ");

            if($old["vi_id"] == "")
            {
                sql_query("insert into g5_video set mb_id = '".$member["mb_id"]."', vi_vi_id = '".$vi_vi_id."', vi_title = '".$vi_title."', vi_content = '".$vi_content."', vi_thumb = '".$vi_thumb."', vi_url = '".$vi_url."', vi_open = '1', vi_reg_date = '".$vi_reg_date."'");
                $update_chk = true;
            }

        }

    }
}else{
    die(json_encode(array('error' => '성과영상 가져오기 실패!! 관리자에게 문의 바랍니다.')));
}

if($update_chk)
{
    die(json_encode(array('error' => '')));
}
else{
    die(json_encode(array('error' => '업로드까지 약간의 시간이 발생합니다. 성과영상을 업로드하신 경우라면 잠시 후 다시 시도해보세요.')));
}

?>