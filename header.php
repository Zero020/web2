<?php
    if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
    if (isset($_SESSION["username"])) $userid = $_SESSION["username"];
    else $userid = "";
    if (isset($_SESSION["nickname"])) $username = $_SESSION["nickname"];
    else $username = "";
?>
<header>
    <div class="logo">
        <h1><a href="index.php">···  PAGE BY PAGE ···</a></h1>
    </div>
    <nav>
        <ul>
            <li><a href="about.php">소개</a></li>
            <li><a href="board.php">게시판</a></li>
            <li><a href="calendar.php">캘린더</a></li>
        </ul>
    </nav>
    <ul id="top_menu">  
<?php
    if(!$userid) {
?>                
        <li><a href="login_form.php">로그인</a></li>
<?php
    } else {
?>
        <li><a href="logout.php">로그아웃</a></li>
        <li><a href="member_modify_form.php">정보수정</a></li>
<?php
    }
?>
    </ul>
</header>