<?php
//////////////////////////////////////////////////////////////////////
////////////////////////////// SEO 시작 //////////////////////////////
//////////////////////////////////////////////////////////////////////
// 제작회사
$seo_Author = "Corp Slash";
$seo_Publisher  = "Corp Slash";

// 웹사이트 타이틀
$seo_head_title = "일반대 채널 링크3.0";

// 브라우저 테마 색상
$seo_theme_color = "#0246ff";

// 주 언어 ex: kr
$seo_language = "kr";

// 로케일 ex: ko_KR , en_EN
$seo_locale = "ko_KR";

// 웹사이트 종류
$seo_type = "website";

// 대표 도메인
$secure_connection = !empty($_SERVER['HTTPS']); // https 확인
if ($secure_connection == true ) {
    $seo_domain_addr = "https://univ.ch-linc.or.kr";
} else {
    $seo_domain_addr = "http://". $_SERVER['SERVER_NAME'];
}

// 웹사이트 설명 (서술형 : 80자 이내)
$seo_descriptionS = "링크3.0의 성과를 한눈에 볼 수 있는 채널 링크3.0으로 여러분을 초대합니다.";

// 웹사이트 설명 (서술형 : 가능한 많이)
$seo_descriptionL = "링크3.0의 성과를 한눈에 볼 수 있는 채널 링크3.0으로 여러분을 초대합니다. 똑똑 위클리, 링크 어워드, 링크 컴퍼니로 링크와 함께 하세요";

// 키워드 (단어형 : 가능한 많이)  예) 프로그램개발,디자인
$seo_keywords = "채널 링크3.0, LINC3.0, 채널 링크3.0일반대, 링크3.0일반대, LINC3.0일반대, 일반대 링크사업단, 링크 사업, 링크플러스, LINC+, 링크 티비, 일반대 산학협력단, 산학연협력, 산학연계, 산학협력지원사업,  똑똑위클리, 링크어워드, 링크컴퍼니";

$seo_image = $seo_domain_addr ."/og.png"; // ex: /img/logo_social.png
$seo_image_width  = "800"; // ex: 200
$seo_image_height = "800"; // ex: 150

$seo_og_image = $seo_domain_addr ."/img/logo_social_og.png"; // ex: /img/logo_social_og.png
$seo_og_image_width  = ""; // ex: 1200
$seo_og_image_height = ""; // ex: 630

$seo_twitter_image = $seo_domain_addr ."/img/logo_social_twitter.png"; // ex: /img/logo_social_twitter.png
$seo_twitter_image_width  = ""; // ex: 800
$seo_twitter_image_height = ""; // ex: 418

// 페이스북 아이디
$seo_facebook = "";

// 트위터 아이디
$seo_twitter = "";

// Naver naver-site-verification 값
$naver_site_verification = "d38000b55aefad46ff1882ce79e3840ba05af3cd";

// Naver 아이디
$seo_naver = "";

// Naver 스마트팜 아이디
$seo_naver_storefarm = "";


// 제작회사
if ($config['cf_title']) $seo_Author = "{$config['cf_title']}";
if ($config['cf_title']) $seo_Publisher  = "{$config['cf_title']}";

// 웹사이트 타이틀
if ($config['cf_title']) $seo_head_title = "{$config['cf_title']}";

$gnu_seo_Publisher  = "{$seo_Author}";
$gnu_seo_Author     = ($wr_id) ? $write['wr_name'] : $seo_Publisher;
$gnu_seo_head_title = $g5_head_title;

if ($gnu_seo_Publisher) $seo_Publisher = $gnu_seo_Publisher;
if ($gnu_seo_Author) $seo_Author = $gnu_seo_Author;
if ($gnu_seo_head_title) $seo_head_title = $gnu_seo_head_title;

// 오늘 날짜
$seo_datetime = date("Y-m-d");

