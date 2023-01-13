<?
include_once('./_common.php');

$_list_page = true;
$data_sub = "show";
$_listVideoPopup = true;

include_once(G5_PATH.'/head2.php');


$cnt = sql_fetch("select count(wr_id) as cnt from g5_write_calender where ca_name = '링크 어워드' and wr_3 != '' and wr_id = wr_parent");
$total_cnt = $cnt["cnt"];

?>

        <div class="list-contents">
            <div class="public--wrap">
                <div class="public--where">
                    <div class="public--where-before">
                        <a href="/">Home<span class="material-symbols-outlined">navigate_next</span></a>
                    </div>
                    <div class="public--where-before">
                        <a href="/chlinc3.html">채널 링크3.0<span
                                class="material-symbols-outlined">navigate_next</span></a>
                    </div>
                    <div class="public--where-now">
                        <a href="">링크 어워드</a>
                    </div>
                </div>
            </div>
            <div class="public--wrap">
                <div class="list--bnr">
                    <div class="list--bnr-text">
                        <div class="list--bnr-textBox">
                            <p class="list--bnr-text00 knock">채널 링크3.0</p>
                            <p class="list--bnr-text01">링크 어워드</p>
                            <p class="list--bnr-text02">#LINC3.0 사업 우수 성과자 시상<br>#개인의 경험을 인사이트로<br>#그들이 전해주는 진솔한 이야기</p>
                        </div>
                        <p class="list--bnr-text03">⏰&nbsp;매주 화요일 13:00<br>Youtube/홈페이지에서 만나요!</p>
                    </div>
                    <div class="list--bnr-bg">
                        <div class="list--bnr-bgImg"></div>
                    </div>
                </div>
                <div class="list--sort">
                    <div class="list--sort-option">
                        <!--
                            div.list--sort-optionValue요소기 sorting 옵션값입니다.
                            옵션값은 중복되지 않습니다.
                            최초옵션값은 최신등록 순(첫번째 옵션값)입니다.
                            버튼 클릭 시 페이지 이동 없이 해당 페이지 내에서 아이템 정렬을 부탁드립니다.
                        -->
                        <div class="list--sort-optionValue checked" data-sort="new">
                            <div class="list--sort-optionState">
                                <span class="list--sort-optionValue-off"></span>
                                <span class="list--sort-optionValue-on material-symbols-outlined">done</span>
                            </div>
                            <div class="list--sort-optionName">최신등록 순</div>
                        </div>
                        <div class="list--sort-optionValue" data-sort="old">
                            <div class="list--sort-optionState">
                                <span class="list--sort-optionValue-off"></span>
                                <span class="list--sort-optionValue-on material-symbols-outlined">done</span>
                            </div>
                            <div class="list--sort-optionName">오래된 순</div>
                        </div>
                        <div class="list--sort-optionValue" data-sort="hit">
                            <div class="list--sort-optionState">
                                <span class="list--sort-optionValue-off"></span>
                                <span class="list--sort-optionValue-on material-symbols-outlined">done</span>
                            </div>
                            <div class="list--sort-optionName">조회 순</div>
                        </div>
                    </div>
                    <!-- 
                        sorting 기능 실행 후 정렬된 아이템의 개수를 
                        <b>{여기에 출력되게 부탁드립니다.}</b>
                    -->
                    <div class="list--sort-itemCount">
                        <span>총 <b><?=number_format($total_cnt)?></b>개</span>
                    </div>
                </div>
                <div class="list--container">
                    <div class="list--wrap">
                        <!-- 링크 어워드의 영상아이템이 list--item에 담겨져 출력되게 부탁드립니다. -->
                        
                    </div>
                </div>
            </div>
            <div class="list--viewMore">
                <div id="viewMore" class="list--viewMore-btn">더 보기</div>
            </div>
            <div class="subscribeLincBar">
                <div class="public--wrap">
                    <div class="subscribeLincBar--wrap">
                        <div>
                            <p>링크 TV의 다양한 정보를 즐겨보세요.</p><span>😃</span>
                        </div>
                        <a href="">링크TV 구독하러가기</a>
                    </div>
                </div>
            </div>
        </div>
        <script>

            var _page = 1;
            var _total_cnt = '<?=$total_cnt?>';
            var _ca_name = '링크 어워드';
            var _sort = 'new';
            
            function list_load(reset)
            {
                $.ajax({
                    url: g5_bbs_url+"/ajax.list.php",
                    type: "POST",
                    data: {
                        "page" : _page,
                        "total_count" : _total_cnt,
                        "ca_name" : _ca_name
                    },
                    dataType: "html",
                    async: true,
                    cache: false,
                    success: function(data) {
                        
                        if(data == "")
                        {
                            alert("페이지가 없습니다.");
                        }
            
                        if(reset){
                            $(".list--wrap").html(data);
                        }
                        else{
                            $(".list--wrap").append(data);
                        }
            
                        
            
                    },
                    complete : function(data) {
                        
                    },
                    error : function(xhr, status, error) {
                        alert(error);
                    }
                });
            }
            
            $(document).ready( function() {
                list_load(true);
            } );
            
            $(function() {
                $(document).on("click", ".list--itemThumb-img", function() {
                    var vi_id = $(this).data("vi_id");
                    
                    $("#listVideoPopup_video").attr("src", "https://www.youtube.com/embed/"+vi_id);
            
                    $("#listVideoPopup").addClass('show');
                    
                });
            
                $("#viewMore").click(function() {
                    _page = _page + 1;
                    list_load(false);
                });
            
            
                $(".list--sort-optionValue").click(function(){
                    
                    _sort = $(this).data("sort");
                    _page = 1;
                    list_load(true);
                });
            });
            
            </script>
    </div>
    <div id="header" class="headerComponent" data-visit="1" data-sub-visit="3"></div>
    <div id="footer" class="footerComponent" LINC3.0></div>
    <div id="listVideoPopup" class="list--videoPopup">
        <div class="list--videoPopup-bg"></div>
        <div class="list--videoPopup-wrap">
            <div class="list--videoPopup-figure">
                <!--item클릭 시 해당 item의 비디오 아이디값으로 ifram의 아이디값을 변경해주세요. -->
                <iframe width="" height="" src="https://www.youtube.com/embed/{아이디값}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./js/component.js"></script>
    <script src="./js/list.js"></script>
</body>

</html>