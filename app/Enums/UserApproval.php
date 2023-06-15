<?php

namespace App\Enums;

enum UserApproval: int
{
    case PENDING  = 0;
    case APPROVED = 1;
    case DECLINED = 2;

    public function color(): string
    {
        return match ($this) {
            self::APPROVED => 'bg-success',
            self::PENDING  => 'bg-warning',
            self::DECLINED => 'bg-danger',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::APPROVED => 'fe fe-check fe-13',
            self::PENDING  => 'fe fe-eye-off fe-13',
            self::DECLINED => 'fe fe-eye-off fe-13',
        };
    }

    public function lang(): string
    {
        return match ($this) {
            self::APPROVED => __('lang.approved'),
            self::PENDING  => __('lang.pending'),
            self::DECLINED => __('lang.declined'),
        };
    }
}
