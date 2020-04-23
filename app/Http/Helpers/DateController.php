<?php

namespace App\Http\Helpers;

use Carbon\Carbon;

/**
 * Class DateController
 *
 */
class DateController
{
    /**
     * Format datetime to international notation.
     *
     * @param string $string
     * @return string
     */
    public static function formatToInternationalNotation(string $string): string
    {
        return Carbon::parse($string)->format('Y-m-d a\t H:i:s');
    }

    /**
     * Format datetime to brazilian notation.
     *
     * @param string $string
     * @return string
     */
    public static function formatToBrazilianNotation(string $string): string
    {
        return Carbon::parse($string)->format('d/m/Y à\s H:i:s');
    }
}
