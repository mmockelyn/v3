@extends("layout.front")

@section("style")

@endsection

@section("subheader")
@endsection

@section("content")
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/storage/slideshow/1.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/storage/slideshow/2.png" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/storage/slideshow/3.png" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="pt-lg-5"></div>
    <h1><i class="la la-newspaper-o"></i> Dernières News</h1>
    <div class="pt-lg-3"></div>
    <div class="row pb-lg-5" id="latestBlog"></div>
    <h1><i class="la la-cubes"></i> Derniers Objets</h1>
    <div class="row pb-lg-5" id="latestDownload"></div>
    <h1><i class="la la-youtube-play"></i> Derniers Tutoriels</h1>
    <div class="row pb-lg-5" id="latestTutoriel"></div>
@endsection

@section("script")
    <script src="{{ asset('js/index.js') }}"></script>
@endsection
