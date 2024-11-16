<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>독서플랫폼</title>
<link rel="stylesheet" type="text/css" href="./css/loginbackground.css">
<link rel="stylesheet" type="text/css" href="./css/member.css">
<script>

   function check_input()
   {
      if (!document.member_form.id.value) {
          alert("아이디를 입력하세요!");    
          document.member_form.id.focus();
          return;
      }

      if (!document.member_form.pass.value) {
          alert("비밀번호를 입력하세요!");    
          document.member_form.pass.focus();
          return;
      }

      if (!document.member_form.pass_confirm.value) {
          alert("비밀번호확인을 입력하세요!");    
          document.member_form.pass_confirm.focus();
          return;
      }

      if (!document.member_form.name.value) {
          alert("이름을 입력하세요!");    
          document.member_form.name.focus();
          return;
      }

      if (!document.member_form.email1.value) {
          alert("이메일 주소를 입력하세요!");    
          document.member_form.email1.focus();
          return;
      }

      if (!document.member_form.email2.value) {
          alert("이메일 주소를 입력하세요!");    
          document.member_form.email2.focus();
          return;
      }

      if (document.member_form.pass.value != 
            document.member_form.pass_confirm.value) {
          alert("비밀번호가 일치하지 않습니다.\n다시 입력해 주세요!");
          document.member_form.pass.focus();
          document.member_form.pass.select();
          return;
      }


       if (!document.member_form.profile_image.value) {
        alert("프로필 사진을 선택하세요!");
        document.member_form.profile_image.focus();
        return;
    	}

      document.member_form.submit();
   }

   function reset_form() {
      document.member_form.id.value = "";  
      document.member_form.pass.value = "";
      document.member_form.pass_confirm.value = "";
      document.member_form.name.value = "";
      document.member_form.email1.value = "";
      document.member_form.email2.value = "";
      document.member_form.id.focus();
      return;
   }

   function check_id() {
     window.open("member_check_id.php?id=" + document.member_form.id.value,
         "IDcheck",
          "left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes");
   }
  function checkAvailability() {
    const idInput = document.getElementById("id");
    const message = document.getElementById("availability-message");

    if (!idInput.value.trim()) {
        message.textContent = "아이디를 입력해 주세요.";
        message.style.color = "red";
        return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "member_check_id.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.status === "available") {
                message.textContent = response.message;
                message.style.color = "green";
            } else if (response.status === "taken") {
                message.textContent = response.message;
                message.style.color = "red";
            } else {
                message.textContent = "오류가 발생했습니다.";
                message.style.color = "red";
            }
        }
    };
    xhr.send("id=" + encodeURIComponent(idInput.value));
}
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form[name='member_form']");
    const inputs = form.querySelectorAll("input");
    const submitButton = document.querySelector(".submit-btn");

    function checkFormCompletion() {
        let allFilled = true;
        inputs.forEach((input) => {
            if (!input.value.trim()) {
                allFilled = false;
            }
        });
        submitButton.disabled = !allFilled;
        submitButton.style.opacity = allFilled ? "1" : "0.6";
    }

    inputs.forEach((input) => {
        input.addEventListener("input", checkFormCompletion);
    });

    checkFormCompletion();
	});
	
	document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form[name='member_form']");
    const inputs = form.querySelectorAll("input");
    const submitButton = document.querySelector(".submit-btn");
    const passwordInput = form.querySelector("input[name='pass']");
    const confirmPasswordInput = form.querySelector("input[name='pass_confirm']");
    const confirmPasswordMessage = document.createElement("span");

    confirmPasswordMessage.style.fontSize = "12px";
    confirmPasswordMessage.style.color = "red";
    confirmPasswordInput.parentNode.appendChild(confirmPasswordMessage);

    function checkFormCompletion() {
        let allFilled = true;

        inputs.forEach((input) => {
            if (!input.value.trim()) {
                allFilled = false;
            }
        });

        if (confirmPasswordInput.value && confirmPasswordInput.value !== passwordInput.value) {
            confirmPasswordMessage.textContent = "비밀번호가 일치하지 않습니다.";
            allFilled = false;
        } else {
            confirmPasswordMessage.textContent = "";
        }

        submitButton.disabled = !allFilled;
        submitButton.style.opacity = allFilled ? "1" : "0.6";
    }

    inputs.forEach((input) => {
        input.addEventListener("input", checkFormCompletion);
    });

    checkFormCompletion();
});
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById("profile-preview");

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

</script>
</head>
<body> 
	<section>
		<div id="main_img">
        </div>
        <div id="main_content">
      		<div id="join_box">
          	<form  name="member_form" method="post" action="member_insert.php" enctype="multipart/form-data">
			    <h2>회원가입</h2>
			    <div class = "form-container">
			    		<div class = "form-left">
	    		    	<div class="form id">
							    <div class="col1">계정 ID</div>
								    <div class="col2" style="position: relative;">
								        <input type="text" id="id" name="id" placeholder="아이디를 입력하세요" onblur="checkAvailability()">
								        <span id="availability-message" class="error-message"></span>
								    </div>
									</div>
			        	<div class="clear"></div>

			        	<div class="form">
					        <div class="col1">비밀번호</div>
						        <div class="col2">
											<input type="password" name="pass" placeholder="비밀번호를 입력해 주세요">
						        </div>                 
			        	</div>

			        	<div class="clear"></div>
			        	<div class="form">
					        <div class="col1">비밀번호 확인</div>
						        <div class="col2" style="position: relative;">
		                	<input type="password" id="password_confirm" name="pass_confirm" placeholder="한번 더 비밀번호를 입력해 주세요">
						        </div>                 
			        	</div>
			       </div>

			      <div class = "form-right">
			      	<div class = "profile-container">
				        <div class="col1">프로필 설정</div>
				      	<div class="profile-image-wrapper">
									<img id="profile-preview" src="./img/default-profile.png" alt="프로필 사진">
									<div class="profile-image-icon">
										<label for="profile-upload" class="upload-icon">
											<img src="./img/upload-icon.png" alt="업로드">
										</label>
									</div>
									<input type="file" id="profile-upload" name="profile_image" accept="image/*" onchange="previewImage(event)" style="display: none;">
							</div>
				      </div>
			      	<div class="clear"></div>
			        	<div class = "form">
			        	<div class = "col1">사용자 이름</div>
			        	<div class="col2">
							<input type="text" name="name" placeholder="사용할 별칭을 적어주세요">
				        </div>                 
			        	</div>
			        	<div class="clear"></div>
			        	<div class="form email">
				        <div class="col1">이메일</div>
				        <div class="col2">
						        <div class="email-container">
						            <input type="text" name="email1" placeholder="이메일 주소">
						            <span>@</span>
						            <input type="text" name="email2">
						        </div>
						    </div>            
			        	</div>
			       </div>
			     </div>

		        	<div class="clear"></div>
		        	<div class="bottom_line"> </div>
		        	<div class="buttons">
									<button type="button" class="submit-btn" onclick="check_input()" disabled>시작하기</button>
	            	</div>
           	</form>
        	</div> <!-- join_box -->
        </div> <!-- main_content -->
	</section> 
	<footer>
    	<?php include "footer.php";?>
    </footer>
</body>
</html>
