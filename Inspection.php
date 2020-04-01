<?php

	$db = new mysqli("localhost","client","P@ssw0rd","checkVulnerabilities");

	if($db->connect_error) {

		die('데이터베이스 연결에 문제가 있습니다.\n관리자에게 문의 바랍니다.');

	}

	$db->set_charset('utf8');

	$referer_domain = $_SERVER['HTTP_REFERER'];


	echo $_SESSION['id'];

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

<div class="container">
  <div style="padding:300px 0px 0px 0px;">
</div>



<div class="row">
	<div class="col-sm-2"></div>


	<div class="col-sm-9">
		<h2 class="text-center">리눅스 취약점 점검</h2>

    <div class="form-group">
      <div class="col-sm-12 text-right">
				<button class="btn btn-danger" type="button" onclick="location.href='reset.php'">리셋<i class="fa fa-check spaceLeft"></i>
        </button>
        <button class="btn btn-primary" type="button"onclick="location.href='start.php'">점검하기<i class="fa fa-check spaceLeft"></i>
        </button>


      </div>
    </div>
<br><br>
		<div class="table-responsive">
      <table class="table table-striped">
        <tr class="danger">
          <td>아이피</td>
          <td>마지막 점검 날짜</td>

        </tr>
      <?php
      $sql="select max(no) as no,max(ip) as ip,max(reg_date) as reg_date from InspectionDate group by ip";

      $result = $db->query($sql);
      $row = $result->fetch_assoc()

      ?>
      <tr>

      <td><?php echo $row['ip']?></td>
      <td><?php echo $row['reg_date']?></td>

      </tr>

      </table>

			<table class="table table-striped">
				<tr class="success">
					<td>항목</td>
					<td>결과</td>
					<td>내용</td>

				</tr>
<?php
$sql = 'select cno , result , contents from details';

$result = $db->query($sql);

while($row = $result->fetch_assoc())

        {
?>
	<tr>
		<td><?php echo $row['cno']?></td>
		<td><?php echo $row['result']?></td>
		<td><?php echo $row['contents']?></td>

	</tr>
  <?php
    }
    ?>
		</table>
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
                      <li><a href="/SW/admin_info.php"><i class="zmdi zmdi-circle"></i> My info</a></li>
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
