<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{-- Font awesome --}}
    <script defer src="https://kit.fontawesome.com/6b2bcc8033.js" crossorigin="anonymous"></script>

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/movie.css') }}">
    <script defer src="{{ asset('js/index.js') }}"></script>


</head>
<body>

    {{-- NAVIGATOR --}}
    <x-navigator></x-navigator>

    {{-- HEADER --}}
    <x-header>
        <div class="container header-content d-flex flex-lg-nowrap flex-wrap gap-3">
            <div class="text-center">
                <img src="{{ asset('images/header-banner.jpg') }}" alt="" class="w-100 rounded">
            </div>
            <div class="">
                <h1 class="fs-1 fw-bold text-uppercase">Past Lives</h1>
                <p class="">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quidem quae eligendi eos doloremque ipsum dolores molestias velit dolorum nostrum voluptate.</p>

                <div class="text-uppercase">
                    <x-btn-primary><i class="fa-solid fa-plus"></i> Add to wishlist</x-btn-primary>
                    <x-btn-primary><i class="fa-solid fa-play"></i> Play trailer</x-btn-primary>
                </div>
            </div>
        </div>
    </x-header>

    <main class="py-5">
        <x-section-component>

            <x-section-header>
                Cast
            </x-section-header>

            <div class="d-flex flex-wrap justify-content-xl-start justify-content-around align-items-center gap-3">

                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('images/header-banner.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="movie-title">Birds of the pray</h3>
                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('images/header-banner.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="movie-title">Birds of the pray</h3>
                    </div>
                </div>
                <div class="card" style="width: 18rem;">
                    <img src="{{ asset('images/header-banner.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="movie-title">Birds of the pray</h3>
                    </div>
                </div>

            </div>
        </x-section-component>
    </main>

    <footer class="d-flex justify-content-center align-items-center py-5">
        <a class="logo text-uppercase text-decoration-none bg-dark p-3 rounded" href="#">Mobhie</a>
    </footer>
</body>
</html>

