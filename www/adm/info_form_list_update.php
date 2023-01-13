<?php
$sub_menu = "100400";
include_once('./_common.php');

check_demo();

if (! (isset($_POST['chk']) && is_array($_POST['chk']))) {
    alert($_POST['act_button']." 하실 항목을 하나 이상 체크하세요.");
}

auth_check_menu($auth, $sub_menu, 'w');

check_admin_token();

$msg = '';

if ($_POST['act_button'] == "선택수정") {

    for ($i=0; $i<count($_POST['chk']); $i++)
    {
        // 실제 번호를 넘김
        $k = isset($_POST['chk'][$i]) ? (int) $_POST['chk'][$i] : 0;
        
        $post_gr_alert_min =  $_POST['gr_alert_min'][$k];
        $post_gr_alert_max =  $_POST['gr_alert_max'][$k];
        $post_gr_alarm_min =  $_POST['gr_alarm_min'][$k];
        $post_gr_alarm_max =  $_POST['gr_alarm_max'][$k];
        $post_gr_use_msg = isset($_POST['gr_use_msg'][$k]) ? (int) $_POST['gr_use_msg'][$k] : 0;
        $gr_id = $_POST['gr_id'][$k];
        

        $sql = " update g5_info
                    set gr_alert_min = '".$post_gr_alert_min."',
                    gr_alert_max = '".$post_gr_alert_max."',
                    gr_alarm_min = '".$post_gr_alarm_min."',
                    gr_alarm_max = '".$post_gr_alarm_max."',
                    gr_use_msg = '".$post_gr_use_msg."'
                    where gr_id = '".$gr_id."' ";
        sql_query($sql);
    }

} 

if ($msg)
    //echo '<script> alert("'.$msg.'"); </script>';
    alert($msg);



goto_url('./info_form.php');