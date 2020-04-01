<?php

        $connect = mysqli_connect('localhost', 'sw', 'P@ssw0rd', 'sw') or die("fail");


        $id=$_POST['userid'];
        $password=$_POST['password_encrypted'];
        $password2=$_POST['passwordcheck_encrypted'];
        $name=$_POST['name'];
        $phone_number=$_POST['tel'];





        //입력받은 데이터를 DB에 저장
        $query = "insert into sign_info (id, password, name, phone_number) values ('$id', '$password', '$name', '$phone_number')";


        $result = $connect->query($query);

        //저장이 됬다면 (result = true) 가입 완료
        if($result) {
        ?>      <script>
                alert('가입 되었습니다.');
                location.replace("/SW/loginform.html");
                </script>

<?php   }


        else{
?>              <script>

                        alert("fail");
                </script>
<?php   }

        mysqli_close($connect);
?>
