<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Reservation;
use App\Models\ReservedSeat;
use App\Models\Showtime;
use Illuminate\Contracts\View\View;
use Illuminate\Database\UniqueConstraintViolationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class CinemaController
{
    public function catalog(): View
    {
        [$comingSoon, $films] = Film::query()->orderBy('id')->get()
            ->partition(fn (Film $film) => $film->isComingSoon());
        $comingSoon = $comingSoon->sortBy('release_date');

        return view('cinema.catalog', compact('films', 'comingSoon'));
    }

    public function detail(Film $film): View
    {
        $showtimes = $film->isComingSoon()
            ? collect()
            : $film->showtimes()->upcoming()->withCount('reservedSeats')->orderBy('starts_at')->get();
        $capacity = count(Showtime::seatLabels());

        return view('cinema.detail', compact('film', 'showtimes', 'capacity'));
    }

    public function booking(Showtime $showtime): View|RedirectResponse
    {
        if ($showtime->film->isComingSoon()) {
            return redirect()->route('films.show', $showtime->film->slug);
        }

        if ($showtime->starts_at->isPast() && ! session()->has('errors')) {
            return redirect()->route('films.show', $showtime->film->slug)
                ->with('notice', 'Jadwal ini sudah dimulai. Silakan pilih jadwal lain.');
        }

        $reserved = $showtime->reservedSeats()->pluck('seat')->all();

        return view('cinema.booking', compact('showtime', 'reserved'));
    }

    public function reserve(Request $request, Showtime $showtime): RedirectResponse
    {
        if ($showtime->film->isComingSoon()) {
            if ($request->expectsJson()) {
                throw ValidationException::withMessages(['seats' => 'Pemesanan dibuka pada hari rilis.']);
            }

            return redirect()->route('films.show', $showtime->film->slug);
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:254'],
            'seats' => ['required', 'list', 'min:1', 'max:'.Showtime::MAX_BOOKING_SEATS],
            'seats.*' => ['bail', 'required', 'string', 'distinct', Rule::in(Showtime::seatLabels())],
        ], [
            'name.required' => 'Masukkan nama pemesan.',
            'name.string' => 'Nama pemesan harus berupa teks.',
            'name.max' => 'Nama pemesan maksimal 100 karakter.',
            'email.required' => 'Masukkan alamat email.',
            'email.string' => 'Alamat email harus berupa teks.',
            'email.email' => 'Masukkan alamat email yang valid.',
            'email.max' => 'Alamat email maksimal 254 karakter.',
            'seats.required' => 'Pilih setidaknya satu kursi.',
            'seats.list' => 'Pilihan kursi tidak valid.',
            'seats.min' => 'Pilih setidaknya satu kursi.',
            'seats.max' => 'Pilih maksimal '.Showtime::MAX_BOOKING_SEATS.' kursi.',
            'seats.*.required' => 'Pilihan kursi tidak valid.',
            'seats.*.string' => 'Pilihan kursi tidak valid.',
            'seats.*.distinct' => 'Pilih setiap kursi satu kali.',
            'seats.*.in' => 'Pilih kursi yang tersedia di denah.',
        ]);

        try {
            $reservation = DB::transaction(function () use ($showtime, $data) {
                $reservation = Reservation::create([
                    'showtime_id' => $showtime->id,
                    'code' => bin2hex(random_bytes(16)),
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'seat_price' => $showtime->price,
                    'confirmed_at' => now(),
                ]);

                if ($showtime->starts_at->lessThanOrEqualTo(now())) {
                    throw ValidationException::withMessages([
                        'seats' => 'Jadwal ini sudah dimulai. Silakan pilih jadwal lain.',
                    ]);
                }

                ReservedSeat::insert(array_map(fn (string $seat) => [
                    'reservation_id' => $reservation->id,
                    'showtime_id' => $showtime->id,
                    'seat' => $seat,
                ], $data['seats']));

                return $reservation;
            });
        } catch (UniqueConstraintViolationException $exception) {
            $taken = $showtime->reservedSeats()->whereIn('seat', $data['seats'])
                ->orderBy('seat')->pluck('seat')->all();

            if ($taken === []) {
                throw $exception;
            }

            throw ValidationException::withMessages([
                'seats' => 'Kursi '.implode(', ', $taken).' sudah terpesan. Silakan tinjau ulang pilihanmu.',
            ]);
        }

        return redirect()->route('tickets.show', $reservation->code);
    }

    public function ticket(Reservation $reservation): Response
    {
        $reservation->load(['showtime.film', 'seats']);

        return response()->view('cinema.ticket', compact('reservation'), 200, [
            'Cache-Control' => 'private, no-store',
            'Referrer-Policy' => 'no-referrer',
            'X-Robots-Tag' => 'noindex',
        ]);
    }
}
