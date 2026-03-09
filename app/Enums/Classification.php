<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum Classification: string implements HasLabel
{
    case Minor = 'minor';
    case Major = 'major';
    case Severe = 'severe';

    public function getLabel(): string | Htmlable | null
    {
        return match ($this) {
            self::Minor => 'Leve',
            self::Major => 'Grave',
            self::Severe => 'Muy Grave',
        };
    }
}