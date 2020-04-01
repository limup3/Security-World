<?php include "/SW/db.php"; ?>
<!DOCTYPE html>
<html lang="ko">


<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Sign up</title>

  <!-- Bootstrap -->
  <link href="other/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" href="./img/core-img/favicon.png">
  <!-- font awesome -->
  <link rel="stylesheet" href="other/css/font-awesome.min.css" media="screen" title="no title" charset="utf-8">
  <!-- Custom style -->
  <link rel="stylesheet" href="other/css/style.css" media="screen" title="no title" charset="utf-8">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <!--[endif]-->
    <script type="text/javascript" src="/SW/js/jquery-3.2.1.js"></script>
<script>
$(document).ready(function(e) {
	$(".check").on("keyup", function(){ //check라는 클래스에 입력을 감지
		var self = $(this);
		var userid;

		if(self.attr("id") === "userid"){
			userid = self.val();
		}

		$.post( //post방식으로 id_check.php에 입력한 userid값을 넘깁니다
			"/SW/check.php",
			{ userid : userid },
			function(data){
				if(data){ //만약 data값이 전송되면
					self.parent().parent().find("div").html(data); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
					self.parent().parent().find("div").css("color", "#F00"); //div 태그를 찾아 css효과로 빨간색을 설정합니다
				}
			}
		);
	});
});
</script>
<?php
error_reporting(E_ALL);

ini_set("display_errors", 1);
?>
</head>

<body>



  <div class="col-md-12">
    <center>
      <div class="page-header">
        <h1>회원가입</h1>
    </center>
  </div>

  <form class="form-horizontal" action="/SW/membersave.php" method="post">
<table>
    <tr>  <div class="form-group">
      <td> <label style="padding:0px 0px 0px 100px;">아이디</label></td>
      <!-- 노트북 45px -->

        <div class="col-sm-2">

          </div>

    							<td style="padding:0px 0px 0px 30px;"><input type="text" size="35" name="userid" id="userid" class="check" placeholder="  아이디"  required />
    							<td><div id="id_check" style="padding:0px 0px 0px 20px;">아이디가 실시간으로 검사됩니다</div></td>
    							</td>
      </tr>
    </table>
    <div class="container">
    <div style="padding:20px 0px 0px 0px;">
    </div>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label" for="password_encrypted">비밀번호</label>
      <div class="col-sm-6">
        <input class="form-control" name="password_encrypted" id="password_encrypted" type="password" placeholder="비밀번호" required />

      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label" for="passwordcheck_encrypted">비밀번호 확인</label>
      <div class="col-sm-6">
        <input class="form-control" name="passwordcheck_encrypted" id="passwordcheck_encrypted" type="password" placeholder="비밀번호 확인" required />
        <div class="alert alert-success" id="alert-success">비밀번호가 일치합니다.</div>
        <div class="alert alert-danger" id="alert-danger">비밀번호가 일치하지 않습니다.</div>

        <!-- <p class="help-block">비밀번호를 한번 더 입력해주세요.</p> -->
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-3 control-label" for="name">이름</label>
      <div class="col-sm-6">
        <input class="form-control" name="name" type="text" placeholder="이름">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-3 control-label" for="tel">휴대폰번호</label>
      <div class="col-sm-6">
        <div class="input-group">
          <input type="tel" class="form-control" name="tel" placeholder="휴대폰 번호" />
        </div>
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-3 control-label" for="inputAgree">약관 동의</label>
      <div class="col-sm-6" data-toggle="buttons">
        <label class="btn btn-warning active"> <input id="agree" type="checkbox" autocomplete="off" chacked> <span class="fa fa-check"></span>
        </label> <a href="#">이용약관</a> 에 동의 합니다.
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-12 text-center">
        <button class="btn btn-primary" type="submit">
          회원가입<i class="fa fa-check spaceLeft"></i>
        </button>
        <a class="btn btn-danger" href="/SW/index.php">가입취소<i class="fa fa-times spaceLeft"></i></a>

      </div>
    </div>
  </form>
  <hr>
  </div>
  </article>



  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="other/js/bootstrap.min.js"></script>
  <script src="/SW/js/login.js"></script>
</body>

</html>
