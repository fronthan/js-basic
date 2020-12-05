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
        <div class="js-slick" id="js_slick">

        </div>
        <div class="daily_detail_box">
            <div class="cont_head">
                <time datatime="2020-01-22" class="date"><i class="icon_clock"><span class="blind">시계 아이콘</span></i><span class="txt"></span></time>
                <div class="li_tit">1월의 생일파티</div>
            </div>
            <div class="cont_body">
                <div class="post_box"></div>
            </div>
            <div class="js-slick_thumb">
                <div class="slick_thumb_wrap" id="js_slick_thumb">

                </div>               
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

let $js_slick = $('#js_slick');
let $js_slick_thumb = $('#js_slick_thumb');
const thumb_wrap = document.getElementById('js_slick_thumb');

const max_daily = $('.neung_daily_wrap .list_item').last().index(); //요소들 최대 갯수
let this_idx = 0; //현재 인덱스
let slick_idx = 0; //썸네일 확인 인덱스

let main_slider, thumb_slider;


function getData(abc) {//데이터 가져오기
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
           const note = data[4];

           setLayer(date, title, hash, imgs, note);        
        }
    });
}

function setLayer(date, title, hash, imgs, note) {//클릭한 레이어의 인덱스에 해당하는 내용 입력
    $layer_box.find('.li_tit').text(title);
    $layer_box.find('.post_box').html(note)
    $layer_box.find('.date .txt').text(date);
    $layer_box.find('.date').attr('datatime', date);

    makeElements(imgs.length); //이미지 박스 갯수 초기화

    $js_slick.find('.img_area').each(function(index){
        $(this).find('img').attr('src', "img/daily/"+imgs[index]+".jpg");
    });
    $js_slick_thumb.find('.img_area').each(function(index){
        $(this).find('img').attr('src', "img/daily/"+imgs[index]+".jpg");
    });

    //slick 초기화
    main_slider = $('#js_slick').slick({
        dots: true,
        slidesToShow: 1,
        arrows: false,
        infinite:false,
        asNavFor: '#js_slick_thumb'
    });
    
    thumb_slider = $('#js_slick_thumb').slick({
        asNavFor: '#js_slick',
        infinite: false,
        arrows:false,
        slidesToShow: 4
    })

    turnArrow();

    $layer_box.addClass('on');
}

function makeElements(cnt) {//이미지 갯수만큼 요소 생성
    let divel, imgel;

    for (i=0; cnt > i; i++) {
        divel = document.createElement('div');
        divel.classList.add('img_area');
        imgel = new Image();
        imgel.src = '';
        divel.appendChild(imgel);
        
        $js_slick.append(divel);
    }
    const copyel = $js_slick.html();
    $js_slick_thumb.append(copyel);
}

function turnArrow() {//처음과 마지막 글일 때 화살표 온오프
    if (max_daily == this_idx ) {
        $('.btn_nextpost').addClass('off');
    } else if (this_idx == 0) {
        $('.btn_prevpost').addClass('off');
    } else {
        $('.btn_nextpost, .btn_prevpost').removeClass('off');
    }
}

function jsSlickDestroy() {//slick 삭제, 초기화
    $layer_box.removeClass('on');
    main_slider.slick('destroy');
    thumb_slider.slick('destroy');

    $js_slick.html('');
    $js_slick_thumb.html('');
}

//썸네일 클릭하면 main-slick 에 active 적용
$(document).on('click', '.js-slick_thumb .img_area', function(e){
    e.stopPropagation();
    const idx = $(this).index();
    $js_slick.slick('slickGoTo',idx);
});


$(document).on('click', '.js-postdetail', function(){//레이어로 자세히 보기 클릭
    this_idx = $(this).closest('.list_item').index();

    $mask.addClass('on');

    getData(this_idx);
}).on('click', '.js-closelayer', function(){//레이어 닫기
    $mask.removeClass('on');         
    
    jsSlickDestroy();
}).on('click', '.js-prevpost', function (){//레이어 왼쪽 화살표 클릭
    jsSlickDestroy();
    
    this_idx--;
    getData(this_idx);
}).on('click', '.js-nextpost', function (){//레이어 우측 화살표 클릭
    jsSlickDestroy();    
    
    this_idx++;       

    getData(this_idx);    
});
</script>

<?php
    include_once('footer.php');
?>