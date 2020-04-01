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
                  <a class="nav-brand" href="/index.php"><img src="/img/core-img/logo2.PNG" alt=""></a>

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
  												<li class="active"><a href="/dvwa" target="_blank">웹 취약점 연습</a></li>
  												<li><a href="/Inspection.php">취약점 점검</a></li>
  												<li><a href="/board/index.php">게시판</a></li>
  												<li><a href="/news/index.php">보안뉴스</a></li>
  												<li><a href="/game/game.php">게임</a></li>
  												<li><a href="/chat/index.php">채팅</a></li>
  											</ul>

                          <!-- Get Tickets Button -->
                          <?php
                          session_start();

                          $S_id=$_SESSION['id'];


                                  //로그인 성공 시 세션 변수 만들기
                          if(isset($S_id))    //세션 변수가 참일 때
                          {
                            ?>
                              <a href="/logout.php" class="btn confer-btn mt-3 mt-lg-0 ml-3 ml-lg-5">logout <i class="zmdi zmdi-long-arrow-right"></i></a>


                          <?php  }
                          else{
                            ?>
                            <a href="/loginform.html" class="btn confer-btn mt-3 mt-lg-0 ml-3 ml-lg-5">login <i class="zmdi zmdi-long-arrow-right"></i></a>
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
    <div style="padding:200px 0px 0px 0px;">
    </div>
    <center>
    <h3>팀노바 위치</h3>
  </center>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyASyU1D8PKZZQyhBrhb1dvqqx0i_0utoww&callback=initMap"></script>

	<script>

		function initialize() {



			/*

				http://openapi.map.naver.com/api/geocode.php?key=f32441ebcd3cc9de474f8081df1e54e3&encoding=euc-kr&coord=LatLng&query=서울특별시 강남구 강남대로 456

                위와같이 링크에서 뒤에 주소를 적으면 x,y 값을 구할수 있다.

			*/

			var Y_point			= 37.483882;		// Y 좌표

			var X_point			= 126.972212;		// X 좌표



			var zoomLevel		= 16;						// 지도의 확대 레벨 : 숫자가 클수록 확대됨



			var markerTitle		= "팀노바";				// 현재 위치 마커에 마우스를 올렸을때 나타나는 정보

			var markerMaxWidth	= 300;						// 마커를 클릭했을때 나타나는 말풍선의 최대 크기



			// 말풍선 내용

			var contentString	= '<div>' +

			'<h2>팀노바</h2>'+

			'<p>남성역 1번출구에서 도보 5분 걸음후 횡단보도 <br />' +

            '건너편 팀노바 간판 있는 건물 3층</p>' +

			//'<a href="http://www.daegu.go.kr" target="_blank">http://www.daegu.go.kr</a>'+ //링크도 넣을 수 있음

			'</div>';



			var myLatlng = new google.maps.LatLng(Y_point, X_point);

			var mapOptions = {

								zoom: zoomLevel,

								center: myLatlng,

								mapTypeId: google.maps.MapTypeId.ROADMAP

			}

			var map = new google.maps.Map(document.getElementById('map_view'), mapOptions);



			var marker = new google.maps.Marker({

													position: myLatlng,

													map: map,

													title: markerTitle

			});



			var infowindow = new google.maps.InfoWindow(

														{

															content: contentString,

															maxWidth: markerMaxWidth

														}

			);



			google.maps.event.addListener(marker, 'click', function() {

				infowindow.open(map, marker);

			});

		}

	</script>

</head>



<body onload="initialize()">

	<div id="map_view" style=" margin: auto;width:500px; height:300px;"></div>

  <div style="padding:100px 0px 0px 0px;">
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
                            <li><a href="/myinfo.php"><i class="zmdi zmdi-circle"></i> My info</a></li>

                        <?php  }
                        else{
                          ?>
                        <li><a href="/loginform.html"><i class="zmdi zmdi-circle"></i> My info</a></li>
                      <?php  }
                          ?>



                          <li><a><button id="check_module" type="button" style="background-color:transparent;  border:0px transparent solid; color:#9293BC"><i class="zmdi zmdi-circle"></i>Donation</button></a></li>
                          <li><a href="/adminpage.php"><i class="zmdi zmdi-circle"></i> Admin page</a></li>
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

</body>

</html>
