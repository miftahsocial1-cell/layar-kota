@extends('layouts.cinema')
@use('App\Support\CinemaFormat')

@section('title', 'E-ticket')
@section('body-class', 'ticket-document')

@push('scripts')
    <script src="{{ asset('js/ticket.js') }}" defer></script>
@endpush

@section('content')
    @php($showtime = $reservation->showtime)

    <div class="shell content-section flow ticket-page">
        <div class="ticket-intro">
            <p class="eyebrow">Langkah 3 dari 3</p>
            <h1>E-ticket siap</h1>
            <p class="subheading">Simpan tautan halaman ini untuk membuka kembali bukti pemesananmu.</p>
        </div>
        <article class="ticket" aria-labelledby="ticket-film">
            <header class="ticket-header">
                <p class="eyebrow">Layar Kota / E-ticket</p>
                <h2 id="ticket-film">{{ $showtime->film->title }}</h2>
                <span class="pill pill--confirmed"><span aria-hidden="true">✓</span> Terkonfirmasi</span>
            </header>
            <div class="ticket-body">
                <dl class="ticket-facts">
                    <div><dt>Jadwal tayang</dt><dd>{{ CinemaFormat::date($showtime->starts_at) }}<br>{{ CinemaFormat::time($showtime->starts_at) }}</dd></div>
                    <div><dt>Kursi</dt><dd>{{ $reservation->seats->pluck('seat')->join(', ') }}</dd></div>
                    <div><dt>Nama pemesan</dt><dd>{{ $reservation->name }}</dd></div>
                    <div><dt>Total simulasi</dt><dd>{{ CinemaFormat::rupiah($reservation->seat_price * $reservation->seats->count()) }}</dd></div>
                </dl>
                <div class="ticket-code">
                    <span>Kode reservasi</span>
                    <strong>{{ $reservation->code }}</strong>
                </div>
            </div>
        </article>
        <div class="ticket-actions">
            <button class="button" type="button" data-print-ticket hidden>Cetak e-ticket</button>
            <a class="back-link" href="{{ route('catalog') }}"><span aria-hidden="true">←</span> Kembali ke katalog</a>
        </div>
    </div>
@endsection
