<?php
include_once('./_common.php');

$wr_id = $_POST['wr_id'];

$ss_name = 'ss_view_calender_'.$wr_id;
if (!get_session($ss_name))
{
    sql_query(" update g5_write_calender set wr_hit = wr_hit + 1 where wr_id = '{$wr_id}' ");

    set_session($ss_name, TRUE);
}

?>