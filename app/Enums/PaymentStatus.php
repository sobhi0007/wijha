<?php

namespace App\Enums;

enum PaymentStatus: int
{
    case PENDING = 0;
    case COMPLETE = 1;

    public function color(): string
    {
        return match ($this) {
            self::PENDING => 'bg-warning',
            self::COMPLETE   => 'bg-success',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::PENDING => 'fe fe-alert-circle fe-13',
            self::COMPLETE   => 'fe fe-check fe-13',
        };
    }

    public function lang(): string
    {
        return match ($this) {
            self::PENDING => __('lang.pending'),
            self::COMPLETE   => __('lang.complete'),
        };
    }
}
