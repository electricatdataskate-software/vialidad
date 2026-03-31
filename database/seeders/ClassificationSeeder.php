<?php

namespace Database\Seeders;

use App\Models\Reports\Classification;
use Illuminate\Database\Seeder;

class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Leve',
                'description' => 'Infracciones que representan un riesgo mínimo para la seguridad vial, como estacionar en un lugar no permitido o no usar el cinturón de seguridad.',
                'severity_level' => 1000,
                'emails_to_notify' => json_encode(['admin@vialidad.com']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Moderada',
                'description' => 'Infracciones que representan un riesgo moderado para la seguridad vial, como exceder la velocidad permitida o no respetar las señales de tráfico.',
                'severity_level' => 2000,
                'emails_to_notify' => json_encode(['admin@vialidad.com', 'auditorias@vialidad.com']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Grave',
                'description' => 'Infracciones que representan un riesgo grave para la seguridad vial, como conducir en estado de embriaguez o violar las normas de tráfico de manera peligrosa.',
                'severity_level' => 3000,
                'emails_to_notify' => json_encode(['admin@vialidad.com', 'auditorias@vialidad.com', 'policia@vialidad.com']),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        Classification::insert($data);
    }
}
