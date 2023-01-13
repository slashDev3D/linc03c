<?php

include_once('./_common.php');

$vi_id = $_POST["vi_id"];
$sort = $_POST["sort"];

$data = sql_fetch("select a.*, b.* from g5_video a left outer join g5_member b on a.mb_id = b.mb_id where a.vi_id = '".$vi_id."'");

if ($sort == "new") $sql_order = " order by vi_reg_date desc ";
if ($sort == "old") $sql_order = " order by vi_reg_date asc ";
if ($sort == "hit") $sql_order = " order by vi_hit desc ";

$result = sql_query("select * from g5_video where mb_id = '".$data["mb_id"]."' and vi_open = '1' and vi_id != '".$vi_id."' ".$sql_order);



?>

<?while ($row = sql_fetch_array($result)){?>
<div class="perd--others01-listItem">
    
    <div class="perd--others01-listItem-thumb">
        <a href="/performancedetail.php?vi_id=<?=$row["vi_id"]?>">
        <div class="perd--others01-listItem-thumbImg" style="background-image:url(<?=$row["vi_thumb"]?>)"></div>
        </a>
    </div>
    
    <div class="perd--others01-listItem-info">
        <div class="perd--others01-listItem-info01"><span><?=$data["mb_nick"]?></span>&nbsp;<span><?=$data["mb_2"]?></span>&nbsp;<span><?=$data["mb_1"]?></span></div>
        <div class="perd--others01-listItem-info02"><?=$row["vi_title"]?></div>
        <div class="perd--others01-listItem-info03">
            <span class="material-symbols-outlined">schedule</span>
            <p><?=get_board_date($row["vi_reg_date"])?></p>
        </div>
    </div>
</div>
<?}?>