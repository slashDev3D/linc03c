<?php
$sub_menu = '100400';
include_once('./_common.php');

check_demo();

auth_check_menu($auth, $sub_menu, "w");

check_admin_token();

$count_post_mb_id = (isset($_POST['mb_id']) && is_array($_POST['mb_id'])) ? count($_POST['mb_id']) : 0;
$gr_id = $_POST['gr_id'];

for ($i=0; $i<$count_post_mb_id; $i++)
{
    $mb_type = isset($_POST['mb_'.$gr_id][$i]) ? (int) $_POST['mb_'.$gr_id][$i] : 0;
    

    $mb_id = isset($_POST['mb_id'][$i]) ? safe_replace_regex($_POST['mb_id'][$i], 'mb_id') : '';

    $sql = "update {$g5['member_table']}
               set mb_".$gr_id." = '".$mb_type."'
             where mb_id = '".$mb_id."' ";
    sql_query($sql);
}

goto_url("info_form_u.php?gr_id=$gr_id&amp;sca=$sca&amp;sst=$sst&amp;sod=$sod&amp;sfl=$sfl&amp;stx=$stx&amp;page=$page");