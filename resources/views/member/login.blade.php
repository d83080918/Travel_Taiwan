<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員系統</title>

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

                <h2 class="form-title">會員登入</h2>

                <form action="/member/dologin" method="POST">
                    @csrf
                    <input type="hidden" name="redirect" value="{{ request('redirect') }}">
                    <div class="mb-3">
                        <label class="form-label">帳號 (Email)</label>
                        <input type="email" name="email" class="form-control" placeholder="請輸入信箱" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">密碼</label>
                        <input type="password" name="pwd" id="pwd" class="form-control" placeholder="請輸入密碼" required>
                        <div id="inview1" style="display:none;">
                            <i class="fa-solid fa-eye-slash" id="view1"></i>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            登入
                        </button>
                    </div>
                </form>
                @if($errors->has("err"))
                <div style="color:red">帳號或密碼錯誤，請再試一次。</div>
                @endif
                <div class="text-center mt-3">
                    <a href="/member/register">會員註冊</a>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery-4.0.0.js"></script>
    <script>
        $(function() {
            $("#pwd").on("input", function() {

                if ($(this).val().trim() == "") {
                    $("#inview1").hide();
                } else {
                    $("#inview1").show();
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
        });
    </script>
</body>

</html>