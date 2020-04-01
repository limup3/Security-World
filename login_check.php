<?php
session_start();
$id=$_POST['id'];
$pw=$_POST['password'];
$mysqli=mysqli_connect("localhost","sw","P@ssw0rd","sw");


$check="SELECT * FROM sign_info WHERE id='$id'";
$result=$mysqli->query($check);
if($result->num_rows==1){
    $row=$result->fetch_array(MYSQLI_ASSOC); //하나의 열을 배열로 가져오기
    if($row['password']==$pw){  //MYSQLI_ASSOC 필드명으로 첨자 가능
        $_SESSION['id']=$id;           //로그인 성공 시 세션 변수 만들기
        if(isset($_SESSION['id']))    //세션 변수가 참일 때
        {

          ?>      <script>
                  alert('로그인 성공.');
                  location.replace("/SW/index.php");
                  </script>

    <?php
        }
        else{
            echo "세션 저장 실패";
        }
    }
    else{
      ?>      <script>
              alert('로그인 실패.');
              location.replace("/SW/loginform.html");
              </script>

<?php
    }
}
else{
  ?>      <script>
          alert('로그인 실패.');
          location.replace("/SW/loginform.html");
          </script>

<?php
}
?>
