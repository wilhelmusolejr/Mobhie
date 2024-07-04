<x-layout>

    {{-- HEADER --}}
    <x-header class="header-partial">
        <div class="text-center">
            <x-header-title>
                {{ $section['header'] }}
            </x-header-title>
        </div>
    </x-header>

    <main class="py-5">

        <x-section-component
            header="{{ $section['header'] }}"
            endpoint="{{ $section['endpoint'] }}"
            :headerhide="true" >
                @foreach($section['movies'] as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach
        </x-section-component>

        <div class="container d-flex justify-content-between align-items-center">

            @if ($section['previous_url'])
                <a class="btn btn-primary" href="{{ $section['previous_url'] }}">Previous</a>
            @endif
            <a class="btn btn-primary" href="{{ $section['next_url'] }}">Next</a>
        </div>

    </main>

</x-layout>
