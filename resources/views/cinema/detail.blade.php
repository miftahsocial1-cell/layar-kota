@extends('layouts.cinema')
@use('App\Support\CinemaFormat')

@section('title', $film->title)

@section('content')
    <div class="shell content-section flow">
        <a class="back-link" href="{{ route('catalog') }}#film"><span aria-hidden="true">←</span> Katalog film</a>
        <section class="detail-intro" aria-labelledby="film-title">
            @include('cinema.poster')
            <div>
                <p class="eyebrow">Rincian film</p>
                <h1 id="film-title">{{ $film->title }}</h1>
                <p class="film-meta">{{ $film->genre }} <span aria-hidden="true">·</span> {{ $film->duration }} menit</p>
                <p class="synopsis">{{ $film->synopsis }}</p>
                @if ($film->isComingSoon())
                    <p class="notice">
                        <strong>Segera tayang.</strong>
                        Pemesanan dibuka pada <time datetime="{{ $film->release_date->toDateString() }}">{{ CinemaFormat::date($film->release_date) }}</time>.
                    </p>
                @else
                    <a class="button" href="#jadwal">Lihat jadwal <span aria-hidden="true">↓</span></a>
                @endif
            </div>
        </section>

        @unless ($film->isComingSoon())
        <section class="flow" id="jadwal" aria-labelledby="schedule-title">
            <div>
                <p class="eyebrow">Langkah 1 dari 3</p>
                <h2 id="schedule-title">Pilih jadwal tayang</h2>
            </div>
            @if (session('notice'))
                <p class="notice" role="status">{{ session('notice') }}</p>
            @endif
            <div class="schedule-list">
                @forelse ($showtimes as $showtime)
                    @php($remaining = $capacity - $showtime->reserved_seats_count)
                    <article class="panel schedule">
                        <div>
                            <h3>{{ CinemaFormat::date($showtime->starts_at) }}</h3>
                            <p>{{ CinemaFormat::time($showtime->starts_at) }}</p>
                        </div>
                        <div>
                            <strong>{{ CinemaFormat::rupiah($showtime->price) }}</strong>
                            <p>per kursi</p>
                        </div>
                        @if ($remaining > 0)
                            <div>
                                <a class="button" href="{{ route('bookings.create', $showtime) }}"
                                   aria-label="Pilih kursi untuk {{ CinemaFormat::date($showtime->starts_at) }}, {{ CinemaFormat::time($showtime->starts_at) }}">Pilih kursi <span aria-hidden="true">→</span></a>
                                <p class="remaining">{{ $remaining }} kursi tersedia</p>
                            </div>
                        @else
                            <span class="pill pill--sold">Habis</span>
                        @endif
                    </article>
                @empty
                    <p class="panel empty-state">Belum ada jadwal tayang mendatang untuk film ini.</p>
                @endforelse
            </div>
        </section>
        @endunless
    </div>
@endsection
