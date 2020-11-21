<?php
    include_once('head.php');
    include_once('header.php');

    $post_tit = ['1월의 생일파티', '조개가득', '소래회어시장', '어울더울','매드포갈릭','아이사구아','타르타르','카페 봄'];
    $post_hash = ['#베라와 함께','#이사 #연초 #보너스','#방어회 #연말','#꽃등심 #A+등급','#마늘맛 #사당', '#테라스카페 #자연전망 #고양시','#홍대 타르트 맛집','#갤러리카페 #과천'];
    $post_img = [
        ['img_200122', 'img_200122_2', 'img_200105'],
        ['img_200102_1', 'img_200102_1', 'img_200102_2'],
        ['img_191206_1', 'img_191206_2','img_191206_3'],
        ['img_191122_1','img_191122_2','img_191122_3','img_191122_4'],
        ['img_191017_3','img_191017_1','img_191017_2'],
        ['img_190718_3','img_190718','img_190718_2','img_190718_4'],
        ['img_190712_1', 'img_190712_2'],
        ['img_190702_2','img_190702_1','img_190702_3','img_190702_4']   
    
    ];

    $post_date = ['20.01.22','20.01.02','19.12.06','19.11.22','19.10.17','19.07.18','19.07.12','19.07.02'];
?>
<link rel="stylesheet" href="css/slick.css">
<div class="ne_daily">
    <h2 class="haze">능이소프트 > 능이의 일상</h2>
    <div class="neung_daily_cont">
        <h3 class="page_tit">능이의 일상</h3>
        <div class="neung_daily_wrap">
            <ol class="list">
            
            <?php
            for ($i=0; $i<count($post_tit); $i++){
             ?>
            <li class="list_item">
                <span class="main_img"><img src="img/daily/<?=$post_img[$i][0]?>.jpg" alt=""></span>
                <div class="cont_area">
                    <div class="li_tit"><?=$post_tit[$i]?></div>
                    <div class="li_hash"><?=$post_hash[$i]?></div>
                    <div class="cont_tail">
                        <span class="btn_detail js-postdetail">MORE</span>
                        <time datatime="<?=$post_date[$i]?>" class="date"><i class="icon_clock"><span class="blind">시계 아이콘</span></i><?=$post_date[$i]?></time>
                    </div>
                </div>
            </li>
            <?php
            }
            ?>
            </ol>
        </div>
    </div>
</div>

<div class="mask">
    <i class="btn_closepop js-closelayer">
        <span class="blind">레이어 팝업 닫기</span>
    </i>
</div>
<div class="layer_box">
    <div class="post_wrap">
        <div class="js-slick">
            <div class="img_area"><img src="img/daily/.jpg" alt=""/></div>
            <div class="img_area"><img src="img/daily/.jpg" alt=""/></div>
            <div class="img_area"><img src="img/daily/.jpg" alt=""/></div>
        </div>
        <div class="daily_detail_box">
            <div class="cont_head">
                <time datatime="2020-01-22" class="date"><i class="icon_clock"><span class="blind">시계 아이콘</span></i>20.01.22</time>
                <div class="li_tit">1월의 생일파티</div>
            </div>
            <div class="cont_body">
                <div class="post_box">가나다라</div>
            </div>
            <div class="js-slick_thumb">
                <div class="img_area"><img src="img/daily/img_200122.jpg" alt=""/></div>
                <div class="img_area"><img src="img/daily/img_200122_2.jpg" alt=""/></div>
                <div class="img_area"><img src="img/daily/img_200105.jpg" alt=""/></div>
            </div>
        </div>
    </div>
    <i class="btn_prevpost js-prevpost"><span class="blind">이전 게시물</span></i>
    <i class="btn_nextpost js-nextpost"><span class="blind">다음 게시물</span></i>
</div>
<script src="js/slick.min.js"></script>
<script>    
    $(document).ready(function(){
        const $mask = $('.mask');
        const $layer_box = $('.layer_box');
        let item_idx = 0;
        
        /* --------------------
        * Slick.js 셋팅
        ---------------------- */
        let slick_idx = 0;
        let thumb_box = $('.js-slick_thumb .img_area');
        const $js_slick = $('.js-slick');
        
    
        function jsSlickInit() {//slick 초기화        
            $js_slick.slick({
                dots: true,
                slidesToShow: 1,
                slidesToScroll:1,
                arrows: false,
                infinite:false
            });
            $layer_box.addClass('on');
        }
        function jsSlickDestroy() {//slick 삭제
            $layer_box.removeClass('on');
            $js_slick.slick('destroy');
        }

        //sync from slick index
        $js_slick.on('afterChange', function(event, slick, currentSlide) {
            thumb_box.removeClass('active');
            slick_idx = currentSlide;
            thumb_box.eq(slick_idx).addClass('active');
        });

        //썸네일 클릭하면 slick에 index 적용
        $(document).on('click', '.js-slick_thumb .img_area', function(e){
            e.stopPropagation();
            const idx = $(this).index();
            $js_slick.slick('slickGoTo',idx);
        });

        /* ----------------------
         * slick이외 일반 클릭 이벤트 모음 
         *---------------------- */
        $(document).on('click', '.js-postdetail', function(){//레이어로 자세히 보기 클릭
            item_idx = $(this).closest('.list_item').index();

            $mask.addClass('on');

            setIndexArray(item_idx);
            jsSlickInit();
        }).on('click', '.js-closelayer', function(){//레이어 닫기
            $mask.removeClass('on');         
            jsSlickDestroy();
        }).on('click', '.js-prevpost', function (){
            jsSlickDestroy();

            ++item_idx;
            



            

                        
        }).on('click', '.js-nextpost', function (){
            $layer_box.removeClass('on');
            
            

        });

        function setIndexArray(idx) {
            //alert(idx);
            const title = <?=$post_tit['?>idx<?=']?>;
           
            // const li_title = document.querySelector('.daily_detail_box .li_tit');
            // li_title.textContent = ;
  


        }

        
    });   
</script>
<?php
    include_once('footer.php');
?>