<?php

namespace App\Enum;

use Illuminate\Support\Carbon;

enum ExpireTime: string
{
    case ONE_MINUTE = '1_min';
    case TWO_MINUTES = '2_min';
    case THREE_MINUTES = '3_min';

    case ONE_HOUR = '1_hour';
    case TWO_HOURS = '2_hours';
    case THREE_HOURS = '3_hours';

    case ONE_DAY = '1_day';
    case TWO_DAYS = '2_day';
    case THREE_DAYS = '3_day';

    case ONE_WEEK = '1_week';
    case TWO_WEEKS = '2_week';
    case THREE_WEEKS = '3_week';

    case ONE_MONTH = '1_month';
    case TWO_MONTHS = '2_month';
    case THREE_MONTHS = '3_month';

    case ONE_YEAR = '1_year';
    case TWO_YEARS = '2_year';
    case THREE_YEARS = '3_year';

    case NONTIME = 'nontime';

    // Get human-readable label
    public function label(): string
    {
        return match ($this) {
            self::ONE_MINUTE => '1 Minute',
            self::TWO_MINUTES => '2 Minutes',
            self::THREE_MINUTES => '3 Minutes',
            self::ONE_HOUR => '1 Hour',
            self::TWO_HOURS => '2 Hours',
            self::THREE_HOURS => '3 Hours',
            self::ONE_DAY => '1 Day',
            self::TWO_DAYS => '2 Days',
            self::THREE_DAYS => '3 Days',
            self::ONE_WEEK => '1 Week',
            self::TWO_WEEKS => '2 Weeks',
            self::THREE_WEEKS => '3 Weeks',
            self::ONE_MONTH => '1 Month',
            self::TWO_MONTHS => '2 Months',
            self::THREE_MONTHS => '3 Months',
            self::ONE_YEAR => '1 Year',
            self::TWO_YEARS => '2 Years',
            self::THREE_YEARS => '3 Years',
            self::NONTIME => 'No Expiry'
        };
    }

    public function getTime(): ?Carbon
    {
        $now = Carbon::now();
        return match ($this) {
            self::ONE_MINUTE => $now->copy()->addMinute(),
            self::TWO_MINUTES => $now->copy()->addMinutes(2),
            self::THREE_MINUTES => $now->copy()->addMinutes(3),

            self::ONE_HOUR => $now->copy()->addHour(),
            self::TWO_HOURS => $now->copy()->addHours(2),
            self::THREE_HOURS => $now->copy()->addHours(3),

            self::ONE_DAY => $now->copy()->addDay(),
            self::TWO_DAYS => $now->copy()->addDays(2),
            self::THREE_DAYS => $now->copy()->addDays(3),

            self::ONE_WEEK => $now->copy()->addWeek(),
            self::TWO_WEEKS => $now->copy()->addWeeks(2),
            self::THREE_WEEKS => $now->copy()->addWeeks(3),

            self::ONE_MONTH => $now->copy()->addMonth(),
            self::TWO_MONTHS => $now->copy()->addMonths(2),
            self::THREE_MONTHS => $now->copy()->addMonths(3),

            self::ONE_YEAR => $now->copy()->addYear(),
            self::TWO_YEARS => $now->copy()->addYears(2),
            self::THREE_YEARS => $now->copy()->addYears(3),

            self::NONTIME => null,
        };
    }
}
