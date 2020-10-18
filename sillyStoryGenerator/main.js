const custom_name = document.getElementById('customname');
const randomize = document.querySelector('.randomize');
const story = document.querySelector('.story');

function randomValueFromArray(array){
  const random = Math.floor(Math.random()*array.length);
  return array[random];
}


const story_text = 'It was 94 fahrenheit outside, so :insertx: went for a walk. When they got to :inserty:, they stared in horror for a few moments, then :insertz:. Bob saw the whole thing, but was not surprised — :insertx: weighs 300 pounds, and it was a hot day.';

let insertX = ['Willy the Goblin', 'Big Daddy', 'Father Christmas'];
let insertY = ['the soup kitchen','Disneyland','the White House'];
let insertZ = ['spontaneously combusted','melted into a puddle on the sidewalk','turned into a slug and crawled away'];

let new_story;
randomize.addEventListener('click', result);

function result() {

    new_story = story_text;
    const x_item = randomValueFromArray(insertX), y_item = randomValueFromArray(insertY), z_item = randomValueFromArray(insertZ);

     new_story = new_story.replace(':insertx:', x_item);
     new_story = new_story.replace(':inserty:', y_item);
     new_story = new_story.replace(':insertz:', z_item);
    
    if(custom_name.value !== '') {
        let name = custom_name.value;
    } else {
        new_story.replace(':insertx:', x_item);
    }
    
  if(document.getElementById("kr").checked) {
    let weight = Math.round(300);
    let temperature =  Math.round(94);
  }

  story.textContent = new_story;
  story.style.visibility = 'visible';
}