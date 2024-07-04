<div class="section container pb-5">
    <div class="d-flex justify-content-between align-items-start">
        <x-section-header>
            {{ $header }}
        </x-section-header>

        <a href="{{ $endpoint }}" class="text-light text-uppercase text-decoration-none btn btn-primary">See more <i class="fa-solid fa-angles-right text-danger"></i></a>
    </div>

    <div class="d-flex flex-wrap justify-content-xl-between justify-content-around gap-3">
        {{ $slot }}
    </div>
</div>
