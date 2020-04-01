<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="description" content="">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <!-- Title -->
  <title>Security World</title>

  <!-- Favicon -->
  <link rel="icon" href="/SW/img/core-img/favicon.png">
  <link rel="stylesheet" href="/SW/style.css">
  <link rel="stylesheet" href="/SW/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/SW/css/normalize.css" />
	<link rel="stylesheet" href="/SW/css/board.css" />
  <link rel="stylesheet" type="text/css" href="/SW/chat/chat.css" />

</head>
<header class="header-area">
		<div class="classy-nav-container breakpoint-off">
				<div class="container">
						<!-- Classy Menu -->
						<nav class="classy-navbar justify-content-between" id="conferNav">

							<!-- Logo -->
							<a class="nav-brand" href="/SW/index.php"><img src="/SW/img/core-img/logo2.PNG" alt=""></a>

							<!-- Navbar Toggler -->
							<div class="classy-navbar-toggler">
									<span class="navbarToggler"><span></span><span></span><span></span></span>
							</div>

							<!-- Menu -->
							<div class="classy-menu">
									<!-- Menu Close Button -->
									<div class="classycloseIcon">
											<div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
									</div>
									<!-- Nav Start -->
									<div class="classynav">
                    <ul id="nav">
                      <li class="active"><a href="/SW/dvwa" target="_blank">웹 취약점 연습</a></li>
                      <li><a href="/SW/Inspection.php">취약점 점검</a></li>
                      <li><a href="/SW/board/index.php">게시판</a></li>
                      <li><a href="/SW/news/index.php">보안뉴스</a></li>
                      <li><a href="/SW/game/game.php">게임</a></li>
                      <li><a href="/SW/chat/index.php">채팅</a></li>
                    </ul>

											<!-- Get Tickets Button -->
											<?php
											session_start();

											$id=$_SESSION['id'];


															//로그인 성공 시 세션 변수 만들기
											if(isset($id))    //세션 변수가 참일 때
											{
												?>
													<a href="/SW/logout.php" class="btn confer-btn mt-3 mt-lg-0 ml-3 ml-lg-5">logout <i class="zmdi zmdi-long-arrow-right"></i></a>


										<?php  }
											else{
												?>
												<a href="/SW/loginform.html" class="btn confer-btn mt-3 mt-lg-0 ml-3 ml-lg-5">login <i class="zmdi zmdi-long-arrow-right"></i></a>
										<?php  }
												?>
											<!-- <a href="/loginform.html" class="btn confer-btn mt-3 mt-lg-0 ml-3 ml-lg-5">login <i class="zmdi zmdi-long-arrow-right"></i></a> -->
									</div>
										<!-- Nav End -->
								</div>
						</nav>
				</div>
		</div>
</header>

<body>



	<div class="container">
	<div style="padding:200px 0px 0px 0px;">
	</div>
<center>
  <h2>게임</h2>
  <div class="row" style="padding:20px 0px 0px 0px;">
  <div class="col-xs-6 col-sm-6 col-md-6">
      <a href="/SW/pong/part5/index.html" target="_blank" class="btn btn-lg btn-primary btn-block">탁구</a>
      </div>
      <div class="col-xs-6 col-sm-6 col-md-6">
      <a href="/SW/Tetris/Tetris.html" target="_blank" class="btn btn-lg btn-primary btn-block">테트리스</a>
      </div>
  </div>
  <div class="row" style="padding:30px 0px 0px 0px;">
        <div class="col-xs-6 col-sm-6 col-md-6">
      <a href="/SW/Flappy_Bird/index.html" target="_blank" class="btn btn-lg btn-primary btn-block">플래피 버드</a>
        </div>
            <div class="col-xs-6 col-sm-6 col-md-6">
      <a href="/SW/brick/lesson10.html" target="_blank" class="btn btn-lg btn-primary btn-block">벽돌깨기</a>
        </div>
  </div>
</center>




<div style="padding:150px 0px 0px 0px;">
</div>
<div class="container">
    <div class="copywrite-content">
        <div class="row">
            <!-- Copywrite Text -->
            <div class="col-12 col-md-6">
                <div class="copywrite-text">
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                </div>
            </div>
            <!-- Footer Menu -->
            <div class="col-12 col-md-6">
                <div class="footer-menu">
                    <ul class="nav">
											<?php
															//로그인 성공 시 세션 변수 만들기
											if(isset($S_id))    //세션 변수가 참일 때
											{
												?>
													<li><a href="/SW/myinfo.php"><i class="zmdi zmdi-circle"></i> My info</a></li>

											<?php  }
											else{
												?>
											<li><a href="/SW/loginform.html"><i class="zmdi zmdi-circle"></i> My info</a></li>
										<?php  }
												?>
                        <li><a href="#"><i class="zmdi zmdi-circle"></i> Terms of Service</a></li>
                        <li><a href="#"><i class="zmdi zmdi-circle"></i> Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<link rel ="stylesheet" href="/SW/css/login.css">

<script src="js/jquery.min.js"></script>
<!-- Popper -->
<script src="js/popper.min.js"></script>
<!-- Bootstrap -->
<script src="js/bootstrap.min.js"></script>
<!-- All Plugins -->
<script src="js/confer.bundle.js"></script>
<!-- Active -->
<script src="js/default-assets/active.js"></script>

</body>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/SW/chat/chat.js"></script>
</html>
