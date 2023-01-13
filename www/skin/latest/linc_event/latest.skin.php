<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);
$thumb_width = 414;
$thumb_height = 184;
$list_count = (is_array($list) && $list) ? count($list) : 0;
?>


    <?php
    for ($i=0; $i<$list_count; $i++) {

        $img_link_html = '';

        $wr_href = get_pretty_url($bo_table, $list[$i]['wr_id']);

        $board_file_path = G5_DATA_PATH . '/file/' . $bo_table;
        $board_file_url = G5_DATA_URL . '/file/' . $bo_table;

        $list[$i]['file'] = get_file($bo_table, $list[$i]['wr_id']);
        $thumb2_src = $board_file_url . "/" . thumbnail($list[$i]['file'][1]['file'], $board_file_path, $board_file_path, $thumb_width,$thumb_height, false,true);

        if( $i === 0 ) {
            $thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, $thumb_height, false, true);

            if($thumb['src']) {
                $img = $thumb['src'];
            } else {
                $img = G5_IMG_URL.'/no_img.png';
                $thumb['alt'] = '이미지가 없습니다.';
            }
            $img_content = '<img src="'.$img.'" alt="'.$thumb['alt'].'" >';
            $img_link_html = '<a href="'.$wr_href.'" class="lt_img" >'.run_replace('thumb_image_tag', $img_content, $thumb).'</a>';
        }
    ?>

        <div class="swiper-slide">
            <div class="mainEventSwiper--text">
                <p><a href="<?php echo $wr_href; ?>" class="pic_li_tit"><?php echo $list[$i]['subject']; ?></a></p>
            </div>
            <div class="mainEventSwiper--img">
                <img src="<?php echo $thumb2_src; ?>" alt="">
            </div>
        </div>


    <?php }  ?>
    <?php if ($list_count == 0) { //게시물이 없을 때  ?>
      <div class="swiper-slide">
          <div class="mainEventSwiper--text">
              <!--이벤트02콘텐츠의 입력값중 이벤트02제 반영됩니다.-->
              <p>이벤트 준비중입니다.</p>
          </div>
          <div class="mainEventSwiper--img">
              <!--이벤트02콘텐츠의 이미지가 반영됩니다.-->
              <img src="./img/main_event01.png" alt="">
          </div>
      </div>
    <?php }  ?>
