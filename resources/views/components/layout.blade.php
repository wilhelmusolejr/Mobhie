<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Default Title')</title>

    {{-- Font awesome --}}
    <script defer src="https://kit.fontawesome.com/6b2bcc8033.js" crossorigin="anonymous"></script>

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <script defer src="{{ asset('js/index.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/movie.css') }}">
    <script defer src="{{ asset('js/movie.js') }}"></script>
</head>
<body style="overflow: hidden">



    <x-loader></x-loader>

    {{-- NAVIGATOR --}}
    <x-navigator></x-navigator>

    {{ $slot }}

    <footer class="">
        <div class="container d-flex justify-content-between align-items-center flex-wrap py-5 gap-5 ">
            <div class="">
                <a class="logo text-uppercase text-decoration-none bg-dark p-3 rounded" href="{{ route('home') }}">Mobhie</a>
            </div>

            <?php
            $portfolio_url = config('app.socials.portfolio');
            $github_url = config('app.socials.github');
            $project_url = config('app.socials.project_information');
            ?>


            <div class="d-flex flex-wrap flex-column flex-md-row gap-3">
                <a class="text-decoration-none text-light" target="_blank" href={{ $portfolio_url }}>Portfolio</a>
                <a class="text-decoration-none text-light" target="_blank" href={{ $project_url }}>Project Information</a>
                <a class="text-decoration-none text-light" target="_blank" href={{ $github_url }}>GitHub</a>
            </div>
        </div>
    </footer>
</body>
</html>
