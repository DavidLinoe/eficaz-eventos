<?php

namespace Database\Seeders;

use App\Models\Registration;
use Illuminate\Database\Seeder;

class RegistrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Registration::create([
            "user_id" => 1,
            "event_id" => 1,
            "created_at" => now(),
            "updated_at" => now(),
        ]);
    }
}
