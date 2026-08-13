<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield("title")</title>
    <link rel="stylesheet" href="/css/all.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    @stack("style")
    <style>
        nav {
            font-family: "Noto Sans TC", sans-serif;
        }

        .navbar {

            transition: .3s;

            padding: 15px 0;

        }

        .navbar-brand {

            font-size: 1.5rem;

            letter-spacing: 1px;

        }

        .navbar .nav-link {

            color: #fff !important;

            margin-left: 12px;

            transition: .3s;

            font-weight: 500;

        }

        /* 後台下拉選單 */
        .dropdown-menu {
            background-color: #FFFFFF;
            border: 1px solid #198754;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 8px 0;
        }

        /* 下拉選單文字 */
        .dropdown-menu .dropdown-item {
            color: #343A40;
            padding: 10px 20px;
            transition: all 0.2s ease;
        }

        /* Hover */
        .dropdown-menu .dropdown-item:hover {
            background-color: #DDF3E8;
            color: #146C43;
        }

        /* 點擊 / focus */
        .dropdown-menu .dropdown-item:focus,
        .dropdown-menu .dropdown-item:active {
            background-color: #C8EBD8;
            color: #146C43;
        }



        .navbar .nav-link:hover {

            color: #ffe082 !important;

        }

        .navbar .nav-link.active {

            color: #ffd54f !important;

        }

        @media(max-width:768px) {

            .navbar-brand {

                font-size: 1.2rem;

            }

        }

        @media(max-width:375px) {
            .dropdown-item {
                text-align: center;
            }
        }

        .page-title {
            color: #146c43;
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: 2px;
            padding: 18px 0;
            position: relative;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm sticky-top">

        <div class="container">

            <a class="navbar-brand fw-bold" href="#">
                <i class="bi bi-airplane"></i>
                Taiwan Travel 景點後台管理
            </a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbar">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbar">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="/attraction/home/">首頁</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/attraction/list/">景點列表</a>
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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            後臺系統
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item " href="/admin/adminhome">管理景點</a></li>
                            <li><a class="dropdown-item " href="/admin/adminchart">圖表資料</a></li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <div class="nav-link">
                            管理員 {{ $member->userName }}
                        </div>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-lg nav-link" id="logout">
                            登出
                        </button>
                    </li>
                    @endif
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div class="fw-bold text-center page-title">@yield("title2")</div>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery-4.0.0.js"></script>
    <script src="/js/member/logout.js"></script>
    <script src="/js/member/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script>
        window.memberId = "{{ session('memberId') }}";
    </script>
    @yield("content")
</body>

</html>