if ($bo_table) {
    if ($wr_id) {
        $seo_qry = sql_query(" select * from {$g5['write_prefix']}{$bo_table} where wr_id='{$wr_id}' ");
        $seo_row = sql_fetch_array($seo_qry);

        $seo_wr_datetime = $seo_row['wr_datetime'];
        if(strpos($seo_row['wr_option'], "secret") !== false) {
            $seo_descriptionL = $g5_head_title;
            $seo_descriptionS = $g5_head_title;
            $seo_keywords     = $g5_head_title;
        } else {
            $seo_description = str_replace('<br />', ' ', $seo_row['wr_content']); // &nbsp; 를 공백으로 교체하기
            $seo_description = str_replace('<br>', ' ', $seo_description); // &nbsp; 를 공백으로 교체하기
            $seo_description = str_replace('"', ' ', $seo_description); // " 를 공백으로 교체하기
            $seo_description = str_replace('&nbsp;', ' ', $seo_description); // &nbsp; 를 공백으로 교체하기
            $seo_description = preg_replace('/[\x00-\x1F\x7F]/', '', $seo_description); // 이상한 특수문자를 제어하는 코드 추가
            //$seo_keywords     = strip_tags($seo_description).", ".$seo_keywords;
            $seo_keywords = $seo_descriptionS .",". cut_str(strip_tags($seo_description),80);
            //$seo_descriptionL = strip_tags($seo_description) .", ". $seo_descriptionL;
            $seo_descriptionL = cut_str(strip_tags($seo_description),200);
            //$seo_descriptionS = cut_str(strip_tags($seo_description),80) .", ". $seo_descriptionS;
            $seo_descriptionS = cut_str(strip_tags($seo_description),80) .", ". $seo_descriptionS;
            $gnu_seo_datetime     = substr($seo_row['wr_datetime'],0,10);
            if ($seo_row['wr_last'] > $seo_row['wr_datetime']) {
                $gnu_seo_datetime = substr($seo_row['wr_last'],0,10);
            } else {
                $gnu_seo_datetime = substr($seo_row['wr_datetime'],0,10);
            }
        }

        // 썸네일 or 로고경로 (최소 200 x 200픽셀)
        include_once(G5_LIB_PATH.'/thumbnail.lib.php');
        $seo_thumb = get_list_thumbnail($bo_table, $wr_id, $board['bo_gallery_width'], $board['bo_gallery_height'], false, true);

        if($seo_thumb['src']) {
            $seo_image        = $seo_thumb['src'];
            $seo_image_width  = $board['bo_gallery_width'];
            $seo_image_height = $board['bo_gallery_height'];
        } /*else {
            if (preg_match("/<img.*src=\\\"(.*)\\\"/iUs", stripslashes($seo_row['wr_content']), $seo_tmp)) { // 에디터 이미지추출
                $seo_file = str_replace(G5_BBS_URL, "..",$seo_tmp[1]); // 파일명
                if (is_file($seo_file)) {
                    $seo_thumb = thumbnail($seo_file, $board['bo_gallery_width'], $board['bo_gallery_height'], 0, 1, 90, 0, "",  99, $noimg); // 에디터 썸네일
                    $seo_image        = $seo_thumb['src'];
                    $seo_image_width  = $board['bo_gallery_width'];
                    $seo_image_height = $board['bo_gallery_height'];
                }
            }
        }*/
    } else {
        if ($g5_head_title) {
            $seo_descriptionL = $g5_head_title.", ".$seo_descriptionL;
            $seo_descriptionS = $g5_head_title.", ".$seo_descriptionS;
            $seo_keywords = $g5_head_title.", ".$seo_keywords;
        }
    }
}

if ($gnu_seo_datetime) $seo_datetime = $gnu_seo_datetime;

// 사이트 언어
echo "<meta http-equiv=\"content-language\" content=\"{$seo_language}\">\r\n";

// 대표도메인 (선호 URL)
echo "<link rel=\"canonical\" href=\"{$seo_domain_addr}\">\r\n";

// 만든사람
echo "<meta name=\"Author\" contents=\"{$seo_Author}\">\r\n";
echo "<meta name=\"Publisher\" content=\"{$seo_Author}\">\r\n";
echo "<meta name=\"Other Agent\" content=\"{$seo_Author}\">\r\n";
echo "<meta name=\"copyright\" content=\"{$seo_Author}\">\r\n";

//  제작일 예) 2017-03-29
echo "<meta name=\"Author-Date\" content=\"{$seo_datetime}\" scheme=\"YYYY-MM-DD\">\r\n";
echo "<meta name=\"Date\" content=\"{$seo_datetime}\" scheme=\"YYYY-MM-DD\">\r\n";

// 사이트 제목
echo "<meta name=\"subject\" content=\"{$seo_head_title}\">\r\n";
echo "<meta name=\"title\" content=\"{$seo_head_title}\">\r\n";

// 설명
echo "<meta name=\"Distribution\" content=\"{$seo_descriptionS}\">\r\n";
echo "<meta name=\"description\" content=\"{$seo_descriptionS}\">\r\n";
echo "<meta name=\"Descript-xion\" content=\"{$seo_descriptionL}\">\r\n";

// 키워드
echo "<meta name=\"keywords\" content=\"{$seo_keywords}\">\r\n";

// 소셜 검색
echo "<meta itemprop=\"name\" content=\"{$seo_head_title}\">\r\n";
echo "<meta itemprop=\"description\" content=\"{$seo_descriptionS}\">\r\n";
if ($seo_image) echo "<meta itemprop=\"image\" content=\"{$seo_image}\">\r\n";

