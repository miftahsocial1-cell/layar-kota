<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Showtime extends Model
{
    public const ROWS = ['A', 'B', 'C', 'D', 'E'];

    public const SEATS_PER_ROW = 8;

    public const MAX_BOOKING_SEATS = 6;

    public $timestamps = false;

    protected function casts(): array
    {
        return ['starts_at' => 'immutable_datetime'];
    }

    public function film(): BelongsTo
    {
        return $this->belongsTo(Film::class);
    }

    public function reservedSeats(): HasMany
    {
        return $this->hasMany(ReservedSeat::class);
    }

    #[Scope]
    protected function upcoming(Builder $query): void
    {
        $query->where('starts_at', '>', now()->toDateTimeString());
    }

    public static function seatLabels(): array
    {
        $labels = [];

        foreach (self::ROWS as $row) {
            foreach (range(1, self::SEATS_PER_ROW) as $number) {
                $labels[] = $row.$number;
            }
        }

        return $labels;
    }
}
