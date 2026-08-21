@extends("member.layout")
@section("title","旅館資訊")
@push("style")
@endpush
@section("content")
<style>
    /* =========================
   整個地圖頁面
========================= */

    .map-page {
        padding: 0;
        overflow: hidden;
    }

    .map-row {
        margin: 0;
    }


    /* =========================
   左側 Sidebar
========================= */

    .sidebar {
        padding: 25px 20px !important;

        background: #f5f7fa !important;

        border-right: 1px solid #e1e5ea;

        height: 100vh;

        display: flex;
        flex-direction: column;

        overflow: hidden;
    }


    /* 景點名稱 */

    .sidebar-title {
        font-size: 28px;
        font-weight: 700;

        color: #263238;

        margin-bottom: 5px;
    }


    /* 景點下拉選單 */

    .attraction-select {
        border: 1px solid #d6dce1;

        border-radius: 10px;

        background-color: #ffffff;

        color: #37474f;

        padding: 10px 14px;

        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);

        transition: 0.2s;
    }

    .attraction-select:focus {
        border-color: #80cbc4;

        box-shadow: 0 0 0 3px rgba(128, 203, 196, 0.2);
    }


    /* =========================
   附近旅館標題
========================= */

    .hotel-title {
        font-size: 20px;

        font-weight: 600;

        color: #37474f;

        margin-top: 20px !important;

        margin-bottom: 5px;

        position: relative;
    }

    .hotel-title::after {
        content: "";

        display: block;

        width: 45px;

        height: 3px;

        margin: 8px auto 0;

        border-radius: 10px;

        background: #26a69a;
    }


    /* =========================
   飯店清單
========================= */

    .hotel-list {
        height: auto !important;

        flex: 1;

        overflow-y: auto !important;

        overflow-x: hidden;

        border: none;

        background: transparent;

        padding: 5px;

        scrollbar-width: thin;
    }


    /* Chrome / Edge 滾動條 */

    .hotel-list::-webkit-scrollbar {
        width: 6px;
    }

    .hotel-list::-webkit-scrollbar-track {
        background: transparent;
    }

    .hotel-list::-webkit-scrollbar-thumb {
        background: #c5ccd2;

        border-radius: 10px;
    }

    .hotel-list::-webkit-scrollbar-thumb:hover {
        background: #9fa8ae;
    }


    /* =========================
   飯店卡片
========================= */

    .hotel-card {
        border: none !important;

        border-radius: 12px !important;

        margin-bottom: 14px;

        padding: 10px;

        background: #ffffff;

        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);

        cursor: pointer;

        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease;
    }


    /* 滑鼠移過去 */

    .hotel-card:hover {
        transform: translateY(-2px);

        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.13);
    }


    /* =========================
   飯店圖片
========================= */

    .hotel-img {
        width: 100%;

        height: 120px;

        object-fit: cover;

        border-radius: 9px;

        display: block;

        margin-bottom: 10px;
    }


    /* =========================
   飯店名稱
========================= */

    .hotel-name {
        font-size: 18px;

        font-weight: 700;

        color: #263238;

        margin: 5px 0 8px;

        white-space: nowrap;

        overflow: hidden;

        text-overflow: ellipsis;
    }


    /* =========================
   飯店資訊
========================= */

    .hotel-info {
        font-size: 14px;

        color: #607d8b;

        margin-bottom: 5px;

        line-height: 1.5;
    }


    /* =========================
   右側地圖
========================= */

    .map-container {
        padding: 0 !important;

        height: 100vh;

        position: relative;
    }

    #map {
        width: 100%;

        height: 100vh;

        z-index: 1;
    }
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<div class="container-fluid map-page" id="app">
    <div class="row map-row">
        <div class="col-3 pt-3 bg-info vh-100 sidebar">
            <label for="attractionList" class="form-check-label display-6 sidebar-title">景點名稱</label>
            <select name="" id="attractionList" class="form-select form-select-lg mt-3" v-model="attraction" @change="getAttractionHotel">
                <option value="" disabled selected>請選擇景點</option>
                <option :value="item" v-for="item in attractionList">@{{item.attName}}</option>
            </select>
            <div class="text-center mt-3 hotel-title">附近旅館資料</div>
            <ul class="list-group mt-3 hotel-list" style="height: 75vh;overflow: scroll">
                <li class="list-group-item  hotel-card" v-for="(item,index) in attractionHotelList" @click="openHotelPopup(index)">
                    <img :src="item.img" alt="" class="hotel-img">
                    <h4 class="hotel-name">@{{item.name}}</h4>
                    <p class="hotel-info">電話:@{{item.tel}}</p>
                    <p class="hotel-info">地址:@{{item.city}}@{{item.town}}@{{item.streetAddress}}</p>

                </li>
            </ul>
        </div>
        <div class="col-9 bg-dark map-container">
            <div class="vh-100" id="map"></div>
        </div>
    </div>
