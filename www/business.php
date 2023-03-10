<?
include_once('./_common.php');

$data_sub = "show";

$data_visit = "3";

include_once(G5_PATH.'/head2.php');


$sql = " select * from g5_member where mb_level = '3' order by mb_nick asc ";

if(!$is_admin)
{
    $sql = " select * from g5_member where mb_level = '3' and mb_id not in('test','test2','monq') order by mb_nick asc ";
}

// 페이지의 공지개수가 목록수 보다 작을 때만 실행
$result = sql_query($sql);

add_stylesheet('<link rel="stylesheet" href="/css/business.css">', 0);
add_stylesheet('<link rel="stylesheet" href="/css/businesssvg.css">', 0);

?>

<style>
.bs--figure:last-child .bs--schoolList{
    height: max-content;
}

.bs--figure:last-child{
    overflow-y: scroll;
    padding-top:0;
    margin-top:40px;
}

.bs--figure:last-child .bs--schoolList{
    overflow-y: auto;
}



.bs--figure:last-child::-webkit-scrollbar{background-color: #eee;border-radius: 10px;width: 8px;}
.bs--figure:last-child::-webkit-scrollbar-thumb{background-color: #aaa;border-radius: 10px;}

</style>
<script src="https://www.youtube.com/iframe_api">
</script>
<div class="bs--container">
    <div class="public--wrap">
        <div class="public--where">
            <div class="public--where-before">
                <a href="/">Home<span class="material-symbols-outlined">navigate_next</span></a>
            </div>
            <div class="public--where-now">
                <a href="">LINC3.0 사업단</a>
            </div>
        </div>
    </div>
    <div class="public--wrap">
        <div class="bs--title">
            <div class="bs--title-text01">LINC3.0 사업단</div>
            <div class="bs--title-text02">👉 산학연 혁신 생태계를 구축하고 산학연협력 성장모형의 확산을 통해 미래인재를 양성하는 링크3.0 사업단을 소개합니다.</div>
        </div>
        <div class="bs--sortList">
            <!--
                bs--sortList-item 클릭 시 해당 값에 맞는 아이템들이 정렬되도록 부탁드립니다.
                정렬 후 초기 값은 지역 상관 없이 전부 출력되게 부탁드립니다.
                참고 사이트 https://lincthree.nrf.re.kr/#/univ/page/type1
                -->
            <div class="bs--sortList-item on">전체</div>
            <!-- <div class="bs--sortList-item">기술혁신선도형</div> -->
            <div class="bs--sortList-item">수요맞춤성장형</div>
            <div class="bs--sortList-item">협력기반구축형</div>
        </div>
        <div class="bs--contents">
            <div class="bs--figure">
                <div class="bs--map-title">지도의 권역을 클릭하면 <br><b>해당 권역의 대학 목록</b>을 확인할 수 있습니다.</div>
                <div class="bs--map">
                    <div class="bs--map-none">
                        <svg id="mapSvg" class="map--svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 471.55 828.51">
                            <g id="mapNoneG1">
                            <g id="mapNoneG2">
                                <!--
                                        권역별로 클래스를 할당했습니다.(.map--area01, .map--area02 ... .map--area05)
                                    해당 클래스 클릭 시 해당 권역 소속의 단체가 출력되도록 부탁드립니다.
                                -->
                                <!-- done -->
                                <polygon class="cls-1 map--area-svg map--area01" data-map-number="1" points="226.62 188.41 225.9 181.94 210.81 178.59 209.13 174.04 193.08 169 185.64 134.34 198.52 125.66 197.35 115.84 178.71 105.76 171.86 90.81 159.7 89.65 148.71 82.86 133.98 86.14 125.56 69.3 116.66 65.35 109.85 75.36 110.48 82.91 100.31 87.9 97.31 99.38 87.07 110.5 74 115.63 72.94 130.46 65.87 146.53 53.59 146.71 51.05 170.23 63.34 175.51 66.93 189.23 71.12 196.09 68.76 205.43 78.3 220.17 88.36 226.37 87.82 232.04 75.86 229.9 71.99 233.37 75.23 239.77 71.17 241.89 73.29 252.14 81.41 252.84 83.49 256.2 82.36 265.44 86.36 268.91 95.09 265.82 100.31 267.85 99.25 276.33 90.95 278.8 102.16 293.26 118.81 289.51 136.06 283.04 152.83 294.78 159.54 289.51 177.51 270.11 191.17 270.11 196.44 262.92 208.65 252.62 219.2 234.41 219.68 215.24 223.51 203.26 217.91 193.68 226.62 188.41"/>
                                <path class="cls-2 map--area-svgText" data-text="1" d="M129.12,183.76H117.19v-1h11.93Zm-6.29-4.94a6,6,0,0,1-2,1.65,8.54,8.54,0,0,1-2.59.88l-.47-.95a7.41,7.41,0,0,0,2.3-.71,5.46,5.46,0,0,0,1.78-1.35,2.6,2.6,0,0,0,.68-1.71v-.75h1v.75a3.52,3.52,0,0,1-.7,2.19Zm.87,9.69h-1.13v-5h1.13Zm.76-10.18a5.67,5.67,0,0,0,1.79,1.36,7.35,7.35,0,0,0,2.29.71l-.48.95a8.24,8.24,0,0,1-2.58-.89,6,6,0,0,1-2-1.65,3.57,3.57,0,0,1-.75-2.18v-.75h1v.75a2.52,2.52,0,0,0,.73,1.7Z" transform="translate(0 0)"/>
                                <path class="cls-2 map--area-svgText" data-text="1" d="M142.22,186.86h-12v-1h12Zm-1.55-9.43h-7.75V182h-1.16v-5.5h8.91Zm.14,5.06h-9.05v-.94h9.05Zm-4.06,3.79h-1.13V182h1.13Z" transform="translate(0 0)"/>
                                <path class="cls-2 map--area-svgText" data-text="1" d="M143.72,180.61c1.54,0,3,0,4.28-.1s2.57-.17,3.74-.33l.08.84a33.49,33.49,0,0,1-4,.43q-2.1.11-4.47.12l-.16-1Zm6.35-3.45h-5.71v-.94h5.71Zm-3.77,10.4h-1.16v-3.34h1.16Zm8.13.66h-9.29v-1h9.29Zm-6.36-3.77h-1.15v-3.18h1.15Zm2.39-5.87a16.53,16.53,0,0,1-.3,2.21L149,180.7a19.48,19.48,0,0,0,.29-2.15c0-.61.06-1.22.06-1.81v-.52h1.15v.52C150.52,177.33,150.5,177.94,150.46,178.58Zm2.76,4.9H150v-.94h3.18Zm.89,1.84h-1.18v-9.9h1.18Z" transform="translate(0 0)"/>

                                <polygon class="cls-1 map--area-svg map--area02" data-map-number="4" points="240.18 252.07 242.79 238.68 250.6 235.33 262.13 245.01 277.39 237.94 291.15 242.77 294.5 252.07 304.92 252.07 313.48 259.14 323.89 259.14 352.54 271.42 358.87 264.72 355.52 258.4 361.84 252.45 374.12 261.75 395.33 263.98 401.65 258.4 413.56 262.12 425.09 255.05 435.67 246.92 432.88 231.32 419.97 208.69 403.25 191.13 403.25 179.63 391.75 168.61 391.75 159.98 337.13 91.94 326.11 58.4 297.22 0.62 292.51 2.27 290.5 31.39 283.97 32.63 281.68 42.16 273.73 44.28 266.13 52.58 248.83 53.46 231.34 53.82 217.91 50.11 196.73 50.11 187.9 54.17 182.25 52.76 166.36 50.99 158.06 54.7 151.52 51.34 131.04 54.52 127.51 59.47 118.5 62.65 116.66 65.34 125.56 69.3 133.98 86.14 148.71 82.86 159.7 89.65 171.86 90.81 178.71 105.76 197.35 115.84 198.52 125.66 185.64 134.34 193.08 169 209.13 174.04 210.81 178.59 225.9 181.94 226.62 188.41 217.91 193.68 223.51 203.26 219.68 215.24 219.2 234.41 214.88 241.87 221.95 252.07 240.18 252.07"/>
                                <polygon class="cls-1 map--area-svg map--area04" data-map-number="4" points="195.13 430.28 196.43 414.95 183.71 407.78 189.92 380.12 181.22 369.12 165.12 361.79 149.47 339.62 159.58 318.42 169.03 321.68 170.99 314.83 152.83 294.78 136.06 283.04 118.81 289.51 102.16 293.26 96.78 302.82 98.51 312.78 93.49 320.89 88.83 319.95 88.3 305.47 88.3 292.4 83.36 283.92 76.65 282.86 71.52 280.21 67.55 290.62 62.93 290.24 60.75 281.27 53.36 271.88 46.62 277.13 50.51 283.75 43.98 293.81 45.56 301.58 42.39 303.88 39.03 297.52 39.54 285.53 34.07 286.06 24.08 299.58 19.96 310.24 0.59 313.44 3.71 328.78 16.78 327.37 24.55 319.95 29.5 326.66 28.9 335.72 33.51 335.78 35.85 321.71 44.33 322.07 44.33 334.08 50.86 341.36 50.01 345.51 40.44 346.08 40.09 352.09 48.5 356.16 48.5 358.9 42.03 364.63 48.13 376.63 58.03 380.78 58.28 387.06 47.33 389.18 47.33 393.06 57.04 395.18 57.09 399.26 46.33 409.17 47.15 423.08 63.93 429.62 62.93 441.89 67.27 452.58 93.69 440.07 93.04 430.61 102.83 423.11 123.05 423.76 127.29 430.61 140.99 433.55 157.62 428.65 170.34 449.2 188.6 451.16 202.3 441.37 195.13 430.28"/>
                                <polygon class="cls-1 map--area-svg map--area04" data-map-number="4" points="250.43 423.02 257.56 415.93 256.37 404.01 245.47 406.38 233.01 400.44 235.38 383.42 238.16 359.26 229.05 356.49 226.62 348.96 236.57 333.52 250.43 326.39 255.18 319.26 288.84 303.03 294.39 313.32 310.62 306.59 309.04 292.73 327.25 271.88 337.41 264.94 323.89 259.14 313.48 259.14 304.92 252.07 294.5 252.07 291.15 242.77 277.39 237.94 262.13 245.01 250.6 235.33 242.79 238.68 240.18 252.07 221.95 252.07 214.88 241.87 208.65 252.62 196.44 262.92 191.16 270.11 177.51 270.11 159.54 289.51 152.83 294.78 170.99 314.83 169.03 321.68 159.58 318.42 149.47 339.62 165.12 361.79 181.22 369.12 189.92 380.12 183.71 407.78 196.43 414.95 195.13 430.28 202.3 441.37 235.78 446.77 250.43 423.02"/>
                                <path class="cls-2 map--area-svgText" data-text="4" d="M120.15,378H108.22v-.93h11.93Zm-6.3-3.51a4.88,4.88,0,0,1-1.91,1.25,9.72,9.72,0,0,1-2.66.62l-.37-.9a9.85,9.85,0,0,0,2.34-.49,4.64,4.64,0,0,0,1.68-1,1.77,1.77,0,0,0,.62-1.34v-.22h1v.22a2.67,2.67,0,0,1-.7,1.88Zm5.09-1.68h-9.48v-.94h9.48Zm-2.33,6.76a3.72,3.72,0,0,1,1.54.73,1.55,1.55,0,0,1,.54,1.19,1.53,1.53,0,0,1-.54,1.18,3.72,3.72,0,0,1-1.54.73,12.05,12.05,0,0,1-4.86,0,3.7,3.7,0,0,1-1.55-.73,1.53,1.53,0,0,1-.54-1.18,1.55,1.55,0,0,1,.54-1.19,3.7,3.7,0,0,1,1.55-.73A12.05,12.05,0,0,1,116.61,379.57Zm-4.24.77a3,3,0,0,0-1.14.45.81.81,0,0,0-.28,1.11.83.83,0,0,0,.28.28,2.93,2.93,0,0,0,1.14.43,8.54,8.54,0,0,0,1.82.14,8.27,8.27,0,0,0,1.79-.14,3,3,0,0,0,1.15-.43.8.8,0,0,0,.3-1.09.79.79,0,0,0-.3-.3,3.18,3.18,0,0,0-1.15-.45,9,9,0,0,0-1.79-.15,9.27,9.27,0,0,0-1.82.17Zm2.38-8h-1.14v-1.76h1.14Zm0,7.32h-1.14v-2h1.14Zm.68-5.64a5,5,0,0,0,1.68,1,9.77,9.77,0,0,0,2.33.49l-.35.9a9.72,9.72,0,0,1-2.66-.62,4.88,4.88,0,0,1-1.91-1.25,2.66,2.66,0,0,1-.72-1.83v-.22h1v.22a1.78,1.78,0,0,0,.63,1.29Z" transform="translate(0 0)"/>
                                <path class="cls-2 map--area-svgText" data-text="4" d="M125.07,375.53a4.93,4.93,0,0,1-1.29,1.71,5.7,5.7,0,0,1-1.92,1.08l-.56-.88a5.53,5.53,0,0,0,1.7-.93,4.59,4.59,0,0,0,1.17-1.42,3.59,3.59,0,0,0,.41-1.67v-.58h1v.58A5,5,0,0,1,125.07,375.53Zm3.61-2.39h-7.06v-.93h7.06Zm1.43,6a3.42,3.42,0,0,1,1.52.82,1.76,1.76,0,0,1,.53,1.3,1.73,1.73,0,0,1-.53,1.28,3.42,3.42,0,0,1-1.52.82,10,10,0,0,1-4.69,0,3.34,3.34,0,0,1-1.51-.82,1.71,1.71,0,0,1-.53-1.28,1.76,1.76,0,0,1,.53-1.3,3.34,3.34,0,0,1,1.51-.82A10.32,10.32,0,0,1,130.11,379.14ZM126,380a2.44,2.44,0,0,0-1.12.51,1,1,0,0,0,0,1.58,2.72,2.72,0,0,0,1.12.51,8.36,8.36,0,0,0,3.45,0,2.76,2.76,0,0,0,1.13-.51,1,1,0,0,0,0-1.58,2.6,2.6,0,0,0-1.12-.51,8.4,8.4,0,0,0-3.46,0Zm-.29-7.44h-1.17v-2h1.17Zm.4,2.41a4.51,4.51,0,0,0,1.2,1.3,5.56,5.56,0,0,0,1.71.84l-.56.9a6.12,6.12,0,0,1-1.93-1,4.83,4.83,0,0,1-1.32-1.59,4.21,4.21,0,0,1-.47-2v-.58h.94v.58a3,3,0,0,0,.47,1.58Zm5.14.37h-3v-1h3Zm.82,3.23H131v-7.94h1.16Z" transform="translate(0 0)"/>
                                <path class="cls-2 map--area-svgText" data-text="4" d="M134.75,375.81c1.54,0,3-.05,4.28-.1s2.56-.17,3.73-.33l.09.84a35.69,35.69,0,0,1-4,.43c-1.39.07-2.88.11-4.46.11l-.17-.95Zm6.35-3.45h-5.72v-.94h5.72Zm-3.77,10.4h-1.17v-3.35h1.17Zm8.13.66h-9.3v-1h9.3Zm-6.37-3.77H138v-3.18h1.14Zm2.39-5.87a18.15,18.15,0,0,1-.29,2.2l-1.15-.09a19.3,19.3,0,0,0,.29-2.14c0-.61.06-1.22.06-1.82v-.51h1.15v.51c0,.59,0,1.21-.06,1.85Zm2.77,4.9h-3.18v-.94h3.18Zm.88,1.84H144v-9.9h1.17Z" transform="translate(0 0)"/>
                                

                                <!-- done -->
                                <polygon class="cls-1 map--area-svg map--area03" data-map-number="3" points="441.42 538.51 455.39 522.16 456.77 505.28 430.17 501.12 416.23 493.65 399.42 512.19 391.92 510.65 391.92 510.65 391.92 528.38 404.94 534.08 415.94 545.07 435.58 562.99 441.33 559.44 441.42 538.51"/>
                                <polygon class="cls-1 map--area-svg map--area03" data-map-number="3" points="419.74 548.54 415.94 545.07 404.94 534.08 391.92 528.38 391.92 510.65 383.43 508.91 374.41 517.52 356.78 517.93 333.42 518.34 324.81 512.19 308.82 518.34 304.31 512.19 278.07 509.73 280.12 493.65 270.28 476.11 255.93 477.34 237.89 468.73 216.12 472.77 196.95 493.87 189.92 524.87 204.64 548.54 194.46 567.46 194.46 586.6 217.91 606.55 219.77 626.67 236.23 629.2 241.91 622.07 252.6 621.55 252.6 616.25 255.98 607.96 261.92 604.95 263.15 608.06 259.85 613.35 259.65 630.12 277.49 638.53 281.71 630.69 286.94 630.58 290.12 635.69 295.14 633.98 296.4 628.38 300.4 629.19 302.3 637.93 309.36 638.03 312.11 631.02 308.43 626.85 313.22 620.47 320.65 619.56 319.23 612.62 309.27 614.45 307.42 619.56 303.7 617.7 305.22 610.96 315.65 608.03 317.1 601.53 329.01 602.61 338.01 610.65 340.85 606.45 333.66 599.36 333.72 593.1 327.82 589.67 332.96 581.48 337.03 583.16 334.94 588.69 356.05 602.8 368.33 601.94 368.57 606.24 381.03 603.3 379.62 599.36 386.83 594.71 389.15 596.57 386.6 604.7 390.08 609.34 406.74 601.4 409.93 593.23 420.36 589.18 429.94 566.47 435.58 562.99 419.74 548.54"/>
                                <path class="cls-2 map--area-svgText" data-text="3" d="M283.65,558.5H271.71v-.93h11.94Zm-3.57,1.23a3.61,3.61,0,0,1,1.55.81,1.75,1.75,0,0,1,.55,1.27,1.82,1.82,0,0,1-.54,1.28,3.71,3.71,0,0,1-1.55.8,10.2,10.2,0,0,1-4.85,0,3.51,3.51,0,0,1-1.55-.81,1.77,1.77,0,0,1-.05-2.49l.05-.05a3.51,3.51,0,0,1,1.55-.81,10,10,0,0,1,2.43-.27A9.79,9.79,0,0,1,280.08,559.73Zm2.08-7.09h-7.8v3h-1.14v-4h8.94Zm.09,3.4h-9v-.94h9Zm-6.38,4.5a2.87,2.87,0,0,0-1.15.49,1,1,0,0,0,0,1.56,2.83,2.83,0,0,0,1.15.5,8.38,8.38,0,0,0,1.8.17,8.2,8.2,0,0,0,1.78-.17,2.87,2.87,0,0,0,1.16-.5.95.95,0,0,0,0-1.56,2.77,2.77,0,0,0-1.16-.49,8.2,8.2,0,0,0-1.78-.17,8.38,8.38,0,0,0-1.8.17Zm2.36-2.57h-1.12v-2.51h1.12Z" transform="translate(0 0)"/>
                                <path class="cls-2 map--area-svgText" data-text="3" d="M286.54,557h-1.16v-5.23h1.16Zm2.88-.61a25.26,25.26,0,0,0,3-.46l.14,1a26.41,26.41,0,0,1-3.07.45c-1,.08-2,.13-3.1.14h-1v-1h1C287.44,556.52,288.44,556.48,289.42,556.39ZM295,564h-8.29v-4.79H295Zm-7.16-1h6v-2.93h-6Zm7.16-4.5h-1.15v-7.4H295Zm2-3.42h-2.29v-1H297Z" transform="translate(0 0)"/>
                                <path class="cls-2 map--area-svgText" data-text="3" d="M298.24,556.29c1.53,0,3,0,4.28-.1s2.56-.17,3.73-.33l.09.84a33.49,33.49,0,0,1-4,.43q-2.1.11-4.47.12l-.16-1Zm6.34-3.45h-5.71v-.94h5.71Zm-3.77,10.4h-1.16V559.9h1.16Zm8.13.66h-9.29v-1h9.29Zm-6.36-3.77h-1.15V557h1.15Zm2.39-5.87a16.53,16.53,0,0,1-.3,2.21l-1.15-.09a19.48,19.48,0,0,0,.29-2.15c.05-.61.07-1.22.07-1.82v-.51H305v2.36Zm2.77,4.9h-3.19v-.94h3.19Zm.88,1.84h-1.18v-9.9h1.18Z" transform="translate(0 0)"/>

                                <!-- done -->
                                <polygon class="cls-1 map--area-svg map--area05" data-map-number="5" points="47.49 565.02 63.77 562.99 76.39 553.63 76.39 541 89.83 536.11 102.86 553.63 119.14 551.99 123.62 567.46 137.46 567.46 165.15 567.46 175.73 558.1 194.46 567.46 204.64 548.54 189.92 524.87 196.95 493.87 216.12 472.77 237.89 468.73 235.78 446.78 202.3 441.37 188.6 451.16 170.34 449.2 157.62 428.65 140.99 433.55 127.29 430.61 123.05 423.76 102.83 423.11 93.04 430.61 93.7 440.07 67.27 452.58 60.31 461.69 70.57 470.66 76.04 465.66 88.23 463.91 85.71 470.38 76.19 472.57 72.93 477.26 83.15 482.95 82.05 489.57 64.41 493.19 38.42 510.2 43.62 520.44 47.4 517.13 63.15 517.13 68.91 521.5 67.87 527.53 61.41 525.01 41.88 529.26 32.28 541.29 43.82 546.7 47.49 565.02"/>
                                <polygon class="cls-1 map--area-svg map--area05" data-map-number="5" points="217.91 606.55 194.46 586.6 194.46 567.46 175.73 558.1 165.15 567.46 137.46 567.46 123.62 567.46 119.14 551.99 102.86 553.63 89.83 536.11 76.39 541 76.39 553.63 63.77 562.99 47.49 565.02 43.82 546.7 32.28 541.29 32.75 554.4 20.02 570.62 22.35 586.75 35.43 605.34 27.66 625.42 27.08 660.63 47.09 675.68 43.25 695.03 36.87 703.27 36.35 713.39 40.67 717.28 40.58 722.65 38.13 728.14 42.99 732.45 42.66 740.38 54.01 737.65 54.94 727.15 63.12 718.41 75.45 711.24 75.29 700.96 78.59 691.06 83.49 691.06 82.55 701.9 83.48 713.44 98.92 717.65 101.26 706.8 109.3 693.86 117.54 685.21 133.78 677.76 138.34 671.48 136.3 666.79 144.27 662 148.52 665.04 167.96 659.29 168.83 654.02 162.85 652.43 163.84 648.24 177.97 649.28 193.08 635.79 201.94 636.73 219.77 626.67 217.91 606.55"/>
                                <polygon class="cls-1 map--area-svg map--area05" data-map-number="5" points="137.39 772.43 98.42 774.34 79.9 783.6 63.82 783.6 44.21 807.85 57.56 828.01 71.45 828.01 80.17 820.38 102.24 821.2 118.59 814.93 139.29 807.3 151.01 787.69 137.39 772.43"/>
                                <path class="cls-2 map--area-svgText" data-text="5" d="M88.27,618.5h-12v-1h12Zm-.68-8.66H76.87v-1H87.59ZM84.53,611a3.27,3.27,0,0,1,1.5.85,1.91,1.91,0,0,1,.52,1.32,2,2,0,0,1-.52,1.36,3.38,3.38,0,0,1-1.5.86,8,8,0,0,1-2.28.3,7.78,7.78,0,0,1-2.3-.3,3.34,3.34,0,0,1-1.49-.86,1.87,1.87,0,0,1-.51-1.36,1.84,1.84,0,0,1,.51-1.33A3.16,3.16,0,0,1,80,611a9.11,9.11,0,0,1,4.58,0Zm-4,.81a2.49,2.49,0,0,0-1.09.54,1,1,0,0,0-.37.82,1.11,1.11,0,0,0,.37.85,2.79,2.79,0,0,0,1.09.54,7.58,7.58,0,0,0,3.35,0A2.75,2.75,0,0,0,85,614a1.15,1.15,0,0,0,.37-.85,1.09,1.09,0,0,0-.37-.82,2.45,2.45,0,0,0-1.08-.54,7.88,7.88,0,0,0-3.35,0Zm2.24-2.36h-1.1v-2.32h1.14Zm0,8.42h-1.1V615.4h1.14Z" transform="translate(0 0)"/>
                                <path class="cls-2 map--area-svgText" data-text="5" d="M91.11,612.84H90v-5.23h1.16Zm2.89-.61a30.13,30.13,0,0,0,3-.45l.15,1a26.89,26.89,0,0,1-3.08.45c-1,.09-2,.14-3.09.14H90v-1h1c1,0,2,0,3-.14Zm5.56,7.62h-8.3v-4.79h8.3Zm-7.16-.94h6V616h-6Zm7.16-4.57H98.41V607h1.15Zm2-3.41h-2.3v-1h2.28Z" transform="translate(0 0)"/>
                                <path class="cls-2 map--area-svgText" data-text="5" d="M103.19,620.44H102l3.44-12.77h1.16Z" transform="translate(0 0)"/>
                                <path class="cls-2 map--area-svgText" data-text="5" d="M110.65,613.41a8.56,8.56,0,0,1-1.06,2.37,5.47,5.47,0,0,1-1.62,1.63l-.74-.87a5.27,5.27,0,0,0,1.55-1.46,7.21,7.21,0,0,0,1-2.07,8,8,0,0,0,.34-2.33V609H111v1.71A10.26,10.26,0,0,1,110.65,613.41Zm3-4h-6v-1h6Zm-2.06,3.46a6.26,6.26,0,0,0,1,2,4.78,4.78,0,0,0,1.51,1.39l-.7.86a5.25,5.25,0,0,1-1.62-1.56,7.7,7.7,0,0,1-1-2.25,9.23,9.23,0,0,1-.35-2.61V609h.87v1.71a7.36,7.36,0,0,0,.28,2.19Zm3.62-.3h-2.56v-.94h2.56Zm.73,6.75h-1.09V607.26h1.09Zm2.65.68h-1.1V606.9h1.1Z" transform="translate(0 0)"/>
                                <path class="cls-2 map--area-svgText" data-text="5" d="M132.36,615.36H120.43v-1h11.93Zm-6.33-4.5a5.89,5.89,0,0,1-1.91,1.56,8.42,8.42,0,0,1-2.53.86l-.46-.91a7.27,7.27,0,0,0,2.22-.7,5.56,5.56,0,0,0,1.73-1.28,2.44,2.44,0,0,0,.67-1.6v-.56h1v.56a3.25,3.25,0,0,1-.75,2.07Zm5.19-2.16h-9.67v-.94h9.67ZM126.94,620H125.8v-5h1.14Zm.76-9.64a5.73,5.73,0,0,0,1.73,1.28,7.27,7.27,0,0,0,2.22.7l-.43.91a8.38,8.38,0,0,1-2.54-.86,5.89,5.89,0,0,1-1.91-1.56,3.33,3.33,0,0,1-.73-2.07v-.56h1v.56a2.41,2.41,0,0,0,.66,1.63Z" transform="translate(0 0)"/>
                                <path class="cls-2 map--area-svgText" data-text="5" d="M133.92,612.13c1.54,0,3,0,4.28-.1s2.56-.16,3.73-.32l.09.84a35.69,35.69,0,0,1-4,.43c-1.39.07-2.88.11-4.46.11l-.16-1Zm6.35-3.44h-5.72v-1h5.72Zm-3.77,10.4h-1.17v-3.35h1.17Zm8.13.66h-9.3v-1h9.3ZM138.26,616h-1.14v-3.2h1.14Zm2.4-5.87a20.4,20.4,0,0,1-.3,2.2l-1.15-.09a19.48,19.48,0,0,0,.29-2.15c0-.61.06-1.21.06-1.81v-.52h1.15v.52c0,.57,0,1.19-.05,1.83Zm2.76,4.9h-3.18v-1h3.18Zm.88,1.84h-1.17V607h1.17Z" transform="translate(0 0)"/>
                                
                                <!-- done -->
                                <polygon class="cls-1 map--area-svg map--area02" data-map-number="2" points="463.83 436.39 455.83 445.34 448.01 448.33 439.3 439.29 442.85 432.84 442.85 418.96 439.62 412.82 439.95 388.3 445.43 384.42 449.31 357.63 443.5 348.6 443.5 338.59 451.17 328.26 451.17 310.91 445.77 298.08 442.2 272.66 442.65 259.54 436.31 250.54 435.67 246.92 425.09 255.05 413.56 262.12 401.65 258.4 395.33 263.98 374.12 261.75 361.84 252.45 355.52 258.4 358.87 264.72 352.54 271.42 337.41 264.94 327.25 271.88 309.04 292.73 310.62 306.59 294.39 313.32 288.84 303.03 255.18 319.26 250.43 326.39 236.57 333.52 226.62 348.96 229.05 356.49 238.16 359.26 235.38 383.42 233.01 400.44 245.47 406.38 256.37 404.01 257.56 415.93 250.43 423.02 235.78 446.77 237.89 468.73 255.93 477.34 270.28 476.11 280.12 493.65 278.07 509.73 304.31 512.19 308.82 518.34 324.81 512.19 333.42 518.34 356.78 517.93 374.41 517.52 383.43 508.91 399.42 512.19 416.23 493.65 430.17 501.12 456.77 505.29 458.34 486.09 463.81 474.79 464.67 459.57 470.93 438.83 463.83 436.39"/>
                                <path class="cls-2 map--area-svgText" data-text="2" d="M272.11,159h-3.76v6.76H267.2v-7.71h4.91Zm-1.4,6.23a17.35,17.35,0,0,0,2.15-.29l.1,1a16.09,16.09,0,0,1-2.18.3c-.71,0-1.63.08-2.74.08h-.84v-1h.8c1.11,0,2,0,2.71-.07Zm4.17,3.63h-1.06V156.75h1.06Zm2.22-6.19h-2.56v-1h2.56Zm.81,6.87h-1.1v-13.1h1.1Z" transform="translate(0 0)"/>
                                <path class="cls-2 map--area-svgText" data-text="2" d="M285.81,160.46a7,7,0,0,1-2.11,2.32,11.42,11.42,0,0,1-3.28,1.53l-.49-.91a10.68,10.68,0,0,0,2.9-1.31,5.84,5.84,0,0,0,1.85-1.85,4.25,4.25,0,0,0,.64-2.28v-.51h1.24A6.19,6.19,0,0,1,285.81,160.46Zm.29-2h-5.51v-1h5.51Zm2.53,6.35a3.37,3.37,0,0,1,1.52.87,2,2,0,0,1,0,2.68,3.32,3.32,0,0,1-1.52.87,8.87,8.87,0,0,1-4.63,0,3.32,3.32,0,0,1-1.52-.87,2,2,0,0,1,0-2.68,3.37,3.37,0,0,1,1.52-.87A9.08,9.08,0,0,1,288.63,164.81Zm-4,.82a2.53,2.53,0,0,0-1.13.54,1.08,1.08,0,0,0-.16,1.53l.16.16a2.82,2.82,0,0,0,1.13.54,6.55,6.55,0,0,0,1.71.19,6.4,6.4,0,0,0,1.69-.19,2.82,2.82,0,0,0,1.13-.54,1.11,1.11,0,0,0,.13-1.56l-.13-.13a2.53,2.53,0,0,0-1.13-.54,6.4,6.4,0,0,0-1.69-.19,6.72,6.72,0,0,0-1.73.15Zm5-3H286v-.95h3.6Zm.08-2.72h-3.58V159h3.58Zm1,4.49h-1.16v-7.87h1.16Z" transform="translate(0 0)"/>
                                <path class="cls-2 map--area-svgText" data-text="2" d="M293.63,170h-1.15l3.43-12.77h1.17Z" transform="translate(0 0)"/>
                                <path class="cls-2 map--area-svgText" data-text="2" d="M303.76,160.44a7.13,7.13,0,0,1-2.13,2.34,11.23,11.23,0,0,1-3.3,1.56l-.49-.94a11,11,0,0,0,2.91-1.3,6.14,6.14,0,0,0,1.87-1.86,4.35,4.35,0,0,0,.66-2.28v-.53h1.22A6.21,6.21,0,0,1,303.76,160.44Zm.17-2.05h-5.51v-1h5.51Zm2.27,6.38a3.52,3.52,0,0,1,1.49.87,2,2,0,0,1,0,2.71,3.27,3.27,0,0,1-1.49.87,8.5,8.5,0,0,1-4.55,0,3.27,3.27,0,0,1-1.49-.87,2,2,0,0,1,0-2.7,3.41,3.41,0,0,1,1.5-.88,8.74,8.74,0,0,1,4.54,0Zm-3.94.82a2.51,2.51,0,0,0-1.09.55,1.14,1.14,0,0,0,0,1.7,2.53,2.53,0,0,0,1.09.56,6.31,6.31,0,0,0,1.67.2,6.19,6.19,0,0,0,1.66-.2,2.72,2.72,0,0,0,1.11-.56,1.1,1.1,0,0,0,.39-.85,1.15,1.15,0,0,0-.39-.85,2.6,2.6,0,0,0-1.1-.55,7.43,7.43,0,0,0-3.34,0Zm5.81-1.26h-1.15v-7.87h1.15Zm2-3.5h-2.3v-1H310Z" transform="translate(0 0)"/>
                                <path class="cls-2 map--area-svgText" data-text="2" d="M315.44,162.46c1.36-.05,2.65-.15,3.88-.3l.07.84a38.42,38.42,0,0,1-4,.4q-2.08.09-4.44.09l-.16-1C312.54,162.53,314.09,162.51,315.44,162.46Zm1.34-5.18a2.6,2.6,0,0,1,1.15.81,2,2,0,0,1,0,2.4,2.67,2.67,0,0,1-1.14.79,5.35,5.35,0,0,1-3.4,0,2.73,2.73,0,0,1-1.14-.79,1.93,1.93,0,0,1-.4-1.2,2,2,0,0,1,.4-1.2,2.6,2.6,0,0,1,1.15-.81,5.28,5.28,0,0,1,3.38,0Zm-2.94,11.3h-1.17v-3.13h1.17Zm8.15.69h-9.32v-1H322Zm-8-11.22a1.74,1.74,0,0,0-.75.5,1.17,1.17,0,0,0,0,1.48,1.74,1.74,0,0,0,.75.5,3.69,3.69,0,0,0,2.23,0,1.74,1.74,0,0,0,.75-.5,1.13,1.13,0,0,0,0-1.48,1.74,1.74,0,0,0-.75-.5A4,4,0,0,0,314,158.05ZM315.8,166h-1.17v-3h1.17Zm5-.9h-3v-.84h3Zm.85,1.36H320.5v-10h1.16Z" transform="translate(0 0)"/>
                                <path class="cls-2 map--area-svgText" data-text="2" d="M324.36,161.66c1.53,0,3,0,4.28-.1s2.56-.17,3.73-.33l.09.84a33.49,33.49,0,0,1-4,.43q-2.1.1-4.47.12l-.16-1Zm6.35-3.45H325v-.94h5.72Zm-3.78,10.4h-1.16v-3.34h1.16Zm8.14.66h-9.3v-1h9.3Zm-6.37-3.77h-1.15v-3.18h1.15Zm2.39-5.87a16.53,16.53,0,0,1-.3,2.21l-1.14-.09a19.45,19.45,0,0,0,.28-2.15c.05-.61.07-1.22.07-1.81v-.52h1.15v.52c0,.58,0,1.21-.06,1.84Zm2.77,4.9h-3.19v-.94h3.19Zm.88,1.84h-1.18v-9.9h1.18Z" transform="translate(0 0)"/>
                            </g>
                            </g>
                        </svg>
                    </div>
                    <div class="map--area-cover"><img src="/img/jc_all.png" alt=""></div>
                    <!-- 아래의 bs--map-hover 요소는 애니메이션 전용입니다. -->
                    <div class="bs--map-hover">
                        <div class="map--areaHover-svg map--areaHover-svg01" id="mapArea01" data-map-area="1"><img src="img/jc_capital.png" alt=""></div>
                        <div class="map--areaHover-svg map--areaHover-svg04" id="mapArea02" data-map-area="4"><img src="img/jc_choong.png" alt=""></div>
                        <div class="map--areaHover-svg map--areaHover-svg05" id="mapArea03" data-map-area="5"><img src="img/jc_honam.png" alt=""></div>
                        <div class="map--areaHover-svg map--areaHover-svg02" id="mapArea04" data-map-area="2"><img src="img/jc_daekyeong.png" alt=""></div>
                        <div class="map--areaHover-svg map--areaHover-svg03" id="mapArea05" data-map-area="3"><img src="img/jc_dongnam.png" alt=""></div>
                    </div>
                </div>
            </div>
            <div class="bs--figure">
                <div class="bs--schoolList-goBack">
                    <p class="bs--schoolList-goBack-button" id="bsSchoolGoBackButton"><span class="material-symbols-outlined">arrow_back_ios_new</span>권역 선택하기</p>
                </div>
                <div class="bs--schoolList">
                    <?while ($row = sql_fetch_array($result)){?>
                    <div class="bs--schoolItem" data-mb_1="<?=$row["mb_1"]?>" data-mb_2="<?=$row["mb_2"]?>">
                        <!-- <a href="/businessdetail.php?bi=<?=$row["mb_id"]?>" class="bs--schoolItem-thumb"><img src="<?=G5_DATA_URL.'/member_image/'.$row["mb_img"]?>" alt="단체로고"></a> -->
                        <a href="/businessdetail.php?bi=<?=$row["mb_id"]?>" class="bs--schoolItem-thumb bs--schoolItem-thumb2">
                            <div class="bs--schoolItem-thumbImg" style="background-image:url('<?=G5_DATA_URL.'/member_image/'.$row["mb_img"]?>')"></div>
                        </a>
                        <div class="bs--schoolItem-text">
                            <div class="bs--schoolItem-text01"><?=$row["mb_8"]?></div>
                            <div class="bs--schoolItem-text02"><?=$row["mb_1"]?></div>
                        </div>
                    </div>
                    <?}?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/js/bs.js"></script>

<script>

var _sel_mb_1 = "전체";
var _sel_mb_2 = "";

$(".bs--sortList-item").click(function(){
    _sel_mb_1 = $(this).text();
    list_reset();
});

$(".map--area-svg").click(function(){
    var mapNumber = $(this).data("map-number");
    if($(this).hasClass("on")){
        _sel_mb_2 = mapNumber;
    }else{
        _sel_mb_2 = "";
    }

    list_reset();

});

function list_reset(){



    if(_sel_mb_1 == "전체" && _sel_mb_2 == "")
    {
        $(".bs--schoolItem").show();
        return;
    }
    else{
        $(".bs--schoolItem").hide();
    }

    var arr_list = Array();

    arr_list["1"] = "수도권";
    arr_list["2"] = "대경권";
    arr_list["3"] = "동남권";
    arr_list["4"] = "충청/강원권";
    arr_list["5"] = "호남/제주권";

    $('.bs--schoolItem').each(function(index,item){

        if($(item).data("mb_2") == arr_list[_sel_mb_2] || _sel_mb_2 == ""){

            if($(item).data("mb_1") == _sel_mb_1 || _sel_mb_1 == "전체")
            {
                $(item).show();
            }
            else{
                $(item).hide();
            }

        }
    });
}

</script>

<?php
include_once(G5_PATH.'/tail2.php');
?>
