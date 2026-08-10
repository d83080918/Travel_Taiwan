@extends('admin/adminlayout')
@section("title","後端資料")
@push("style")
<link rel="stylesheet" href="/css/admin/adminchart.css">
@endpush
@section("content")
<div class="container-fluid py-4 dashboard-bg" id="app">
    <div class="container dashboard-container">
        <div class="row g-4 dashboard-row">
            <div class="col-12">
                <div class="chart-card dashboard-card">
                    <div class="chart-header">
                        <h5 class="chart-title">
                            <i class="bi bi-bar-chart-line-fill me-2"></i>
                            景點收藏次數
                        </h5>
                    </div>
                    <div class="chart-body">
                        <canvas id="chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="chart-card dashboard-card">

                    <div class="chart-header">
                        <h5 class="chart-title">
                            <i class="bi bi-geo-alt-fill me-2"></i>
                            各區域景點數
                        </h5>
                    </div>

                    <div class="chart-body">
                        <canvas id="areachart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<SCript>
    let chart = null;
    let areachart = null;
    const favorite = @json($favorite);
    const eastCount = @json($eastCount);
    const northCount = @json($northCount);
    const westCount = @json($westCount);
    const southCount = @json($southCount);
    const islandCount = @json($islandCount);

    console.log(westCount);
    console.log(favorite);
    const App = {
        data() {
            return {
                label_x: [],
                data_y: [],

                arealabel_x: []
            }
        },
        methods: {
            getCityName() {
                const vm = this;
                vm.label_x = favorite.map(function(item) {
                    return item.attName
                });
            },
            getFavoriteCount() {
                const vm = this;
                vm.data_y = favorite.map(function(item) {
                    return item.collect_count
                });
            },
            createChart() {
                const ctx = document.getElementById('chart');
                const vm = this
                chart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: vm.label_x,
                        datasets: [{
                            label: '各景點的收藏數',
                            data: vm.data_y,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {

                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            },
            createAreaChart() {
                const ctx2 = document.getElementById('areachart');
                const vm = this
                areachart = new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels: ["東", "北", "西", "南", "外島"],
                        datasets: [{
                            label: '各區域景點數',
                            data: [eastCount, northCount, westCount, southCount, islandCount],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {

                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            },
        },
        mounted() {
            const vm = this;
            vm.getCityName();
            vm.getFavoriteCount();
            vm.createChart();
            vm.createAreaChart();
        }
    }
    Vue.createApp(App).mount("#app");

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
</SCript>
@endsection