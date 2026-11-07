<?php

namespace App\Support;

use Carbon\CarbonInterface;

class CinemaFormat
{
    public static function rupiah(int $amount): string
    {
        return 'Rp'.number_format($amount, 0, ',', '.');
    }

    public static function date(CarbonInterface $instant): string
    {
        return $instant->copy()->setTimezone('Asia/Makassar')->locale('id')->translatedFormat('l, j F Y');
    }

    public static function time(CarbonInterface $instant): string
    {
        return $instant->copy()->setTimezone('Asia/Makassar')->format('H.i').' WITA';
    }
}
