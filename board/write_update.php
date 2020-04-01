<?php
$db = new mysqli("localhost","sw","P@ssw0rd","sw");


if($db->connect_error) {

	die('데이터베이스 연결에 문제가 있습니다.\n관리자에게 문의 바랍니다.');

}

$db->set_charset('utf8');

  // error_reporting(E_ALL);
  //
  // ini_set("display_errors", 1);

  //$_POST['bno']이 있을 때만 $bno 선언

  	if(isset($_POST['bno'])) {

  		$bNo = $_POST['bno'];

  	}
    //bno이 없다면(글 쓰기라면) 변수 선언

    	if(empty($bNo)) {

    		$bID = $_POST['bID'];

    		$date = date('Y-m-d H:i:s');

    	}

//항상 변수 선언
	$bPassword = $_POST['bPassword'];

	$bTitle = $_POST['bTitle'];

	$bContent = $_POST['bContent'];

  //글 수정

  if(isset($bNo)) {

  	//수정 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크

  	$sql = 'select count(b_password) as cnt from board_free where b_password="' . $bPassword . '" and b_no = ' . $bNo;

  	$result = $db->query($sql);

  	$row = $result->fetch_assoc();


  	//비밀번호가 맞다면 업데이트 쿼리 작성

  	if($row['cnt']) {

  		$sql = 'update board_free set b_title="' . $bTitle . '", b_content="' . $bContent . '" where b_no = ' . $bNo;

  		$msgState = '수정';

  	//틀리다면 메시지 출력 후 이전화면으로

  	} else {

  		$msg = '비밀번호가 맞지 않습니다.';

  	?>

  		<script>

  			alert("<?php echo $msg?>");

  			history.back();

  		</script>

  	<?php

  		exit;

  	}


	// $sql = 'insert into board_free (b_no, b_title, b_content, b_date, b_hit, b_id, b_password) values(null, "'.$bTitle . '", "' . $bContent . '", "' . $date . '", 0, "' . $bID . '", password("' . $bPassword . '"))';
  //글 등록

  } else {
  $sql = "insert into board_free values(null,'$bTitle','$bContent','$date',0,'$bID','$bPassword')";
  $msgState = '등록';

  }

  //메시지가 없다면 (오류가 없다면)

  if(empty($msg)) {
	$result = mysqli_query($db,$sql);


	if($result) { // query가 정상실행 되었다면,

    $msg = '정상적으로 글이 ' . $msgState . '되었습니다.';

  		if(empty($bNo)) {

  			$bNo = $db->insert_id;

  		}

		$replaceURL = '/SW/board/view.php?bno=' . $bNo;

	} else {
    $msg = '글을 ' . $msgState . '하지 못했습니다.';


?>

		<script>

			alert("<?php echo $msg?>");
      history.back();


		</script>

<?php
exit;
	}
}
?>

<script>

	alert("<?php echo $msg?>");

	location.replace("<?php echo $replaceURL?>");

</script>
