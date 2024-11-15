<?php
header('Content-Type: application/json');

// ID 값이 비어 있는 경우
if (!isset($_POST['id']) || empty($_POST['id'])) {
    echo json_encode(["status" => "error", "message" => "아이디를 입력해 주세요."]);
    exit;
}

$id = trim($_POST['id']);

// 데이터베이스 연결
$con = mysqli_connect("localhost", "root", "", "book_platform");

if (!$con) {
    echo json_encode(["status" => "error", "message" => "데이터베이스 연결 실패."]);
    exit;
}

// 중복 여부 확인
$sql = "SELECT * FROM users WHERE username = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    echo json_encode(["status" => "taken", "message" => "아이디가 중복됩니다. 다른 아이디를 사용해 주세요."]);
} else {
    echo json_encode(["status" => "available", "message" => "아이디는 사용 가능합니다."]);
}

mysqli_close($con);
?>
