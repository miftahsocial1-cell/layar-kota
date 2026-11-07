<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reservation extends Model
{
    public $timestamps = false;

    protected $fillable = ['showtime_id', 'code', 'name', 'email', 'seat_price', 'confirmed_at'];

    public function showtime(): BelongsTo
    {
        return $this->belongsTo(Showtime::class);
    }

    public function seats(): HasMany
    {
        return $this->hasMany(ReservedSeat::class)->orderBy('seat');
    }
}
