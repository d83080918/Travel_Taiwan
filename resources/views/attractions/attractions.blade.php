@extends("member.layout")
@section("title","景點列表 | Taiwan Travel")
@push("style")
<link rel="stylesheet" href="/css/style.css">
@endpush
@section("content")
<section class="hero">

    <div class="container text-center">

        <h1>探索台灣每一處美景</h1>

        <p>
            超過數百熱門旅遊景點，帶你發現台灣之美。
        </p>

    </div>

</section>

<!-- ================= 搜尋 ================= -->

<section class="search-section">

    <div class="container">

        <div class="card shadow border-0">

            <div class="card-body">

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
                        <select id="city" class="form-select ">
                            <option value="" selected>全部城市</option>
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
        </div>
    </div>
</section>

<!-- ================= 景點 ================= -->

<section class="py-5">

    <div class="container">

        <div class="row g-4" id="attractions">

            <!-- app.js 動態產生 -->

        </div>

    </div>

</section>

<!-- ================= Pagination ================= -->

<section class="pb-5">

    <div class="container">
        <nav>
            <ul class="pagination justify-content-center" id="pagination">
            </ul>
        </nav>
    </div>
</section>

<!-- ================= Footer ================= -->

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <h5>Taiwan Travel</h5>
                <p>探索台灣最美旅遊景點。</p>
            </div>

            <div class="col-lg-4">
                <h5>快速連結</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="index.html">首頁</a>
                    </li>
                    <li>
                        <a href="#">景點列表</a>
                    </li>
                    <li>
                        <a href="#">旅遊攻略</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-4">
                <h5>聯絡我們</h5>
                <p>service@travel.com</p>
                <p>04-12345678</p>
            </div>
        </div>

        <hr>
        <div class="text-center">© 2026 Taiwan Travel</div>
    </div>
</footer>
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
            let html = '<option value="" selected >全部城市</option>';
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
        let memberId = window.memberId;
        $.ajax({
            url: "/api/attraction/getAttractionList",
            type: "get",
            dataType: "json",
            data: {
                page: page,
                keyword: $("#keyword").val().trim(),
                area: $("#area").val(),
                city: $("#city").val(),
                classid: $("#classid").val(),
                memberId: memberId
            },
            success: function(data) {
                let html = "";
                if (data.data.length > 0) {
                    $("#totalCount").text(data.total);
                    data.data.forEach(function(item) {
                        let favoriteText = "";
                        let favoriteClass = "";
                        if (item.isFavorite) {
                            favoriteText = "已收藏❤️";
                            favoriteClass = "active";
                        } else {
                            favoriteText = "收藏🤍";
                            favoriteClass = "";
                        }
                        html += `<div class="col-12 col-sm-6 col-lg-4 mb-4">
                                        <div class="card attraction-card h-100 shadow-sm border-0">        
                                            <div class="ratio ratio-4x3 overflow-hidden">
                                                <img src="${item.attImg}" class="card-img-top attraction-img" alt="${item.attName}">
                                        </div>
                                        <div class="card-body d-flex flex-column"> 
                                            <div class="d-flex justify-content-between align-items-start mb-3">
                                                <h4 class="card-title fw-bold mb-0 pe-2">${item.attName}</h4>
                                                <button class="favorite btn btn-outline-danger btn-sm ${favoriteClass}" data-id="${item.id}">${favoriteText}</button>
                                        </div>
                                        <div class="mb-2">
                                            <span class="badge bg-success me-2">所在縣市</span>
                                            <span class="text-secondary">${item.city.cityName}</span>
                                        </div>
                                        <div class="mb-3">
                                            <span class="badge bg-primary me-2">分類</span>
                                            <span class="text-secondary">${item.class.className} </span>
                                        </div>            
                                        <p class="card-text text-muted flex-grow-1">${item.attContent}</p>  
                                        <a href="/attraction/detail/${item.id}"
                                         class="btn btn-success w-100 mt-auto">
                                        查看景點
                                             </a>
                                        </div>
                                        </div>                                      
                                    </div>`;

                    });
                } else {
                    html += `<div class="card fw-900 display-5 text-center">無相關景點資料</div>`;
                    $("#totalCount").text(0);
                }
                $("#attractions").html(html);
                createPagination(data);

            }

        });
    }

    function createPagination(data) {

        let html = "";


        // 上一頁
        if (data.current_page > 1) {

            html += `
                <button class="btn btn-secondary"
                        onclick="loadData(${data.current_page - 1})">上一頁
                </button>
                `;
        }

        // 頁碼
        for (let i = 1; i <= data.last_page; i++) {

            if (i == data.current_page) {

                html += `
            <button class="btn btn-primary">
                ${i}
            </button>
            `;

            } else {

                html += `
            <button class="btn btn-outline-primary"
                onclick="loadData(${i})">
                ${i}
            </button>
            `;

            }

        }

        // 下一頁
        if (data.current_page < data.last_page) {

            html += `
        <button class="btn btn-secondary"
            onclick="loadData(${data.current_page + 1})">
            下一頁
        </button>
        `;
        }
        $("#pagination").html(html);

    }
    $(document).on("click", ".favorite", function() {
        const memberId = "{{ session('memberId') ?? '' }}";

        if (!memberId) {
            Swal.fire({
                icon: "warning",
                title: "尚未登入",
                text: "登入會員後才可以收藏景點",
                showCancelButton: true,
                confirmButtonText: "前往登入",
                cancelButtonText: "取消"
            }).then((result) => {

                if (result.isConfirmed) {

                    location.href =
                        "/member/login?redirect=" +
                        encodeURIComponent(location.href);
                }
            });
            return;
        } else {
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
                    } else {
                        btn.removeClass("active");
                        btn.html("收藏🤍");
                    }

                }
            });
        }

    });
</script>
@endsection