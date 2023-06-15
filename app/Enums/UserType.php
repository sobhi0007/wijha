<?php

namespace App\Enums;

enum UserType: int
{
    case USER = 0; 
    case OWNER = 1;

    public function color(): string
    {
        return match ($this) {
            self::USER  => 'bg-warning',
            self::OWNER => 'bg-succes',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::USER  => 'fe fe-check fe-13',
            self::OWNER => 'fe fe-eye-off fe-13',
        };
    }

    public function lang(): string
    {
        return match ($this) {
            self::USER  => __('lang.user'),
            self::OWNER => __('lang.owner'),
        };
    }
}
