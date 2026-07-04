<?php
namespace App\Enums;

enum PaymentStatus: string
{
    case ODENILDI = 'ODENILDI';
    case GOZLEMEDE = 'GOZLEMEDE';
    case ODENILMEMIS = 'ODENILMEMIS';

    public function label(): string
    {
        return match($this) {
            self::ODENILDI => 'Ödənilib',
            self::GOZLEMEDE => 'Gözləmədə',
            self::ODENILMEMIS => 'Ödənilməmiş',
        };
    }

    public function badgeVariant(): string
    {
        return match($this) {
            self::ODENILDI => 'success',
            self::GOZLEMEDE => 'warning',
            self::ODENILMEMIS => 'destructive',
        };
    }
}

