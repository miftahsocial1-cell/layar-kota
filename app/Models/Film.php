<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Film extends Model
{
    public $timestamps = false;

    protected function casts(): array
    {
        return ['release_date' => 'immutable_date'];
    }

    public function isComingSoon(): bool
    {
        return $this->release_date !== null
            && $this->release_date->toDateString() > today('Asia/Makassar')->toDateString();
    }

    public function showtimes(): HasMany
    {
        return $this->hasMany(Showtime::class);
    }
}
