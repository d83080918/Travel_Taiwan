<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Travel Taiwan｜探索台灣之美</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">



    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/all.min.css">

    <!-- 自訂CSS -->
    <link rel="stylesheet" href="/css/home.css">

</head>

<body>

    <!-- ================= NAVBAR ================= -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm sticky-top">

        <div class="container">

            <a class="navbar-brand fw-bold" href="/">
                <i class="bi bi-airplane"></i>
                Travel Taiwan
            </a>

            <button class="navbar-toggler"
                data-bs-toggle="collapse"
                data-bs-target="#navbar">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbar">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link active" href="#">首頁</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/attraction/list">
                            旅遊景點
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            熱門活動
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            旅遊攻略
                        </a>
                    </li>

                    @if(session()->has('memberId'))
                    @if(session('memberId') == 1)
                    <li class="nav-item">
                        <a href="/admin/adminhome" class="nav-link">管理員 {{ $member->userName }}</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-lg nav-link" id="logout1">
                            登出
                        </button>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="/member/home" class="nav-link">會員 {{ $member->userName }}</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-lg nav-link" id="logout2">
                            登出
                        </button>
                    </li>
                    @endif
                    @else
                    <li class="nav-item">
                        <button class="btn btn-lg nav-link" id="login">
                            登入
                        </button>
                    </li>
                    @endif

                </ul>

            </div>

        </div>

    </nav>

    <!-- ================= HERO CAROUSEL ================= -->

    <div id="heroCarousel"
        class="carousel slide carousel-fade"
        data-bs-ride="carousel"
        data-bs-interval="4000">

        <!-- 指示器 -->

        <div class="carousel-indicators">

            <button type="button"
                data-bs-target="#heroCarousel"
                data-bs-slide-to="0"
                class="active"></button>

            <button type="button"
                data-bs-target="#heroCarousel"
                data-bs-slide-to="1"></button>

            <button type="button"
                data-bs-target="#heroCarousel"
                data-bs-slide-to="2"></button>

            <button type="button"
                data-bs-target="#heroCarousel"
                data-bs-slide-to="3"></button>

        </div>

        <div class="carousel-inner">

            <!-- 第一張 -->

            <div class="carousel-item active">

                <img src="/images/banner/banner1.jpg"
                    class="d-block w-100 hero-img"
                    alt="台北101">

                <div class="carousel-caption">

                    <h1>探索台灣之美</h1>

                    <p>
                        Discover Amazing Taiwan
                    </p>

                    <a href="/attraction/list"
                        class="btn btn-success btn-lg">
                        開始探索
                    </a>

                </div>

            </div>

            <!-- 第二張 -->

            <div class="carousel-item">

                <img src="/images/banner/banner2.jpg"
                    class="d-block w-100 hero-img"
                    alt="日月潭">

                <div class="carousel-caption">

                    <h1>山海美景 一次收藏</h1>

                    <p>
                        從高山到海岸，感受台灣最迷人的風景。
                    </p>

                    <a href="/attraction/list"
                        class="btn btn-success btn-lg">
                        更多景點
                    </a>

                </div>

            </div>

            <!-- 第三張 -->

            <div class="carousel-item">

                <img src="/images/banner/banner3.jpg"
                    class="d-block w-100 hero-img"
                    alt="阿里山">

                <div class="carousel-caption">

                    <h1>體驗在地文化</h1>

                    <p>
                        夜市、美食、古蹟與人文風情，一次滿足。
                    </p>

                    <a href="#"
                        class="btn btn-success btn-lg">
                        熱門活動
                    </a>

                </div>

            </div>

            <!-- 第四張 -->

            <div class="carousel-item">

                <img src="/images/banner/banner4.jpg"
                    class="d-block w-100 hero-img"
                    alt="太魯閣">

                <div class="carousel-caption">

                    <h1>規劃你的台灣旅程</h1>

                    <p>
                        找尋屬於你的旅遊攻略，立即出發。
                    </p>

                    <a href="#"
                        class="btn btn-success btn-lg">
                        查看攻略
                    </a>

                </div>

            </div>

        </div>

        <!-- 左右控制 -->

        <button class="carousel-control-prev"
            type="button"
            data-bs-target="#heroCarousel"
            data-bs-slide="prev">

            <span class="carousel-control-prev-icon"></span>

        </button>

        <button class="carousel-control-next"
            type="button"
            data-bs-target="#heroCarousel"
            data-bs-slide="next">

            <span class="carousel-control-next-icon"></span>

        </button>

    </div>

    <!-- 第二部分會從這裡開始 -->

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery-4.0.0.js"></script>
    <script src="/js/home.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#login").on("click", function() {
            location.href =
                "/member/login?redirect=" +
                encodeURIComponent(location.href);
        });

        $("#logout1,#logout2").on("click", function() {
            Swal.fire({
                title: "確定要登出嗎?",
                showDenyButton: true,
                confirmButtonText: "確定",
                denyButtonText: `取消`
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/member/logout",
                        type: "POST",
                        data: {
                            _token: "{{csrf_token()}}"
                        },
                        success: function(res) {

                            if (res.status == "success") {
                                Swal.fire({
                                    title: "登出成功",
                                    confirmButtonText: "確定",
                                    icon: "success"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.href = "/attraction/home";
                                    }
                                });
                            }

                        }
                    });
                }
            });
        });
    </script>

</body>

</html>