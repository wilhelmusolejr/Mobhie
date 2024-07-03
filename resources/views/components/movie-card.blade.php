<a href="movie/{{ $movie['id'] }}" class="card text-decoration-none" style="width: 18rem;">
    <img src="{{ 'https://images.tmdb.org/t/p/w500'.$movie['poster_path'] }}" class="card-img-top" alt="{{ $movie['original_title'] }}">
    <div class="card-body">
        <h3 class="movie-title">{{ $movie['original_title'] }}</h3>
        <p class="card-text movie-descriptionn">{{ $movie['overview'] }}</p>
        <div class="movie-rate">
            @for ($i = 0; $i < 5; $i++)
                @if ($i < $movie['star_rating'])
                    <i class="fas fa-star"></i>
                @endif
            @endfor
        </div>
    </div>
</a>
