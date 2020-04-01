<?php



$db = new mysqli("localhost","sw","P@ssw0rd","sw");

if($db->connect_error) {

  die('데이터베이스 연결에 문제가 있습니다.\n관리자에게 문의 바랍니다.');

}

$db->set_charset('utf8');

// 방문자 조회 쿼리문
	if(!isset($_SESSION)) { session_start(); }

	date_default_timezone_set('Asia/Seoul');

	$currdt = date("Y-m-d H:i:s");

	$userip = $_SERVER['REMOTE_ADDR'];

	if(isset($_SERVER['HTTP_REFERER']))

		$referer = $_SERVER['HTTP_REFERER'];

	else

		$referer = "";

	if($db){

		// 처음 방문했는지 검사

		if(!isset($_SESSION['visit'])) {

			$_SESSION['visit'] = "1";

			$query = "insert into tb_stat_visit (regdate, regip, referer) values('$currdt','$userip','$referer')";

			$result = $db->query($query);

		}

		// 오늘 방문자수

		$query = "select count(*) as count from tb_stat_visit where DATE(regdate) = DATE('$currdt')";

		$data = $db->query($query)->fetch_array();

		$today_visit_count = $data['count'];

		// 전체 방문자수

		$query = "select count(*) as count from tb_stat_visit";

		$data = $db->query($query)->fetch_array();

		$total_visit_count = $data['count'];
// 방문자 조회 쿼리문 끝

//이전 페이지 경로 확인
$referer_domain = $_SERVER['HTTP_REFERER'];

$query = "insert into ref_page (domain,hit) values ('$referer_domain',0) on duplicate key update domain='$referer_domain', hit= hit + 1" ;
//유니크 값에 키 존재할때 새로운 값이 들어오면 update 실행해주는 INSERT INTO ON DUPLICATE KEY UPDATE 쿼리

$result = $db->query($query);
//이전 페이지 경로 확인 끝

$output = shell_exec('php news/test.php > news/index.php');
echo $output;
	}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Title -->
    <title>Security World</title>

    <!-- Favicon -->
    <link rel="icon" href="./img/core-img/favicon.png">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <!-- Preloader -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- /Preloader -->

    <!-- Header Area Start -->
    <header class="header-area">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <!-- Classy Menu -->
                <nav class="classy-navbar justify-content-between" id="conferNav">

                  <!-- Logo -->
                  <a class="nav-brand" href="/SW/index.php"><img src="img/core-img/logo2.PNG" alt=""></a>

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
  												<li><a href="/SW/chat/index.php">채팅
                            <?php
                            $output = shell_exec('cd php /SW/news/test.php > /SW/news/index.php');
                            // var_dump($output);
                            ?>
                          </a></li>
  											</ul>

                          <!-- Get Tickets Button -->
                          <?php
                          session_start();

                          $S_id=$_SESSION['id'];


                                  //로그인 성공 시 세션 변수 만들기
                          if(isset($S_id))    //세션 변수가 참일 때
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
    <!-- Header Area End -->

    <!-- Welcome Area Start -->
    <section class="welcome-area">
        <div class="welcome-slides owl-carousel">
            <!-- Single Slide -->
            <div class="single-welcome-slide bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/hacking.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <!-- Welcome Text -->
                        <div class="col-12">
                            <div class="welcome-text text-right">
                                <h2 data-animation="fadeInUp" data-delay="300ms">Security <br>World&nbsp;&nbsp;</h2>
                                <div class="hero-btn-group" data-animation="fadeInUp" data-delay="700ms">
                                    <a href="#" class="btn confer-btn">More Information <i class="zmdi zmdi-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Single Slide -->
            <div class="single-welcome-slide bg-img bg-overlay jarallax" style="background-image: url(img/bg-img/hacking_2.jpg);">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <!-- Welcome Text -->
                        <div class="col-12">
                            <div class="welcome-text-two text-center">
                                <h5 data-animation="fadeInUp" data-delay="100ms">Try</h5>
                                <h2 data-animation="fadeInUp" data-delay="300ms">Hacking Competition</h2>
                                <!-- Event Meta -->
                                <div class="event-meta" data-animation="fadeInUp" data-delay="500ms">
                                    <a class="event-date" href="#"><i class="zmdi zmdi-account"></i> March 26, 2019</a>
                                    <a class="event-author" href="#"><i class="zmdi zmdi-alarm-check"></i> 24:00</a>
                                </div>
                                <div class="hero-btn-group" data-animation="fadeInUp" data-delay="700ms">
                                    <a href="http://codegate.org/" target="_blank" class="btn confer-btn m-2">Codegate <i class="zmdi zmdi-long-arrow-right"></i></a>
                                    <a href="https://www.defcon.org/" target="_blank" class="btn confer-btn m-2">Defcon <i class="zmdi zmdi-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Icon -->
        <div class="icon-scroll" id="scrollDown"></div>


    <!-- Footer Area Start -->
    <footer class="footer-area bg-img bg-overlay-2 section-padding-100-0">
        <!-- Main Footer Area -->
        <div class="main-footer-area">
            <div class="container">
                <div class="row">
                    <!-- Single Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget mb-60 wow fadeInUp" data-wow-delay="300ms">
                            <!-- Footer Logo -->
                            <a href="/SW/map.php" class="footer-logo"><img src="img/image/teamnova.png" alt=""></a>
                            <a href="https://cafe.naver.com/teamnovaopen"><p>https://cafe.naver.com/<br>teamnovaopen</br></p></a>

                            <!-- Social Info -->
                            <div class="social-info">
                                <a href="https://www.facebook.com/codingfinal/?ref=br_rs"><i class="zmdi zmdi-facebook"></i></a>
                                <a href="#"><i class="zmdi zmdi-instagram"></i></a>
                                <a href="#"><i class="zmdi zmdi-twitter"></i></a>
                                <a href="#"><i class="zmdi zmdi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                    <!-- Single Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget mb-60 wow fadeInUp" data-wow-delay="300ms">
                            <!-- Widget Title -->
                            <h5 class="widget-title">Contact</h5>

                            <!-- Contact Area -->
                            <div class="footer-contact-info">
                                <a href="/SW/map.php"><p><i class="zmdi zmdi-map"></i> 서울특별시 동작구 사당동 318-13<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ㅡ> 위치 보기 )</p></a>
                                <p><i class="zmdi zmdi-phone"></i> (010) 7255 2316</p>
                                <p><i class="zmdi zmdi-email"></i> manadra@naver.com</p>
                                <p><i class="zmdi zmdi-globe"></i> teamnova.co.kr</p>
                            </div>
                        </div>
                    </div>

                    <!-- Single Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget mb-60 wow fadeInUp" data-wow-delay="300ms">
                            <!-- Widget Title -->
                            <h5 class="widget-title">Hacking Skills</h5>

                            <!-- Footer Nav -->
                            <ul class="footer-nav">
                                <li><a href="https://namu.wiki/w/SQL%20injection">SQL injection</a></li>
                                <li><a href="https://namu.wiki/w/XSS">XSS</a></li>
                                <li><a href="https://namu.wiki/w/CSRF">CSRF</a></li>
                                <li><a href="https://namu.wiki/w/%EB%B6%84%EC%82%B0%20%EC%84%9C%EB%B9%84%EC%8A%A4%20%EA%B1%B0%EB%B6%80%20%EA%B3%B5%EA%B2%A9?from=DDoS">DDOS Attack</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Single Footer Widget Area -->
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="single-footer-widget mb-60 wow fadeInUp" data-wow-delay="300ms">
                            <!-- Widget Title -->
                            <h5 class="widget-title">Profile</h5>

                            <!-- Footer Gallery -->
                            <div class="footer-gallery">
                                <div class="row">
                                    <div class="col-7">
                                        <a href="img/image/rion.png" class="single-gallery-item"><img src="img/image/rion.png" alt=""></a>
                                        <p>KyungMin</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copywrite Area -->
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



                                <li><a><button id="check_module" type="button" style="background-color:transparent;  border:0px transparent solid; color:#9293BC"><i class="zmdi zmdi-circle"></i>Donation</button></a></li>
                                <li><a href="/SW/adminpage.php"><i class="zmdi zmdi-circle"></i> Admin page</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Area End -->

    <!-- **** All JS Files ***** -->
    <!-- jQuery 2.2.4 -->
    <script src="js/jquery.min.js"></script>
    <!-- Popper -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- All Plugins -->
    <script src="js/confer.bundle.js"></script>
    <!-- Active -->
    <script src="js/default-assets/active.js"></script>
    <!-- donation -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="https://service.iamport.kr/js/iamport.payment-1.1.5.js"></script>
    <script src="js/pay.js"></script>

</body>

</html>
