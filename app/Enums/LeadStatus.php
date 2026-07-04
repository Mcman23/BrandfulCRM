<?php
namespace App\Enums;

enum LeadStatus: string
{
    case YENI_MURACIET = 'YENI_MURACIET';
    case ELAQE_SAXLANILDI = 'ELAQE_SAXLANILDI';
    case GORUS_TEYIN_EDILDI = 'GORUS_TEYIN_EDILDI';
    case TEKLIF_GONDERILDI = 'TEKLIF_GONDERILDI';
    case DANISIQ_GEDIR = 'DANISIQ_GEDIR';
    case QAZANILDI = 'QAZANILDI';
    case ITIRILDI = 'ITIRILDI';

    public function label(): string
    {
        return match($this) {
            self::YENI_MURACIET => 'Yeni müraciət',
            self::ELAQE_SAXLANILDI => 'Əlaqə saxlandı',
            self::GORUS_TEYIN_EDILDI => 'Görüş təyin edildi',
            self::TEKLIF_GONDERILDI => 'Təklif göndərildi',
            self::DANISIQ_GEDIR => 'Danışıq gedir',
            self::QAZANILDI => 'Qazanıldı',
            self::ITIRILDI => 'İtirildi',
        };
    }

    public function color(): string
    {
        return match($this) {
            self::YENI_MURACIET => 'bg-blue-500',
            self::ELAQE_SAXLANILDI => 'bg-purple-500',
            self::DANISIQ_GEDIR => 'bg-yellow-500',
            self::TEKLIF_GONDERILDI => 'bg-orange-500',
            self::GORUS_TEYIN_EDILDI => 'bg-pink-500',
            self::QAZANILDI => 'bg-green-500',
            self::ITIRILDI => 'bg-red-500',
        };
    }

    public static function columns(): array
    {
        return [
            ['status' => self::YENI_MURACIET, 'label' => 'Yeni müraciət', 'color' => 'bg-blue-500'],
            ['status' => self::ELAQE_SAXLANILDI, 'label' => 'Əlaqə saxlandı', 'color' => 'bg-purple-500'],
            ['status' => self::DANISIQ_GEDIR, 'label' => 'Danışıq gedir', 'color' => 'bg-yellow-500'],
            ['status' => self::TEKLIF_GONDERILDI, 'label' => 'Təklif göndərildi', 'color' => 'bg-orange-500'],
            ['status' => self::GORUS_TEYIN_EDILDI, 'label' => 'Görüş təyin edildi', 'color' => 'bg-pink-500'],
            ['status' => self::QAZANILDI, 'label' => 'Qazanıldı', 'color' => 'bg-green-500'],
            ['status' => self::ITIRILDI, 'label' => 'İtirildi', 'color' => 'bg-red-500'],
        ];
    }
}

