<?php
namespace App\Enums;

enum DealStatus: string
{
    case ACIQ = 'ACIQ';
    case QAZANILDI = 'QAZANILDI';
    case ITIRILDI = 'ITIRILDI';

    public function label(): string
    {
        return match($this) {
            self::ACIQ => 'Açıq',
            self::QAZANILDI => 'Qazanıldı',
            self::ITIRILDI => 'İtirildi',
        };
    }

    public function badgeVariant(): string
    {
        return match($this) {
            self::QAZANILDI => 'success',
            self::ITIRILDI => 'destructive',
            self::ACIQ => 'secondary',
        };
    }
}

