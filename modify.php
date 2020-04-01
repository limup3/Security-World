<?php
$db = new mysqli("localhost","sw","P@ssw0rd","sw");


if($db->connect_error) {

	die('데이터베이스 연결에 문제가 있습니다.\n관리자에게 문의 바랍니다.');

}

$db->set_charset('utf8');

$id =$_POST['id'];
$password=$_POST['password_encrypted'];
$name=$_POST['name'];
$phone_number=$_POST['tel'];


$sql = "update sign_info set password = '$password' , name = '$name' , phone_number = '$phone_number' where id= '$id'";

$result = $db->query($sql);

?>      <script>
        alert('수정되었습니다.');
        location.replace("/index.php");
        </script>

<?php

?>
