<header {{ $attributes->merge(['class' => 'd-flex align-items-center justify-content-center position-relative']) }}>
    <div class="container header-content">
        {{ $slot }}
    </div>
</header>
