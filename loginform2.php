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
                            <li><a href="/board/index.php">게시판</a></li>
                            <li><a href="#">보안뉴스</a></li>
                            <li><a href="#">게임</a></li>
                        </ul>

                          <!-- Get Tickets Button -->

                          
                          <!-- <a href="/loginform.html" class="btn confer-btn mt-3 mt-lg-0 ml-3 ml-lg-5">login <i class="zmdi zmdi-long-arrow-right"></i></a> -->
                      </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </header>

<div class="container">
  <div style="padding:300px 0px 0px 0px;">
</div>
<div class="row" style="margin-top:20px">



    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		<form class="form-horizontal" action="/login_check.php"
      method="post">
			<fieldset>
				<h2>회원정보 수정</h2>
				<hr class="colorgraph">
				<div class="form-group">
                    <input type="id" name="id" id="id" class="form-control input-lg" placeholder="아이디">
				</div>
				<div class="form-group">
                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="비밀번호">
				</div>

				<hr class="colorgraph">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
                        <input type="submit" class="btn btn-lg btn-success btn-block" value="Modify">
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<a href="/signup.php" class="btn btn-lg btn-primary btn-block">Sign up</a>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>

</div>

<div style="padding:350px 0px 0px 0px;">
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
<link rel ="stylesheet" href="/css/login.css">

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

</html>
