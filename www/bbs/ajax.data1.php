<?php
include_once('./_common.php');

$sql = " select vi_val from g5_data_1 order by vi_id desc limit 1 ";

$rtn = sql_fetch($sql);
die(json_encode($rtn));