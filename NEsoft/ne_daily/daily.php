<?php
    include_once('head.php');
    include_once('header.php');
    include_once('daily_arrays.php'); 

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
                <time datatime="2020-01-22" class="date"><i class="icon_clock"><span class="blind">시계 아이콘</span></i><span class="txt"></span></time>
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
const $mask = $('.mask');
const $layer_box = $('.layer_box');

let item_idx = 0;

function getData(abc) {
    $.ajax({
        type : "post",
        url : "./daily_data.php", 
        data :  {
            "idx" : abc        
        },     
        dataType:"json",
        success : function(data) {
           const date = data[0];
           const title = data[1];
           const hash = data[2];
           let imgs = data[3];

           setLayer(date, title, hash, imgs);           
        }
    });
}

      
       
        
        /* --------------------
        * Slick.js 셋팅
        ---------------------- */
        let slick_idx = 0;
        let thumb_box = $('.js-slick_thumb .img_area');
        const $js_slick = $('.js-slick');
        
        function setLayer(date, title, hash, imgs) {//클릭한 레이어의 인덱스에 해당하는 내용 입력
            $layer_box.find('.li_tit').text(title);
            //$layer_box.find('.post_box').text()
            $layer_box.find('.date .txt').text(date);
            $layer_box.find('.date').attr('datatime', date);
            $js_slick.find('.img_area').each(function(index){
                $(this).find('img').attr('src', "img/daily/"+imgs[index]+".jpg");
            });
            thumb_box.each(function(index){
                $(this).find('img').attr('src', "img/daily/"+imgs[index]+".jpg");
            });
        }

    
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
            const this_idx = $(this).closest('.list_item').index();

            $mask.addClass('on');
            getData(this_idx);
            
            jsSlickInit();
        }).on('click', '.js-closelayer', function(){//레이어 닫기
            $mask.removeClass('on');         
            jsSlickDestroy();
        }).on('click', '.js-prevpost', function (){
            jsSlickDestroy();

          //  ++item_idx;
            

                        
        }).on('click', '.js-nextpost', function (){
            $layer_box.removeClass('on');
            
            

        });
</script>
<?php
    include_once('footer.php');
?>