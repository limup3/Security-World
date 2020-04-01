<?php
 session_start();

 $db = new mysqli("localhost","sw","P@ssw0rd","sw");
 $db->set_charset("utf8");
 function mq($sql){
   global $db;
   return $db->query($sql);
 }

 ?>
