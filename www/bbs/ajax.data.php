<?php
include_once('./_common.php');

$sql = " select ";
$sql .= " (select vi_val from g5_data_1 order by vi_id desc limit 1) as val1, ";
$sql .= " (select vi_val from g5_data_2 order by vi_id desc limit 1) as val2, ";
$sql .= " (select vi_val from g5_data_3 order by vi_id desc limit 1) as val3, ";
$sql .= " (select vi_val from g5_data_4 order by vi_id desc limit 1) as val4, ";
$sql .= " (select vi_val from g5_data_5 order by vi_id desc limit 1) as val5, ";
$sql .= " (select vi_val from g5_data_6 order by vi_id desc limit 1) as val6 ";

$rtn = sql_fetch($sql);
die(json_encode($rtn));