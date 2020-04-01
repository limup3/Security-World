<?php
$db = new mysqli("localhost","sw","P@ssw0rd","sw");
$db->set_charset("utf8");
function mq($sql){
	global $db;
	return $db->query($sql);
}



	if($_POST['userid'] != NULL){
	$id_check = mq("select * from sign_info where id='{$_POST['userid']}'");
	$id_check = $id_check->fetch_array();

	if($id_check >= 1){
		echo "<span style='color:red;'>존재하는 아이디입니다.</span>\n";
	} else {
		echo "<span style='color:green;'>존재하지 않는 아이디입니다.</span>\n";




	}
} ?>
