<?php
$db = new mysqli("localhost","sw","P@ssw0rd","sw");
$db->query('SET NAMES utf8');

$db->query('
	INSERT INTO chat(name, msg, date)
	VALUES(
		"' . $db->real_escape_string($_POST['name']) . '",
		"' . $db->real_escape_string($_POST['msg']) . '",
		NOW()
	)
');
?>
