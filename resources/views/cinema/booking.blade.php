@extends('layouts.cinema')
@use('App\Models\Showtime')
@use('App\Support\CinemaFormat')

@section('title', 'Pemesanan '.$showtime->film->title)

@push('scripts')
    <script src="{{ asset('js/booking.js') }}" defer></script>
@endpush

@section('content')
    @php
        $closed = $showtime->starts_at->lessThanOrEqualTo(now()) || count($reserved) >= count(Showtime::seatLabels());
        $available = array_diff(Showtime::seatLabels(), $reserved);
        $selected = array_values(array_filter(
            $available,
            fn (string $seat) => in_array($seat, (array) old('seats', []), true)
        ));
        $selectionError = $errors->first('seats') ?: $errors->first('seats.*');
    @endphp

    <div class="shell content-section flow">
        <a class="back-link" href="{{ route('films.show', $showtime->film->slug) }}#jadwal"><span aria-hidden="true">←</span> Kembali ke jadwal</a>
        <div>
            <p class="eyebrow">Langkah 2 dari 3</p>
            <h1>Pilih kursimu</h1>
            <p class="subheading">{{ $showtime->film->title }} <span aria-hidden="true">·</span> {{ CinemaFormat::date($showtime->starts_at) }} <span aria-hidden="true">·</span> {{ CinemaFormat::time($showtime->starts_at) }}</p>
        </div>

        <form class="booking-layout" method="post" action="{{ route('bookings.store', $showtime) }}"
              data-booking data-price="{{ $showtime->price }}" data-limit="{{ Showtime::MAX_BOOKING_SEATS }}" data-closed="{{ (int) $closed }}">
            @csrf
            <div class="panel seat-panel">
                <fieldset @disabled($closed) aria-describedby="seat-help @if($selectionError) seat-error @endif">
                    <legend>Denah kursi</legend>
                    <p id="seat-help">Pilih hingga {{ Showtime::MAX_BOOKING_SEATS }} kursi. Kursi terpesan ditandai dengan simbol ×.</p>
                    @if ($selectionError)
                        <p class="field-error notice" id="seat-error" role="alert">{{ $selectionError }}</p>
                    @elseif ($closed)
                        <p class="notice" role="status">{{ $showtime->starts_at->lessThanOrEqualTo(now()) ? 'Jadwal ini sudah dimulai.' : 'Semua kursi sudah terpesan.' }} Silakan pilih jadwal lain.</p>
                    @endif
                    <div class="screen">LAYAR</div>
                    <div class="seat-map">
                        @foreach (Showtime::ROWS as $row)
                            <div class="seat-row">
                                <span class="row-label" aria-hidden="true">{{ $row }}</span>
                                @foreach (range(1, Showtime::SEATS_PER_ROW) as $number)
                                    @php($seat = $row.$number)
                                    @php($taken = in_array($seat, $reserved, true))
                                    <label class="seat @if($taken) seat--taken @endif">
                                        <input type="checkbox" name="seats[]" value="{{ $seat }}"
                                               @checked(in_array($seat, $selected, true)) @disabled($taken)
                                               aria-label="Kursi {{ $seat }}{{ $taken ? ', sudah terpesan' : '' }}">
                                        <span aria-hidden="true">{{ $taken ? '×' : $seat }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <ul class="seat-key" aria-label="Legenda denah">
                        <li><span aria-hidden="true">A1</span> Tersedia</li>
                        <li><span class="key-selected" aria-hidden="true">✓</span> Terpilih</li>
                        <li><span class="key-taken" aria-hidden="true">×</span> Terpesan</li>
                    </ul>
                    <p class="seat-limit" data-seat-limit aria-live="polite"></p>
                </fieldset>
            </div>

            <aside class="panel booking-summary">
                <fieldset @disabled($closed)>
                    <legend>Data pemesan</legend>
                    <label for="name">Nama lengkap</label>
                    <input id="name" name="name" type="text" autocomplete="name" required maxlength="100"
                           value="{{ is_string(old('name')) ? old('name') : '' }}"
                           @error('name') aria-invalid="true" aria-describedby="name-error" @enderror>
                    @error('name')
                        <p class="field-error" id="name-error">{{ $message }}</p>
                    @enderror

                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required maxlength="254"
                           value="{{ is_string(old('email')) ? old('email') : '' }}"
                           @error('email') aria-invalid="true" aria-describedby="email-error" @enderror>
                    @error('email')
                        <p class="field-error" id="email-error">{{ $message }}</p>
                    @enderror
                </fieldset>

                <div class="booking-cost" aria-live="polite" aria-atomic="true">
                    <div><span>Kursi terpilih</span><strong data-seat-count>{{ count($selected) }}</strong></div>
                    <div><span>Nomor kursi</span><strong data-seat-list>{{ $selected ? implode(', ', $selected) : '—' }}</strong></div>
                    <div><span>Harga per kursi</span><strong>{{ CinemaFormat::rupiah($showtime->price) }}</strong></div>
                    <div class="total"><span>Total simulasi</span><strong data-seat-total>{{ CinemaFormat::rupiah(count($selected) * $showtime->price) }}</strong></div>
                </div>
                <button class="button button--wide" type="submit" @disabled($closed)>Konfirmasi pemesanan <span aria-hidden="true">→</span></button>
                <p class="form-footnote">E-ticket terbit setelah reservasi berhasil. Harga ditampilkan untuk simulasi.</p>
            </aside>
        </form>
    </div>
@endsection
