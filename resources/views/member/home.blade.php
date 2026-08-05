<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>會員中心</title>
    <link rel="stylesheet" href="/css/all.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/member/attsearch.css">
    <link rel="stylesheet" href="/css/member/member.css">

    <style>

    </style>

</head>

<body>

    <div class="member-container">
        <div class="sidebar">
            <h2>會員中心</h2>
            <ul>
                <li class="active" onclick="showPage(0,this)">會員資料</li>
                <li onclick="showPage(1,this)">編輯會員資料</li>
                <li onclick="showPage(2,this)">修改密碼</li>
                <li onclick="showPage(3,this)">收藏景點</li>
            </ul>
        </div>
        <div class="content">
            <!--會員資料-->
            <div class="page active">
                <h3>會員資料</h3>
                <div class="info">
                    <span>會員姓名：</span>{{$member->userName}}
                </div>
                <div class="info">
                    <span>信箱：</span>{{$member->email}}
                </div>
                <div class="info">
                    <span>電話：</span>{{$member->phone}}
                </div>
                <div class="info">
                    <span>生日：</span>{{ $member->birthday->format('Y-m-d') }}
                </div>
                <div class="info">
                    <span>密碼：</span>
                    <span><i class="fa-solid fa-eye-slash" id="viewbtn"></i></span>
                    <span id="view1" style="display:inline">********</span>
                    <span id="view2" style="display:none">{{$member->pwd}}</span>
                </div>
            </div>
            <!--編輯會員資料-->
            <div class="page">
                <h3>編輯會員資料</h3>
                <form action="/member/update" method="POST" id="updateForm1">
                    @csrf
                    <div class="form-group">
                        <label>姓名</label>
                        <input type="text" id="userName" name="userName"
                            value="{{$member->userName}}">
                    </div>

                    <div class="form-group">
                        <label>信箱</label>
                        <input type="email" id="email" name="email" value="{{$member->email}}" onblur="checkemail()">
                        <div id="msg"></div>
                    </div>

                    <div class="form-group">
                        <label>電話</label>
                        <input type="text" id="phone" name="phone" value="{{$member->phone}}">
                    </div>

                    <div class="form-group">
                        <label>生日</label>
                        <input type="date" id="birthday" name="birthday" value="{{$member->birthday->format('Y-m-d') }}">
                    </div>

                    <button type="submit">
                        儲存修改
                    </button>

                </form>

            </div>

            <!--修改密碼-->

            <div class="page">

                <h3>修改密碼</h3>
                <div class="" id="msg"></div>
                <form id="updateForm2" action="/member/updatepwd" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>舊密碼</label>
                        <input type="password" name="pwd" id="oldpwd" onblur="checkpwd()">
                        <div class="" id="msg2"></div>
                    </div>

                    <div class="form-group">
                        <label>新密碼</label>
                        <input type="password" name="newpwd1" id="newpwd1" class="form-control" placeholder="請輸入新密碼" required>
                        <div id="inview1" style="display:none;">
                            <i class="fa-solid fa-eye-slash" id="view3"></i>
                        </div>
                        <div class="valid-feedback text-success">輸入正確</div>
                        <div class="invalid-feedback text-danger">請輸入正確密碼(需要有大小寫英文字母和數字)</div>
                    </div>

                    <div class="form-group">
                        <label>確認新密碼</label>
                        <input type="password" name="newpwd2" id="newpwd2" class="form-control" placeholder="再次輸入新密碼" required>
                        <div id="inview2" style="display:none;">
                            <i class="fa-solid fa-eye-slash" id="view4"></i>
                        </div>
                        <div class="valid-feedback text-success">輸入正確</div>
                        <div class="invalid-feedback text-danger">與密碼不符</div>
                    </div>

                    <button type="submit">
                        修改密碼
                    </button>

                </form>

            </div>

            <!-- 收藏的景點 -->
            <div class="page">
                <h3>收藏的景點</h3>
                <div class="card search-card shadow-sm border-0 p-4 mb-4">
                    <div class="row g-3">

                        <!-- 搜尋 -->

                        <div class="col-lg-4">
                            <label class="form-label">景點搜尋</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input id="keyword" type="text" class="form-control" placeholder="輸入景點名稱">
                            </div>
                        </div>
                        <!-- 區域 -->
                        <div class="col-lg-2 text-center">
                            <label class="form-label">區域</label>
                            <select id="area" class="form-select">
                                <option value="">全台</option>
                                <option value="east">東部</option>
                                <option value="north">北部</option>
                                <option value="west">西部</option>
                                <option value="south">南部</option>
                                <option value="island">外島</option>
                            </select>
                        </div>

                        <!-- 城市 -->

                        <div class="col-lg-2 text-center">
                            <label class="form-label">城市</label>
                            <select id="city" class="form-select">
                                <option value="">全部城市</option>
                                <option value="1">台北市</option>
                                <option value="2">新北市</option>
                                <option value="3">基隆市</option>
                                <option value="4">桃園市</option>
                                <option value="5">新竹縣</option>
                                <option value="6">新竹市</option>
                                <option value="7">苗栗縣</option>
                                <option value="8">台中市</option>
                                <option value="9">彰化縣</option>
                                <option value="10">南投縣</option>
                                <option value="11">雲林縣</option>
                                <option value="12">嘉義縣</option>
                                <option value="13">嘉義市</option>
                                <option value="14">台南市</option>
                                <option value="15">高雄市</option>
                                <option value="16">屏東縣</option>
                                <option value="17">宜蘭縣</option>
                                <option value="18">花蓮縣</option>
                                <option value="19">台東縣</option>
                                <option value="20">澎湖縣</option>
                                <option value="21">金門縣</option>
                                <option value="22">連江縣</option>
                            </select>
                        </div>

                        <!-- 分類 -->

                        <div class="col-lg-2 text-center">
                            <label class="form-label">分類</label>
                            <select id="classid" class="form-select">
                                <option value="">全部分類</option>
                                <option value="1">自然景觀</option>
                                <option value="2">山岳</option>
                                <option value="3">海邊</option>
                                <option value="4">古蹟</option>
                                <option value="5">夜市</option>
                                <option value="6">老街</option>
                                <option value="7">文化園區</option>
                            </select>
                        </div>
                        <!-- 筆數 -->

                        <div class="col-lg-2 text-center">
                            <label class="form-label">景點數</label>
                            <div class="result-count">共<span id="totalCount"></span>筆</div>
                        </div>
                    </div>
                </div>
                <div class="row g-4" id="attractions">
                    <!-- app.js 動態產生 -->
                </div>
                <div class="">
                    <nav>
                        <ul class="pagination justify-content-center" id="pagination">
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="text-danger fw-900"></div>
    </div>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery-4.0.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.memberId = "{{ session('memberId') }}";
    </script>
    <script src="/js/member/attsearch.js"></script>
    <script>
        const pages = document.querySelectorAll(".page");
        const menus = document.querySelectorAll(".sidebar li");


        function showPage(index, element) {

            pages.forEach(page => {
                page.classList.remove("active");
            });

            menus.forEach(menu => {
                menu.classList.remove("active");
            });

            pages[index].classList.add("active");
            element.classList.add("active");
            if (index == 3) {
                getFavoriteList();
            }
        }

        $("#viewbtn").on("click", function() {
            if ($("#view1").is(":visible")) {
                $("#view1").hide();
                $("#view2").show();
                $("#viewbtn").removeClass("fa-eye-slash").addClass("fa-eye");
            } else {
                $("#view1").show();
                $("#view2").hide();
                $("#viewbtn").removeClass("fa-eye").addClass("fa-eye-slash");
            }
        });
        // $("#viewbtn").click(function() {

        //     $("#view1, #view2").toggle();

        //     $(this).toggleClass("fa-eye fa-eye-slash");

        // });
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
                            $("#msg").html("<font color='green'>Email可修改</font>");
                        }
                    }
                });
            }
        }


        $("#updateForm1").on("submit", function(e) {

            e.preventDefault(); // 永遠先阻止

            let email = $("#email").val().trim();
            let phone = $("#phone").val().trim();

            let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            let phonePattern = /^09\d{8}$/;

            if (!emailPattern.test(email) || !phonePattern.test(phone)) {

                Swal.fire({
                    title: "欄位錯誤",
                    text: "資料錯誤，請修正！",
                    icon: "error"
                });

                return;
            }

            Swal.fire({
                title: "修改成功",
                icon: "success"
            }).then(() => {
                this.submit();
            });
        });

        function checkpwd() {
            var pwd = $("#oldpwd").val().trim();
            if (pwd != "") {
                $.ajax({
                    url: "/api/member/checkpwd",
                    type: "get",
                    dataType: "json",
                    data: {
                        pwd: pwd,
                        _token: "{{csrf_token()}}"
                    },
                    success: function(item) {
                        console.log(item.msg);
                        if (item.msg.trim() == "N") {
                            $("#msg2").html("<font color='red'>密碼錯誤</font>");

                        } else {
                            $("#msg2").html("<font color='green'>密碼正確</font>");
                        }
                    }
                });
            }
        }


        $("#newpwd1").on("input", function() {
            let pwd = $(this).val().trim();
            let pwdPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/;

            if ($(this).val().trim() == "") {
                $("#inview1").hide();
            } else {
                $("#inview1").show();
            }

            if (pwdPattern.test(pwd)) {
                $(this).removeClass("is-invalid").addClass("is-valid");

            } else {
                $(this).removeClass("is-valid").addClass("is-invalid");

            }
        });
        $("#newpwd2").on("input", function() {
            let pwd2 = $(this).val().trim();

            if ($(this).val().trim() == "") {
                $("#inview2").hide();
            } else {
                $("#inview2").show();
            }

            if (pwd2 == $("#newpwd1").val().trim()) {
                $(this).removeClass("is-invalid").addClass("is-valid");

            } else {
                $(this).removeClass("is-valid").addClass("is-invalid");

            }
        });

        $("#view3").on("click", function() {

            if ($("#newpwd1").attr("type") == "password") {
                $("#newpwd1").remove("type", "password").attr("type", "text");
                $(this).removeClass("fa-eye-slash").addClass("fa-eye");
            } else {
                $("#newpwd1").remove("type", "text").attr("type", "password");
                $(this).removeClass("fa-eye").addClass("fa-eye-slash");
            }
        });

        $("#view4").on("click", function() {
            if ($("#newpwd2").attr("type") == "password") {
                $("#newpwd2").remove("type", "password").attr("type", "text");
                $(this).removeClass("fa-eye-slash").addClass("fa-eye");
            } else {
                $("#newpwd2").remove("type", "text").attr("type", "password");
                $(this).removeClass("fa-eye").addClass("fa-eye-slash");
            }
        });

        $("#updateForm2").on("submit", function(e) {
            e.preventDefault();
            let form = this;
            Swal.fire({
                text: '確定要修改密碼嗎？',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '確定',
                cancelButtonText: '取消'
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }
            });

        });
        $(document).on("click", ".favorite", function() {
            console.log("收藏按鈕被點了");
            const memberId = window.memberId;
            console.log("會員ID:", memberId);

            Swal.fire({
                icon: "question",
                title: "確定要取消收藏嗎",
                showCancelButton: true,
                confirmButtonText: "確定",
                cancelButtonText: "取消"
            }).then((result) => {
                if (result.isConfirmed) {
                    let btn = $(this);
                    $.ajax({
                        url: "/attraction/addfavorite",
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            attractionId: btn.data("id")
                        },
                        success: function(res) {

                            if (res.status == "add") {
                                btn.addClass("active");
                                btn.html("已收藏❤️");
                                loadData();
                            } else {
                                btn.removeClass("active");
                                btn.html("收藏🤍");
                                loadData();
                            }


                        }
                    });
                }
            });
        });
    </script>

</body>

</html>