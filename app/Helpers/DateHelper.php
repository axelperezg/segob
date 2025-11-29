<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    /**
     * Format a date in Spanish format: "DD de MONTH de YYYY"
     * Example: "15 de enero de 2024"
     */
    public static function formatSpanishDate(?string $date): string
    {
        if (!$date) {
            return '';
        }

        $months = [
            1 => 'enero',
            2 => 'febrero',
            3 => 'marzo',
            4 => 'abril',
            5 => 'mayo',
            6 => 'junio',
            7 => 'julio',
            8 => 'agosto',
            9 => 'septiembre',
            10 => 'octubre',
            11 => 'noviembre',
            12 => 'diciembre',
        ];

        $carbon = Carbon::parse($date);
        $day = str_pad($carbon->day, 2, '0', STR_PAD_LEFT);
        $month = $months[$carbon->month];
        $year = $carbon->year;

        return "{$day} de {$month} de {$year}";
    }
}
