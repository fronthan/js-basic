const custom_name = document.getElementById('customname');
const randomize = document.querySelector('.randomize');
const story = document.querySelector('.story');

/**
 * 이벤트 리스너 
 */
randomize.addEventListener('click', init);
document.addEventListener('keypress', enterChk);


function randomValueFromArray(array){//아무 이야기 선택
  const random = Math.floor(Math.random()*array.length);
  return array[random];
}

//기본 이야기
const story_text = 'It was 94 fahrenheit outside, so :insertx: went for a walk. When they got to :inserty:, they stared in horror for a few moments, then :insertz:. Bob saw the whole thing, but was not surprised — :insertx: weighs 300 pounds, and it was a hot day.';

let insertX = ['고블린', '큰아빠', '산타클로스'];
let insertY = ['키친','디즈니랜드','백악관'];
let insertZ = ['자발적으로','물웅덩이 근처를','기어간다'];

let new_story;


function init() {

  new_story = story_text;
  const x_item = randomValueFromArray(insertX), y_item = randomValueFromArray(insertY), z_item = randomValueFromArray(insertZ);

  new_story = new_story.replace(':inserty:', y_item);
  new_story = new_story.replace(':insertz:', z_item);
  
  let name = "";
  custom_name.value !== '' ? name = custom_name.value : name = x_item;

  new_story = new_story.replace(':insertx:', name);
  new_story = new_story.replace(':insertx:', name);

  if(document.getElementById("kr").checked) {
    let weight = Math.round(300*0.45) + 'kg';
    let temperature =  Math.round((94-32)*50/9)/10 + '도';

    new_story = new_story.replace('300 pounds', weight);
    new_story = new_story.replace('94 fahrenheit',temperature);
  }

  story.textContent = new_story;
  story.style.visibility = 'visible';
}

function enterChk(e) {
  if ( e.keyCode == '13' ) {
    init();
  }
}