@extends('layouts.cinema')

@push('scripts')
    <script src="{{ asset('js/catalog.js') }}" defer></script>
@endpush

@section('content')
    @include('cinema.carousel')

    <section class="shell content-section" id="film" aria-labelledby="film-title">
        <div class="section-heading">
            <div>
                <p class="eyebrow">Katalog</p>
                <h2 id="film-title">Sedang tayang</h2>
            </div>
            <span class="section-count">{{ $films->count() }} film</span>
        </div>
        <div class="film-grid">
            @forelse ($films as $film)
                @include('cinema.film-card')
            @empty
                <p class="panel empty-state">Belum ada film di katalog.</p>
            @endforelse
        </div>
    </section>

    <section class="coming-soon" id="segera-tayang" aria-labelledby="coming-soon-title">
        <div class="shell content-section">
            <div class="section-heading">
                <div>
                    <p class="eyebrow">Jadwal mendatang</p>
                    <h2 id="coming-soon-title">Segera tayang</h2>
                </div>
                <span class="section-count">{{ $comingSoon->count() }} film</span>
            </div>
            <div class="film-grid">
                @forelse ($comingSoon as $film)
                    @include('cinema.film-card', ['showReleaseDate' => true])
                @empty
                    <p class="panel empty-state">Belum ada film dengan jadwal rilis mendatang.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
