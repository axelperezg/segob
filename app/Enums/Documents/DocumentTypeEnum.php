<?php

namespace App\Enums\Documents;

use Filament\Support\Contracts\HasLabel;

enum DocumentTypeEnum: int implements HasLabel
{
    case INFOGRAPHIC = 1;
    case PRESENTATION = 2;
    case PUBLICATION = 3;

    public function getLabel(): string
    {
        return match ($this) {
            self::INFOGRAPHIC => 'Infografía',
            self::PRESENTATION => 'Presentación',
            self::PUBLICATION => 'Publicación',
        };
    }
}
