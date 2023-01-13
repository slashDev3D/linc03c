<?php
$sub_menu = "100400";
include_once('./_common.php');

auth_check_menu($auth, $sub_menu, 'r');

$sql_common = " from g5_info ";

$sql_search = " where (1) ";


$sql_order = " order by gr_id asc ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = $config['cf_page_rows'];
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '기준정보 관리';
include_once('./admin.head.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;
?>

<style>
table td{
    width:100px !important;
}
</style>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
</div>

<form name="fmemberlist" id="fmemberlist" action="./info_form_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="token" value="">

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col" id="mb_list_chk" rowspan="2">
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col" rowspan="2">구분(센서)</th>
        <th scope="col" colspan="2">경보</th>
        <th scope="col" colspan="2">알람</th>
        <th scope="col" rowspan="2">문자 발송</th>
        <th scope="col" rowspan="2">문자전송관리</th>
    </tr>
    <tr>
        <th scope="col">최저</th>
        <th scope="col">최고</th>
        <th scope="col">최저</th>
        <th scope="col">최고</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $row=sql_fetch_array($result); $i++) {
        // 접근가능한 그룹수
        $sql2 = " select count(*) as cnt from {$g5['group_member_table']} where mb_id = '{$row['mb_id']}' ";
        $row2 = sql_fetch($sql2);
        $group = '';
        if ($row2['cnt'])
            $group = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'">'.$row2['cnt'].'</a>';

        if ($is_admin == 'group') {
            $s_mod = '';
        } else {
            $s_mod = '<a href="./info_form_u.php?gr_id='.$row['gr_id'].'" class="btn btn_03">문자전송 관리</a>';
        }
        $s_grp = '<a href="./boardgroupmember_form.php?mb_id='.$row['mb_id'].'" class="btn btn_02">그룹</a>';

        $leave_date = $row['mb_leave_date'] ? $row['mb_leave_date'] : date('Ymd', G5_SERVER_TIME);
        $intercept_date = $row['mb_intercept_date'] ? $row['mb_intercept_date'] : date('Ymd', G5_SERVER_TIME);

        $mb_nick = get_sideview($row['mb_id'], get_text($row['mb_nick']), $row['mb_email'], $row['mb_homepage']);

        $mb_id = $row['mb_id'];
        $leave_msg = '';
        $intercept_msg = '';
        $intercept_title = '';
        if ($row['mb_leave_date']) {
            $mb_id = $mb_id;
            $leave_msg = '<span class="mb_leave_msg">탈퇴함</span>';
        }
        else if ($row['mb_intercept_date']) {
            $mb_id = $mb_id;
            $intercept_msg = '<span class="mb_intercept_msg">차단됨</span>';
            $intercept_title = '차단해제';
        }
        if ($intercept_title == '')
            $intercept_title = '차단하기';

        $address = $row['mb_zip1'] ? print_address($row['mb_addr1'], $row['mb_addr2'], $row['mb_addr3'], $row['mb_addr_jibeon']) : '';

        $bg = 'bg'.($i%2);

        switch($row['mb_certify']) {
            case 'hp':
                $mb_certify_case = '휴대폰';
                $mb_certify_val = 'hp';
                break;
            case 'ipin':
                $mb_certify_case = '아이핀';
                $mb_certify_val = '';
                break;
            case 'admin':
                $mb_certify_case = '관리자';
                $mb_certify_val = 'admin';
                break;
            default:
                $mb_certify_case = '&nbsp;';
                $mb_certify_val = 'admin';
                break;
        }
    ?>

    <tr class="<?php echo $bg; ?>">
        <td headers="mb_list_chk" class="td_chk" >
            <input type="hidden" name="gr_id[<?php echo $i ?>]" value="<?php echo $row['gr_id'] ?>" id="gr_id_<?php echo $i ?>">
            <input type="checkbox" name="chk[]" value="<?php echo $i ?>" id="chk_<?php echo $i ?>">
        </td>
        <td><?php echo get_text($row['gr_subject']); ?></td>
        <td>
            <input type="text" class="tbl_input full_input" name="gr_alert_min[<?php echo $i ?>]" value="<?php echo $row['gr_alert_min'] ?>" id="gr_alert_min_<?php echo $i ?>">
        </td>
        <td>
            <input type="text" class="tbl_input full_input" name="gr_alert_max[<?php echo $i ?>]" value="<?php echo $row['gr_alert_max'] ?>" id="gr_alert_max_<?php echo $i ?>">
        </td>
        <td>
            <input type="text" class="tbl_input full_input" name="gr_alarm_min[<?php echo $i ?>]" value="<?php echo $row['gr_alarm_min'] ?>" id="gr_alarm_min_<?php echo $i ?>">
        </td>
        <td>
            <input type="text" class="tbl_input full_input" name="gr_alarm_max[<?php echo $i ?>]" value="<?php echo $row['gr_alarm_max'] ?>" id="gr_alarm_max_<?php echo $i ?>">
        </td>
        <td>
            <input type="checkbox" name="gr_use_msg[<?php echo $i; ?>]" <?php echo $row['gr_use_msg']?'checked':''; ?> value="1" id="gr_alarm_max_<?php echo $i ?>" >
        </td>
        <td headers="mb_list_mng"  class="td_mng td_mng_s"><?php echo $s_mod ?></td>
    </tr>
    
    <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn btn_02">    
</div>


</form>

<script>
function fmemberlist_submit(f)
{
    if (!is_checked("chk[]")) {
        alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}
</script>

<?php
include_once ('./admin.tail.php');