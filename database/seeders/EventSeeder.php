<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::create([
            'title' => 'Показ фильма "Броненосец Потёмкин"',
            'description' => 'Классика советского кинематографа. Режиссер: Сергей Эйзенштейн.',
            'start_time' => now()->addDays(7)->setTime(19, 0, 0),
            'end_time' => now()->addDays(7)->setTime(21, 0, 0),
            'total_tickets' => 50,
            'available_tickets' => 50,
            'price' => 350.00,
           'image' => 'img/gallery/1.jpg',
        ]);

        Event::create([
            'title' => 'Лекция "История русского авангарда в кино"',
            'description' => 'Обзор ключевых фигур и фильмов эпохи авангарда.',
            'start_time' => now()->addDays(14)->setTime(18, 30, 0),
            'end_time' => now()->addDays(14)->setTime(20, 0, 0),
            'total_tickets' => 30,
            'available_tickets' => 30,
            'price' => 250.00,
            'image' => 'img/gallery/1.jpg',
        ]);
         // Остальные события аналогично
        Event::create([
            'title' => 'Театральная постановка "Гамлет"',
            'description' => 'Классическая трагедия Шекспира в современной интерпретации.',
            'start_time' => now()->addDays(35)->setTime(19, 0, 0),
            'end_time' => now()->addDays(35)->setTime(22, 0, 0),
            'total_tickets' => 60,
            'available_tickets' => 60,
            'price' => 600.00,
          'image' => 'img/gallery/1.jpg',
        ]);

        Event::create([
            'title' => 'Показ документального кино',
            'description' => 'Подборка лучших документальных фильмов со всего мира.',
            'start_time' => now()->addDays(42)->setTime(17, 0, 0),
            'end_time' => now()->addDays(42)->setTime(19, 0, 0),
            'total_tickets' => 40,
            'available_tickets' => 40,
            'price' => 300.00,
           'image' => 'img/gallery/1.jpg',
        ]);
    }
}