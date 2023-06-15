<?php

namespace App\Enums;

enum TimeAvailability: int
{
    case AVAILABLE = 1;
    case NOTAVAILABLE = 0;

    public function color(): string
    {
        return match ($this) {
            self::AVAILABLE    => 'bg-success',
            self::NOTAVAILABLE => 'bg-warning',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::AVAILABLE    => 'fe fe-check fe-13',
            self::NOTAVAILABLE => 'fe fe-alert-circle fe-13',
        };
    }

    public function lang(): string
    {
        return match ($this) {
            self::AVAILABLE    => __('lang.available'),
            self::NOTAVAILABLE => __('lang.not_available'),
        };
    }
}
