<?php

namespace Database\Seeders;

use App\Models\Reports\ViolationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ViolationTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $violationTypes = [
            ['name' => 'Exceso de velocidad', 'description' => 'Conducir a una velocidad superior al límite permitido.'],
            ['name' => 'Conducción bajo los efectos del alcohol', 'description' => 'Conducir con un nivel de alcohol en sangre superior al permitido por la ley.'],
            ['name' => 'Uso del teléfono móvil mientras se conduce', 'description' => 'Utilizar el teléfono móvil para llamar, enviar mensajes o usar aplicaciones mientras se conduce.'],
            ['name' => 'No respetar las señales de tráfico', 'description' => 'Ignorar o no obedecer las señales de tráfico, como semáforos, señales de stop, etc.'],
            ['name' => 'Conducción temeraria', 'description' => 'Realizar maniobras peligrosas o imprudentes que ponen en riesgo la seguridad vial.'],
        ];

        foreach ($violationTypes as $type) {
            ViolationType::create($type);
        }
    }
}
