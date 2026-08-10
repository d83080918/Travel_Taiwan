@extends('admin/adminlayout')
@section("title","後端資料")
@section("content")
<style>
    html,
    body {
        overflow-x: hidden;
        scroll-behavior: smooth;
    }

    body {
        background: linear-gradient(180deg, #dff6ff 0%, #eef9ff 35%, #ffffff 100%);
        font-family: "Noto Sans TC", sans-serif;
        color: #334155;
    }

    /* 外層 */
    .add-page {
        max-width: 1100px;
    }

    /* 卡片 */
    .card {
        border: none;

        border-radius: 18px;

        overflow: hidden;

        background: #fff;

        box-shadow: 0 8px 25px rgba(25, 135, 84, .12);
    }

    /* Header */
    .add-header {
        background: #198754;

        color: #fff;

        font-size: 28px;

        font-weight: 700;

        text-align: center;

        padding: 22px;
    }

    .add-header i {
        margin-right: 8px;
    }

    /* card body */

    .card-body {
        padding: 40px;
    }

    /* label */

    .form-label {
        font-weight: 600;

        color: #198754;

        margin-bottom: 8px;
    }

    .required {
        color: #dc3545;
    }

    /* input */

    .form-control,
    .form-select {
        min-height: 50px;

        border: 1px solid #ced4da;

        border-radius: 10px;

        transition: .3s;

        box-shadow: none;
    }

    .form-control:focus,
    .form-select:focus {

        border-color: #198754;

        box-shadow: 0 0 0 .2rem rgba(25, 135, 84, .15);

    }

    textarea.form-control {

        min-height: 220px;

        resize: vertical;

    }

    /* 上傳圖片 */

    .preview {

        width: 100%;

        max-width: 650px;

        height: 340px;

        margin-top: 20px;

        object-fit: cover;

        border-radius: 12px;

        border: 2px dashed #198754;

        background: #f8f9fa;

        display: none;

    }



    /* hr */

    hr {

        border-top: 1px solid #dee2e6;

        margin: 35px 0;

    }

    /* 按鈕 */

    .btn-save {

        min-width: 170px;

        min-height: 48px;

        background: #198754;

        border: none;

        border-radius: 10px;

        font-weight: 600;

        transition: .3s;

    }

    .btn-save:hover {

        background: #157347;

        transform: translateY(-2px);

    }

    .btn-back {

        min-width: 170px;

        min-height: 48px;

        background: #fff;

        color: #198754;

        border: 2px solid #198754;

        border-radius: 10px;

        font-weight: 600;

        transition: .3s;

    }

    .btn-back:hover {

        background: #0077b6;

        color: #fff;

    }

    /* row間距 */

    .row {

        margin-bottom: 10px;

    }

    /* placeholder */

    ::placeholder {

        color: #adb5bd;

    }

    /* 響應式 */

    @media (max-width:991px) {

        .add-page {

            max-width: 760px;

        }

        .card-body {

            padding: 30px;

        }

        .preview {

            height: 280px;

        }

        .add-header {

            font-size: 25px;

        }

    }

    @media (max-width:576px) {

        .container {

            padding-left: 15px;

            padding-right: 15px;

        }

        .card {

            border-radius: 18px;

        }

        .card-body {

            padding: 22px;

        }

        .add-header {

            font-size: 22px;

            padding: 22px;

        }

        .preview {

            height: 220px;

        }

        .btn-save,
        .btn-back {

            width: 100%;

            margin-bottom: 12px;

        }
    }

    .navbar {
        transition: .3s;
        padding: 15px 0;
    }

    .navbar {
        transition: .3s;
        padding: 15px 0;
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
</style>
<div class="container py-5 add-page">


    <div class="card shadow-lg border-0 ">

        <div class="add-header">
            <i class="bi bi-plus-circle"></i>
            新增旅遊景點
        </div>

        <div class="card-body">

            <form id="frmAttraction" enctype="multipart/form-data" class="needs-validation">
                @csrf
                <div class="row g-4">

                    <!-- 景點名稱 -->
                    <div class="col-md-6">
                        <label class="form-label">
                            景點名稱
                            <span class="required">*</span>
                        </label>

                        <input type="text" id="attName" name="attName" class="form-control form-control-lg" maxlength="30" placeholder="請輸入景點名稱">
                    </div>
                </div>

                <!-- 區域 -->
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="form-label">區域<span class="required">*</span></label>
                        <select id="area" name="area" class="form-select form-select-lg">
                            <option value="" disabled selected>請選擇</option>
                            <option value="east">東部</option>
                            <option value="north">北部</option>
                            <option value="west">西部</option>
                            <option value="south">南部</option>
                            <option value="island">外島</option>
                        </select>
                    </div>
                </div>

                <!-- 城市 -->
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="form-label">城市<span class="required">*</span></label>
                        <select id="city" name="cityId" class="form-select form-select-lg">
                            <option value="" disabled selected>請選擇城市</option>

                        </select>
                    </div>
                </div>

                <!-- 分類 -->
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="form-label">分類<span class="required">*</span></label>
                        <select id="classid" name="classId" class="form-select form-select-lg">
                            <option value="" disabled selected>請選擇分類</option>
                            <option value="1">自然景觀</option>
                            <option value="2">山岳</option>
                            <option value="3">海邊</option>
                            <option value="4">古蹟</option>
                            <option value="5">夜市</option>
                            <option value="6">老街</option>
                            <option value="7">文化園區</option>
                        </select>
                    </div>
                </div>

                <!-- 照片 -->
                <div class="row mt-3">
                    <div class="col-md-6">
                        <label class="form-label">景點照片<span class="required">*</span></label>
                        <input type="file" id="photo" name="photo" class="form-control form-control-lg" accept=".png,image/png">
                    </div>
                    <div class="col-12 text-center">
                        <img id="preview" class="preview">
                    </div>
                </div>

                <!-- 景點介紹 -->
                <div class="row mt-3">
                    <div class="col-12">
                        <label class="form-label">景點介紹<span class="required">*</span></label>
                        <textarea id="attContent" name="attContent" rows="8" class="form-control form-control-lg" placeholder="請輸入景點介紹"></textarea>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <button type="button"
                        class="btn btn-success btn-lg btn-save" id="btnSave">
                        <i class="bi bi-check-circle"></i> 儲存
                    </button>

                    <button type="button"
                        class="btn btn-success btn-lg btn-back" id="btnback">
                        <i class="bi bi-check-circle"></i> 返回列表
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $("#photo").change(function() {
        const file = this.files[0];
        if (!file) return;
        if (file.type != "image/png") {
            alert("只能上傳 PNG 圖片");
            $(this).val("");
            return;
        }

    });

    $("#btnSave").click(function() {
        let formData = new FormData($("#frmAttraction")[0]);
        $.ajax({
            url: "/admin/store",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(res) {
                alert("新增成功");
                location.href = "/admin/adminhome";
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert("新增失敗");
            }
        });
    });

    $("#btnback").click(function() {
        location.href = "/admin/adminhome";
    });

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

        let html = '<option value="" selected disabled>請選擇城市</option>';

        $.each(cityData[$(this).val()], function(_, city) {
            html += `<option value="${city.id}">${city.name}</option>`;
        });

        $("#city").html(html);

    })
</script>
@endsection