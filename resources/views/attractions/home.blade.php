@extends("member.layout")
@section("title","Travel Taiwan｜探索台灣之美")
@push("style")
<link rel="stylesheet" href="/css/home.css">
@endpush
@section("content")
<div id="heroCarousel"
    class="carousel slide carousel-fade"
    data-bs-ride="carousel"
    data-bs-interval="4000">

    <!-- 指示器 -->

    <div class="carousel-indicators">

        <button type="button"
            data-bs-target="#heroCarousel"
            data-bs-slide-to="0"
            class="active"></button>

        <button type="button"
            data-bs-target="#heroCarousel"
            data-bs-slide-to="1"></button>

        <button type="button"
            data-bs-target="#heroCarousel"
            data-bs-slide-to="2"></button>

        <button type="button"
            data-bs-target="#heroCarousel"
            data-bs-slide-to="3"></button>

    </div>

    <div class="carousel-inner">

        <!-- 第一張 -->

        <div class="carousel-item active">

            <img src="/images/banner/banner1.jpg"
                class="d-block w-100 hero-img"
                alt="台北101">

            <div class="carousel-caption">

                <h1>探索台灣之美</h1>

                <p>
                    Discover Amazing Taiwan
                </p>

                <a href="/attraction/list"
                    class="btn btn-success btn-lg">
                    開始探索
                </a>

            </div>

        </div>

        <!-- 第二張 -->

        <div class="carousel-item">

            <img src="/images/banner/banner2.jpg"
                class="d-block w-100 hero-img"
                alt="日月潭">

            <div class="carousel-caption">

                <h1>山海美景 一次收藏</h1>

                <p>
                    從高山到海岸，感受台灣最迷人的風景。
                </p>

                <a href="/attraction/list"
                    class="btn btn-success btn-lg">
                    更多景點
                </a>

            </div>

        </div>

        <!-- 第三張 -->

        <div class="carousel-item">

            <img src="/images/banner/banner3.jpg"
                class="d-block w-100 hero-img"
                alt="阿里山">

            <div class="carousel-caption">

                <h1>體驗在地文化</h1>

                <p>
                    夜市、美食、古蹟與人文風情，一次滿足。
                </p>

                <a href="#"
                    class="btn btn-success btn-lg">
                    熱門活動
                </a>

            </div>

        </div>

        <!-- 第四張 -->

        <div class="carousel-item">

            <img src="/images/banner/banner4.jpg"
                class="d-block w-100 hero-img"
                alt="太魯閣">

            <div class="carousel-caption">

                <h1>規劃你的台灣旅程</h1>

                <p>
                    找尋屬於你的旅遊攻略，立即出發。
                </p>

                <a href="#"
                    class="btn btn-success btn-lg">
                    查看攻略
                </a>
            </div>
        </div>
    </div>
    <!-- 左右控制 -->
    <button class="carousel-control-prev"
        type="button"
        data-bs-target="#heroCarousel"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next"
        type="button"
        data-bs-target="#heroCarousel"
        data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>
<script src="/js/home.js"></script>
@endsection