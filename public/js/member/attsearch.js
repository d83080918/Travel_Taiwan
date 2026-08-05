function getFavoriteList() {
    console.log("window.memberId =", window.memberId);
    loadData();
    $("#area, #city, #classid").on("change", function () {
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
