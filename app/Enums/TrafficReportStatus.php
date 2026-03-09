<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasLabel;

enum TrafficReportStatus: string
implements HasLabel, HasColor
{
    case Pending = 'pending';
    case UnderReview = 'under_review';
    case Resolved = 'resolved';
    case Rejected = 'rejected';

    public function getLabel(): string
    {
        return match ($this) {
            self::Pending => 'Pendiente',
            self::UnderReview => 'En Revisión',
            self::Resolved => 'Resuelto',
            self::Rejected => 'Rechazado',
        };
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Pending => 'warning',
            self::UnderReview => 'primary',
            self::Resolved => 'success',
            self::Rejected => 'danger'
        };
    }
    /*
    public funtion getDescription(): string
    {
        return match($this) {
            self::Pending => 'Esperando a que los administradores, revisen el caso',
            self::UnderReview => 'Los administradores estan revisando el caso',
            self::Resolved => 'Revision concluida y resultados cargados',
            self::Rejected => 'Caso desestimado'
        };
    }
*/
}
