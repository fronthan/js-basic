$(function(){
    //wow 사용
    wow = new WOW(
                  {
                  boxClass:     'wow',      // default
                  animateClass: 'animated', // default
                  offset:       0,          // default
                  mobile:       true,      
                  live:         true        // default
                }
                )
                wow.init();
                
                
     $('#gnb li a').hover(function(){
         $(this).addClass('bounce');
     }, function(){
         $(this).removeClass('bounce');
     });
     
     
     

   $("#navBtn").click(function() {
                    $('html, body').animate({
            scrollTop : 0
        }, 400);
        return false;
     });
     
     var goCookie = $.cookie('goContact');
      $("#goContact").removeClass('on');
      $.cookie('goContact','ok');
     if (goCookie == 'ok') {
         $("#goContact").removeClass('on');             
         $.cookie('goContact','ok');
     } else {
          $("#goContact").addClass('on');
          $.cookie("goContact", null);
     }
     
     $("#goContact .open").click(function() {
         $("#goContact").removeClass('on');             
         $.cookie('goContact','ok');
     });
     $("#goContact .close").click(function() {
         $("#goContact").addClass('on');
         $.cookie('goContact',null);
     });
     
     
     
});




/* ------------------------
    header
--------------------------*/

$(function(){

    $('#goMenu').click(function (){
        $('#subGnb').slideDown();
    });
    
    $('#subClose').click(function (){
        $('#subGnb').slideUp();
    })

});