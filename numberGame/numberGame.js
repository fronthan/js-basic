let NBR = 0, game_score = 0;
const btn = document.querySelector('.js-startgame'); //게임시작 버튼
const game_on_box = document.querySelector('.js-game_on'); //게임 박스 전체
const guess_box = document.querySelector('.guess_nbr'); //추측한 
const guess_nbr_box = document.querySelector('.guess_nbr_box');
const cnt = document.querySelector('.nowcount'); //카운트
const user_nbr = document.querySelector('.inp_guessnbr'); // 숫자 입력 인풋
 
document.body.addEventListener('click', clickEvent, true); //클릭이벤트 감지

document.addEventListener('keydown', keyEvent); //인풋 이벤트 감지

///클릭이벤트 모음
function clickEvent(event) {
    event.stopPropagation(); 
    
    var tg = event.target;
    var clicked = tg.classList;
    
    if ( clicked.contains("js-startgame") ) {  
        if ( tg.textContent == 'Restart' ) {
            const reset = confirm("게임을 다시 시작할까요?");
            if( reset == false ) {
                init();
                gameOn('off');
                return;
            }
            gameOn();
        }
        gameOn();
    }
    
    if ( clicked.contains('guess_nbr') ) {
        guessNbr();
    }
    if ( clicked.contains('guess_go') ) {
        guessNbr();
    }
}

//엔터 이벤트
function keyEvent(ev) {
    if (ev.keyCode === 13) {
        guessNbr();
    }
}



// 0. 초기화
function init() {
    NBR = randomNumber();
}
// 1.랜덤 숫자 생성
function randomNumber() {
    return Math.floor(Math.random() * 100);
}

// 2. 게임 시작 누를 때 화면 정리
function gameOn(off) {
    if ( !off ) {//처음 시작할 때
        btn.textContent = 'Restart';
        game_on_box.style.display = "block";
        cnt.classList.add('on');
    } else {//다시 시작할 때
        btn.textContent = '게임 시작!';
        game_on_box.style.display = "none";
        cnt.classList.remove('on');
        guess_nbr_box.classList.remove('on');
    }
    init();
    initHtml();        
}



//결과 표시
function guessNbr() {    
    const user_value = user_nbr.value;

    //입력값 제한 ~
    if ( user_value < 0 || user_value > 100 ) {
        alert('0에서 100 사이의 숫자만 입력하세요');
        user_nbr.value = '';
        return;
    }
    if ( user_value == false ) {
        alert('숫자를 입력하세요');
        return;
    }
    // ~ 입력값 제한


    //처음 추측일때
    if (game_score == 0) {
        guess_nbr_box.classList.add('on');
    }

    if ( game_score == 10 ) {
        gameReset();
        return;  
    }
    let cnt_txt = cnt.querySelector('.txt');
    cnt_txt.textContent = ++game_score;

    const result = NBR == user_value;
    let resultText, resultCls;
    if ( result == true ) { //맞았을 때
        resultText = '정답 !!';
        alert('ㅊㅋㅊㅋ You win!');
        const question = confirm('do you want to restart the game?');
        
    } else { //틀리면
        resultText = NBR > user_value ? '입력한 값보다 커요' :'입력한 값보다 작아요';
        resultCls = NBR > user_value ? 'high' : 'low';
    }

    createLi(resultText,resultCls,user_value);
    user_nbr.value = "";       
}

//입력한 값 li 태그 만들어서 보이기
function createLi(txt,cls,nbr) {
    const li_once = document.createElement('li');
    li_once.classList.add(cls);
    li_once.textContent = txt + " " +nbr;
    guess_box.append(li_once);
}


//html 정리
function initHtml() {
    cnt.querySelector('.txt').textContent = '0';
    game_score = 0;

    while ( guess_box.hasChildNodes() ) {
        guess_box.removeChild( guess_box.firstChild );
    }

    user_nbr.value = '';
}

//졌을 때 게임 다시 시작
function gameReset() {
    var qa = confirm('you lose. game again?');
    if ( qa ) {
        init();        
        document.querySelector('.guess_nbr_box').classList.remove('on');
        initHtml();
        return;
    }
}