@use('App\Support\CinemaFormat')

<article class="film-card">
    <a class="film-link" href="{{ route('films.show', $film->slug) }}">
        @include('cinema.poster')
        <div class="film-card-body">
            <div>
                <p class="film-meta">{{ $film->genre }} <span aria-hidden="true">·</span> {{ $film->duration }} menit</p>
                <h3>{{ $film->title }}</h3>
                @if ($showReleaseDate ?? false)
                    <p class="release-date"><time datetime="{{ $film->release_date->toDateString() }}">{{ CinemaFormat::date($film->release_date) }}</time></p>
                @endif
            </div>
            <span class="arrow-badge" aria-hidden="true">↗</span>
        </div>
    </a>
</article>
