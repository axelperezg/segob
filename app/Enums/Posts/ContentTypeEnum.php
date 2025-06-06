<?php

namespace App\Enums\Posts;

use Filament\Support\Contracts\HasLabel;

enum ContentTypeEnum: int implements HasLabel
{
    case COMMUNIQUE = 1;
    case JOINT_STATEMENT = 2;
    case PRESS_RELEASE = 3;
    case EMERGENCY_DECLARATION = 4;
    case INFORMATIVE_NOTE = 5;
    case INFORMATIVE_CARD = 6;
    case STENOGRAPHIC_VERSION = 7;

    public function getLabel(): string
    {
        return match ($this) {
            self::COMMUNIQUE => 'Comunicado',
            self::JOINT_STATEMENT => 'Comunicado conjunto',
            self::PRESS_RELEASE => 'Comunicado de prensa',
            self::EMERGENCY_DECLARATION => 'Declaratoria de Emergencia',
            self::INFORMATIVE_NOTE => 'Nota informativa',
            self::INFORMATIVE_CARD => 'Tarjeta informativa',
            self::STENOGRAPHIC_VERSION => 'Versión estenográfica',
        };
    }
}
