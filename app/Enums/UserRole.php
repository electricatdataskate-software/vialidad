<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Htmlable;

enum UserRole: string implements HasLabel
{
    case Admin = 'admin';
    case Supervisor = 'supervisor';
    case User = 'user';

    public function getLabel(): string|Htmlable|null
    {
        return match ($this) {
            self::Admin => 'Admin',
            self::Supervisor => 'Supervisor',
            self::User => 'Usuario',
        };
    }
}
