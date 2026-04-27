<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TicketType;

class TicketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TicketType::create([
            'name' => 'Tiket Masuk Dewasa (Weekday)',
            'price' => 40000,
            'description' => 'Berlaku Senin - Jumat untuk dewasa'
        ]);

        TicketType::create([
            'name' => 'Tiket Masuk Dewasa (Weekend)',
            'price' => 50000,
            'description' => 'Berlaku Sabtu, Minggu, Hari Libur untuk dewasa'
        ]);

        TicketType::create([
            'name' => 'Tiket Masuk Anak',
            'price' => 30000,
            'description' => 'Berlaku setiap hari untuk anak di bawah 12 tahun'
        ]);
    }
}
