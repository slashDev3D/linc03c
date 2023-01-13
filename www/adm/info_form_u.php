<?php
$sub_menu = '100400';
include_once('./_common.php');

$info = sql_fetch("select * from g5_info where gr_id = '".$gr_id."'");


auth_check_menu($auth, $sub_menu, "r");



$g5['title'] = $info["gr_subject"].'센서 문자 발송 관리';
include_once (G5_ADMIN_PATH.'/admin.head.php');


$sql_common = " from {$g5['member_table']} ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'mb_tel' :
        case 'mb_hp' :
            $sql_search .= " ({$sfl} like '%{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$qstr  = $qstr.'&amp;gr_id='.$gr_id.'&amp;sca='.$sca.'&amp;page='.$page.'&amp;save_stx='.$stx;

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'?gr_id='.$gr_id.'" class="ov_listall">전체목록</a>';

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 8;

?>

<style>
table td{
    width:100px !important;
}
</style>

<div class="local_ov01 local_ov">
    <?php echo $listall; ?>
        <span class="btn_ov01"><span class="ov_txt">전체 회원</span><span class="ov_num">  <?php echo $total_count; ?>명</span></span>
</div>

<form name="flist" class="local_sch01 local_sch">
<input type="hidden" name="page" value="<?php echo $page; ?>">
<input type="hidden" name="gr_id" value="<?php echo $gr_id; ?>">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_id"<?php echo get_selected($sfl, "mb_id"); ?>>회원아이디</option>    
    <option value="mb_name"<?php echo get_selected($sfl, "mb_name"); ?>>이름</option>
    <option value="mb_nick"<?php echo get_selected($sfl, "mb_nick"); ?>>직급</option>
    <option value="mb_level"<?php echo get_selected($sfl, "mb_level"); ?>>권한</option>
    <option value="mb_email"<?php echo get_selected($sfl, "mb_email"); ?>>E-MAIL</option>
    <option value="mb_tel"<?php echo get_selected($sfl, "mb_tel"); ?>>전화번호</option>
    <option value="mb_hp"<?php echo get_selected($sfl, "mb_hp"); ?>>휴대폰번호</option>    
</select>

<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx; ?>" id="stx" required class="frm_input required">
<input type="submit" value="검색" class="btn_submit">

</form>

<form name="fitemtypelist" method="post" action="./info_form_u_update.php">
<input type="hidden" name="gr_id" value="<?php echo $gr_id; ?>">
<input type="hidden" name="sca" value="<?php echo $sca; ?>">
<input type="hidden" name="sst" value="<?php echo $sst; ?>">
<input type="hidden" name="sod" value="<?php echo $sod; ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl; ?>">
<input type="hidden" name="stx" value="<?php echo $stx; ?>">
<input type="hidden" name="page" value="<?php echo $page; ?>">

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col"><?php echo subject_sort_link("mb_id", $qstr, 1); ?>아이디</a></th>
        <th scope="col"><?php echo subject_sort_link("mb_name", $qstr, 1); ?>이름</a></th>
        <th scope="col"><?php echo subject_sort_link("mb_nick", $qstr, 1); ?>직급</a></th>
        <th scope="col"><?php echo subject_sort_link("mb_level", $qstr, 1); ?>권한</a></th>
        <th scope="col"><?php echo subject_sort_link("mb_email", $qstr, 1); ?>이메일</a></th>
        <th scope="col"><?php echo subject_sort_link("mb_hp", $qstr, 1); ?>휴대폰번호</a></th>
        <th scope="col"><?php echo subject_sort_link("mb_".$gr_id, $qstr, 1); ?>문자<br>수신</a></th>
        <th scope="col">관리</th>
    </tr>
    </thead>
    <tbody>
    <?php for ($i=0; $row=sql_fetch_array($result); $i++) {
        $href = "/adm/member_form.php?w=u&mb_id=".$row["mb_id"];

        $bg = 'bg'.($i%2);
    ?>
    <tr class="<?php echo $bg; ?>">
        <td class="td_code">
            <input type="hidden" name="mb_id[<?php echo $i; ?>]" value="<?php echo $row['mb_id']; ?>">
            <?php echo $row['mb_id']; ?>
        </td>
        <td class="td_code">
            <?php echo $row['mb_name']; ?>
        </td>
        <td class="td_code">
            <?php echo $row['mb_nick']; ?>
        </td>
        <td class="td_code">
            <?php echo $row['mb_level']; ?>
        </td>
        <td class="td_code">
            <?php echo $row['mb_email']; ?>
        </td>
        <td class="td_code">
            <?php echo $row['mb_hp']; ?>
        </td>
        <td class="td_chk2">
            <label for="type1_<?php echo $i; ?>" class="sound_only">히트상품</label>
            <input type="checkbox" name="mb_<?=$gr_id?>[<?php echo $i; ?>]" value="1" id="mb_<?=$gr_id?>_<?php echo $i; ?>" <?php echo ($row['mb_'.$gr_id] ? 'checked' : ''); ?>>
        </td>
        <td class="td_mng td_mng_s">
            <a href="<?=$href?>" class="btn btn_03">수정</a>
         </td>
    </tr>
    <?php
    }

    if (!$i)
        echo '<tr><td colspan="8" class="empty_table"><span>자료가 없습니다.</span></td></tr>';
    ?>
    </tbody>
    </table>
</div>

<div class="btn_confirm03 btn_confirm">
    <input type="submit" value="일괄수정" class="btn_submit">
</div>
</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>

<?php
include_once (G5_ADMIN_PATH.'/admin.tail.php');