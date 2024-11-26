<?php

namespace App\Enums\Documents;

use Filament\Support\Contracts\HasLabel;

enum DocumentSectionEnum: int implements HasLabel
{
    case ZERO_IMPUNITY = 1;
    case SECURITY_REPORTS = 2;

    public function getLabel(): string
    {
        return match ($this) {
            self::ZERO_IMPUNITY => 'Cero impunidad',
            self::SECURITY_REPORTS => 'Informes de seguridad',
        };
    }
}
