<?php
$sub_menu = '200100';
include_once('./_common.php');

// 상품이 많을 경우 대비 설정변경
set_time_limit ( 0 );
ini_set('memory_limit', '50M');

auth_check_menu($auth, $sub_menu, "w");

function only_number($n)
{
    return preg_replace('/[^0-9]/', '', $n);
}

$is_upload_file = (isset($_FILES['excelfile']['tmp_name']) && $_FILES['excelfile']['tmp_name']) ? 1 : 0;

if( ! $is_upload_file){
    alert("엑셀 파일을 업로드해 주세요.");
}

if($is_upload_file) {
    $file = $_FILES['excelfile']['tmp_name'];

    include_once(G5_LIB_PATH.'/PHPExcel/IOFactory.php');

    $objPHPExcel = PHPExcel_IOFactory::load($file);
    $sheet = $objPHPExcel->getSheet(0);

    $num_rows = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();

    $dup_it_id = array();
    $fail_it_id = array();
    $dup_count = 0;
    $total_count = 0;
    $fail_count = 0;
    $succ_count = 0;

    for ($i = 2; $i <= $num_rows; $i++) {
       

        $j = 0;

        $rowData = $sheet->rangeToArray('A' . $i . ':' . $highestColumn . $i,
                                            NULL,
                                            TRUE,
                                            FALSE);

        
        $mb_id        = trim(addslashes($rowData[0][$j++]));
        $mb_password  = trim($rowData[0][$j++]);
        $mb_1  = trim(addslashes($rowData[0][$j++]));
        $mb_2  = trim(addslashes($rowData[0][$j++]));
        $mb_nick  = trim(addslashes($rowData[0][$j++]));
        $mb_img  = trim(addslashes($rowData[0][$j++]));
        $mb_homepage  = trim(addslashes($rowData[0][$j++]));
        $mb_3  = trim(addslashes($rowData[0][$j++]));
        $mb_4  = trim(addslashes($rowData[0][$j++]));
        $mb_5  = trim(addslashes($rowData[0][$j++]));
        $mb_6  = trim(addslashes($rowData[0][$j++]));
        $mb_name  = trim(addslashes($rowData[0][$j++]));
        $mb_hp  = trim(addslashes($rowData[0][$j++]));
        $mb_email  = trim(addslashes($rowData[0][$j++]));
        $mb_7  = trim(addslashes($rowData[0][$j++]));
        $mb_signature  = trim(addslashes($rowData[0][$j++]));
        $mb_profile  = trim(addslashes($rowData[0][$j++]));
        $mb_8  = trim(addslashes($rowData[0][$j++]));
        $mb_9  = trim(addslashes($rowData[0][$j++]));
        $mb_10  = trim(addslashes($rowData[0][$j++]));
        $mb_11  = trim(addslashes($rowData[0][$j++]));
        $mb_12  = trim(addslashes($rowData[0][$j++]));

        $mb_password = get_encrypt_string($mb_password);
        $mb_hp = only_number($mb_hp);

        if($mb_id == "" || $mb_password == "" || $mb_email == "")
        {
            continue;
        }

        $total_count++;

        
        // mb_id 중복체크
        $sql2 = " select count(*) as cnt from g5_member where mb_id = '$mb_id' ";
        $row2 = sql_fetch($sql2);
        if(isset($row2['cnt']) && $row2['cnt']) {
            $fail_it_id[] = $mb_id;
            $dup_it_id[] = $mb_id;
            $dup_count++;
            $fail_count++;
            continue;
        }

        // 이메일중복체크
        $sql2 = " select mb_id from {$g5['member_table']} where mb_email = '{$mb_email}' ";
        $row2 = sql_fetch($sql2);
        if (isset($row2['mb_id']) && $row2['mb_id'])
        {
            $fail_it_id[] = $mb_id;
            $dup_it_id[] = $mb_id;
            $dup_count++;
            $fail_count++;
            continue;
        }

        $sql = " INSERT INTO g5_member
                     SET mb_id = '$mb_id',
                     mb_password = '{$mb_password}',
                     mb_1 = '$mb_1',
                     mb_2 = '$mb_2',
                     mb_nick = '$mb_nick',
                     mb_img = '$mb_img',
                     mb_homepage = '$mb_homepage',
                     mb_3 = '$mb_3',
                     mb_4 = '$mb_4',
                     mb_5 = '$mb_5',
                     mb_6 = '$mb_6',
                     mb_name = '$mb_name',
                     mb_hp = '$mb_hp',
                     mb_email = '$mb_email',
                     mb_7 = '$mb_7',
                     mb_signature = '$mb_signature',
                     mb_profile = '$mb_profile',
                     mb_8 = '$mb_8',
                     mb_9 = '$mb_9',
                     mb_10 = '$mb_10',
                     mb_11 = '$mb_11',
                     mb_12 = '$mb_12',
                     mb_datetime = '".G5_TIME_YMDHIS."',
                     mb_ip = '{$_SERVER['REMOTE_ADDR']}',
                     mb_level = '3' ";

        
        $result = sql_query($sql);
        
        if($result){

            $succ_count++;

        }
        else{
            $fail_it_id[] = $mb_id;
            $fail_count++;
            continue;
        }


        
    }
}

$g5['title'] = '엑셀일괄등록 결과';
include_once(G5_PATH.'/head.sub.php');
?>

<div class="new_win">
    <h1><?php echo $g5['title']; ?></h1>

    <div class="local_desc01 local_desc">
        <p>등록을 완료했습니다.</p>
    </div>

    <dl id="excelfile_result">
        <dt>총등록수</dt>
        <dd><?php echo number_format($total_count); ?></dd>
        <dt>완료건수</dt>
        <dd><?php echo number_format($succ_count); ?></dd>
        <dt>실패건수</dt>
        <dd><?php echo number_format($fail_count); ?></dd>
        <?php if($fail_count > 0) { ?>
        <dt>실패아이디</dt>
        <dd><?php echo implode(', ', $fail_it_id); ?></dd>
        <?php } ?>
        <?php if($dup_count > 0) { ?>
        <dt>중복아이디건수</dt>
        <dd><?php echo number_format($dup_count); ?></dd>
        <dt>중복아이디</dt>
        <dd><?php echo implode(', ', $dup_it_id); ?></dd>
        <?php } ?>
    </dl>

    <div class="btn_win01 btn_win">
        <button type="button" onclick="window.close();">창닫기</button>
    </div>

</div>

<?php
include_once(G5_PATH.'/tail.sub.php');