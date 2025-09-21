<?php

namespace App\Filament\Utils;

use Illuminate\Support\Number;
use function config;

/**
 * Currency Helper.
 *
 * This final class provides static methods to retrieve currency
 * configuration values from the `config/currency.php` file.
 * It ensures a consistent way to access currency details
 * throughout the application.
 */
final class Currency
{
    /**
     * Get the currency code from the configuration.
     *
     * @return string The currency code (e.g., 'USD', 'IDR').
     */
    public static function code(): string
    {
        return config('currency.code', 'IDR');
    }

    /**
     * Get the currency locale from the configuration.
     *
     * @return string The currency locale (e.g., 'en_US', 'id_ID').
     */
    public static function locale(): string
    {
        return config('currency.locale', 'id_ID');
    }

    /**
     * Get the currency name from the configuration.
     *
     * @return string The currency name (e.g., 'US Dollar').
     */
    public static function name(): string
    {
        return config('currency.name', 'Rupiah');
    }

    /**
     * Get the currency symbol from the configuration.
     *
     * @return string The currency symbol (e.g., '$', 'Rp').
     */
    public static function symbol(): string
    {
        return config('currency.symbol', 'Rp');
    }

    /**
     * Get the number of decimal places for the currency from the configuration.
     *
     * @return int The currency precision.
     */
    public static function precision(): int
    {
        return (int)config('currency.precision', 2);
    }

    /**
     * Get the minimum allowed amount for the currency.
     *
     * @return float The minimum amount.
     */
    public static function minimumAmount(): float
    {
        return (float)config('currency.minimum_amount', 0);
    }

    /**
     * Get the formatted currency value.
     *
     * @param  float  $number  The value to format.
     * @return string The formatted currency value.
     */
    public static function format(float $number): string
    {
        return Number::currency(
            $number,
            self::code(),
            self::locale(),
            self::precision()
        );
    }

    /**
     * Get the formatted currency value without the currency symbol.
     *
     * @param  float  $number  The value to format.
     * @return string The formatted number without currency symbol.
     */
    public static function numberOnly(float $number): string
    {
        return Number::format(
            number: $number,
            precision: self::precision(),
            locale: self::locale()
        );
    }
}
