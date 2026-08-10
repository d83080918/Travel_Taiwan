<!DOCTYPE html>
<html lang="zh-TW">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        景點管理後台 | Taiwan Travel
    </title>

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/all.min.css">


    <style>
        body {
            background: #f5f6fa;
            font-family: "Noto Sans TC", sans-serif;
        }


        /* Content */
        .content {
            padding: 100px;
        }

        /* Card */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .08);
        }

        /* Table */
        table {
            vertical-align: middle;
            width: 100%;
            table-layout: fixed;
        }

        .table img {
            width: 300px;
            height: 210px;
            object-fit: cover;
            border-radius: 10px;
        }

        .badge-category {
            background: #198754;
        }

        /* Button */
        .btn-add {
            border-radius: 30px;
            padding: 10px 25px;
        }

        /* Mobile */
        @media(max-width:768px) {
            .sidebar {
                position: relative;
                width: 100%;
                top: 0;
                min-height: auto;
            }

            .content {
                margin-left: 0;
            }
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

        /* table */
        .attraction-table {

            table-layout: fixed;
            width: 100%;
        }

        .attraction-table td,
        .attraction-table th {

            vertical-align: middle;
            word-break: break-word;
        }

        .attraction-img {

            width: 100%;
            max-width: 220px;
            height: 140px;
            object-fit: cover;
            border-radius: 8px;
        }

        .badge-category {

            background: #0d6efd;
            color: #fff;
            padding: 8px 12px;
            border-radius: 20px;
        }

        .action-group {

            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .action-group .btn {

            min-height: 36px;
        }


        /* ---------- Tablet ---------- */

        @media (max-width:991px) {

            .attraction-img {

                height: 120px;
            }

        }


        /* ---------- Phone ---------- */

        @media (max-width:768px) {

            .table-responsive {

                overflow-x: visible !important;
            }

            .attraction-table {

                border: 0;
            }

            .attraction-table thead {

                display: none;
            }

            .attraction-table,
            .attraction-table tbody,
            .attraction-table tr,
            .attraction-table td {

                display: block;
                width: 100%;
            }

            .attraction-table tr {

                margin-bottom: 20px;
                border-radius: 12px;
                background: #fff;
                box-shadow: 0 2px 8px rgba(0, 0, 0, .1);
                padding: 15px;
            }

            .attraction-table td {

                border: none;
                padding: 10px 10px 10px 45%;
                position: relative;
                min-height: 40px;
            }

            .attraction-table td::before {

                content: attr(data-label);

                position: absolute;

                left: 15px;

                top: 10px;

                width: 38%;

                font-weight: 700;

                color: #198754;
            }

            .attraction-img {

                width: 100%;

                height: 180px;

                object-fit: cover;

                max-width: none;
            }

            .action-group {

                display: flex;

                flex-direction: column;

                gap: 10px;
            }

            .action-group .btn {

                width: 100%;

                min-height: 40px;
            }

        }


        /* ---------- 375px ---------- */

        @media (max-width:375px) {

            .card-body {

                padding: 10px;
            }

            .attraction-table td {

                padding-left: 42%;
                font-size: 14px;
            }

            .attraction-table td::before {

                width: 35%;
                font-size: 13px;
            }

            .attraction-img {

                height: 160px;
            }

        }
    </style>
</head>

<body>
    <!-- ================= NAVBAR ================= -->
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
                        <a class="nav-link active" href="#">
                            管理景點
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/admin/adminchart/">
                            景點收藏圖表
                        </a>
                    </li>

                    @if(session()->has('memberId'))
                    @if(session('memberId') == 1)
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
    <div class="content">

        <!-- ================= SEARCH ================= -->
        <div class="card mb-4">
            <div class="card-body">
                <div class="row g-3">
                    <!-- 關鍵字 -->
                    <div class="col-lg-2">
                        <label class="form-label">搜尋景點</label>
                        <input type="text" id="keyword" class="form-control" placeholder="輸入景點名稱">
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
                            <option value="">請選擇城市</option>
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
                    <div class="col-lg-2 text-center ">
                        <label class="form-label">景點數</label>
                        <div class="result-count">共<span id="totalCount"></span>筆</div>
                    </div>
                    <!-- 新增 -->
                    <div class="col-lg-2 d-flex align-items-end">
                        <a class="btn btn-success btn-add w-100 bi bi-plus-circle" href="/admin/create">新增景點</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ================= TABLE ================= -->
        <div class="card">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover attraction-table">

                        <!-- 固定欄位比例 -->
                        <colgroup>
                            <col style="width:10%">
                            <col style="width:30%">
                            <col style="width:10%">
                            <col style="width:10%">
                            <col style="width:30%">
                            <col style="width:10%">
                        </colgroup>

                        <thead class="table-success">

                            <tr>
                                <th>景點名稱</th>
                                <th>圖片</th>
                                <th>城市</th>
                                <th>分類</th>
                                <th>景點介紹</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody id="attractionTable">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="pagination" class="mt-3 text-center"></div>
    </div>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery-4.0.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
    <script>
        Swal.fire({
            icon: "success",
            title: "{{ session('success') }}",
            timer: 1500,
            showConfirmButton: false
        });
    </script>
    @endif
    <script>
        $(function() {
            loadData();
            const cityData = {
                north: [{
                        id: 1,
                        name: "台北市"
                    },
                    {
                        id: 2,
                        name: "新北市"
                    },
                    {
                        id: 3,
                        name: "基隆市"
                    },
                    {
                        id: 4,
                        name: "桃園市"
                    },
                    {
                        id: 5,
                        name: "新竹縣"
                    },
                    {
                        id: 6,
                        name: "新竹市"
                    }
                ],
                west: [{
                        id: 7,
                        name: "苗栗縣"
                    },
                    {
                        id: 8,
                        name: "台中市"
                    },
                    {
                        id: 9,
                        name: "彰化縣"
                    },
                    {
                        id: 10,
                        name: "南投縣"
                    },
                    {
                        id: 11,
                        name: "雲林縣"
                    }
                ],
                south: [{
                        id: 12,
                        name: "嘉義縣"
                    },
                    {
                        id: 13,
                        name: "嘉義市"
                    },
                    {
                        id: 14,
                        name: "台南市"
                    },
                    {
                        id: 15,
                        name: "高雄市"
                    },
                    {
                        id: 16,
                        name: "屏東縣"
                    }
                ],
                east: [{
                        id: 17,
                        name: "宜蘭縣"
                    },
                    {
                        id: 18,
                        name: "花蓮縣"
                    },
                    {
                        id: 19,
                        name: "台東縣"
                    }
                ],
                island: [{
                        id: 20,
                        name: "澎湖縣"
                    },
                    {
                        id: 21,
                        name: "金門縣"
                    },
                    {
                        id: 22,
                        name: "連江縣"
                    }
                ]
            };
            $("#area").on("change", function() {
                let area = $(this).val();
                let html = '<option value="" selected disabled>請選擇城市</option>';
                if (!area) {
                    $.each(cityData, function(_, cities) {

                        $.each(cities, function(_, city) {

                            html += `<option value="${city.id}">${city.name}</option>`;

                        });

                    });


                } else {
                    $.each(cityData[$(this).val()], function(_, city) {
                        html += `<option value="${city.id}">${city.name}</option>`;
                    });


                }
                $("#city").html(html);
                $("#city").val("");
                loadData();

            });
            $("#city, #classid").on("change", function() {
                console.log($(this).val());
                loadData();
            });
            $("#keyword").on("input", function() {
                loadData();
            });
        });

        function loadData(page = 1) {
            $.ajax({
                url: "/api/attraction/getAttractionList",
                type: "get",
                dataType: "json",
                data: {
                    page: page,
                    keyword: $("#keyword").val().trim(),
                    area: $("#area").val(),
                    city: $("#city").val(),
                    classid: $("#classid").val()
                },
                success: function(data) {
                    let html = "";
                    if (data.data.length > 0) {
                        $("#totalCount").text(data.total);
                        data.data.forEach(function(item) {
                            html += `<tr>
                                <td data-label="景點名稱">${item.attName}</td>
                                <td data-label="圖片"><img src="${item.attImg}" class="img-fluid"></td>
                                <td data-label="城市">${item.city.cityName}</td>
                                <td data-label="分類"><span class="badge badge-category">${item.class.className}</span></td>
                                <td data-label="景點介紹">${item.attContent}</td>
                                <td data-label="操作">
                                    <button class="btn btn-warning btn-sm editbtn" data-id="${item.id}">
                                        <i class="bi bi-pencil"></i>編輯
                                    </button>
                                    <button class="btn btn-danger btn-sm deletebtn" data-id="${item.id}">
                                        <i class="bi bi-trash"></i>刪除
                                    </button>
                                </td>
                            </tr>`;
                        });
                    } else {
                        $("#totalCount").text(0);
                        html += `<tr><td colspan="6" class="text-center py-5 fw-bold fs-3 text-danger">無相關景點資料</td></tr>`;
                    }
                    $("#attractionTable").html(html);
                    createPagination(data);
                }
            });
        }

        function createPagination(data) {
            let html = "";
            // 上一頁
            if (data.current_page > 1) {
                html += `<button class="btn btn-secondary" onclick="loadData(${data.current_page - 1})">上一頁</button>`;
            }
            // 頁碼
            for (let i = 1; i <= data.last_page; i++) {
                if (i == data.current_page) {
                    html += `<button class="btn btn-primary">${i}</button>`;
                } else {
                    html += `<button class="btn btn-outline-primary" onclick="loadData(${i})">${i}</button>`;
                }
            }
            // 下一頁
            if (data.current_page < data.last_page) {
                html += `<button class="btn btn-secondary" onclick="loadData(${data.current_page + 1})">下一頁</button>`;
            }
            $("#pagination").html(html);
        }

        $("#attractionTable").on("click", ".deletebtn", function() {

            let btn = $(this);

            Swal.fire({
                title: "確認要刪除嗎？",
                text: "刪除後將無法恢復！",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "確認刪除",
                cancelButtonText: "取消"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/admin/delete",
                        type: "DELETE",
                        data: {
                            id: btn.data("id"),
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {

                            Swal.fire("刪除成功", res.message, "success");

                            btn.closest("tr").remove();

                        },
                        error: function() {

                            Swal.fire("錯誤", "刪除失敗", "error");

                        }
                    });
                }
            });
        });

        $("#attractionTable").on("click", ".editbtn", function() {
            let id = $(this).data("id");
            window.location.href = "/admin/edit/" + id;
        });

        $("#logout").on("click", function() {
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