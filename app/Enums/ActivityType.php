<?php
namespace App\Enums;

enum ActivityType: string
{
    case ZENG = 'ZENG';
    case WHATSAPP = 'WHATSAPP';
    case GORUS = 'GORUS';
    case EMAIL = 'EMAIL';

    public function label(): string
    {
        return match($this) {
            self::ZENG => 'Zəng',
            self::WHATSAPP => 'WhatsApp',
            self::GORUS => 'Görüş',
            self::EMAIL => 'Email',
        };
    }

    public function icon(): string
    {
        return match($this) {
            self::ZENG => '📞',
            self::WHATSAPP => '💬',
            self::GORUS => '🤝',
            self::EMAIL => '📧',
        };
    }
}

