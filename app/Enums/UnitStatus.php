<?php

namespace App\Enums;

enum UnitStatus: int
{
    case REVIEW = 0;
    case PUBLISHED = 1;
    case SUSPENDED = 2;

    public function color(): string
    {
        return match ($this) {
            self::REVIEW    => 'bg-warning',
            self::PUBLISHED => 'bg-success',
            self::SUSPENDED => 'bg-danger',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::REVIEW    => 'fe fe-check fe-13',
            self::PUBLISHED => 'fe fe-check-circle fe-13',
            self::SUSPENDED => 'fe fe-alert-circle fe-13',
        };
    }

    public function lang(): string
    {
        return match ($this) {
            self::REVIEW    => __('lang.review'),
            self::PUBLISHED => __('lang.published'),
            self::SUSPENDED => __('lang.suspended'),
        };
    }
}
