@extends("member.layout")
@section("title","旅館資訊")
@push("style")
@endpush
@section("content")
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<div class="container" id="app">
    <div class="row ">
        <div class="col-3 pt-3 bg-info vh-100">
            <label for="attractionList">景點名稱</label>
            <select name="" id="attractionList" class="form-select form-select-lg mt-3" v-model="attraction">
                <option value="" disabled selected>請選擇景點</option>
                <option :value="item" v-for="item in attractionList">@{{item.attName}}</option>
            </select>
            <div class="text-center mt-3">附近旅館資料</div>
        </div>
        <div class="col-9 bg-dark">
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
                attractionList: attraction,
                attraction: "",
            }
        },
        methods: {
            getHotelList() {
                const vm = this;
                axios.get('/js/HotelList.json')
                    .then(function(response) {
                        console.log(response);
                        vm.hotelList = response.data.Hotels;
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