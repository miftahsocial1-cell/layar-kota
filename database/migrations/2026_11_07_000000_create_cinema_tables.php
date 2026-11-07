<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('films', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('genre');
            $table->unsignedSmallInteger('duration');
            $table->text('synopsis');
            $table->string('poster');
        });

        Schema::create('showtimes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('film_id')->constrained();
            $table->dateTime('starts_at');
            $table->unsignedInteger('price');
            $table->unique(['film_id', 'starts_at']);
        });

        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('showtime_id')->constrained();
            $table->string('code', 32)->unique();
            $table->string('name', 100);
            $table->string('email', 254);
            $table->unsignedInteger('seat_price');
            $table->dateTime('confirmed_at');
            $table->unique(['id', 'showtime_id']);
        });

        Schema::create('reserved_seats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reservation_id');
            $table->unsignedBigInteger('showtime_id');
            $table->string('seat', 3);
            $table->foreign(['reservation_id', 'showtime_id'])
                ->references(['id', 'showtime_id'])->on('reservations');
            $table->unique(['showtime_id', 'seat']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reserved_seats');
        Schema::dropIfExists('reservations');
        Schema::dropIfExists('showtimes');
        Schema::dropIfExists('films');
    }
};
