var mainState = {
  preload: function() {
    // 이 기능은 처음에 실행됩니다.
    // 그것이 이미지와 사운드를 로드하는 곳입니다.

    // 새 스프라이트 로드
    game.load.image('bird', '/Flappy_Bird/assets/bird.png');
    game.load.image('pipe', '/Flappy_Bird/assets/pipe.png');
    game.load.audio('jump', '/Flappy_Bird/assets/jump.wav');
  },

  create: function() {
    // 이 함수는 preload 함수 후에 호출됩니다.
    // 여기에서는 게임을 설정하고 스프라이트를 표시합니다.

    // 게임의 배경색을 파란색으로 변경하십시오.
    game.stage.backgroundColor = '#71c5cf';
    // 물리 시스템 설정
    game.physics.startSystem(Phaser.Physics.ARCADE);

    // 새를 x = 100 및 y = 245 위치에 표시하십시오.
    this.bird = game.add.sprite(100, 245, 'bird');

    // 새를 물리 시스템에 추가
    // 추가내용 : movements, gravity, collisions, etc.
    game.physics.arcade.enable(this.bird);

    // 새에 중력을 가하여 떨어 뜨립니다.
    this.bird.body.gravity.y = 1000;

    // 스페이스 키가 눌려지면 'jump'함수를 호출하십시오.
    var spaceKey = game.input.keyboard.addKey(
      Phaser.Keyboard.SPACEBAR);
    spaceKey.onDown.add(this.jump, this);

    // 빈 그룹을 만듭니다
    this.pipes = game.add.group();

    //타이머 추가
    this.timer = game.time.events.loop(1500, this.addRowOfPipes, this);

    //점프 사운드 추가
    this.jumpSound = game.add.audio('jump');

    this.score = 0;
    this.labelScore = game.add.text(20, 20, "0", {
      font: "30px Arial",
      fill: "#ffffff"
    });
  },

  update: function() {
    // 이 함수는 초당 60 회 호출됩니다.
    // 여기에는 게임의 로직이 포함되어 있습니다.

    // 새가 화면에서 벗어난 경우 (너무 높거나 너무 낮은 경우)
    // 'restartGame'함수를 호출하십시오.
    if (this.bird.y < 0 || this.bird.y > 490)
      this.restartGame();

    // 새의 회전
    if (this.bird.angle < 20)
      this.bird.angle += 1;

    //파이프 때릴때 호출
    game.physics.arcade.overlap(this.bird, this.pipes, this.hitPipe, null, this);

    game.physics.arcade.overlap(this.bird, this.pipes, this.restartGame, null, this);
  },

  // 새가 점프하는 함수
  jump: function() {
    // 중력을 반대로 설정
    this.bird.body.velocity.y = -350;

    // 새 애니메이션 만들기
    var animation = game.add.tween(this.bird);

    // 100 밀리세컨드 동안 angle은 -20도로 변경
    animation.to({
      angle: -20
    }, 100);

    // 애니메이션 시작하기
    animation.start();

    if (this.bird.alive == false)
      return;
  },

  // Game Restart 함수
  restartGame: function() {
    // 게임을 다시 시작하게 합니다.
    game.state.start('main');
  },

  addOnePipe: function(x, y) {
    // x와 y 위치에 파이프 만들기
    var pipe = game.add.sprite(x, y, 'pipe');

    // 이전에 생성된 그룹에 추가
    this.pipes.add(pipe);

    // 파이프를 물리 시스템에 추가
    game.physics.arcade.enable(pipe);

    // 파이프에 속도를 추가하여 왼쪽으로 이동합니다.
    pipe.body.velocity.x = -200;

    // 파이프가 더 이상 보이지 않을 때 자동으로 파이프를 삭제합니다.
    pipe.checkWorldBounds = true;
    pipe.outOfBoundsKill = true;


  },

  addRowOfPipes: function() {
    // 무작위로 1과 5 사이의 숫자 선택
    // 구멍 위치가됩니다.
    var hole = Math.floor(Math.random() * 5) + 1;

    // 6 개의 파이프 추가
    // '구멍'과 '구멍 + 1' 위치에 하나의 큰 구멍이있는 상태
    for (var i = 0; i < 8; i++)
      if (i != hole && i != hole + 1)
        this.addOnePipe(400, i * 60 + 10);

        this.score += 1;
        this.labelScore.text = this.score;
  },

  hitPipe: function() {
    // 새가 이미 파이프에 부딪쳤다면 아무 것도하지 않습니다
    // 새가 벌써 화면에서 떨어지고있는 것을 의미합니다.
    if (this.bird.alive == false)
      return;

    // 새의 alive 속성을 false로 설정합니다.
    this.bird.alive = false;

    // 새 파이프가 나타나지 않도록하십시오.
    game.time.events.remove(this.timer);

    // 모든 파이프를 통과 및 이동을 중지하십시오.
    this.pipes.forEach(function(p) {
      p.body.velocity.x = 0;
    }, this);
  },
};

// 페이저 초기화 및 400 x 490 게임 만들기
var game = new Phaser.Game(400, 490);

// 'mainState'를 추가하고 'main' 이라고 설정합니다.
game.state.add('main', mainState);

// 실제로 게임을 시작하기 위해 'main' 을 시작합니다..
game.state.start('main');
