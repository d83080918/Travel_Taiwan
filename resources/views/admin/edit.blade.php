@extends('admin/adminlayout')
@section("title","編輯景點")
@section("content")
<style>
    html,
    body {

        overflow-x: hidden;

    }

    body {
        background: #f5f7fa;
    }

    .card {
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, .1);
    }

    .card-header {
        font-size: 24px;
        font-weight: bold;
    }



    .required {
        color: red;
    }



    .add-page {
        max-width: 1100px;
    }

    .add-card {
        border-radius: 20px;
        overflow: hidden;
    }

    .add-header {
        font-size: 28px;
        font-weight: 700;
        padding: 20px;
    }

    .form-label {
        font-weight: 700;
    }

    .form-control,
    .form-select {
        min-height: 48px;
    }

    textarea.form-control {

        min-height: 220px;

        resize: vertical;

    }

    .preview {
        width: 100%;
        max-width: 650px;
        height: 350px;
        margin-top: 20px;
        border-radius: 12px;
        border: 2px dashed #d8d8d8;
        object-fit: cover;

    }

    .btn-save,
    .btn-back {
        min-height: 48px;
        min-width: 150px;
        margin: 8px;
        font-weight: 700;
    }


    @media (max-width:991px) {
        .add-page {
            max-width: 760px;
        }

        .preview {
            height: 280px;
        }

        .add-header {
            font-size: 24px;
        }
    }

    @media (max-width:576px) {
        .container {
            padding-left: 15px;
            padding-right: 15px;
        }

        .card {
            border-radius: 12px;
        }

        .add-header {
            font-size: 22px;
            padding: 15px;
        }

        .form-control,
        .form-select {
            font-size: 16px;
        }

        .preview {
            width: 100%;
            height: 220px;
        }

        .btn-save,
        .btn-back {
            width: 100%;
            margin-bottom: 12px;
            min-height: 44px;
        }

        textarea {
            min-height: 180px;
        }
    }
</style>

</head>

<body>
    {{session('error')}}
    @if(session('error'))
    <script>
        Swal.fire({
            icon: "error",
            title: "修改失敗",
            text: "{{ session('error') }}"
        });
    </script>
    @endif
    <div class="container py-5 add-page">

        <div class="card shadow-lg border-0 add-card">

            <div class="card-header bg-success text-white text-center add-header">
                <i class="bi bi-plus-circle"></i>
                編輯旅遊景點
            </div>

            <div class="card-body">

                <form id="updateAttraction" method="POST" action="/admin/update" enctype="multipart/form-data" class="needs-validation">
                    @csrf
                    <input type="hidden" name="id" value="{{ $editattraction->id }}">
                    <div class="row g-4">

                        <div class="col-md-6">
                            <label class="form-label">
                                景點名稱
                                <span class="required">*</span>
                            </label>

                            <input type="text" id="attName" name="attName" class="form-control form-control-lg" maxlength="30" placeholder="請輸入景點名稱" value="{{$editattraction->attName}}">
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label">區域<span class="required">*</span></label>
                            <select id="area" name="area" class="form-select form-select-lg">
                                <option value="" disabled>請選擇</option>
                                <option value="east" {{ $editattraction->attArea == 'east' ? 'selected' : '' }}>東部</option>
                                <option value="north" {{ $editattraction->attArea == 'north' ? 'selected' : '' }}>北部</option>
                                <option value="west" {{ $editattraction->attArea == 'west' ? 'selected' : '' }}>西部</option>
                                <option value="south" {{ $editattraction->attArea == 'south' ? 'selected' : '' }}>南部</option>
                                <option value="island" {{ $editattraction->attArea == 'island' ? 'selected' : '' }}>外島</option>
                            </select>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label">城市<span class="required">*</span></label>
                            <select id="city" name="cityId" class="form-select form-select-lg">
                                <option value="" disabled selected>請選擇城市</option>

                            </select>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label">分類<span class="required">*</span></label>
                            <select id="classid" name="classId" class="form-select form-select-lg">
                                <option value="" disabled>請選擇分類</option>
                                <option value="1" {{ $editattraction->classId == '1' ? 'selected' : '' }}>自然景觀</option>
                                <option value="2" {{ $editattraction->classId == '2' ? 'selected' : '' }}>山岳</option>
                                <option value="3" {{ $editattraction->classId == '3' ? 'selected' : '' }}>海邊</option>
                                <option value="4" {{ $editattraction->classId == '4' ? 'selected' : '' }}>古蹟</option>
                                <option value="5" {{ $editattraction->classId == '5' ? 'selected' : '' }}>夜市</option>
                                <option value="6" {{ $editattraction->classId == '6' ? 'selected' : '' }}>老街</option>
                                <option value="7" {{ $editattraction->classId == '7' ? 'selected' : '' }}>文化園區</option>
                            </select>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label">景點照片<span class="required">*</span></label>
                            <input type="file" id="photo" name="photo" class="form-control form-control-lg" accept=".png,image/png">
                        </div>
                        <div class="col-12 text-center mt-3">
                            <img id="preview" src="/images/{{$editattraction->attImg}}" class="preview" style="max-width:300px;">
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-12 ">
                            <label class="form-label">景點介紹<span class="required">*</span></label>
                            <textarea id="attContent" name="attContent" rows="8" class="form-control form-control-lg" placeholder="請輸入景點介紹">{{$editattraction->attContent}}</textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button type="submit"
                            class="btn btn-success btn-lg editbtn">
                            <i class="bi bi-check-circle"></i> 儲存
                        </button>

                        <button type="button"
                            class="btn btn-success btn-lg " id="btnback">
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
            $("#preview").attr("src", URL.createObjectURL(file));
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

        $("#area").change(function() {

            loadCity($(this).val());

        });

        function loadCity(area, selectedCity = null) {

            $("#city").html('<option value="">請選擇城市</option>');

            if (!cityData[area]) return;

            $.each(cityData[area], function(index, item) {

                let selected = item.id == selectedCity ? "selected" : "";

                $("#city").append(
                    `<option value="${item.id}" ${selected}>
                ${item.name}
            </option>`
                );
            });
        }

        $(function() {

            let area = $("#area").val(); // 目前區域
            let cityId = "{{ $editattraction->cityId }}"; // 目前城市ID

            loadCity(area, cityId);

        });

        $("#updateAttraction").on("submit", function(e) {

            e.preventDefault();

            let form = this;

            Swal.fire({
                title: "確認要儲存修改嗎？",
                icon: "question",
                showCancelButton: true
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }

            });

        });

        $("#btnback").click(function() {
            location.href = "/admin/adminhome";
        });
    </script>
    @endsection