<?php
namespace App\Enums;

enum FollowUpStatus: string
{
    case GOZLEYEN = 'GOZLEYEN';
    case TAMAMLANMIS = 'TAMAMLANMIS';
    case KECMIS = 'KECMIS';

    public function label(): string
    {
        return match($this) {
            self::GOZLEYEN => 'Gözləyən',
            self::TAMAMLANMIS => 'Tamamlanmış',
            self::KECMIS => 'Keçmiş',
        };
    }

    public function badgeVariant(): string
    {
        return match($this) {
            self::GOZLEYEN => 'warning',
            self::TAMAMLANMIS => 'success',
            self::KECMIS => 'destructive',
        };
    }
}

