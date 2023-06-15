<?php

namespace App\Enums;

enum BookingStatus: int
{
    case DRAFT     = 0;
    case APPROVED  = 1;
    case COMPLETED = 2;
    case REJECTED  = 3;
    case CANCELLED = 4;
    case PENDING   = 5;

    public function color(): string
    {
        return match ($this) {
            self::DRAFT     => 'bg-warning',
            self::APPROVED  => 'bg-primary',
            self::COMPLETED => 'bg-success',
            self::REJECTED  => 'bg-danger',
            self::CANCELLED => 'bg-danger',
            self::PENDING   => 'bg-secondary',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::DRAFT     => 'fe fe-check fe-13',
            self::APPROVED  => 'fe fe-check fe-13',
            self::COMPLETED => 'fe fe-check fe-13',
            self::REJECTED  => 'fe fe-alert-circle fe-13',
            self::CANCELLED => 'fe fe-alert-circle fe-13',
            self::PENDING   => 'fe fe-alert-circle fe-13',
        };
    }

    public function lang(): string
    {
        return match ($this) {
            self::DRAFT     => __('lang.draft'),
            self::APPROVED  => __('lang.approved'),
            self::COMPLETED => __('lang.completed'),
            self::REJECTED  => __('lang.rejected'),
            self::CANCELLED => __('lang.cancelled'),
            self::PENDING   => __('lang.pending'),
        };
    }
}