</div>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script src="https://cdn.jsdelivr.net/npm/axios@1.13.2/dist/axios.min.js"></script>
<script src="/js/leaflet-color-markers.js"></script>
<script>
    const attraction = @json($attraction);
    console.log(attraction)
    const App = {
        data() {
            return {
                map: null,
                markerLayer: null,
                hotelList: [],
                attractionHotelList: [],
                attractionList: attraction,
                attraction: "",
                hotelMarkerList: [],
            }
        },
        methods: {
            getHotelList() {
                const vm = this;
                axios.get('/js/HotelList.json')
                    .then(function(response) {
                        console.log(response);
                        vm.hotelList = response.data.Hotels.map(function(item, index) {
                            return {
                                id: index + 1,
                                name: (item.HotelName ?? "未提供店名").trim(),
                                description: item.Description.substring(1, 10),
                                tel: item.Telephones[0].Tel,
                                city: item.PostalAddress.City,
                                town: item.PostalAddress.Town,
                                streetAddress: item.PostalAddress.StreetAddress,
                                // item?的?是判斷後方有沒有Images沒有會回傳unifind
                                img: (item?.Images[0]?.URL) || "/images/noimage.png",
                                lat: (item.PositionLat ?? "未提供lat"),
                                lng: (item.PositionLon ?? "未提供lng"),
                            }
                        });

                    })
                    .catch(function(error) {
                        console.log(error);
                    })
                    .finally(function() {
                        // always executed
                    });

            },
            initmap() {
                const vm = this;
                vm.map = L.map('map').setView([23.9651605, 120.967272], 8);

                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(vm.map);

                // 建立maker專用layer
                vm.markerLayer = L.layerGroup().addTo(vm.map);
            },
            getAttractionHotel() {
                const vm = this;
                vm.markerLayer.clearLayers();
                vm.attractionHotelList = [];
                vm.hotelMarkerList = [];
                vm.hotelList.forEach((item) => {
                    if (item.city == vm.attraction.city.cityName) {
                        vm.attractionHotelList.push(item);
                    }
                });

                vm.attractionHotelList.forEach(function(item, index) {
                    if (index == 0) {
                        vm.map.setView([item.lat, item.lng], 14);
                    }
                    const popupHTML = `<div class="card">
                            <img src="${item.img}" class="card-img-top" alt="">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">${item.name}</h5>
                                <p class="card-text mb-2">電話:${item.tel}</p>
                                <p class="card-text mb-2">地址:${item.city}${item.town}${item.streetAddress}</p>
                                <p class="card-text ">簡介:${item.description}</p>
                            </div>
                        </div>`;

                    const marker = L.marker([item.lat, item.lng]).bindPopup(popupHTML, {
                        maxWidth: 300
                    }).addTo(vm.markerLayer);

                    // 將marker資料存進陣列
                    vm.hotelMarkerList.push(marker);
                });
            },
            openHotelPopup(index) {
                const vm = this;
                // 抓該旅館
                const hotel = vm.attractionHotelList[index];
                // 移動地圖到該旅館
                vm.map.setView([hotel.lat, hotel.lng], 17);
                // 開啟對應的marker
                vm.hotelMarkerList[index].openPopup();

            }
        },
        mounted() {
            const vm = this;
            vm.getHotelList();
            vm.initmap();
        }
    }

    Vue.createApp(App).mount("#app");
</script>
@endsection