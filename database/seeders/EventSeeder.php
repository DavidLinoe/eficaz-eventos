<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
            'user_id' => 1,
            'title' => 'Evento Teste',
            'description' => 'Descricao do Evento Teste',
            'capacity' => 30,
            'status' => 'active',
            'location' => 'Marilia',
            'starts_at' => now(),

        ]);
    }
}
