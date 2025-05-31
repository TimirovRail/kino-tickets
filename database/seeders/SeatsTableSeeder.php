<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Event; // Import the Event model
use App\Models\Seat; // Import the Seat model

class SeatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получаем все мероприятия
        $events = Event::all();

        foreach ($events as $event) {
            // Для каждого мероприятия создаем, например, 20 мест
            for ($i = 1; $i <= 20; $i++) {
                Seat::create([
                    'event_id' => $event->id,
                    'seat_number' => 'Место ' . $i, // Или что-то вроде A1, B2 и т.д.
                    'is_reserved' => false,
                ]);
            }
        }
    }
}