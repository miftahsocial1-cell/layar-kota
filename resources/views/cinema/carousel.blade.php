<section class="hero" aria-labelledby="carousel-title" data-carousel>
    <div class="shell">
        <h1 id="carousel-title" class="sr-only">Film sedang tayang di Layar Kota</h1>
        @forelse ($films as $film)
            <article class="hero-slide" data-film-slide @if(!$loop->first) hidden @endif>
                <div class="hero-copy">
                    <p class="eyebrow"><span class="signal"></span> Sedang tayang</p>
                    <h2>{{ $film->title }}</h2>
                    <p class="hero-meta">{{ $film->genre }} <span aria-hidden="true">·</span> {{ $film->duration }} menit</p>
                    <p class="hero-synopsis">{{ $film->synopsis }}</p>
                    <a class="button button--light" href="{{ route('films.show', $film->slug) }}">Lihat jadwal <span aria-hidden="true">→</span></a>
                    <a class="hero-link" href="#segera-tayang">Segera tayang <span aria-hidden="true">↘</span></a>
                </div>
                <div class="hero-poster" aria-hidden="true">
                    <img src="{{ asset('posters/'.$film->poster.'.webp') }}" width="640" height="960" alt=""
                         @if($loop->first) fetchpriority="high" @else loading="lazy" @endif>
                </div>
            </article>
        @empty
            <div class="hero-copy hero-empty">
                <p class="eyebrow">Bioskop Layar Kota</p>
                <h2>Jadwal segera hadir</h2>
                <a class="hero-link" href="#segera-tayang">Lihat film yang akan tayang</a>
            </div>
        @endforelse

        @if ($films->count() > 1)
            <div class="carousel-controls" data-carousel-controls hidden>
                <button class="carousel-arrow" type="button" data-previous aria-label="Film sebelumnya">←</button>
                <div class="carousel-dots" role="group" aria-label="Pilih film">
                    @foreach ($films as $film)
                        <button type="button" data-slide-index="{{ $loop->index }}" aria-label="{{ $film->title }}"
                                @if($loop->first) aria-current="true" @endif>{{ $loop->iteration }}</button>
                    @endforeach
                </div>
                <button class="carousel-arrow" type="button" data-next aria-label="Film berikutnya">→</button>
                <span class="sr-only" aria-live="polite" data-carousel-status></span>
            </div>
        @endif
    </div>
</section>
