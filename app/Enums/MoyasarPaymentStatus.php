<?php

namespace App\Enums;

enum MoyasarPaymentStatus: string
{
    case INITIATED = 'initiated';
    case PENDING = 'pending';
    case AUTHORIZED = 'authorized';
    case CAPTURED = 'captured';
    case FAILED = 'failed';
    case REFUNDED = 'refunded';
    case CANCELED = 'canceled';
    case CHARGEBACK = 'chargeback';
    case PAID = 'paid';

    public function color(): string
    {
        return match ($this) {
        
            self::PAID   => 'bg-success',
        };
    }

    public function icon(): string
    {
        return match ($this) {
          
            self::PAID   => 'fe fe-check fe-13',
        };
    }

    public function lang(): string
    {
        return match ($this) {
         
            self::PAID   => __('lang.paid'),
        };
    }
}


