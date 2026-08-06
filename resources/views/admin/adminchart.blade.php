<!DOCTYPE html>
<html lang="zh-TW">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>後端資料</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/all.min.css">
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

            <a class="navbar-brand fw-bold" href="#">
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
                    @if(session()->has('memberId'))
                    @if(session('memberId') == 1)
                    <li class="nav-item">
                        <a href="/admin/adminhome" class="nav-link">管理員 {{ $member->userName }}</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-lg nav-link" id="logout1">
                            登出
                        </button>
                    </li>
                    @else
                    <li class="nav-item">
                        <a href="/member/home" class="nav-link active">會員 {{ $member->userName }}</a>
                    </li>
                    <li class="nav-item">
                        <button class="btn btn-lg nav-link" id="logout2">
                            登出
                        </button>
                    </li>
                    @endif
                    @else
                    <li class="nav-item">
                        <button class="btn btn-lg nav-link" id="login">
                            登入
                        </button>
                    </li>
                    @endif

                </ul>

            </div>

        </div>

    </nav>
    <div class="container" id="app">
        <div class="row">
            <div class="col-12 justify-content-center">
                <canvas id="chart" class="w-100"></canvas>
            </div>
            <div class="col-12">
                <canvas id="areachart" class="w-100"></canvas>
            </div>
        </div>
    </div>


    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/jquery-4.0.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
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
    </SCript>
</body>

</html>