<?php
$db = new mysqli("localhost","sw","P@ssw0rd","sw");

if($db->connect_error) {

	die('데이터베이스 연결에 문제가 있습니다.\n관리자에게 문의 바랍니다.');

}

$db->set_charset('utf8');

//$_GET['bno']이 있을 때만 $bno 선언
	if(isset($_GET['bno'])) {
		$bNo = $_GET['bno'];
	}

	if(isset($bNo)) {
		$sql = 'select b_title, b_content, b_id from board_free where b_no = ' . $bNo;
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
	}
?>
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
  <link rel="icon" href="./img/core-img/favicon.png">
  <link rel="stylesheet" href="/SW/style.css">
  <link rel="stylesheet" href="/SW/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="/SW/css/normalize.css" />
	<link rel="stylesheet" href="/SW/css/board.css" />

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

<div class="container">
<div style="padding:200px 0px 0px 0px;">
</div>

<body>
<div class="container">
  <h2>게시판 글쓰기</h2>
  <form action="/SW/board/write_update.php" method="post">
		<?php
				if(isset($bNo)) {
					echo '<input type="hidden" name="bno" value="' . $bNo . '">';
				}
				?>
    <div class="form-group">
      <label for="bID">아이디</label>
			<?php
								if(isset($bNo)) {
									echo $row['b_id'];
								} else { ?>
									<input type="text" class="form-control" id="bID"
						       placeholder="아이디 입력" name="bID"
						       maxlength="100" >
								<?php } ?>

    </div>
    <div class="form-group">
      <label for="bPassword">비밀번호</label>
      <input type="password" class="form-control" id="bPassword"
       placeholder="비밀번호 입력" name="bPassword"
       maxlength="100">
    </div>

    <div class="form-group">
      <label for="bTitle">제목</label>
      <input type="text" class="form-control" id="bTitle"
       placeholder="제목 입력" name="bTitle" value="<?php echo isset($row['b_title'])?$row['b_title']:null?>"
       maxlength="100" >
    </div>
    <div class="form-group">
   <label for="bContent">내용</label>
<!--  여러줄의 데이터를 입력하고 하고자 할때 textarea 태그를 사용한다. -->
<!--  textarea 안에 있는 모든 글자는 그대로 나타난다. 공백문자, tag, enter -->
   <textarea class="form-control" rows="20" id="bContent"
    name="bContent" placeholder="내용 작성"><?php echo isset($row['b_content'])?$row['b_content']:null?></textarea>
 </div>
    <button type="submit" class="btn btn-default pull-right">
<?php echo isset($bNo)?'수정':'작성'?>
		</button>
		<a class="btn btn-default" href="/SW/board/index.php">목록</a>

  </form>
</div>

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

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>
