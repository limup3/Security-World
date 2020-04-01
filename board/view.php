<?php

$db = new mysqli("localhost","sw","P@ssw0rd","sw");


if($db->connect_error) {

	die('데이터베이스 연결에 문제가 있습니다.\n관리자에게 문의 바랍니다.');

}

$db->set_charset('utf8');

$bNo = $_GET['bno'];

if(!empty($bNo) && empty($_COOKIE['board_free_' . $bNo])) {

		$sql = 'update board_free set b_hit = b_hit + 1 where b_no = ' . $bNo;

		$result = $db->query($sql);

		if(empty($result)) {

			?>

			<script>

				alert('오류가 발생했습니다.');

				history.back();

			</script>

			<?php

		} else {

			setcookie('board_free_' . $bNo, TRUE, time() + (60 * 60 * 24), '/');

		}

	}



	$sql = 'select b_title, b_content, b_date, b_hit, b_id from board_free where b_no = ' . $bNo;
		$result = $db->query($sql);
		$row = $result->fetch_assoc();

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
  <link rel="icon" href="/SW/img/core-img/favicon.png">
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

<body>



	<div class="container">
	<div style="padding:200px 0px 0px 0px;">
	</div>

	<table width="100%" cellpadding="0" cellspacing="0" border="4">
	     <tr style=" text-align:center;">
	      <td><h2>글 내용보기</h2></td>
	     </tr>
	    </table>
			<div style="padding:30px 0px 0px 0px;">
			</div>
			<br>
			<form>
			<table width="1112">
				 <tr height="1" bgcolor="#dddddd"><td colspan="4" width="407"></td></tr>
				<tr>
			      <td width="0">&nbsp;</td>
			      <td align="center" width="76"><p style="font-size:20px">조회수</p></td>
			      <td width="319"><p style="font-size:18px" textCenter>&nbsp;&nbsp;&nbsp;<?php echo $row['b_hit']?></p></td>
			      <td width="0">&nbsp;</td>
			     </tr>
				 <tr height="1" bgcolor="#dddddd"><td colspan="4" width="407"></td></tr>
			  <tr>
			      <td width="0">&nbsp;</td>
			      <td align="center" width="76"><p style="font-size:20px">작성자</p></td>
			      <td width="319"><p style="font-size:18px" textCenter>&nbsp;&nbsp;&nbsp;<?php echo $row['b_id']?></p></td>
			      <td width="0">&nbsp;</td>
			     </tr>
				 <tr height="1" bgcolor="#dddddd"><td colspan="4" width="407"></td></tr>
				   <tr>
			      <td width="0">&nbsp;</td>
			      <td align="center" width="76"><p style="font-size:20px">작성일</p></td>
			      <td width="319"><p style="font-size:18px" textCenter>&nbsp;&nbsp;&nbsp;<?php echo $row['b_date']?></p></td>
			      <td width="0">&nbsp;</td>
			     </tr>
				 <tr height="1" bgcolor="#dddddd"><td colspan="4" width="407"></td></tr>
				 	   <tr>
			      <td width="0">&nbsp;</td>
			      <td align="center" width="76"><p style="font-size:20px">글제목</p></td>
			      <td width="319"><p style="font-size:18px" textCenter>&nbsp;&nbsp;&nbsp;<?php echo $row['b_title']?></p></td>
			      <td width="0">&nbsp;</td>
			     </tr>
				 <tr height="1" bgcolor="#dddddd"><td colspan="4" width="407"></td></tr>

				 	   <tr>
			      <td width="0">&nbsp;</td>
			      <td align="center" width="76"><p style="font-size:20px">글내용</p></td>
			      <td width="319"><p style="font-size:18px" font-family:"돋움", textCenter>&nbsp;&nbsp;&nbsp;<?php echo $row['b_content']?></p></td>
			      <td width="0">&nbsp;</td>
			     </tr>
				 <tr height="1" bgcolor="#dddddd"><td colspan="4" width="407"></td></tr>

			  <tr height="100">
			    <td colspan="4" align="center" >
						<a class="btn btn-default" href="/SW/board/write.php?bno=<?php echo $bNo?>">수정</a>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<a class="btn btn-default" href="/SW/board/delete.php?bno=<?php echo $bNo?>">삭제</a>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<a class="btn btn-default" href="/SW/board/index.php">목록</a>
						&nbsp;&nbsp;&nbsp;&nbsp;
			    </td>
			  </tr>
			</table>

</form>
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
