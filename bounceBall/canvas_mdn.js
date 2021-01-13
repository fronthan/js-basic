// 캔버스 기본 셋팅
const canvas = document.querySelector('canvas');
const ctx = canvas.getContext('2d');

const width = canvas.width = window.innerWidth;
const height = canvas.height = window.innerHeight;

// 공 사이즈 랜덤 셋팅
function random(min, max) {
  const num = Math.floor(Math.random() * (max - min + 1)) + min;
  return num;
}

// 공 그림 기본 셋팅
function Ball(x, y, velX, velY, color, size) {
  this.x = x;
  this.y = y;
  this.velX = velX; //속도
  this.velY = velY;
  this.color = color;
  this.size = size;
}

Ball.prototype.draw = function() {
  ctx.beginPath(); //모양
  ctx.fillStyle = this.color;
  ctx.arc(this.x, this.y, this.size, 0, 2*Math.PI); // 0 =시작 각도, 2*math.pi = 끝 각도 degrees
  ctx.fill();
}

Ball.prototype.update = function() {
  if ((this.x + this.size) >= width) {
    this.velX = -(this.velX);
  }

  if ((this.x - this.size) <= 0) {
    this.velX = -(this.velX);
  }

  if ((this.y + this.size) >= height) {
    this.velY = -(this.velY);
  }

  if ((this.y - this.size) <= 0) {
    this.velY = -(this.velY);
  }

  this.x += this.velX;
  this.y += this.velY;
}

Ball.prototype.collisionDetect = function() {//이런 것도 있다
  for (let j=0; j<balls.length; j++) {
    if (!(this === balls[j])) { //현재 공 자기 자신을 빼고 충돌할 때 색깔 변경
      const dx = this.x - balls[j].x;
      const dy = this.y - balls[j].y;
      const distance = Math.sqrt(dx * dx + dy*dy);

      if (distance < this.size + balls[j].size) {
        balls[j].color = this.color = 'rgb(' + random(0,255) + ',' + random(0,255) + ',' + random(0,255) + ')';
      }
    }
  }
}

//공 25개 만들기
let balls = [];
while (balls.length < 25) {
  let size = random(10, 20);
  let ball = new Ball(
    random(0 + size, width - size),
    random(0 + size, height - size),
    random(-7, 7),
    random(-7, 7),
    'rgb(' + random(0, 255) + ',' + random(0,255) + ',' + random(0,255) + ')', size
  );

  balls.push(ball);
}


// 색깔 바꾸기, 움직이기
function loop() {
  ctx.fillStyle = 'rgba(0,0,0, 0.25)';
  ctx.fillRect(0, 0, width, height);

  for (let i=0; i<balls.length; i++) {
    balls[i].draw();
    balls[i].update();
    balls[i].collisionDetect(); 
  }

  requestAnimationFrame(loop);
}

loop();