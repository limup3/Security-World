<?php
session_start();
session_unset(); 
$res=session_destroy();
if($res){
  ?>      <script>
          alert('로그아웃 성공.');
          location.replace("/index.php");
          </script>

  <?php

}

?>
