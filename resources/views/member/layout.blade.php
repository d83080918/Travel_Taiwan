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
            cursor: pointer;
        }

        .navbar .nav-link:hover {

            color: #ffe082 !important;

        }

        .navbar .nav-link.active {

            color: #ffd54f !important;

        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm sticky-top">

        <div class="container ">

            <a class="navbar-brand fw-bold" href="/attraction/home/">
                <i class="bi bi-airplane"></i>
                Travel Taiwan
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
                        <a class="nav-link " href="/attraction/list">
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
                    <li class="nav-item">
                        <a class="nav-link" href="/attraction/hotel">
                            旅館查詢
                        </a>
                    </li>
                    @if(session()->has('memberId'))
                    @if(session('memberId') == 1)
                    <li class="nav-item">
                        <a href="/admin/adminhome" class="nav-link">管理員 {{ $member->userName }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="logout1">
                            登出
                        </a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="/member/home" class="nav-link active">會員 {{ $member->userName }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="logout2">
                            登出
                        </a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item">
                        <a class="nav-link" id="login">
                            登入
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery-4.0.0.js"></script>
    <script src="/js/member/logout.js"></script>
    <script src="/js/member/login.js"></script>
    <script src="/js/vue.global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.memberId = "{{ session('memberId') }}";
    </script>
    @yield("content")
</body>

</html>