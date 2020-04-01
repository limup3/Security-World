<?php
$db = new mysqli("localhost","sw","P@ssw0rd","sw");


if($db->connect_error) {

	die('데이터베이스 연결에 문제가 있습니다.\n관리자에게 문의 바랍니다.');

}

$db->set_charset('utf8');

$id =$_POST['id'];
$password=$_POST['password_encrypted'];

if(isset($id)) {

	//삭제 할 글의 비밀번호가 입력된 비밀번호와 맞는지 체크

	$sql = 'select count(password) as cnt from sign_info where password="' . $password . '" and id = "' . $id . '"';

	$result = $db->query($sql);

	$row = $result->fetch_assoc();



	//비밀번호가 맞다면 삭제 쿼리 작성

	if($row['cnt']) {

		$sql = "delete from sign_info where id = '$id' ";

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

}



	$result = $db->query($sql);



//쿼리가 정상 실행 됐다면,

if($result) {



	$msg = '정상적으로 계정이 삭제되었습니다.';

	$replaceURL = './';

	session_start();
	session_unset(); 

} else {

	$msg = '계정을 삭제하지 못했습니다.';

?>

	<script>

		alert("<?php echo $msg?>");

		history.back();

	</script>

<?php

	exit;

}





?>

<script>

	alert("<?php echo $msg?>");

	location.replace("<?php echo $replaceURL?>");

</script>