// Open Graph: 네임스페이스가 지정된 meta 태그를 사용하여 메타데이터
echo "<meta property=\"og:locale\" content=\"{$seo_locale}\">\r\n"; // ko_KR
echo "<meta property=\"og:locale:alternate\" content=\"{$seo_locale}\">\r\n";
echo "<meta property=\"og:author\" content=\"{$seo_Author}\">\r\n";
echo "<meta property=\"og:type\" content=\"website\">\r\n";
echo "<meta property=\"og:site_name\" content=\"{$seo_head_title}\">\r\n";
echo "<meta property=\"og:title\" id=\"ogtitle\" itemprop=\"name\" content=\"{$seo_head_title}\">\r\n";
echo "<meta property=\"og:description\" id=\"ogdesc\" content=\"{$seo_descriptionS}\">\r\n";
echo "<meta property=\"og:url\" content=\"{$seo_domain_addr}{$_SERVER['REQUEST_URI']}\">\r\n";
if ($seo_og_image) echo "<meta property=\"og:image\" id=\"ogimg\" content=\"{$seo_og_image}\">\r\n";
if ($seo_og_image_width) echo "<meta property=\"og:image:width\" content=\"{$seo_og_image_width}\">\r\n";
if ($seo_og_image_height) echoecho "<meta property=\"og:image:height\" content=\"{$seo_og_image_height}\">\r\n";
if ($wr_id) echo "<meta property=\"og:updated_time\" content=\"".substr($seo_wr_datetime,0,10)."T".substr($seo_wr_datetime,11,18)."+09:00\">\r\n";

// iOS
echo "<meta name=\"apple-mobile-web-app-title\" content=\"{$seo_head_title}\">\r\n";
echo "<meta name=\"format-detection\" content=\"telephone=no\">\r\n";

// Android
if ($seo_theme_color) echo "<meta name=\"theme-color\" content=\"{$seo_theme_color}\">\r\n";

// twitter
if ($seo_twitter) echo "<meta name=\"twitter:site\" content=\"@{$seo_twitter}\">\r\n";
if ($seo_twitter) echo "<meta name=\"twitter:creator\" content=\"@{$seo_twitter}\">\r\n";
echo "<meta name=\"twitter:title\" content=\"{$seo_head_title}\">\r\n";
echo "<meta name=\"twitter:description\" content=\"{$seo_descriptionS}\">\r\n";
echo "<meta name=\"twitter:domain\" content=\"{$seo_domain_addr}\">\r\n";
echo "<meta name=\"twitter:url\" content=\"{$seo_domain_addr}{$_SERVER['REQUEST_URI']}\">\r\n";
if ($seo_twitter_image) echo "<meta name=\"twitter:image\" content=\"{$seo_twitter_image}\">\r\n";
if ($seo_twitter_image_width) echo "<meta name=\"twitter:image:width\" content=\"{$seo_twitter_image_width}\">\r\n";
if ($seo_twitter_image_height) echo "<meta name=\"twitter:image:height\" content=\"{$seo_twitter_image_height}\">\r\n";
echo "<meta name=\"twitter:card\" content=\"summary\">\r\n"; // summary, photo, player , 신청: https://cards-dev.twitter.com/validator

// Naver
if ($naver_site_verification) echo "<meta name=\"naver-site-verification\" content=\"{$naver_site_verification}\">\r\n";

// 사이트 연관 채널
echo "<span itemscope=\"\" itemtype=\"http://schema.org/Organization\">\r\n";
echo "<link itemprop=\"url\" href=\"{$seo_domain_addr}\">\r\n";
if ($seo_facebook) echo "<a itemprop=\"sameAs\" href=\"https://www.facebook.com/{$seo_facebook}\"></a>\r\n";
if ($seo_twitter) echo "<a itemprop=\"sameAs\" href=\"https://twitter.com/{$seo_twitter}\"></a>\r\n";
if ($seo_naver) echo "<a itemprop=\"sameAs\" href=\"http://blog.naver.com/{$seo_naver}\"></a>\r\n";
if ($seo_naver_storefarm) echo "<a itemprop=\"sameAs\" href=\"http://storefarm.naver.com/{$seo_naver_storefarm}\"></a>\r\n";
echo "</span>\r\n";

// Windows용 타일 아이콘
if ($seo_theme_color) echo "<meta name=\"msapplication-TileColor\" content=\"{$seo_theme_color}\">\r\n";

echo "\r\n";

// 검색로봇 robots.txt
echo "<meta name=\"referrer\" content=\"no-referrer-when-downgrade\">\r\n";
echo "<meta name=\"robots\" content=\"all\">\r\n";
echo "\r\n";

?>
