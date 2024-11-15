<?php
    $id   = $_POST["email"];
    $pass = $_POST["password"];

    $con = mysqli_connect("localhost", "root", "", "book_platform");
   $sql = "select * from users where email='$email'";
   $result = mysqli_query($con, $sql);

   $num_match = mysqli_num_rows($result);

   if(!$num_match) 
   {
     echo("
           <script>
             window.alert('등록되지 않은 이메일입니다!')
             history.go(-1)
           </script>
         ");
    }
    else
    {
        $row = mysqli_fetch_array($result);
        $db_pass = $row["password"];

        mysqli_close($con);

        if($pass != $db_pass)
        {

           echo("
              <script>
                window.alert('비밀번호가 틀립니다!')
                history.go(-1)
              </script>
           ");
           exit;
        }
        else
        {
            session_start();
            $_SESSION["userid"] = $row[""];
            $_SESSION["username"] = $row["name"];

            echo("
              <script>
                location.href = 'index.php';
              </script>
            ");
        }
     }        
?>
