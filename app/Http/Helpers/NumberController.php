<?php

namespace App\Http\Helpers;

use phpDocumentor\Reflection\Types\Mixed_;

/**
 * Class NumberController
 *
 */
class NumberController
{
    /**
     * Format number to international notation.
     *
     * @param float $number
     * @return float
     */
    public static function formatToInternationalNotation(float $number): float
    {
        return $number;
    }

    /**
     * Format number to brazilian notation.
     *
     * @param float $number
     * @return mixed
     */
    public static function formatToBrazilianNotation(float $number)
    {
        if ($number - floor($number) > 0) {
            return number_format($number, 2, ',', '.');
        } else {
            return number_format($number, 0, ',', '.');
        }
    }
}
