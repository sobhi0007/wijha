<?php

namespace App\Enums;

enum UnitActivation: int
{
    case INACTIVE = 0;
    case ACTIVE = 1;

    public function color(): string
    {
        return match ($this) {
            self::INACTIVE => 'bg-danger',
            self::ACTIVE   => 'bg-success',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::INACTIVE => 'fe fe-x fe-13',
            self::ACTIVE   => 'fe fe-check fe-13',
        };
    }

    public function lang(): string
    {
        return match ($this) {
            self::INACTIVE => __('lang.inactive'),
            self::ACTIVE   => __('lang.active'),
        };
    }
}
