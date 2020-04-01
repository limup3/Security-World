<?php
//GET 파라메터로 주어진 날짜 이후의 채팅내용을 가져와 JSON 포맷으로 출력하는 페이지

if(!$_GET['date'])
{
	$_GET['date'] = date('Y-m-d H:i:s');
}


$db = new mysqli("localhost","sw","P@ssw0rd","sw");
$db->query('SET NAMES utf8');
$res = $db->query('SELECT * FROM chat WHERE date > "' . $_GET['date'] . '"');
$data = array();
$date = $_GET['date'];

while($v = $res->fetch_array(MYSQLI_ASSOC))
{
	$data[] = $v;
	$date = $v['date'];
}

echo json_encode(array('date' => $date, 'data' => $data));
?>
