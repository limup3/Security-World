<?php
$db = new mysqli("localhost","sw","P@ssw0rd","sw");
echo "<br>";


if($db->connect_error) {

	die('데이터베이스 연결에 문제가 있습니다.\n관리자에게 문의 바랍니다.');

}



$db->set_charset('utf8');

/* 페이징 시작 */

	//페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.

	if(isset($_GET['page'])) {

		$page = $_GET['page'];

	} else {

		$page = 1;

	}


	/* 검색 시작 */



	if(isset($_GET['searchColumn'])) {

		$searchColumn = $_GET['searchColumn'];

		$subString .= '&amp;searchColumn=' . $searchColumn;

	}

	if(isset($_GET['searchText'])) {

		$searchText = $_GET['searchText'];

		$subString .= '&amp;searchText=' . $searchText;

	}



	if(isset($searchColumn) && isset($searchText)) {

		$searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%"';

	} else {

		$searchSql = '';

	}



	/* 검색 끝 */



	$sql = 'select count(*) as cnt from board_free' . $searchSql;

	$result = $db->query($sql);

	$row = $result->fetch_assoc();



	$allPost = $row['cnt']; //전체 게시글의 수

	if(empty($allPost)) {

			$emptyData = '<tr><td class="textCenter" colspan="5">글이 존재하지 않습니다.</td></tr>';

		} else {

	$onePage = 10; // 한 페이지에 보여줄 게시글의 수.

	$allPage = ceil($allPost / $onePage); //전체 페이지의 수



	if($page < 1 || ($allPage && $page > $allPage)) {

?>

		<script>

			alert("존재하지 않는 페이지입니다.");

			history.back();

		</script>

<?php

		exit;

	}



	$oneSection = 10; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)

	$currentSection = ceil($page / $oneSection); //현재 섹션

	$allSection = ceil($allPage / $oneSection); //전체 섹션의 수



	$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지



	if($currentSection == $allSection) {

		$lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.

	} else {

		$lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지

	}



	$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.

	$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.



	$paging = '<ul class="pagination">'; // 페이징을 저장할 변수



	//첫 페이지가 아니라면 처음 버튼을 생성

	if($page != 1) {

		$paging .= '<li ><a href="./index.php?page=1' . $subString . '">처음</a></li>';
	}

	//첫 섹션이 아니라면 이전 버튼을 생성

	if($currentSection != 1) {

		$paging .= '<li ><a href="./index.php?page=' . $prevPage . $subString . '">이전</a></li>';
	}



	for($i = $firstPage; $i <= $lastPage; $i++) {

		if($i == $page) {

			$paging .= '<li ><a href="#">' . $i . '</li>';

		} else {

			$paging .= '<li ><a href="./index.php?page=' . $i . $subString . '">' . $i . '</a></li>';
		}

	}



	//마지막 섹션이 아니라면 다음 버튼을 생성

	if($currentSection != $allSection) {

		$paging .= '<li><a href="./index.php?page=' . $nextPage . $subString . '">다음</a></li>';
	}



	//마지막 페이지가 아니라면 끝 버튼을 생성

	if($page != $allPage) {

		$paging .= '<li ><a href="./index.php?page=' . $allPage . $subString . '">끝</a></li>';
	}

	$paging .= '</ul>';



	/* 페이징 끝 */

	$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지

	$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문





	$sql = 'select * from board_free' . $searchSql . ' order by b_no desc' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
	$result = $db->query($sql);
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
  <link rel="stylesheet" href="/SW/style.css">
  <link rel="stylesheet" href="/SW/bootstrap/css/bootstrap.css">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <!-- <link rel="stylesheet" href="/css/normalize.css" />
	<link rel="stylesheet" href="/css/board.css" /> -->
<script src="/SW/js/jquery-2.1.3.min.js"></script>
</head>

<body>

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







	<div class="searchBox">

		<form action="./index.php" method="get">

			<select name="searchColumn">

				<option <?php echo $searchColumn=='b_title'?'selected="selected"':null?> value="b_title">제목</option>

				<option <?php echo $searchColumn=='b_content'?'selected="selected"':null?> value="b_content">내용</option>



				<option <?php echo $searchColumn=='b_id'?'selected="selected"':null?> value="b_id">작성자</option>

			</select>

			<input type="text" name="searchText" value="<?php echo isset($searchText)?$searchText:null?>">

			<button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>

		</form>

	</div>
  <!-- <div class="input-group">
    <form action="/board.html" method ="get">
    <input type="text" class="form-control" placeholder="검색 키워드를 입력하세요!" name="search" >
    <div class="input-group-btn">
      <button class="btn btn-secondary" type="submit">검색</button>
    </div>
  </form>
  </div> -->
  <div style="padding:50px 0px 0px 0px;">
  </div>
<article class ="boardArticle">
  <div class="container">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col" class="no">번호</th>
					<th scope="col" class="title">제목</th>
					<th scope="col" class="author">작성자</th>
					<th scope="col" class="date">작성일</th>
					<th scope="col" class="hit">조회</th>
        </tr>
      </thead>
      <tbody>
				<?php
				if(isset($emptyData)) {

											echo $emptyData;

										} else {
							while($row = $result->fetch_assoc())

							{

								$datetime = explode(' ', $row['b_date']);

								$date = $datetime[0];

								$time = $datetime[1];

								if($date == Date('Y-m-d'))

									$row['b_date'] = $time;

								else

									$row['b_date'] = $date;

						?>

				<tr>
					<td class="no"><?php echo $row['b_no']?></td>
					<td class="title">
						<a href="./view.php?bno=<?php echo $row['b_no']?>"><?php echo $row['b_title']?></a>
					</td>
					<td class="author"><?php echo $row['b_id']?></td>
					<td class="date"><?php echo $row['b_date']?></td>
					<td class="hit"><?php echo $row['b_hit']?></td>
				</tr>
					<?php
						}
					}
					?>
      </tbody>
    </table>
    <hr/>
    <div style="padding:50px 0px 0px 0px;">
    </div>
		<div class="text-center">

				<?php echo $paging ?>

			</div>

    <a class="btn btn-default pull-right" href="write.php">글쓰기</a>

    <div style="padding:50px 0px 0px 0px;">
    </div>


    <!-- <div class="text-center">
      <ul class="pagination">
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
      </ul>
    </div> -->
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

  <script src="/SW/js/jquery.min.js"></script>
  <!-- Popper -->
  <script src="/SW/js/popper.min.js"></script>
  <!-- Bootstrap -->
  <script src="/SW/js/bootstrap.min.js"></script>
  <!-- All Plugins -->
  <script src="/SW/js/confer.bundle.js"></script>
  <!-- Active -->
  <script src="/SW/js/default-assets/active.js"></script>

</body>

</html>
