<?php
    $id   = $_POST["id"];
    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $email1  = $_POST["email1"];
    $email2  = $_POST["email2"];
    
    $upload_dir = './uploads/';
    $profile_image = $_FILES['profile_image']['name'];

    $email = $email1 . "@" . $email2;
    $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

    // 파일 업로드 처리
    if ($profile_image) {
    $profile_image_tmp = $_FILES['profile_image']['tmp_name'];
    $profile_image_name = time() . "_" . $profile_image;
    $uploaded_file = $upload_dir . $profile_image_name;

    // 디버깅용 출력
    echo "임시 파일 경로: $profile_image_tmp<br>";
    echo "목적지 파일 경로: $uploaded_file<br>";

    if (!move_uploaded_file($profile_image_tmp, $uploaded_file)) {
        echo "
        <script>
            alert('파일 업로드 실패! 다시 시도하세요.');
            history.back();
        </script>
        ";
        exit;
    }
} else {
    echo "
    <script>
        alert('파일이 선택되지 않았습니다!');
        history.back();
    </script>
    ";
    exit;
}


    $con = mysqli_connect("localhost", "root", "", "book_platform");

    // SQL 작성 시 문자열 값을 안전하게 처리
    $profile_image_sql = $profile_image_name ? "'$profile_image_name'" : "NULL";
    $sql = "INSERT INTO users (username, password, nickname, email, created_at, profile_image) ";
    $sql .= "VALUES ('$id', '$pass', '$name', '$email', '$regist_day', $profile_image_sql)";

    mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    mysqli_close($con);

    echo "
          <script>
              location.href = 'index.php';
          </script>
      ";
?>
