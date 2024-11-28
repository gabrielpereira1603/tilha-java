<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Certifique-se de que o modelo User esteja importado

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        $buyer = User::first();

        DB::table('tickets')->insert([
            'value' => 350.00,
            'buyer' => $buyer->id,
            'belongs_to' => $buyer->id,
            'type' => 'Motorista',
            'car_plate' => 'ABC-1234',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('tickets')->insert([
            'value' => 100.00,
            'buyer' => $buyer->id,
            'belongs_to' => $buyer->id,
            'type' => 'Passageiro',
            'car_plate' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
