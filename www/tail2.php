</div>

<?if($_list_page){?>
<div id="header" class="headerComponent" data-visit="<?=$data_visit?>" data-sub-visit="<?=$data_sub_visit?>">
    <?include_once(G5_PATH.'/Header.html');?>
</div>
<div id="footer" class="footerComponent"></div>
<?}else{?>
<div id="header" class="headerComponent" data-sub="hide" data-visit="<?=$data_visit?>">
    <?include_once(G5_PATH.'/Header.html');?>
</div>
<div id="footer" class="footerComponent"></div>
<?}?>


<div id="listVideoPopup" class="list--videoPopup">
    <div class="list--videoPopup-bg"></div>
    <div class="list--videoPopup-wrap">
        <div class="list--videoPopup-figure">
            <!--item클릭 시 해당 item의 비디오 아이디값으로 ifram의 아이디값을 변경해주세요. -->
            <iframe id="listVideoPopup_video" width="" height="" src="https://www.youtube.com/embed/{아이디값}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</div>
<?if($_listVideoPopup){?>
<?}?>

<script src="/js/component.js"></script>

<?if(defined('_INDEX_')) { ?>
    <script src="/js/index.js"></script>
<?}?>

<?if($_list_page){?>
    <script src="/js/list.js"></script>
<?}?>


</body>
</html>
<?php echo html_end(); // HTML 마지막 처리 함수 : 반드시 넣어주시기 바랍니다.