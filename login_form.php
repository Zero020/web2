<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>독서플랫폼 로그인</title>
<link rel="stylesheet" type="text/css" href="./css/loginbackground.css">
<link rel="stylesheet" type="text/css" href="./css/login.css">
<script type="text/javascript" src="./js/login.js"></script>
</head>
<body> 
	<section>
        <div id="main_content">
            <div class="form-container">
                <div class="left-title">
                    <h2>PAGE</h2>
                    <h3>by</h3>
                    <h2>PAGE</h2>
                    <div class="button_signup">
                        <button type="button" class="signup-btn" onclick="location.href='member_form.php'">회원가입</button>
                    </div>
                </div>
                <div class="login_form">
                    <div class="login_title">
                        <span>로그인</span>
                    </div>
                    <form name="login_form" method="post" action="login.php">
                        <ul>
                            <li>
                                <input type="text" name="username" placeholder="아이디">
                            </li>
                            <li>
                                <input type="password" id="password" name="password" placeholder="비밀번호">
                            </li>
                        </ul>
                        <div id="login_btn">
                      	<a href="#"><img src="./img/login.png" onclick="check_input()"></a>
                  		</div>		
                    </form>
                </div>
            </div>
        </div>
	</section> 
	<footer>
    	<?php include "footer.php";?>
    </footer>
</body>
</html>

