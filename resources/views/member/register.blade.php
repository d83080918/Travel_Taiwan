<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員註冊</title>
    <link rel="stylesheet" href="/css/all.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">


    <style>
        body {
            background-color: #f5f5f5;
        }

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .container-box {
            max-width: 500px;
            margin: auto;
            padding-top: 50px;
        }

        .form-title {
            text-align: center;
            margin-bottom: 25px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container container-box">
        <div class="card">
            <div class="card-body p-4">
                <h2 class="form-title">會員註冊</h2>

                <form action="/member/store" method="POST" onsubmit="return checkdata()">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">姓名</label>
                        <input type="text" name="userName" id="userName" class="form-control" placeholder="請輸入姓名" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">信箱</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="請輸入 Email" required onblur="checkemail()" />
                        <div id="msg"></div>
                        <div class="valid-feedback text-success">輸入正確</div>
                        <div class="invalid-feedback text-danger">請輸入正確信箱</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">手機</label>
                        <input type="tel" name="phone" id="phone" class="form-control" placeholder="請輸入手機號碼" required>
                        <div class="valid-feedback text-success">輸入正確</div>
                        <div class="invalid-feedback text-danger">請輸入正確手機號碼</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">生日</label>
                        <input type="date" name="birthday" id="birthday" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">密碼</label>
                        <input type="password" name="pwd" id="pwd" class="form-control" placeholder="請輸入密碼" required>
                        <div id="inview1" style="display:none;">
                            <i class="fa-solid fa-eye-slash" id="view1"></i>
                        </div>
                        <div class="valid-feedback text-success">輸入正確</div>
                        <div class="invalid-feedback text-danger">請輸入正確密碼(需要有大小寫英文字母和數字)</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">確認密碼</label>
                        <input type="password" name="pwd2" id="pwd2" class="form-control" placeholder="再次輸入密碼" required>
                        <div id="inview2" style="display:none;">
                            <i class="fa-solid fa-eye-slash" id="view2"></i>
                        </div>
                        <div class="valid-feedback text-success">輸入正確</div>
                        <div class="invalid-feedback text-danger">與密碼不符</div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-success" id="confirm">
                            註冊會員
                        </button>
                    </div>

                </form>

            </div>
        </div>




    </div>

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery-4.0.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let flag_email = false;
        let flag_phone = false;
        let flag_pwd = false;
        let flag_pwd2 = false;


        $(function() {
            $("#email").on("input", function() {
                let email = $(this).val().trim();
                let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                if (email === "") {
                    $(this).removeClass("is-valid is-invalid");
                    return;
                }
                if (emailPattern.test(email)) {
                    $(this).removeClass("is-invalid").addClass("is-valid");
                    flag_email = true;
                } else {
                    $(this).removeClass("is-valid").addClass("is-invalid");
                    flag_email = false;
                }
            });


            $("#phone").on("input", function() {
                let phone = $(this).val().trim();
                let phonePattern = /^09\d{8}$/;

                if (phonePattern.test(phone)) {
                    $(this).removeClass("is-invalid").addClass("is-valid");
                    flag_phone = true;
                } else {
                    $(this).removeClass("is-valid").addClass("is-invalid");
                    flag_phone = false;
                }
            });
            $("#pwd").on("input", function() {
                let pwd = $(this).val().trim();
                let pwdPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/;

                if ($(this).val().trim() == "") {
                    $("#inview1").hide();
                } else {
                    $("#inview1").show();
                }

                if (pwdPattern.test(pwd)) {
                    $(this).removeClass("is-invalid").addClass("is-valid");
                    flag_pwd = true;
                } else {
                    $(this).removeClass("is-valid").addClass("is-invalid");
                    flag_pwd = false;
                }
            });
            $("#pwd2").on("input", function() {
                let pwd2 = $(this).val().trim();

                if ($(this).val().trim() == "") {
                    $("#inview2").hide();
                } else {
                    $("#inview2").show();
                }

                if (pwd2 == $("#pwd").val().trim()) {
                    $(this).removeClass("is-invalid").addClass("is-valid");
                    flag_pwd2 = true;
                } else {
                    $(this).removeClass("is-valid").addClass("is-invalid");
                    flag_pwd2 = false;
                }
            });

            $("#view1").on("click", function() {
                if ($("#pwd").attr("type") == "password") {
                    $("#pwd").remove("type", "password").attr("type", "text");
                    $("#view1").removeClass("fa-eye-slash").addClass("fa-eye");
                } else {
                    $("#pwd").remove("type", "text").attr("type", "password");
                    $("#view1").removeClass("fa-eye").addClass("fa-eye-slash");
                }
            });

            $("#view2").on("click", function() {
                if ($("#pwd2").attr("type") == "password") {
                    $("#pwd2").remove("type", "password").attr("type", "text");
                    $("#view2").removeClass("fa-eye-slash").addClass("fa-eye");
                } else {
                    $("#pwd2").remove("type", "text").attr("type", "password");
                    $("#view2").removeClass("fa-eye").addClass("fa-eye-slash");
                }
            });
        });

        function checkemail() {
            var email = $("#email").val().trim();
            if (email != "") {
                $.ajax({
                    url: "/api/member/checkemail",
                    type: "get",
                    dataType: "json",
                    data: {
                        email: email,
                        _token: "{{csrf_token()}}"
                    },
                    success: function(item) {
                        console.log(item.msg);
                        if (item.msg.trim() == "Y") {
                            $("#msg").html("<font color='red'>Email已註冊過</font>");
                            $("#email").focus();
                            $("#email").removeClass("is-valid");
                            flag_email = false;
                        } else {
                            flag_email = true;
                            $("#msg").html("<font color='green'>Email可註冊</font>");
                        }
                    }
                });
            }
        }

        function checkdata() {
            if (!(flag_email && flag_phone && flag_pwd && flag_pwd2)) {
                Swal.fire({
                    title: "欄位錯誤",
                    text: "資料錯誤，請修正!",
                    icon: "error"
                });
                return false;
            } else {
                Swal.fire({
                    title: "創建成功",
                    icon: "success"
                }).then(() => {
                    document.forms[0].submit();
                });
                return false;
            }
        }
    </script>
</body>

</html>