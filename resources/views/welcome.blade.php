<x-layout>
    {{-- NAVIGATOR --}}
    <x-navigator></x-navigator>

    {{-- HEADER --}}
    <x-header></x-header>

    {{-- Sponsor --}}
    <div class="container sponsor py-5 d-flex flex-wrap flex-md-nowrap justify-content-around align-items-center gap-5 text-center">
        <div class="">
            <img src="{{ asset('images/sponsor1.png') }}" alt="">
        </div>
        <div class="">
            <img src="{{ asset('images/sponsor2.png') }}" alt="">
        </div>
        <div class="">
            <img src="{{ asset('images/sponsor3.png') }}" alt="">
        </div>
        <div class="">
            <img src="{{ asset('images/sponsor4.png') }}" alt="">
        </div>
    </div>

    <main class="py-5">

        <x-section-component>

            <x-section-header>
                Popular Movies
            </x-section-header>

            <div class="d-flex flex-wrap justify-content-xl-between justify-content-around align-items-center gap-3">

                <x-movie-card></x-movie-card>
                <x-movie-card></x-movie-card>
                <x-movie-card></x-movie-card>
                <x-movie-card></x-movie-card>

            </div>
        </x-section-component>

        <x-section-component>

            <x-section-header>
                Top Series
            </x-section-header>

            <div class="d-flex flex-wrap justify-content-xl-between justify-content-around align-items-center gap-3">

                <x-movie-card></x-movie-card>
                <x-movie-card></x-movie-card>
                <x-movie-card></x-movie-card>
                <x-movie-card></x-movie-card>

            </div>
        </x-section-component>

        <div class="container-md container-fluid my-5 py-5">
            <div class="p-3 card d-flex flex-md-row gap-3 randomize">

                <div class="movie-image">
                    <img src="{{ asset('images/header-banner.jpg') }}" class="w-100 rounded">
                </div>

                <div class="movie-info d-flex flex-column">
                    <h3 class="movie-title align-self-center">Birds of the pray</h3>
                    <p class="card-text movie-descriptionn">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <div class="movie-rate pb-3">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>

                    <a href="#" class="btn btn-primary text-dark align-self-center mt-auto">Randomize</a>
                </div>

            </div>
        </div>
    </main>

</x-layout>
