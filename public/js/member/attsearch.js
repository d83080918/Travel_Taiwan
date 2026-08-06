function getFavoriteList() {
    console.log("window.memberId =", window.memberId);
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
    $("#area").on("change", function () {
        let area = $(this).val();
        let html = '<option value="" selected disabled>請選擇城市</option>';
        if (!area) {
            $.each(cityData, function (_, cities) {

                $.each(cities, function (_, city) {

                    html += `<option value="${city.id}">${city.name}</option>`;

                });

            });


        } else {
            $.each(cityData[$(this).val()], function (_, city) {
                html += `<option value="${city.id}">${city.name}</option>`;
            });


        }
        $("#city").html(html);
        $("#city").val("");
        loadData();

    });
    $("#city, #classid").on("change", function () {
        loadData();
    });

    $("#keyword").on("input", function () {
        loadData();
    });
}

function loadData(page = 1) {

    $.ajax({
        url: "/api/attraction/favoriteAttractionList",
        type: "get",
        dataType: "json",
        data: {
            page: page,
            keyword: $("#keyword").val().trim(),
            area: $("#area").val(),
            city: $("#city").val(),
            classid: $("#classid").val(),
            memberId: window.memberId
        },
        success: function (data) {
            let html = "";
            if (data.data.length > 0) {
                $("#totalCount").text(data.total);
                data.data.forEach(function (item) {
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
