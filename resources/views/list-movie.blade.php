<x-layout>
    {{-- NAVIGATOR --}}
    <x-navigator></x-navigator>

    {{-- HEADER --}}
    <x-header>
        <div class="container header-content">
            <div class="">
                <h1 class="fs-1 fw-bold">Watch movies for <br><span class="accent-color">FREE</span> now</h1>
                <p class="">The films that we show are not illegal and of course in very good quality.</p>
                <x-btn-primary>Login</x-btn-primary>
            </div>
        </div>
    </x-header>

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
        <x-section-component header="{{ $section['header'] }}" endpoint="{{ $section['endpoint'] }}">
            @foreach($section['movies'] as $movie)
                <x-movie-card :movie="$movie" />
            @endforeach
        </x-section-component>
    </main>

</x-layout>
