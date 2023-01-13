<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$sub_menu = '500100';
require_once './_common.php';
require_once G5_LIB_PATH.'/PHPExcel.php';

auth_check_menu($auth, $sub_menu, "r");

$g5['title'] = '통신데이터 송수신 정확도';

$sel_field = (isset($_GET['sel_field']) && in_array($_GET['sel_field'], array('1', '2', '3', '4', '5', '6')) ) ? $_GET['sel_field'] : ''; 
$fr_date = (isset($_GET['fr_date']) && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_GET['fr_date'])) ? $_GET['fr_date'] : '';
$to_date = (isset($_GET['to_date']) && preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_GET['to_date'])) ? $_GET['to_date'] : '';

if ($sel_field == "")  $sel_field = "1";

$sql_search = "";

if ($fr_date && $to_date) {
    $where[] = " vi_date between '$fr_date' and '$to_date' ";
}

if ($where) {
    $sql_search = ' where '.implode(' and ', $where);
}

if ($sort1 == "") $sort1 = "vi_id";
if ($sort2 == "") $sort2 = "desc";

$sql_common = " from g5_data_".$sel_field." ".$sql_search;

$sql  = " select *
           $sql_common
           order by $sort1 $sort2 ";
$result = sql_query($sql);

$fileName = 'excel_stats01';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Me")->setLastModifiedBy("Me")->setTitle("My Excel Sheet")->setSubject("My Excel Sheet")->setDescription("Excel Sheet")->setKeywords("Excel Sheet")->setCategory("Me");

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Add column headers
$objPHPExcel->getActiveSheet()
    ->setCellValue('A1', '시리얼번호')
    ->setCellValue('B1', '전송시간(센서)')
    ->setCellValue('C1', '송신값(센서)')
    ->setCellValue('D1', '수신시간(DAQ)')
    ->setCellValue('E1', '수신값')
    ->setCellValue('F1', '수신시간(서버)')
    ->setCellValue('G1', '수신값')
;

$num = 1;
for ($i=0;$row=sql_fetch_array($result);$i++) {
    $num = $num + 1;
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$num, $row['vi_code']);
    $objPHPExcel->getActiveSheet()->setCellValue('B'.$num, $row['vi_s_datetime']);
    $objPHPExcel->getActiveSheet()->setCellValue('C'.$num, $row['vi_s_val']);
    $objPHPExcel->getActiveSheet()->setCellValue('D'.$num, $row['vi_d_datetime']);
    $objPHPExcel->getActiveSheet()->setCellValue('E'.$num, $row['vi_d_val']);
    $objPHPExcel->getActiveSheet()->setCellValue('F'.$num, $row['vi_date']." ".$row['vi_time']);
    $objPHPExcel->getActiveSheet()->setCellValue('G'.$num, $row['vi_val']);
}

// Set worksheet title
$objPHPExcel->getActiveSheet()->setTitle($fileName);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$fileName.'.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');

//save the file to the server (Excel2007)
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$objWriter->save('.\\' . $fileName . '.xlsx'); // 저장될 파일 위치


?>

